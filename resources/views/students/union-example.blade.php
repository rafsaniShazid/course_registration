@extends('layouts.app')

@section('title', 'UNION Example - Students')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1><i class="bi bi-union"></i> UNION </h1>
                    <p class="text-muted">Combining students from selected departments</p>
                </div>
                <a href="{{ route('students.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Back to Students
                </a>
            </div>

            <!-- Department Selection Form -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="card-title mb-0">Select Departments to Compare</h6>
                </div>
                <div class="card-body">
                    <form method="GET" class="row g-3">
                        <div class="col-md-5">
                            <label for="dept1" class="form-label">Department 1</label>
                            <select name="dept1" id="dept1" class="form-select">
                                @foreach($departments as $dept)
                                    <option value="{{ $dept->dept_name }}" {{ $dept->dept_name == $dept1 ? 'selected' : '' }}>
                                        {{ $dept->dept_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-5">
                            <label for="dept2" class="form-label">Department 2</label>
                            <select name="dept2" id="dept2" class="form-select">
                                @foreach($departments as $dept)
                                    <option value="{{ $dept->dept_name }}" {{ $dept->dept_name == $dept2 ? 'selected' : '' }}>
                                        {{ $dept->dept_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="bi bi-search"></i> Compare
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- SQL Query Display -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="card-title mb-0">SQL Query (Relational Algebra: ∪)</h6>
                </div>
                <div class="card-body">
                    <pre class="bg-light p-3 rounded"><code>SELECT name, major, '{{ $dept1 }} Students' as category
FROM students 
WHERE major = '{{ $dept1 }}'
UNION
SELECT name, major, '{{ $dept2 }} Students' as category  
FROM students 
WHERE major = '{{ $dept2 }}'
ORDER BY name;</code></pre>
                    <div class="alert alert-info">
                        <strong>UNION</strong> combines results from multiple SELECT statements, automatically removing duplicates.
                        Equivalent to relational algebra ∪ (union) operation.
                    </div>
                </div>
            </div>            <!-- Results Table -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Combined Student List</h5>
                </div>
                <div class="card-body">
                    @if(count($unionResults) > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Name</th>
                                        <th>Major</th>
                                        <th>Category</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($unionResults as $result)
                                        <tr>
                                            <td><strong>{{ $result->name }}</strong></td>
                                            <td>
                                                <span class="badge bg-primary">{{ $result->major }}</span>
                                            </td>
                                            <td>
                                                <span class="badge bg-success">{{ $result->category }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="alert alert-success">
                            <i class="bi bi-check-circle"></i> Found {{ count($unionResults) }} students from both Computer Science and Mathematics departments.
                        </div>
                    @else
                        <div class="alert alert-warning">
                            <i class="bi bi-exclamation-triangle"></i> No students found in Computer Science or Mathematics majors.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection