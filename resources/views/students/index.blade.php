@extends('layouts.app')

@section('title', 'Student Dashboard')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="display-4 text-primary mb-0">
                        <i class="bi bi-people-fill"></i> Student Dashboard
                    </h1>
                    <p class="text-muted mb-0">Comprehensive student management and analytics</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('students.create') }}" class="btn btn-primary btn-lg">
                        <i class="bi bi-plus-circle"></i> Add Student
                    </a>
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary btn-lg">
                        <i class="bi bi-house"></i> Main Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-lg-6 col-md-6 mb-3">
            <div class="card border-primary h-100">
                <div class="card-body text-center">
                    <div class="display-4 text-primary mb-2">
                        <i class="bi bi-people"></i>
                    </div>
                    <h3 class="card-title">{{ count($students) }}</h3>
                    <p class="card-text text-muted">
                        @if($search ?? false)
                            Filtered Students
                        @else
                            Total Students
                        @endif
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 mb-3">
            <div class="card border-success h-100">
                <div class="card-body text-center">
                    <div class="display-4 text-success mb-2">
                        <i class="bi bi-mortarboard"></i>
                    </div>
                    <h3 class="card-title">6</h3>
                    <p class="card-text text-muted">Departments</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 mb-3">
            <div class="card border-info h-100">
                <div class="card-body text-center">
                    <div class="display-4 text-info mb-2">
                        <i class="bi bi-book"></i>
                    </div>
                    <h3 class="card-title">10+</h3>
                    <p class="card-text text-muted">Query Examples</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 mb-3">
            <div class="card border-warning h-100">
                <div class="card-body text-center">
                    <div class="display-4 text-warning mb-2">
                        <i class="bi bi-graph-up"></i>
                    </div>
                    <h3 class="card-title">15</h3>
                    <p class="card-text text-muted">SQL Topics</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Form -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-light">
                    <h6 class="card-title mb-0">
                        <i class="bi bi-search"></i> Search Students (SQL LIKE Operation)
                    </h6>
                </div>
                <div class="card-body">
                    <form method="GET" class="row g-3">
                        <div class="col-md-6">
                            <label for="search" class="form-label">Search Term</label>
                            <input type="text" name="search" id="search" class="form-control"
                                   placeholder="Enter search term..." value="{{ $search ?? '' }}">
                        </div>
                        <div class="col-md-4">
                            <label for="search_field" class="form-label">Search In</label>
                            <select name="search_field" id="search_field" class="form-select">
                                <option value="name" {{ ($searchField ?? 'name') == 'name' ? 'selected' : '' }}>
                                    Name
                                </option>
                                <option value="email" {{ ($searchField ?? 'name') == 'email' ? 'selected' : '' }}>
                                    Email
                                </option>
                                <option value="major" {{ ($searchField ?? 'name') == 'major' ? 'selected' : '' }}>
                                    Major
                                </option>
                            </select>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary me-2">
                                <i class="bi bi-search"></i> Search
                            </button>
                            @if($search ?? false)
                                <a href="{{ route('students.index') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-x-circle"></i> Clear
                                </a>
                            @endif
                        </div>
                    </form>

                    <!-- SQL Query Display -->
                    <div class="mt-3">
                        <div class="card border-primary">
                            <div class="card-header bg-primary text-white">
                                <h6 class="mb-0">
                                    <i class="bi bi-code-slash"></i> Current SQL Query
                                    @if($search ?? false)
                                        <small class="text-light opacity-75">(LIKE Operation Demo)</small>
                                    @endif
                                </h6>
                            </div>
                            <div class="card-body">
                                <pre class="bg-light p-3 rounded mb-0"><code class="text-dark">{{ $sqlQuery }}</code></pre>
                                @if($search ?? false)
                                    <small class="text-muted mt-2 d-block">
                                        <i class="bi bi-info-circle"></i> Found {{ count($students) }} result(s) matching your search
                                    </small>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Main Content Grid -->
    <div class="row">
        <!-- Student List Section -->
        <div class="col-xl-8 col-lg-7 mb-4">
            <div class="card h-100">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-list-ul"></i> Student Directory
                    </h5>
                </div>
                <div class="card-body">
                    @if(count($students) > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th><i class="bi bi-hash"></i> ID</th>
                                        <th><i class="bi bi-person"></i> Name</th>
                                        <th><i class="bi bi-envelope"></i> Email</th>
                                        <th><i class="bi bi-building"></i> Major</th>
                                        <th><i class="bi bi-calendar"></i> Year</th>
                                        <th><i class="bi bi-gear"></i> Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($students as $student)
                                        <tr>
                                            <td><code>{{ $student->student_id }}</code></td>
                                            <td><strong>{{ $student->name }}</strong></td>
                                            <td><small class="text-muted">{{ $student->email }}</small></td>
                                            <td>
                                                <span class="badge bg-primary">{{ $student->major }}</span>
                                            </td>
                                            <td>Year {{ $student->year }}</td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <a href="{{ route('students.show', $student->student_id) }}"
                                                       class="btn btn-outline-info" title="View Details">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    <a href="{{ route('students.edit', $student->student_id) }}"
                                                       class="btn btn-outline-warning" title="Edit">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <form action="{{ route('students.destroy', $student->student_id) }}"
                                                          method="POST" class="d-inline"
                                                          onsubmit="return confirm('Are you sure you want to delete this student?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-outline-danger" title="Delete">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <div class="display-1 text-muted mb-3">
                                <i class="bi bi-people"></i>
                            </div>
                            <h4>No students found</h4>
                            <p class="text-muted">Get started by adding your first student.</p>
                            <a href="{{ route('students.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus-circle"></i> Add First Student
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Query Examples Sidebar -->
        <div class="col-xl-4 col-lg-5">
            <div class="row">
                <!-- Basic Analytics -->
                <div class="col-12 mb-3">
                    <div class="card h-100">
                        <div class="card-header bg-success text-white">
                            <h6 class="card-title mb-0">
                                <i class="bi bi-bar-chart"></i> Basic Analytics
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                <a href="{{ route('students.by-major') }}" class="btn btn-outline-success btn-sm">
                                    <i class="bi bi-diagram-3"></i> Students by Major
                                </a>
                                <a href="{{ route('students.with-credits') }}" class="btn btn-outline-success btn-sm">
                                    <i class="bi bi-credit-card"></i> Students with Credits
                                </a>
                                <a href="{{ route('students.unregistered') }}" class="btn btn-outline-success btn-sm">
                                    <i class="bi bi-person-dash"></i> Unregistered Students
                                </a>
                                <a href="{{ route('students.top-performers') }}" class="btn btn-outline-success btn-sm">
                                    <i class="bi bi-trophy"></i> Top Performers
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Advanced Queries -->
                <div class="col-12 mb-3">
                    <div class="card h-100">
                        <div class="card-header bg-info text-white">
                            <h6 class="card-title mb-0">
                                <i class="bi bi-gear"></i> Advanced Queries
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                <a href="{{ route('students.course-details') }}" class="btn btn-outline-info btn-sm">
                                    <i class="bi bi-journal-text"></i> Course Details
                                </a>
                                <a href="{{ route('students.semester-performance') }}" class="btn btn-outline-info btn-sm">
                                    <i class="bi bi-calendar-event"></i> Semester Performance
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Set Operations -->
                <div class="col-12 mb-3">
                    <div class="card h-100">
                        <div class="card-header bg-warning text-dark">
                            <h6 class="card-title mb-0">
                                <i class="bi bi-intersect"></i> Set Operations
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                <a href="{{ route('students.union-example') }}" class="btn btn-outline-warning btn-sm">
                                    <i class="bi bi-union"></i> UNION Example
                                </a>
                                <a href="{{ route('students.intersect-example') }}" class="btn btn-outline-warning btn-sm">
                                    <i class="bi bi-intersect"></i> INTERSECT Example
                                </a>
                                <a href="{{ route('students.except-example') }}" class="btn btn-outline-warning btn-sm">
                                    <i class="bi bi-dash-circle"></i> EXCEPT Example
                                </a>
                                <a href="{{ route('students.cartesian-product') }}" class="btn btn-outline-warning btn-sm">
                                    <i class="bi bi-grid"></i> Cartesian Product
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Database Navigation -->
                <div class="col-12 mb-3">
                    <div class="card h-100">
                        <div class="card-header bg-secondary text-white">
                            <h6 class="card-title mb-0">
                                <i class="bi bi-database"></i> Database Sections
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                <a href="{{ route('courses.index') }}" class="btn btn-outline-secondary btn-sm">
                                    <i class="bi bi-book"></i> Courses
                                </a>
                                <a href="{{ route('departments.index') }}" class="btn btn-outline-secondary btn-sm">
                                    <i class="bi bi-building"></i> Departments
                                </a>
                                <a href="{{ route('queries.index') }}" class="btn btn-outline-secondary btn-sm">
                                    <i class="bi bi-code-slash"></i> Query Examples
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Info -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card bg-light">
                <div class="card-body text-center">
                    <h6 class="text-muted mb-2">🎓 Course Registration System</h6>
                    <p class="text-muted small mb-0">
                        Explore SQL concepts through interactive examples •
                        <a href="{{ route('dashboard') }}" class="text-decoration-none">Return to Main Dashboard</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection