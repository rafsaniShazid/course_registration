@extends('layouts.app')

@section('title', 'Students by Major')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1><i class="bi bi-bar-chart"></i> Students by Major</h1>
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
                    <pre class="sql-code">SELECT major, COUNT(*) as student_count 
FROM students 
GROUP BY major 
ORDER BY student_count DESC</pre>
                    <div class="mt-3">
                        <span class="badge bg-info">Concepts:</span>
                        <span class="badge bg-light text-dark">GROUP BY</span>
                        <span class="badge bg-light text-dark">COUNT()</span>
                        <span class="badge bg-light text-dark">ORDER BY</span>
                        <span class="badge bg-light text-dark">Aggregate Functions</span>
                    </div>
                </div>
            </div>

            <!-- Results -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Results</h5>
                </div>
                <div class="card-body">
                    @if(count($studentsByMajor) > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th><i class="bi bi-mortarboard"></i> Major</th>
                                        <th><i class="bi bi-people"></i> Number of Students</th>
                                        <th><i class="bi bi-percent"></i> Percentage</th>
                                        <th><i class="bi bi-bar-chart-fill"></i> Visual</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $total = array_sum(array_column($studentsByMajor, 'student_count')); @endphp
                                    @foreach($studentsByMajor as $row)
                                        @php $percentage = $total > 0 ? round(($row->student_count / $total) * 100, 1) : 0; @endphp
                                        <tr>
                                            <td>
                                                <strong>{{ $row->major }}</strong>
                                            </td>
                                            <td>
                                                <span class="badge bg-primary fs-6">{{ $row->student_count }}</span>
                                            </td>
                                            <td>{{ $percentage }}%</td>
                                            <td>
                                                <div class="progress" style="height: 20px;">
                                                    <div class="progress-bar" role="progressbar" 
                                                         style="width: {{ $percentage }}%" 
                                                         aria-valuenow="{{ $percentage }}" 
                                                         aria-valuemin="0" 
                                                         aria-valuemax="100">
                                                        {{ $percentage }}%
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="table-light">
                                    <tr>
                                        <th>Total Students</th>
                                        <th><span class="badge bg-success fs-6">{{ $total }}</span></th>
                                        <th>100%</th>
                                        <th>-</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle"></i> No students found in the database.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection