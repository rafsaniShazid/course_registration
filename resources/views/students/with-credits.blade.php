@extends('layouts.app')
@section('title', 'Students with Total Credits')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1><i class="bi bi-award"></i> Students with Total Credits</h1>
                <a href="{{ route('students.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Back to Students
                </a>
            </div>

            <!-- Students with Credits Table -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Student Credit Summary</h5>
                    <small class="text-muted">Showing all students ranked by total credits earned</small>
                </div>
                <div class="card-body">
                    @if(count($studentsWithCredits) > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th><i class="bi bi-hash"></i> Rank</th>
                                        <th><i class="bi bi-person"></i> Student Name</th>
                                        <th><i class="bi bi-envelope"></i> Email</th>
                                        <th><i class="bi bi-mortarboard"></i> Major</th>
                                        <th><i class="bi bi-calendar"></i> Year</th>
                                        <th><i class="bi bi-award"></i> Total Credits</th>
                                        <th><i class="bi bi-gear"></i> Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($studentsWithCredits as $index => $student)
                                        <tr>
                                            <td>
                                                <span class="badge 
                                                    @if($index == 0) bg-warning
                                                    @elseif($index == 1) bg-secondary
                                                    @elseif($index == 2) bg-info
                                                    @else bg-light text-dark
                                                    @endif">
                                                    {{ $index + 1 }}
                                                </span>
                                            </td>
                                            <td>
                                                <strong>{{ $student->name }}</strong>
                                            </td>
                                            <td>
                                                <small class="text-muted">{{ $student->email }}</small>
                                            </td>
                                            <td>
                                                <span class="badge bg-primary">{{ $student->major }}</span>
                                            </td>
                                            <td>
                                                <span class="badge bg-success">Year {{ $student->year }}</span>
                                            </td>
                                            <td>
                                                <span class="badge bg-warning text-dark fs-6">
                                                    <i class="bi bi-award"></i> {{ $student->total_credits }} credits
                                                </span>
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <a href="{{ route('students.show', $student->student_id) }}" 
                                                       class="btn btn-outline-info" title="View Details">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    <a href="{{ route('students.edit', $student->student_id) }}" 
                                                       class="btn btn-outline-warning" title="Edit">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Credit Statistics -->
                        <div class="row mt-4">
                            <div class="col-md-4">
                                <div class="card bg-light">
                                    <div class="card-body text-center">
                                        <h5 class="card-title text-primary">
                                            <i class="bi bi-people"></i> Total Students
                                        </h5>
                                        <h3 class="text-primary">{{ count($studentsWithCredits) }}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card bg-light">
                                    <div class="card-body text-center">
                                        <h5 class="card-title text-success">
                                            <i class="bi bi-trophy"></i> Highest Credits
                                        </h5>
                                        <h3 class="text-success">
                                            {{ count($studentsWithCredits) > 0 ? $studentsWithCredits[0]->total_credits : 0 }}
                                        </h3>
                                        @if(count($studentsWithCredits) > 0)
                                            <small class="text-muted">{{ $studentsWithCredits[0]->name }}</small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card bg-light">
                                    <div class="card-body text-center">
                                        <h5 class="card-title text-info">
                                            <i class="bi bi-calculator"></i> Average Credits
                                        </h5>
                                        <h3 class="text-info">
                                            @php
                                                $avgCredits = count($studentsWithCredits) > 0 
                                                    ? round(collect($studentsWithCredits)->avg('total_credits'), 1) 
                                                    : 0;
                                            @endphp
                                            {{ $avgCredits }}
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-inbox display-1 text-muted"></i>
                            <h3 class="text-muted mt-3">No Students Found</h3>
                            <p class="text-muted">There are no students in the database yet.</p>
                            <a href="{{ route('students.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus-circle"></i> Add First Student
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Query Information -->
            <div class="card mt-4">
                <div class="card-header">
                    <h6 class="card-title mb-0"><i class="bi bi-code-slash"></i> SQL Query Used</h6>
                </div>
                <div class="card-body">
                    <pre class="bg-light p-3 rounded"><code>SELECT 
    s.*,
    COALESCE(SUM(c.credits), 0) as total_credits
FROM students s
LEFT JOIN registrations r ON s.student_id = r.student_id
LEFT JOIN courses c ON r.course_id = c.course_id
GROUP BY s.student_id, s.name, s.email, s.major, s.year, s.created_at, s.updated_at
ORDER BY total_credits DESC</code></pre>
                    <small class="text-muted">
                        <strong>Key SQL Concepts:</strong> LEFT JOIN, COALESCE, GROUP BY, Aggregate Functions (SUM)
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection