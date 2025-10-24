@extends('layouts.app')
@section('title', 'Top Performing Students')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1><i class="bi bi-trophy"></i> Top Performing Students</h1>
                <a href="{{ route('students.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Back to Students
                </a>
            </div>

            <!-- Top Performers Table -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Student GPA Rankings</h5>
                    <small class="text-muted">Showing students ranked by Grade Point Average (only students with grades)</small>
                </div>
                <div class="card-body">
                    @if(count($topStudents) > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th><i class="bi bi-award"></i> Rank</th>
                                        <th><i class="bi bi-person"></i> Student Name</th>
                                        <th><i class="bi bi-envelope"></i> Email</th>
                                        <th><i class="bi bi-mortarboard"></i> Major</th>
                                        <th><i class="bi bi-calendar"></i> Year</th>
                                        <th><i class="bi bi-star"></i> GPA</th>
                                        <th><i class="bi bi-bar-chart"></i> Performance</th>
                                        <th><i class="bi bi-gear"></i> Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($topStudents as $index => $student)
                                        <tr class="
                                            @if($index == 0) table-warning
                                            @elseif($index == 1) table-secondary
                                            @elseif($index == 2) table-info
                                            @endif">
                                            <td>
                                                @if($index == 0)
                                                    <span class="badge bg-warning text-dark fs-5">
                                                        <i class="bi bi-trophy"></i> 1st
                                                    </span>
                                                @elseif($index == 1)
                                                    <span class="badge bg-secondary fs-5">
                                                        <i class="bi bi-award"></i> 2nd
                                                    </span>
                                                @elseif($index == 2)
                                                    <span class="badge bg-info fs-5">
                                                        <i class="bi bi-medal"></i> 3rd
                                                    </span>
                                                @else
                                                    <span class="badge bg-light text-dark">{{ $index + 1 }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <strong>{{ $student->name }}</strong>
                                                @if($index < 3)
                                                    <i class="bi bi-star-fill text-warning ms-1"></i>
                                                @endif
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
                                                <span class="badge 
                                                    @if($student->gpa >= 3.5) bg-success
                                                    @elseif($student->gpa >= 3.0) bg-warning text-dark
                                                    @elseif($student->gpa >= 2.5) bg-info
                                                    @else bg-danger
                                                    @endif fs-6">
                                                    {{ number_format($student->gpa, 2) }}
                                                </span>
                                            </td>
                                            <td>
                                                @if($student->gpa >= 3.75)
                                                    <span class="badge bg-success">
                                                        <i class="bi bi-emoji-smile"></i> Excellent
                                                    </span>
                                                @elseif($student->gpa >= 3.5)
                                                    <span class="badge bg-success">
                                                        <i class="bi bi-hand-thumbs-up"></i> Very Good
                                                    </span>
                                                @elseif($student->gpa >= 3.0)
                                                    <span class="badge bg-warning text-dark">
                                                        <i class="bi bi-check-circle"></i> Good
                                                    </span>
                                                @elseif($student->gpa >= 2.5)
                                                    <span class="badge bg-info">
                                                        <i class="bi bi-dash-circle"></i> Average
                                                    </span>
                                                @else
                                                    <span class="badge bg-danger">
                                                        <i class="bi bi-exclamation-triangle"></i> Needs Improvement
                                                    </span>
                                                @endif
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

                        <!-- Performance Statistics -->
                        <div class="row mt-4">
                            <div class="col-md-3">
                                <div class="card bg-light">
                                    <div class="card-body text-center">
                                        <h5 class="card-title text-success">
                                            <i class="bi bi-trophy"></i> Top GPA
                                        </h5>
                                        <h3 class="text-success">
                                            {{ count($topStudents) > 0 ? number_format($topStudents[0]->gpa, 2) : 'N/A' }}
                                        </h3>
                                        @if(count($topStudents) > 0)
                                            <small class="text-muted">{{ $topStudents[0]->name }}</small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card bg-light">
                                    <div class="card-body text-center">
                                        <h5 class="card-title text-info">
                                            <i class="bi bi-calculator"></i> Average GPA
                                        </h5>
                                        <h3 class="text-info">
                                            @php
                                                $avgGPA = count($topStudents) > 0 
                                                    ? round(collect($topStudents)->avg('gpa'), 2) 
                                                    : 0;
                                            @endphp
                                            {{ number_format($avgGPA, 2) }}
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card bg-light">
                                    <div class="card-body text-center">
                                        <h5 class="card-title text-warning">
                                            <i class="bi bi-star"></i> Honors Students
                                        </h5>
                                        <h3 class="text-warning">
                                            @php
                                                $honorsCount = collect($topStudents)->where('gpa', '>=', 3.5)->count();
                                            @endphp
                                            {{ $honorsCount }}
                                        </h3>
                                        <small class="text-muted">GPA ≥ 3.5</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card bg-light">
                                    <div class="card-body text-center">
                                        <h5 class="card-title text-primary">
                                            <i class="bi bi-people"></i> Total Students
                                        </h5>
                                        <h3 class="text-primary">{{ count($topStudents) }}</h3>
                                        <small class="text-muted">with grades</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- GPA Distribution Chart -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="card-title mb-0">
                                            <i class="bi bi-bar-chart"></i> GPA Distribution
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        @php
                                            $excellent = collect($topStudents)->where('gpa', '>=', 3.75)->count();
                                            $veryGood = collect($topStudents)->whereBetween('gpa', [3.5, 3.74])->count();
                                            $good = collect($topStudents)->whereBetween('gpa', [3.0, 3.49])->count();
                                            $average = collect($topStudents)->whereBetween('gpa', [2.5, 2.99])->count();
                                            $needsImprovement = collect($topStudents)->where('gpa', '<', 2.5)->count();
                                            $total = count($topStudents);
                                        @endphp
                                        
                                        <div class="row text-center">
                                            <div class="col">
                                                <div class="progress mb-2" style="height: 30px;">
                                                    @if($total > 0)
                                                        <div class="progress-bar bg-success" style="width: {{ ($excellent/$total)*100 }}%" 
                                                             title="Excellent (3.75-4.0): {{ $excellent }} students">
                                                            {{ $excellent }}
                                                        </div>
                                                        <div class="progress-bar bg-info" style="width: {{ ($veryGood/$total)*100 }}%" 
                                                             title="Very Good (3.5-3.74): {{ $veryGood }} students">
                                                            {{ $veryGood }}
                                                        </div>
                                                        <div class="progress-bar bg-warning" style="width: {{ ($good/$total)*100 }}%" 
                                                             title="Good (3.0-3.49): {{ $good }} students">
                                                            {{ $good }}
                                                        </div>
                                                        <div class="progress-bar bg-secondary" style="width: {{ ($average/$total)*100 }}%" 
                                                             title="Average (2.5-2.99): {{ $average }} students">
                                                            {{ $average }}
                                                        </div>
                                                        <div class="progress-bar bg-danger" style="width: {{ ($needsImprovement/$total)*100 }}%" 
                                                             title="Needs Improvement (<2.5): {{ $needsImprovement }} students">
                                                            {{ $needsImprovement }}
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="row small">
                                                    <div class="col"><span class="badge bg-success">Excellent</span><br>3.75-4.0</div>
                                                    <div class="col"><span class="badge bg-info">Very Good</span><br>3.5-3.74</div>
                                                    <div class="col"><span class="badge bg-warning text-dark">Good</span><br>3.0-3.49</div>
                                                    <div class="col"><span class="badge bg-secondary">Average</span><br>2.5-2.99</div>
                                                    <div class="col"><span class="badge bg-danger">Below Average</span><br>&lt;2.5</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-clipboard-x display-1 text-muted"></i>
                            <h3 class="text-muted mt-3">No Graded Students Found</h3>
                            <p class="text-muted">There are no students with grades in the database yet.</p>
                            <a href="{{ route('students.index') }}" class="btn btn-primary">
                                <i class="bi bi-arrow-left"></i> Back to Students
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
    AVG(
        CASE 
            WHEN r.grade = 'A+' THEN 4.0
            WHEN r.grade = 'A' THEN 3.75
            WHEN r.grade = 'A-' THEN 3.5
            WHEN r.grade = 'B+' THEN 3.25
            WHEN r.grade = 'B' THEN 3.0
            WHEN r.grade = 'B-' THEN 2.75
            WHEN r.grade = 'C+' THEN 2.5
            WHEN r.grade = 'C' THEN 2.25
            WHEN r.grade = 'C-' THEN 2
            WHEN r.grade = 'D' THEN 1.75
            ELSE 0
        END
    ) as gpa
FROM students s
INNER JOIN registrations r ON s.student_id = r.student_id
WHERE r.grade IS NOT NULL
GROUP BY s.student_id, s.name, s.email, s.major, s.year, s.created_at, s.updated_at
ORDER BY gpa DESC</code></pre>
                    <small class="text-muted">
                        <strong>Key SQL Concepts:</strong> CASE statement, AVG function, INNER JOIN, GROUP BY, WHERE clause with NULL check
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection