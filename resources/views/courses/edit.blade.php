@extends('layouts.app')
@section('title', 'Edit course ' . $course->title)
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1><i class="bi bi-pencil"></i> Edit Course</h1>
            <form action="{{ route('courses.update', $course->course_id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" 
                           class="form-control @error('title') is-invalid @enderror" 
                           id="title" 
                           name="title" 
                           value="{{ old('title', $course->title) }}" 
                           required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="credits" class="form-label">Credits</label>
                    <input type="number" 
                           class="form-control @error('credits') is-invalid @enderror" 
                           id="credits" 
                           name="credits" 
                           value="{{ old('credits', $course->credits) }}" 
                           required>
                    @error('credits')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update Course</button>
            </form>
        </div>
    </div>
</div>
@endsection