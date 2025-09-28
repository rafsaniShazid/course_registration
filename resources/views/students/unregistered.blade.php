@extends('layouts.app')

@section('title', 'Unregistered Students')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1><i class="bi bi-person-x"></i> Unregistered Students</h1>
                <a href="{{ route('students.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Back to Students
                </a>
            </div>

            <!-- SQL Query Display -->
            <div class="card mb-4">
                <div class="card-header bg-dark text-white">
                    <h5 class="card-title mb-0"><i class="bi bi-code"></i> SQL Query Used</h5>
                </div>
                <div class="card-body">
                    <pre class="sql-code">SELECT * 
FROM students s
WHERE NOT EXISTS (
    SELECT 1 
    FROM registrations r 
    WHERE r.student_id = s.student_id
)</pre>
                    <div class="mt-3">
                        <span class="badge bg-info">Concepts:</span>
                        <span class="badge bg-light text-dark">NOT EXISTS</span>
                        <span class="badge bg-light text-dark">Subqueries</span>
                        <span class="badge bg-light text-dark">Correlated Subquery</span>
                    </div>
                </div>
            </div>

            <!-- Results -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Results</h5>
                </div>
                <div class="card-body">
                    @if(count($unregisteredStudents) > 0)
                        <div class="alert alert-warning">
                            <i class="bi bi-exclamation-triangle"></i>
                            <strong>{{ count($unregisteredStudents) }}</strong> students haven't registered for any courses yet.
                        </div>
                        
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
                                    @foreach($unregisteredStudents as $student)
                                        <tr>
                                            <td>{{ $student->student_id }}</td>
                                            <td>
                                                <strong>{{ $student->name }}</strong>
                                            </td>
                                            <td>
                                                <small class="text-muted">{{ $student->email }}</small>
                                            </td>
                                            <td>
                                                <span class="badge bg-secondary">{{ $student->major }}</span>
                                            </td>
                                            <td>Year {{ $student->year }}</td>
                                            <td>
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <a href="{{ route('students.show', $student->student_id) }}" 
                                                       class="btn btn-outline-info" title="View Details">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    <a href="{{ route('students.edit', $student->student_id) }}" 
                                                       class="btn btn-outline-warning" title="Edit Student">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-success">
                            <i class="bi bi-check-circle"></i>
                            <strong>Excellent!</strong> All students have registered for at least one course.
                        </div>
                    @endif
                </div>
            </div>

            <!-- Explanation -->
            <div class="card mt-4">
                <div class="card-header bg-light">
                    <h6 class="card-title mb-0"><i class="bi bi-lightbulb"></i> How This Query Works</h6>
                </div>
                <div class="card-body">
                    <ol>
                        <li><strong>Main Query:</strong> Selects all students from the students table</li>
                        <li><strong>Subquery:</strong> For each student, checks if any registrations exist</li>
                        <li><strong>NOT EXISTS:</strong> Only includes students where the subquery finds no matches</li>
                        <li><strong>Result:</strong> Students who have never registered for any course</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection