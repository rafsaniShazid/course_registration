@extends('layouts.app')
@section('title', 'Add New Course')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1><i class="bi bi-plus-circle"></i> Add New Course</h1>
                <a href="{{ route('courses.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Back to Courses
                </a>
            </div>

            <!-- Course Creation Form -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Course Information</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('courses.store') }}" method="POST">
                        @csrf
                        
                        <!-- Course ID Field -->
                        <div class="mb-3">
                            <label for="course_id" class="form-label">Course ID</label>
                            <input type="text" 
                                   class="form-control @error('course_id') is-invalid @enderror" 
                                   id="course_id" 
                                   name="course_id" 
                                   value="{{ old('course_id') }}" 
                                   placeholder="e.g., CS101, MATH201, CSE3110"
                                   maxlength="10"
                                   required>
                            <div class="form-text">
                                Enter a unique course identifier (max 10 characters, e.g., CS101, MATH201, CSE3110)
                            </div>
                            @error('course_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Course Title Field -->
                        <div class="mb-3">
                            <label for="title" class="form-label">Course Title</label>
                            <input type="text" 
                                   class="form-control @error('title') is-invalid @enderror" 
                                   id="title" 
                                   name="title" 
                                   value="{{ old('title') }}" 
                                   placeholder="e.g., Introduction to Computer Science"
                                   required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Credits Field -->
                        <div class="mb-3">
                            <label for="credits" class="form-label">Credits</label>
                            <input type="number" 
                                   class="form-control @error('credits') is-invalid @enderror" 
                                   id="credits" 
                                   name="credits" 
                                   value="{{ old('credits') }}" 
                                   min="1" 
                                   max="6" 
                                   required>
                            <div class="form-text">
                                Number of credit hours (1-6)
                            </div>
                            @error('credits')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Department Field -->
                        <div class="mb-3">
                            <label for="dept_id" class="form-label">Department</label>
                            <select class="form-select @error('dept_id') is-invalid @enderror" 
                                    id="dept_id" 
                                    name="dept_id" 
                                    required>
                                <option value="">Select a department...</option>
                                @foreach($departments as $department)
                                    <option value="{{ $department->dept_id }}" 
                                            {{ old('dept_id') == $department->dept_id ? 'selected' : '' }}>
                                        {{ $department->dept_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('dept_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle"></i> Create Course
                            </button>
                            <a href="{{ route('courses.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-x-circle"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection