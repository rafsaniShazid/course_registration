@extends('layouts.app')

@section('title', 'Cartesian Product Example - Students')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1><i class="bi bi-grid"></i> Cartesian Product (CROSS JOIN)</h1>
                    <p class="text-muted">{{ $selectedDept }} students with all departments</p>
                </div>
                <a href="{{ route('students.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Back to Students
                </a>
            </div>

            <!-- Department Selection Form -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="card-title mb-0">Select Student Department</h6>
                </div>
                <div class="card-body">
                    <form method="GET" class="row g-3">
                        <div class="col-md-10">
                            <label for="department" class="form-label">Student Department</label>
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
                                <i class="bi bi-search"></i> Generate
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- SQL Query Display -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="card-title mb-0">SQL Query (Relational Algebra: ×)</h6>
                </div>
                <div class="card-body">
                    <pre class="bg-light p-3 rounded"><code>SELECT
    s.name as student_name,
    d.dept_name,
    CONCAT(s.name, ' - ', d.dept_name) as combination
FROM students s
CROSS JOIN departments d
WHERE s.major = '{{ $selectedDept }}'
ORDER BY s.name, d.dept_name
LIMIT 20;</code></pre>
                    <div class="alert alert-info">
                        <strong>CROSS JOIN</strong> creates a Cartesian product - every row from the first table combined with every row from the second table.
                        Equivalent to relational algebra × (Cartesian product) operation. Limited to 20 results for display.
                    </div>
                </div>
            </div>

            <!-- Results Table -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Student-Department Combinations (Filtered)</h5>
                </div>
                <div class="card-body">
                    @if(count($cartesianResults) > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Student Name</th>
                                        <th>Department</th>
                                        <th>Combination</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cartesianResults as $result)
                                        <tr>
                                            <td><strong>{{ $result->student_name }}</strong></td>
                                            <td>
                                                <span class="badge bg-info">{{ $result->dept_name }}</span>
                                            </td>
                                            <td><small class="text-muted">{{ $result->combination }}</small></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle"></i> Showing {{ count($cartesianResults) }} filtered combinations (students whose major relates to department name).
                            <br><small class="text-muted">Without WHERE filter, this would produce {{ count($cartesianResults) * 5 }} combinations!</small>
                        </div>
                    @else
                        <div class="alert alert-warning">
                            <i class="bi bi-exclamation-triangle"></i> No matching student-department combinations found.
                        </div>
                    @endif
                </div>
            </div>

            <!-- Explanation -->
            <div class="card mt-4">
                <div class="card-header">
                    <h6 class="card-title mb-0">Understanding Cartesian Product</h6>
                </div>
                <div class="card-body">
                    <p><strong>Cartesian Product (×)</strong> combines every row from Table A with every row from Table B.</p>
                    <ul>
                        <li>If Table A has 10 rows and Table B has 5 rows, the result has 50 rows (10 × 5)</li>
                        <li>Useful for generating all possible combinations</li>
                        <li>Often filtered with WHERE clauses to be meaningful</li>
                        <li>Can be expensive on large tables - use judiciously!</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection