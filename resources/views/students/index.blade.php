@extends('layouts.app')

@section('title', 'All Students')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1><i class="bi bi-people"></i> All Students</h1>
                <a href="{{ route('students.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus"></i> Add New Student
                </a>
            </div>

            <!-- Quick Navigation to Query Examples -->
            <div class="card mb-4">
                <div class="card-body">
                    <h6 class="card-title">Student Query Examples:</h6>
                    <div class="btn-group btn-group-sm" role="group">
                        <a href="{{ route('students.by-major') }}" class="btn btn-outline-primary">By Major</a>
                        <a href="{{ route('students.with-credits') }}" class="btn btn-outline-primary">With Credits</a>
                        <a href="{{ route('students.unregistered') }}" class="btn btn-outline-primary">Unregistered</a>
                        <a href="{{ route('students.top-performers') }}" class="btn btn-outline-primary">Top Performers</a>
                    </div>
                </div>
            </div>

            <!-- Students Table -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Student List</h5>
                </div>
                <div class="card-body">
                    @if(count($students) > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Major</th>
                                        <th>Year</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($students as $student)
                                        <tr>
                                            <td>{{ $student->student_id }}</td>
                                            <td><strong>{{ $student->name }}</strong></td>
                                            <td><small class="text-muted">{{ $student->email }}</small></td>
                                            <td>
                                                <span class="badge bg-info">{{ $student->major }}</span>
                                            </td>
                                            <td>Year {{ $student->year }}</td>
                                            <td>
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <a href="{{ route('students.show', $student->student_id) }}" 
                                                       class="btn btn-outline-info" title="View">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    <a href="{{ route('students.edit', $student->student_id) }}" 
                                                       class="btn btn-outline-warning" title="Edit">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <form action="{{ route('students.destroy', $student->student_id) }}" 
                                                          method="POST" 
                                                          class="d-inline"
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
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle"></i> No students found. 
                            <a href="{{ route('students.create') }}" class="alert-link">Add the first student</a>.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection