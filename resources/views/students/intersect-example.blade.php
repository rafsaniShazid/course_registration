@extends('layouts.app')

@section('title', 'INTERSECT Example - Students')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1><i class="bi bi-intersect"></i> INTERSECT</h1>
                    <p class="text-muted">{{ $selectedDept }} students who have taken courses</p>
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
                    <h6 class="card-title mb-0">SQL Query (Relational Algebra: ∩)</h6>
                </div>
                <div class="card-body">
                    <pre class="bg-light p-3 rounded"><code>SELECT s.name, s.major
FROM students s
WHERE s.major = '{{ $selectedDept }}'
INTERSECT
SELECT s.name, s.major
FROM students s
INNER JOIN registrations r ON s.student_id = r.student_id
WHERE r.grade IS NOT NULL;</code></pre>
                    <div class="alert alert-info">
                        <strong>INTERSECT</strong> returns only the rows that appear in both SELECT statements.
                        Equivalent to relational algebra ∩ (intersection) operation.
                    </div>
                </div>
            </div>

            <!-- Results Table -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">{{ $selectedDept }}  Students with Course Registrations</h5>
                </div>
                <div class="card-body">
                    @if(count($intersectResults) > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Name</th>
                                        <th>Major</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($intersectResults as $result)
                                        <tr>
                                            <td><strong>{{ $result->name }}</strong></td>
                                            <td>
                                                <span class="badge bg-primary">{{ $result->major }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="alert alert-success">
                            <i class="bi bi-check-circle"></i> Found {{ count($intersectResults) }} {{ $selectedDept }}  students who have registered for courses.
                        </div>
                    @else
                        <div class="alert alert-warning">
                            <i class="bi bi-exclamation-triangle"></i> No {{ $selectedDept }}  students have registered for courses yet.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection