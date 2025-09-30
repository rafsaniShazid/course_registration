<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CourseController extends Controller
{
    public function index(){
        $sql = "SELECT course_id,title,credits FROM courses";
        $courses = DB::select($sql);
        return view('courses.index', ['courses' => $courses]);
    }

    /**
     * Show the form for creating a new course.
     */
    public function create()
    {
        // Get all departments for the dropdown
        $departments = DB::select("SELECT dept_id, dept_name FROM departments ORDER BY dept_name");
        return view('courses.create', ['departments' => $departments]);
    }

    /**
     * Store a newly created course in storage.
     */
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'course_id' => 'required|string|max:10|unique:courses,course_id',
            'title' => 'required|string|max:255',
            'credits' => 'required|integer|min:1|max:6',
            'dept_id' => 'required|integer|exists:departments,dept_id'
        ], [
            'course_id.required' => 'Course ID is required.',
            'course_id.unique' => 'This Course ID already exists. Please choose a different one.',
            'course_id.max' => 'Course ID must not exceed 10 characters.',
            'title.required' => 'Course title is required.',
            'title.max' => 'Course title must not exceed 255 characters.',
            'credits.required' => 'Credits field is required.',
            'credits.integer' => 'Credits must be a whole number (no decimals like 2.0).',
            'credits.min' => 'Credits must be at least 1.',
            'credits.max' => 'Credits cannot exceed 6.',
            'dept_id.required' => 'Department is required.',
            'dept_id.exists' => 'Selected department does not exist.'
        ]);

        // Insert new course using raw SQL
        try {
            $result = DB::insert("INSERT INTO courses (course_id, title, credits, dept_id, created_at, updated_at) VALUES (?, ?, ?, ?, NOW(), NOW())", [
                $request->course_id,
                $request->title,
                $request->credits,
                $request->dept_id
            ]);

            if ($result) {
                return redirect()->route('courses.index')->with('success', 
                    "Course '{$request->title}' ({$request->course_id}) has been created successfully!");
            } else {
                return redirect()->back()->with('error', 'Failed to create course. Please try again.')
                    ->withInput();
            }
        } catch (\Exception $e) {
            // Handle database errors
            return redirect()->back()->with('error', 'Error creating course: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function edit($course)  // $course = "CS101"
    {
        // Find course with ID "CS101"
        $sql = "SELECT course_id,title,credits FROM courses WHERE course_id = ?";
        $course = DB::selectOne($sql, [$course]);
        if (!$course) {
            abort(404);
        }
        // Show edit form
        return view('courses.edit', ['course' => $course]); 
    }

    public function update(Request $request, $course)
    {
        // Get the course ID from the parameter
        $courseId = $course;
        
        // Validate the form data
        $request->validate([
            'title' => 'required|string|max:255',
            'credits' => 'required|integer|min:1|max:6'
        ], [
            'title.required' => 'Course title is required.',
            'title.max' => 'Course title must not exceed 255 characters.',
            'credits.required' => 'Credits field is required.',
            'credits.integer' => 'Credits must be a whole number (no decimals like 2.0).',
            'credits.min' => 'Credits must be at least 1.',
            'credits.max' => 'Credits cannot exceed 6.'
        ]);

        // Check if course exists
        $existingCourse = DB::selectOne("SELECT * FROM courses WHERE course_id = ?", [$courseId]);
        if (!$existingCourse) {
            abort(404, 'Course not found');
        }

        // Update course using raw SQL
        $result = DB::update("UPDATE courses SET title = ?, credits = ?, updated_at = NOW() WHERE course_id = ?", [
            $request->title,
            $request->credits,
            $courseId
        ]);

        return redirect()->route('courses.index')->with('success', 'Course updated successfully!');
    }

    /**
     * Remove the specified course from storage.
     */
    public function destroy($courseId)
    {
        // First check if course exists
        $course = DB::selectOne("SELECT * FROM courses WHERE course_id = ?", [$courseId]);
        if (!$course) {
            abort(404, 'Course not found');
        }

        // Check if course has any registrations (students enrolled)
        $registrations = DB::select("SELECT COUNT(*) as count FROM registrations WHERE course_id = ?", [$courseId]);
        $registrationCount = $registrations[0]->count;

        if ($registrationCount > 0) {
            return redirect()->route('courses.index')->with('error', 
                "Cannot delete course '{$course->title}' because {$registrationCount} student(s) are enrolled in it.");
        }

        // Delete the course using raw SQL
        $result = DB::delete("DELETE FROM courses WHERE course_id = ?", [$courseId]);

        if ($result) {
            return redirect()->route('courses.index')->with('success', 
                "Course '{$course->title}' has been deleted successfully!");
        } else {
            return redirect()->route('courses.index')->with('error', 'Failed to delete course. Please try again.');
        }
    }
}
