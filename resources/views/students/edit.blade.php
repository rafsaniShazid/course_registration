@extends('layouts.app')
@section('title', 'Edit Student')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1><i class="bi bi-pencil"></i> Edit Student</h1>
                <a href="{{ route('students.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Back to Students
                </a>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Student Information</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('students.update', $student->student_id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="student_id" class="form-label">Student ID</label>
                            <input type="text" 
                                   class="form-control @error('student_id') is-invalid @enderror" 
                                   id="student_id" 
                                   name="student_id" 
                                   value="{{ old('student_id', $student->student_id) }}" 
                                   readonly>
                            <small class="form-text text-muted">Student ID cannot be changed</small>
                            @error('student_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name', $student->name) }}" 
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email', $student->email) }}" 
                                   required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="major" class="form-label">Major</label>
                            <select class="form-select @error('major') is-invalid @enderror" id="major" name="major" required>
                                <option value="">Select Major</option>
                                <option value="Computer Science" {{ old('major', $student->major) == 'Computer Science' ? 'selected' : '' }}>Computer Science</option>
                                <option value="Electrical Engineering" {{ old('major', $student->major) == 'Electrical Engineering' ? 'selected' : '' }}>Electrical Engineering</option>
                                <option value="Mechanical Engineering" {{ old('major', $student->major) == 'Mechanical Engineering' ? 'selected' : '' }}>Mechanical Engineering</option>
                                <option value="Physics" {{ old('major', $student->major) == 'Physics' ? 'selected' : '' }}>Physics</option>
                                <option value="Mathematics" {{ old('major', $student->major) == 'Mathematics' ? 'selected' : '' }}>Mathematics</option>
                                <option value="Business Administration" {{ old('major', $student->major) == 'Business Administration' ? 'selected' : '' }}>Business Administration</option>
                                <option value="English Literature" {{ old('major', $student->major) == 'English Literature' ? 'selected' : '' }}>English Literature</option>
                                <option value="History" {{ old('major', $student->major) == 'History' ? 'selected' : '' }}>History</option>
                            </select>
                            @error('major')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="year" class="form-label">Year</label>
                            <select class="form-select @error('year') is-invalid @enderror" id="year" name="year" required>
                                <option value="">Select Year</option>
                                <option value="1" {{ old('year', $student->year) == '1' ? 'selected' : '' }}>1st Year</option>
                                <option value="2" {{ old('year', $student->year) == '2' ? 'selected' : '' }}>2nd Year</option>
                                <option value="3" {{ old('year', $student->year) == '3' ? 'selected' : '' }}>3rd Year</option>
                                <option value="4" {{ old('year', $student->year) == '4' ? 'selected' : '' }}>4th Year</option>
                            </select>
                            @error('year')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('students.index') }}" class="btn btn-secondary me-md-2">Cancel</a>
                            <button type="submit" class="btn btn-warning">
                                <i class="bi bi-pencil"></i> Update Student
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection