@extends('layouts.app')

@section('title', 'Students with Course Details')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1><i class="bi bi-people"></i> Students with Course Details</h1>
                <a href="{{ route('students.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Back to Students
                </a>
            </div>

            <div class="alert alert-info">
                <i class="bi bi-info-circle"></i>
                <strong>Query Example:</strong> This view demonstrates a complex SQL query using multiple INNER JOINs 
                to connect students, registrations, courses, departments, and instructors tables.
            </div>

            <!-- Students with Course Details Table -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-diagram-3"></i> Complex JOIN Query Results
                        <small class="text-muted">({{ count($studentCourseDetails) }} records)</small>
                    </h5>
                </div>
                <div class="card-body">
                    @if(count($studentCourseDetails) > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Student Name</th>
                                        <th>Major</th>
                                        <th>Course Title</th>
                                        <th>Department</th>
                                        <th>Instructor</th>
                                        <th>Grade</th>
                                        <th>Semester</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($studentCourseDetails as $detail)
                                        <tr>
                                            <td>
                                                <strong>{{ $detail->student_name }}</strong>
                                            </td>
                                            <td>
                                                <span class="badge bg-info">{{ $detail->major }}</span>
                                            </td>
                                            <td>
                                                <strong class="text-primary">{{ $detail->course_title }}</strong>
                                            </td>
                                            <td>
                                                <small class="text-muted">{{ $detail->dept_name }}</small>
                                            </td>
                                            <td>
                                                <span class="text-success">{{ $detail->instructor_name }}</span>
                                            </td>
                                            <td>
                                                @if($detail->grade)
                                                    @php
                                                        $gradeClass = match($detail->grade) {
                                                            'A+', 'A', 'A-' => 'bg-success',
                                                            'B+', 'B', 'B-' => 'bg-primary',
                                                            'C+', 'C', 'C-' => 'bg-warning',
                                                            'D' => 'bg-danger',
                                                            default => 'bg-secondary'
                                                        };
                                                    @endphp
                                                    <span class="badge {{ $gradeClass }}">{{ $detail->grade }}</span>
                                                @else
                                                    <span class="badge bg-secondary">Pending</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge bg-outline-secondary">{{ $detail->semester }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- SQL Query Display -->
                        <div class="mt-4">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="card-title mb-0">
                                        <i class="bi bi-code-square"></i> SQL Query Used:
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <pre class="bg-light p-3 rounded"><code>SELECT 
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
ORDER BY s.name, r.semester</code></pre>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-warning">
                            <i class="bi bi-exclamation-triangle"></i> 
                            No student course details found. This could mean:
                            <ul class="mb-0 mt-2">
                                <li>No students have registered for courses yet</li>
                                <li>No courses are available in the system</li>
                                <li>Database relationships need to be set up</li>
                            </ul>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Navigation to Other Queries -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Other Query Examples:</h6>
                            <div class="btn-group btn-group-sm flex-wrap" role="group">
                                <a href="{{ route('students.by-major') }}" class="btn btn-outline-primary">
                                    <i class="bi bi-bar-chart"></i> By Major
                                </a>
                                <a href="{{ route('students.with-credits') }}" class="btn btn-outline-primary">
                                    <i class="bi bi-calculator"></i> With Credits
                                </a>
                                <a href="{{ route('students.unregistered') }}" class="btn btn-outline-warning">
                                    <i class="bi bi-person-x"></i> Unregistered
                                </a>
                                <a href="{{ route('students.top-performers') }}" class="btn btn-outline-success">
                                    <i class="bi bi-trophy"></i> Top Performers
                                </a>
                                <a href="{{ route('students.semester-performance') }}" class="btn btn-outline-info">
                                    <i class="bi bi-graph-up"></i> Semester Performance
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection