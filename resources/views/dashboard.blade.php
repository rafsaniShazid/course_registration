@extends('layouts.app')

@section('title', 'Main Dashboard - Course Registration System')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="display-4 text-primary mb-0">
                        <i class="bi bi-speedometer2"></i> Course Registration System
                    </h1>
                    <p class="text-muted mb-0">Interactive SQL Learning & Database Management</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('students.create') }}" class="btn btn-success btn-lg">
                        <i class="bi bi-plus-circle"></i> Quick Add
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Overview -->
    <div class="row mb-4">
        <div class="col-xl-3 col-lg-6 col-md-6 mb-3">
            <div class="card border-primary h-100">
                <div class="card-body text-center">
                    <div class="display-4 text-primary mb-2">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <h3 class="card-title">Students</h3>
                    <p class="card-text text-muted">Student Management</p>
                    <a href="{{ route('students.index') }}" class="btn btn-primary">View All</a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 mb-3">
            <div class="card border-success h-100">
                <div class="card-body text-center">
                    <div class="display-4 text-success mb-2">
                        <i class="bi bi-book-fill"></i>
                    </div>
                    <h3 class="card-title">Courses</h3>
                    <p class="card-text text-muted">Course Catalog</p>
                    <a href="{{ route('courses.index') }}" class="btn btn-success">View All</a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 mb-3">
            <div class="card border-info h-100">
                <div class="card-body text-center">
                    <div class="display-4 text-info mb-2">
                        <i class="bi bi-building-fill"></i>
                    </div>
                    <h3 class="card-title">Departments</h3>
                    <p class="card-text text-muted">Academic Units</p>
                    <a href="{{ route('departments.index') }}" class="btn btn-info">View All</a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 mb-3">
            <div class="card border-warning h-100">
                <div class="card-body text-center">
                    <div class="display-4 text-warning mb-2">
                        <i class="bi bi-code-slash"></i>
                    </div>
                    <h3 class="card-title">SQL Queries</h3>
                    <p class="card-text text-muted">Interactive Examples</p>
                    <a href="{{ route('queries.index') }}" class="btn btn-warning">Explore</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Feature Grid -->
    <div class="row">
        <!-- Student Analytics Section -->
        <div class="col-xl-6 col-lg-6 mb-4">
            <div class="card h-100">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-graph-up"></i> Student Analytics & Reports
                    </h5>
                </div>
                <div class="card-body">
                    <p class="card-text">Explore student data through various analytical queries and reports.</p>
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="text-primary mb-2">📊 Basic Analytics</h6>
                            <div class="d-grid gap-1 mb-3">
                                <a href="{{ route('students.by-major') }}" class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-bar-chart"></i> By Major
                                </a>
                                <a href="{{ route('students.with-credits') }}" class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-calculator"></i> With Credits
                                </a>
                                <a href="{{ route('students.unregistered') }}" class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-person-x"></i> Unregistered
                                </a>
                                <a href="{{ route('students.top-performers') }}" class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-trophy"></i> Top Performers
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-success mb-2">🔧 Advanced Queries</h6>
                            <div class="d-grid gap-1 mb-3">
                                <a href="{{ route('students.course-details') }}" class="btn btn-outline-success btn-sm">
                                    <i class="bi bi-journal-text"></i> Course Details
                                </a>
                                <a href="{{ route('students.semester-performance') }}" class="btn btn-outline-success btn-sm">
                                    <i class="bi bi-calendar-event"></i> Semester Perf.
                                </a>
                            </div>
                            <h6 class="text-warning mb-2">⚡ Set Operations</h6>
                            <div class="d-grid gap-1">
                                <a href="{{ route('students.union-example') }}" class="btn btn-outline-warning btn-sm">
                                    <i class="bi bi-union"></i> UNION
                                </a>
                                <a href="{{ route('students.intersect-example') }}" class="btn btn-outline-warning btn-sm">
                                    <i class="bi bi-intersect"></i> INTERSECT
                                </a>
                                <a href="{{ route('students.except-example') }}" class="btn btn-outline-warning btn-sm">
                                    <i class="bi bi-dash-circle"></i> EXCEPT
                                </a>
                                <a href="{{ route('students.cartesian-product') }}" class="btn btn-outline-warning btn-sm">
                                    <i class="bi bi-grid"></i> Cartesian
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Database Management Section -->
        <div class="col-xl-6 col-lg-6 mb-4">
            <div class="card h-100">
                <div class="card-header bg-success text-white">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-database-gear"></i> Database Management
                    </h5>
                </div>
                <div class="card-body">
                    <p class="card-text">Manage your course registration data with full CRUD operations.</p>
                    <div class="row">
                        <div class="col-md-4">
                            <h6 class="text-primary mb-2">👥 Students</h6>
                            <div class="d-grid gap-1 mb-3">
                                <a href="{{ route('students.index') }}" class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-list"></i> View All
                                </a>
                                <a href="{{ route('students.create') }}" class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-plus"></i> Add New
                                </a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h6 class="text-success mb-2">📚 Courses</h6>
                            <div class="d-grid gap-1 mb-3">
                                <a href="{{ route('courses.index') }}" class="btn btn-outline-success btn-sm">
                                    <i class="bi bi-list"></i> View All
                                </a>
                                <a href="{{ route('courses.create') }}" class="btn btn-outline-success btn-sm">
                                    <i class="bi bi-plus"></i> Add New
                                </a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h6 class="text-info mb-2">🏢 Departments</h6>
                            <div class="d-grid gap-1 mb-3">
                                <a href="{{ route('departments.index') }}" class="btn btn-outline-info btn-sm">
                                    <i class="bi bi-list"></i> View All
                                </a>
                                <a href="{{ route('departments.create') }}" class="btn btn-outline-info btn-sm">
                                    <i class="bi bi-plus"></i> Add New
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SQL Learning Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-mortarboard-fill"></i> SQL Learning Hub
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <div class="text-center">
                                <div class="display-4 text-primary mb-2">
                                    <i class="bi bi-table"></i>
                                </div>
                                <h6>Database Design</h6>
                                <p class="small text-muted">Tables, relationships, constraints</p>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="text-center">
                                <div class="display-4 text-success mb-2">
                                    <i class="bi bi-search"></i>
                                </div>
                                <h6>Query Fundamentals</h6>
                                <p class="small text-muted">SELECT, WHERE, JOIN operations</p>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="text-center">
                                <div class="display-4 text-warning mb-2">
                                    <i class="bi bi-gear"></i>
                                </div>
                                <h6>Advanced SQL</h6>
                                <p class="small text-muted">Aggregates, subqueries, set operations</p>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="text-center">
                                <div class="display-4 text-danger mb-2">
                                    <i class="bi bi-lightbulb"></i>
                                </div>
                                <h6>Real-world Examples</h6>
                                <p class="small text-muted">Interactive learning with live data</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions Footer -->
    <div class="row">
        <div class="col-12">
            <div class="card bg-light">
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-3 mb-2">
                            <a href="{{ route('queries.index') }}" class="btn btn-outline-primary btn-lg w-100">
                                <i class="bi bi-code-slash"></i><br>
                                <small>Query Examples</small>
                            </a>
                        </div>
                        <div class="col-md-3 mb-2">
                            <a href="{{ route('students.index') }}" class="btn btn-outline-success btn-lg w-100">
                                <i class="bi bi-people"></i><br>
                                <small>Student Dashboard</small>
                            </a>
                        </div>
                        <div class="col-md-3 mb-2">
                            <a href="{{ route('courses.index') }}" class="btn btn-outline-info btn-lg w-100">
                                <i class="bi bi-book"></i><br>
                                <small>Course Catalog</small>
                            </a>
                        </div>
                        <div class="col-md-3 mb-2">
                            <a href="{{ route('departments.index') }}" class="btn btn-outline-warning btn-lg w-100">
                                <i class="bi bi-building"></i><br>
                                <small>Departments</small>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- System Info Footer -->
    <div class="row mt-3">
        <div class="col-12">
            <div class="text-center text-muted">
                <small>
                    🎓 Course Registration System • Built with Laravel & MySQL •
                    <a href="https://github.com/rafsaniShazid/course_registration" target="_blank" class="text-decoration-none">
                        <i class="bi bi-github"></i> View Source
                    </a>
                </small>
            </div>
        </div>
    </div>
</div>
@endsection