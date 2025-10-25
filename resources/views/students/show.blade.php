@extends('layouts.app')

@section('title', 'Student Details - ' . $student->name)

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="display-4 text-primary mb-0">
                        <i class="bi bi-person-circle"></i> Student Details
                    </h1>
                    <p class="text-muted mb-0">Complete academic profile and course history</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('students.edit', $student->student_id) }}" class="btn btn-warning btn-lg">
                        <i class="bi bi-pencil-square"></i> Edit Student
                    </a>
                    <a href="{{ route('students.index') }}" class="btn btn-outline-secondary btn-lg">
                        <i class="bi bi-arrow-left"></i> Back to Students
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Student Information Cards -->
    <div class="row mb-4">
        <!-- Basic Information -->
        <div class="col-xl-4 col-lg-6 mb-3">
            <div class="card h-100 border-primary">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-person-fill"></i> Basic Information
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <strong>Student ID:</strong>
                        </div>
                        <div class="col-sm-8">
                            <code class="text-primary">{{ $student->student_id }}</code>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-4">
                            <strong>Name:</strong>
                        </div>
                        <div class="col-sm-8">
                            <h5 class="text-primary mb-0">{{ $student->name }}</h5>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-4">
                            <strong>Email:</strong>
                        </div>
                        <div class="col-sm-8">
                            <a href="mailto:{{ $student->email }}" class="text-decoration-none">
                                {{ $student->email }}
                            </a>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-4">
                            <strong>Major:</strong>
                        </div>
                        <div class="col-sm-8">
                            <span class="badge bg-success fs-6">{{ $student->major }}</span>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-4">
                            <strong>Year:</strong>
                        </div>
                        <div class="col-sm-8">
                            <span class="badge bg-info">Year {{ $student->year }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Academic Statistics -->
        <div class="col-xl-4 col-lg-6 mb-3">
            <div class="card h-100 border-success">
                <div class="card-header bg-success text-white">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-graph-up"></i> Academic Statistics
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6">
                            <div class="display-4 text-success mb-2">
                                {{ count($registrationDetails) }}
                            </div>
                            <small class="text-muted">Total Courses</small>
                        </div>
                        <div class="col-6">
                            <div class="display-4 text-info mb-2">
                                {{ count(array_filter($registrationDetails, fn($r) => !empty($r->grade))) }}
                            </div>
                            <small class="text-muted">Completed</small>
                        </div>
                    </div>
                    <hr>
                    @php
                        $totalCredits = array_sum(array_column($registrationDetails, 'credits'));
                        $completedCredits = array_sum(array_map(fn($r) => (!empty($r->grade)) ? $r->credits : 0, $registrationDetails));
                        $gpa = 0;
                        $gradedCourses = array_filter($registrationDetails, fn($r) => !empty($r->grade));
                        if (count($gradedCourses) > 0) {
                            $totalPoints = 0;
                            foreach ($gradedCourses as $reg) {
                                $points = match($reg->grade) {
                                    'A+' => 4.0, 'A' => 3.75, 'A-' => 3.5,
                                    'B+' => 3.25, 'B' => 3.0, 'B-' => 2.75,
                                    'C+' => 2.5, 'C' => 2.25, 'C-' => 2.0,
                                    'D' => 1.75, default => 0
                                };
                                $totalPoints += $points;
                            }
                            $gpa = round($totalPoints / count($gradedCourses), 2);
                        }
                    @endphp
                    <div class="row">
                        <div class="col-6">
                            <strong>Total Credits:</strong><br>
                            <span class="h5 text-success">{{ $totalCredits }}</span>
                        </div>
                        <div class="col-6">
                            <strong>Completed:</strong><br>
                            <span class="h5 text-info">{{ $completedCredits }}</span>
                        </div>
                    </div>
                    <hr>
                    <div class="text-center">
                        <strong>Current GPA:</strong><br>
                        <span class="display-6 text-warning">{{ $gpa > 0 ? $gpa : 'N/A' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="col-xl-4 col-lg-12 mb-3">
            <div class="card h-100 border-info">
                <div class="card-header bg-info text-white">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-gear"></i> Quick Actions
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('students.edit', $student->student_id) }}" class="btn btn-warning">
                            <i class="bi bi-pencil-square"></i> Edit Student Information
                        </a>
                        <button class="btn btn-outline-primary" onclick="window.print()">
                            <i class="bi bi-printer"></i> Print Academic Record
                        </button>
                        <a href="mailto:{{ $student->email }}" class="btn btn-outline-success">
                            <i class="bi bi-envelope"></i> Send Email
                        </a>
                        <a href="{{ route('students.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-people"></i> View All Students
                        </a>
                    </div>
                    <hr>
                    <div class="text-center">
                        <small class="text-muted">
                            <i class="bi bi-clock"></i> Last updated: {{ $student->updated_at ? $student->updated_at->format('M d, Y') : 'Never' }}
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Course Registration History -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-journal-text"></i> Course Registration History
                    </h5>
                </div>
                <div class="card-body">
                    @if(count($registrationDetails) > 0)
                        <!-- SQL Query Display -->
                        <div class="alert alert-light border">
                            <h6 class="alert-heading">
                                <i class="bi bi-code-slash"></i> SQL Query Used
                            </h6>
                            <pre class="mb-0 small"><code>SELECT
    r.reg_id, r.semester, r.grade, r.registered_at,
    c.course_id, c.title as course_title, c.credits,
    d.dept_name, i.name as instructor_name
FROM registrations r
INNER JOIN courses c ON r.course_id = c.course_id
INNER JOIN departments d ON c.dept_id = d.dept_id
INNER JOIN instructors i ON c.instructor_id = i.instructor_id
WHERE r.student_id = '{{ $student->student_id }}'
ORDER BY r.semester, c.title;</code></pre>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th><i class="bi bi-hash"></i> Reg ID</th>
                                        <th><i class="bi bi-calendar-event"></i> Semester</th>
                                        <th><i class="bi bi-book"></i> Course</th>
                                        <th><i class="bi bi-building"></i> Department</th>
                                        <th><i class="bi bi-person"></i> Instructor</th>
                                        <th><i class="bi bi-star"></i> Grade</th>
                                        <th><i class="bi bi-credit-card"></i> Credits</th>
                                        <th><i class="bi bi-calendar"></i> Registered</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($registrationDetails as $registration)
                                        <tr>
                                            <td><code>{{ $registration->reg_id }}</code></td>
                                            <td>
                                                <span class="badge bg-primary">{{ $registration->semester }}</span>
                                            </td>
                                            <td>
                                                <strong>{{ $registration->course_id }}</strong><br>
                                                <small class="text-muted">{{ $registration->course_title }}</small>
                                            </td>
                                            <td>
                                                <span class="badge bg-secondary">{{ $registration->dept_name }}</span>
                                            </td>
                                            <td>
                                                <strong>{{ $registration->instructor_name }}</strong><br>
                                                <small class="text-muted">{{ $registration->instructor_email }}</small>
                                            </td>
                                            <td>
                                                @if($registration->grade)
                                                    <span class="badge bg-{{ match($registration->grade) {
                                                        'A+', 'A', 'A-' => 'success',
                                                        'B+', 'B', 'B-' => 'primary',
                                                        'C+', 'C', 'C-' => 'warning',
                                                        'D' => 'danger',
                                                        default => 'secondary'
                                                    } }} fs-6">
                                                        {{ $registration->grade }}
                                                    </span>
                                                @else
                                                    <span class="badge bg-light text-dark">In Progress</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge bg-info">{{ $registration->credits }}</span>
                                            </td>
                                            <td>
                                                <small class="text-muted">
                                                    {{ \Carbon\Carbon::parse($registration->registered_at)->format('M d, Y') }}
                                                </small>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Summary Statistics -->
                        <div class="row mt-3">
                            <div class="col-md-3">
                                <div class="card border-success">
                                    <div class="card-body text-center">
                                        <h4 class="text-success">{{ count($registrationDetails) }}</h4>
                                        <small class="text-muted">Total Registrations</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card border-info">
                                    <div class="card-body text-center">
                                        <h4 class="text-info">{{ $totalCredits }}</h4>
                                        <small class="text-muted">Total Credits</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card border-warning">
                                    <div class="card-body text-center">
                                        <h4 class="text-warning">{{ count(array_unique(array_column($registrationDetails, 'semester'))) }}</h4>
                                        <small class="text-muted">Semesters</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card border-primary">
                                    <div class="card-body text-center">
                                        <h4 class="text-primary">{{ count(array_unique(array_column($registrationDetails, 'dept_name'))) }}</h4>
                                        <small class="text-muted">Departments</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <div class="display-1 text-muted mb-3">
                                <i class="bi bi-journal-x"></i>
                            </div>
                            <h4>No course registrations found</h4>
                            <p class="text-muted">This student hasn't registered for any courses yet.</p>
                            <div class="alert alert-info">
                                <i class="bi bi-info-circle"></i> Students can register for courses through the course registration system.
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card bg-light">
                <div class="card-body text-center">
                    <h6 class="text-muted mb-2">📚 Student Academic Profile</h6>
                    <p class="text-muted small mb-0">
                        Complete course history and academic performance •
                        <a href="{{ route('students.index') }}" class="text-decoration-none">Back to Student Directory</a> •
                        <a href="{{ route('dashboard') }}" class="text-decoration-none">Main Dashboard</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
@media print {
    .btn, .card-header .btn, nav, .d-flex.justify-content-between {
        display: none !important;
    }
    .card {
        border: 1px solid #dee2e6 !important;
        box-shadow: none !important;
    }
}
</style>
@endsection