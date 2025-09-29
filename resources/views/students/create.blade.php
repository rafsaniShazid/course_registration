@extends('layouts.app')
@section('title', 'Add New Student')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1><i class="bi bi-person-plus"></i> Add New Student</h1>
                <a href="{{ route('students.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Back to Students
                </a>
            </div>
            
            <form action="{{ route('students.store') }}" method="POST">
                @csrf
                
                
                <div class="mb-3">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                
                <div class="mb-3">
                    <label for="major" class="form-label">Major</label>
                    <select class="form-select" id="major" name="major" required>
                        <option value="">Select Major</option>
                        <option value="Computer Science">Computer Science</option>
                        <option value="Electrical Engineering">Electrical Engineering</option>
                        <option value="Mechanical Engineering">Mechanical Engineering</option>
                        <option value="Physics">Physics</option>
                        <option value="Mathematics">Mathematics</option>
                        <option value="Business Administration">Business Administration</option>
                        <option value="English Literature">English Literature</option>
                        <option value="History">History</option>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label for="year" class="form-label">Year</label>
                    <select class="form-select" id="year" name="year" required>
                        <option value="">Select Year</option>
                        <option value="1">1st Year</option>
                        <option value="2">2nd Year</option>
                        <option value="3">3rd Year</option>
                        <option value="4">4th Year</option>
                    </select>
                </div>
                
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="{{ route('students.index') }}" class="btn btn-secondary me-md-2">Cancel</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-person-plus"></i> Add Student
                    </button>
                </div>
            </form>
            
        </div>
    </div>
</div>
@endsection