<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    // Basic CRUD Operations
    
    /**
     * Display a listing of all students
     */
    public function index()
    {
        $students = Student::all();
        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new student
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created student in storage
     */
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'major' => 'required|string|max:255',
            'year' => 'required|integer|between:1,4'
        ]);

        // Create the new student
        Student::create([
            'name' => $request->name,
            'email' => $request->email,
            'major' => $request->major,
            'year' => $request->year
        ]);

        // Redirect back to students list with success message
        return redirect()->route('students.index')->with('success', 'Student added successfully!');
    }

    /**
     * Display the specified student with their registrations - RAW SQL VERSION
     */
    public function show(Student $student)
    {
        // Get student_id from the model
        $studentId = $student->student_id;
        
        // Get complete registration details with one complex query
        $registrationDetails = DB::select("
            SELECT 
                r.reg_id,
                r.semester,
                r.grade,
                r.registered_at,
                c.course_id,
                c.title as course_title,
                c.credits,
                d.dept_name,
                i.instructor_id,
                i.name as instructor_name,
                i.email as instructor_email
            FROM registrations r
            INNER JOIN courses c ON r.course_id = c.course_id
            INNER JOIN departments d ON c.dept_id = d.dept_id  
            INNER JOIN instructors i ON c.instructor_id = i.instructor_id
            WHERE r.student_id = ?
            ORDER BY r.semester, c.title
        ", [$studentId]);
        
        return view('students.show', compact('student', 'registrationDetails'));
    }

    /**
     * Show the form for editing the specified student - RAW SQL VERSION
     */
    public function edit(Student $student)
    {
        // Student is already loaded by route model binding
        // But if you want to use raw SQL for consistency:
        $studentId = $student->student_id;
        $studentData = DB::selectOne("SELECT * FROM students WHERE student_id = ?", [$studentId]);
        
        if (!$studentData) {
            abort(404, 'Student not found');
        }
        
        // Convert stdClass to array for consistency (optional)
        $student = (object) [
            'student_id' => $studentData->student_id,
            'name' => $studentData->name,
            'email' => $studentData->email,
            'major' => $studentData->major,
            'year' => $studentData->year
        ];
        
        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified student - RAW SQL VERSION
     */
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'major' => 'required|string|max:255',
            'year' => 'required|integer|min:1|max:4'
        ]);

        // Get student_id from model
        $studentId = $student->student_id;

        // Check email uniqueness (exclude current student)
        $emailCheck = DB::selectOne("SELECT * FROM students WHERE email = ? AND student_id != ?", 
            [$request->email, $studentId]);
        if ($emailCheck) {
            return back()->withErrors(['email' => 'Email already exists'])->withInput();
        }

        // Update student using raw SQL
        DB::update("UPDATE students SET name = ?, email = ?, major = ?, year = ?, updated_at = NOW() WHERE student_id = ?", [
            $request->name,
            $request->email,
            $request->major,
            $request->year,
            $studentId
        ]);

        return redirect()->route('students.index')->with('success', 'Student updated successfully!');
    }

    /**
     * Remove the specified student - RAW SQL VERSION with CASCADE DELETE
     */
    public function destroy(Student $student)
    {
        // Get the student_id from the model
        $studentId = $student->student_id;
        
        // Get count of registrations for feedback (optional - for user information)
        $registrationCount = DB::selectOne("SELECT COUNT(*) as count FROM registrations WHERE student_id = ?", [$studentId]);
        
        // Use transaction for data integrity
        DB::transaction(function() use ($studentId) {
            // First delete all registrations (CASCADE DELETE manually)
            DB::delete("DELETE FROM registrations WHERE student_id = ?", [$studentId]);
            
            // Then delete the student
            DB::delete("DELETE FROM students WHERE student_id = ?", [$studentId]);
        });
        
        $message = $registrationCount->count > 0 
            ? "Student and {$registrationCount->count} registration(s) deleted successfully!"
            : "Student deleted successfully!";
            
        return redirect()->route('students.index')->with('success', $message);
    }

    // Advanced Query Examples Using Raw SQL for Learning

    /**
     * Students by major with course count - RAW SQL
     */
    public function byMajor()
    {
        $sql = "
            SELECT major, COUNT(*) as student_count 
            FROM students 
            GROUP BY major 
            ORDER BY student_count DESC
        ";
        
        $studentsByMajor = DB::select($sql);
        
        return view('students.by-major', compact('studentsByMajor'));
    }

    /**
     * Students with their total credits - RAW SQL with LEFT JOIN
     */
    public function withCredits()
    {
        $sql = "
            SELECT 
                s.*,
                COALESCE(SUM(c.credits), 0) as total_credits
            FROM students s
            LEFT JOIN registrations r ON s.student_id = r.student_id
            LEFT JOIN courses c ON r.course_id = c.course_id
            GROUP BY s.student_id, s.name, s.email, s.major, s.year, s.created_at, s.updated_at
            ORDER BY total_credits DESC
        ";
        
        $studentsWithCredits = DB::select($sql);
        
        return view('students.with-credits', compact('studentsWithCredits'));
    }

    /**
     * Students who haven't registered for any courses - RAW SQL with NOT EXISTS
     */
    public function unregistered()
    {
        $sql = "
            SELECT * 
            FROM students s
            WHERE NOT EXISTS (
                SELECT 1 
                FROM registrations r 
                WHERE r.student_id = s.student_id
            )
        ";
        
        $unregisteredStudents = DB::select($sql);
        
        return view('students.unregistered', compact('unregisteredStudents'));
    }

    /**
     * Top performing students by grade - RAW SQL with CASE statement
     */
    public function topPerformers()
    {
        $sql = "
            SELECT 
                s.*,
                AVG(
                    CASE 
                        WHEN r.grade = 'A+' THEN 4.0
                        WHEN r.grade = 'A' THEN 3.75
                        WHEN r.grade = 'A-' THEN 3.5
                        WHEN r.grade = 'B+' THEN 3.25
                        WHEN r.grade = 'B' THEN 3.0
                        WHEN r.grade = 'B-' THEN 2.75
                        WHEN r.grade = 'C+' THEN 2.5
                        WHEN r.grade = 'C' THEN 2.25
                        WHEN r.grade = 'C-' THEN 2
                        WHEN r.grade = 'D' THEN 1.75
                        ELSE 0
                    END
                ) as gpa
            FROM students s
            INNER JOIN registrations r ON s.student_id = r.student_id
            WHERE r.grade IS NOT NULL
            GROUP BY s.student_id, s.name, s.email, s.major, s.year, s.created_at, s.updated_at
            ORDER BY gpa DESC
        ";
        
        $topStudents = DB::select($sql);
        
        return view('students.top-performers', compact('topStudents'));
    }

    /**
     * Advanced Query: Students with course details - RAW SQL with multiple JOINs
     */
    public function withCourseDetails()
    {
        $sql = "
            SELECT 
                s.name as student_name,
                s.major,
                c.title as course_title,
                d.dept_name,
                i.name as instructor_name,
                r.grade,
                r.semester
            FROM students s
            INNER JOIN registrations r ON s.student_id = r.student_id
            INNER JOIN courses c ON r.course_id = c.course_id
            INNER JOIN departments d ON c.dept_id = d.dept_id
            INNER JOIN instructors i ON c.instructor_id = i.instructor_id
            ORDER BY s.name, r.semester
        ";
        
        $studentCourseDetails = DB::select($sql);
        
        return view('students.course-details', compact('studentCourseDetails'));
    }

    /**
     * Complex Query: Students with semester-wise performance
     */
    public function semesterPerformance()
    {
        $sql = "
            SELECT 
                s.name as student_name,
                r.semester,
                COUNT(r.reg_id) as courses_taken,
                AVG(
                    CASE 
                        WHEN r.grade = 'A+' THEN 4.0
                        WHEN r.grade = 'A' THEN 3.75
                        WHEN r.grade = 'A-' THEN 3.5
                        WHEN r.grade = 'B+' THEN 3.25
                        WHEN r.grade = 'B' THEN 3.0
                        WHEN r.grade = 'B-' THEN 2.75
                        WHEN r.grade = 'C+' THEN 2.5
                        WHEN r.grade = 'C' THEN 2.25
                        WHEN r.grade = 'C-' THEN 2
                        WHEN r.grade = 'D' THEN 1.75
                        ELSE 0
                    END
                ) as semester_gpa,
                SUM(c.credits) as total_credits
            FROM students s
            INNER JOIN registrations r ON s.student_id = r.student_id
            INNER JOIN courses c ON r.course_id = c.course_id
            WHERE r.grade IS NOT NULL
            GROUP BY s.student_id, s.name, r.semester
            ORDER BY s.name, r.semester
        ";
        
        $semesterPerformance = DB::select($sql);
        
        return view('students.semester-performance', compact('semesterPerformance'));
    }
}
