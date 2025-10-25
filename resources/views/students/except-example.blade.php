@extends('layouts.app')

@section('title', 'EXCEPT Example - Students')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1><i class="bi bi-dash-circle"></i> EXCEPT</h1>
                    <p class="text-muted">{{ $selectedDept }} students who haven't registered for courses</p>
                </div>
                <a href="{{ route('students.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Back to Students
                </a>
            </div>

            <!-- Department Selection Form -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="card-title mb-0">Select Department</h6>
                </div>
                <div class="card-body">
                    <form method="GET" class="row g-3">
                        <div class="col-md-10">
                            <label for="department" class="form-label">Department</label>
                            <select name="department" id="department" class="form-select">
                                @foreach($departments as $dept)
                                    <option value="{{ $dept->dept_name }}" {{ $dept->dept_name == $selectedDept ? 'selected' : '' }}>
                                        {{ $dept->dept_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="bi bi-search"></i> Filter
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- SQL Query Display -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="card-title mb-0">SQL Query (Relational Algebra: −)</h6>
                </div>
                <div class="card-body">
                    <pre class="bg-light p-3 rounded"><code>SELECT name, major, email
FROM students
WHERE major = '{{ $selectedDept }}'
EXCEPT
SELECT s.name, s.major, s.email
FROM students s
INNER JOIN registrations r ON s.student_id = r.student_id
WHERE s.major = '{{ $selectedDept }}';</code></pre>
                    <div class="alert alert-info">
                        <strong>EXCEPT</strong> returns rows from the first SELECT that don't appear in the second SELECT.
                        Equivalent to relational algebra − (set difference) operation. Also known as MINUS in some databases.
                    </div>
                </div>
            </div>

            <!-- Results Table -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Unregistered Students</h5>
                </div>
                <div class="card-body">
                    @if(count($exceptResults) > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Name</th>
                                        <th>Major</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($exceptResults as $result)
                                        <tr>
                                            <td><strong>{{ $result->name }}</strong></td>
                                            <td>
                                                <span class="badge bg-primary">{{ $result->major }}</span>
                                            </td>
                                            <td><small class="text-muted">{{ $result->email }}</small></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="alert alert-warning">
                            <i class="bi bi-exclamation-triangle"></i> Found {{ count($exceptResults) }} students who haven't registered for any courses.
                        </div>
                    @else
                        <div class="alert alert-success">
                            <i class="bi bi-check-circle"></i> All students have registered for at least one course!
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection