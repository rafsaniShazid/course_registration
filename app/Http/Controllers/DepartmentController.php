<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    /**
     * Display a listing of departments
     */
    public function index()
    {
        // Load departments with their courses and instructors for statistics
        $departments = Department::with(['courses', 'instructors'])->get();
        return view('departments.index', compact('departments'));
    }

    /**
     * Show the form for creating a new department
     */
    public function create()
    {
        return view('departments.create');
    }

    /**
     * Store a newly created department
     */
    public function store(Request $request)
    {
        $request->validate([
            'dept_name' => 'required|string|max:100|unique:departments',
            'location' => 'nullable|string|max:150'
        ]);

        Department::create($request->all());
        return redirect()->route('departments.index')->with('success', 'Department created successfully!');
    }

    /**
     * Display the specified department with its courses
     */
    public function show(Department $department)
    {
        $department->load(['courses.instructor', 'instructors']);
        return view('departments.show', compact('department'));
    }

    /**
     * Show the form for editing the specified department
     */
    public function edit(Department $department)
    {
        return view('departments.edit', compact('department'));
    }

    /**
     * Update the specified department
     */
    public function update(Request $request, Department $department)
    {
        $request->validate([
            'dept_name' => 'required|string|max:100|unique:departments,dept_name,' . $department->dept_id . ',dept_id',
            'location' => 'nullable|string|max:150'
        ]);

        $department->update($request->all());
        return redirect()->route('departments.index')->with('success', 'Department updated successfully!');
    }

    /**
     * Remove the specified department
     */
    public function destroy(Department $department)
    {
        $department->delete();
        return redirect()->route('departments.index')->with('success', 'Department deleted successfully!');
    }

    /**
     * Show departments with course statistics
     */
    public function withStats()
    {
        $departmentStats = Department::select('departments.*', 
            DB::raw('COUNT(DISTINCT courses.course_id) as course_count'),
            DB::raw('COUNT(DISTINCT instructors.instructor_id) as instructor_count'),
            DB::raw('COUNT(DISTINCT registrations.student_id) as student_count'))
            ->leftJoin('courses', 'departments.dept_id', '=', 'courses.dept_id')
            ->leftJoin('instructors', 'departments.dept_id', '=', 'instructors.dept_id')
            ->leftJoin('registrations', 'courses.course_id', '=', 'registrations.course_id')
            ->groupBy('departments.dept_id', 'departments.dept_name', 'departments.location', 'departments.created_at', 'departments.updated_at')
            ->get();
        
        return view('departments.with-stats', compact('departmentStats'));
    }
}
