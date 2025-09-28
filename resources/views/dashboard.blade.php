@extends('layouts.app')

@section('title', 'Dashboard - Course Registration DB')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">
                <i class="bi bi-speedometer2"></i> 
                Welcome to the Course Registration Dashboard
            </h1>
            <p class="lead text-muted mb-5">
                Different types of queries at your fingertips
            </p>
        </div>
    </div>

    <div class="row">
        <!-- Student Queries -->
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-people"></i> Student Queries
                    </h5>
                </div>
                <div class="card-body">
                    <p class="card-text">Learn GROUP BY, JOINs, and aggregate functions</p>
                    <div class="d-grid gap-2">
                        <a href="{{ route('students.by-major') }}" class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-bar-chart"></i> Students by Major
                        </a>
                        <a href="{{ route('students.with-credits') }}" class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-calculator"></i> Students with Credits
                        </a>
                        <a href="{{ route('students.unregistered') }}" class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-person-x"></i> Unregistered Students
                        </a>
                        <a href="{{ route('students.top-performers') }}" class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-trophy"></i> Top Performers
                        </a>
                    </div>
                </div>
            </div>
        </div>

    

        <!-- Data Management -->
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100">
                <div class="card-header bg-info text-white">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-database"></i> Data Management
                    </h5>
                </div>
                <div class="card-body">
                    <p class="card-text">View and manage your course registration data</p>
                    <div class="d-grid gap-2">
                        <a href="{{ route('students.index') }}" class="btn btn-outline-info btn-sm">
                            <i class="bi bi-people"></i> All Students
                        </a>
                        <a href="{{ route('courses.index') }}" class="btn btn-outline-info btn-sm">
                            <i class="bi bi-book"></i> All Courses
                        </a>
                        <a href="{{ route('departments.index') }}" class="btn btn-outline-info btn-sm">
                            <i class="bi bi-building"></i> Departments
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
@endsection