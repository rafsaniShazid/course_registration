@extends('layouts.app')
@section('title', 'All Departments')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1><i class="bi bi-building"></i> All Departments</h1>
                <div>
                    <a href="{{ route('departments.create') }}" class="btn btn-primary me-2">
                        <i class="bi bi-plus-circle"></i> Add New Department
                    </a>
                    <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Back to Dashboard
                    </a>
                </div>
            </div>

            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-circle"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Departments Grid -->
            @if(count($departments) > 0)
                <div class="row">
                    @foreach($departments as $department)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card h-100 shadow-sm">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="card-title mb-0">
                                        <i class="bi bi-building"></i> {{ $department->dept_name }}
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <strong><i class="bi bi-geo-alt"></i> Location:</strong>
                                        <p class="text-muted mb-0">{{ $department->location ?: 'Not specified' }}</p>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <strong><i class="bi bi-person-badge"></i> Department ID:</strong>
                                        <span class="badge bg-info">{{ $department->dept_id }}</span>
                                    </div>

                                    <!-- Department Statistics -->
                                    <div class="row text-center mb-3">
                                        <div class="col-6">
                                            <div class="border rounded p-2">
                                                <h6 class="text-primary mb-1">
                                                    <i class="bi bi-journal-bookmark"></i>
                                                </h6>
                                                <small class="text-muted">Courses</small>
                                                <div class="fw-bold">
                                                    {{ $department->courses ? $department->courses->count() : 'N/A' }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="border rounded p-2">
                                                <h6 class="text-success mb-1">
                                                    <i class="bi bi-person-video3"></i>
                                                </h6>
                                                <small class="text-muted">Instructors</small>
                                                <div class="fw-bold">
                                                    {{ $department->instructors ? $department->instructors->count() : 'N/A' }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="btn-group w-100" role="group">
                                        <a href="{{ route('departments.show', $department->dept_id) }}" 
                                           class="btn btn-outline-info" title="View Details">
                                            <i class="bi bi-eye"></i> View
                                        </a>
                                        <a href="{{ route('departments.edit', $department->dept_id) }}" 
                                           class="btn btn-outline-warning" title="Edit">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                        <form action="{{ route('departments.destroy', $department->dept_id) }}" 
                                              method="POST" 
                                              class="d-inline"
                                              onsubmit="return confirm('Are you sure you want to delete this department? This will also delete all courses and instructors in this department.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger" title="Delete">
                                                <i class="bi bi-trash"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Department Summary -->
                <div class="row mt-4">
                    <div class="col-md-3">
                        <div class="card bg-light">
                            <div class="card-body text-center">
                                <h5 class="card-title text-primary">
                                    <i class="bi bi-building"></i> Total Departments
                                </h5>
                                <h3 class="text-primary">{{ count($departments) }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-light">
                            <div class="card-body text-center">
                                <h5 class="card-title text-success">
                                    <i class="bi bi-journal-bookmark"></i> Total Courses
                                </h5>
                                <h3 class="text-success">
                                    @php
                                        $totalCourses = $departments->sum(function($dept) {
                                            return $dept->courses ? $dept->courses->count() : 0;
                                        });
                                    @endphp
                                    {{ $totalCourses }}
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-light">
                            <div class="card-body text-center">
                                <h5 class="card-title text-info">
                                    <i class="bi bi-person-video3"></i> Total Instructors
                                </h5>
                                <h3 class="text-info">
                                    @php
                                        $totalInstructors = $departments->sum(function($dept) {
                                            return $dept->instructors ? $dept->instructors->count() : 0;
                                        });
                                    @endphp
                                    {{ $totalInstructors }}
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-light">
                            <div class="card-body text-center">
                                <h5 class="card-title text-warning">
                                    <i class="bi bi-calculator"></i> Avg Courses/Dept
                                </h5>
                                <h3 class="text-warning">
                                    @php
                                        $avgCourses = count($departments) > 0 ? round($totalCourses / count($departments), 1) : 0;
                                    @endphp
                                    {{ $avgCourses }}
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="bi bi-building display-1 text-muted"></i>
                    <h3 class="text-muted mt-3">No Departments Found</h3>
                    <p class="text-muted">There are no departments in the database yet.</p>
                    <a href="{{ route('departments.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Add First Department
                    </a>
                </div>
            @endif

            <!-- Raw SQL Query Examples -->
            <div class="card mt-4">
                <div class="card-header">
                    <h6 class="card-title mb-0">
                        <i class="bi bi-code-slash"></i> SQL Query Examples for Departments
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="text-primary">Basic Department Query:</h6>
                            <pre class="bg-light p-2 rounded small"><code>SELECT dept_id, dept_name, location 
FROM departments 
ORDER BY dept_name;</code></pre>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-success">Departments with Course Count:</h6>
                            <pre class="bg-light p-2 rounded small"><code>SELECT d.dept_name, COUNT(c.course_id) as course_count
FROM departments d
LEFT JOIN courses c ON d.dept_id = c.dept_id
GROUP BY d.dept_id, d.dept_name;</code></pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection