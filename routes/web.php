<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\QueryExamplesController;

// Home page
Route::get('/', function () {
    return view('dashboard');
});

// Dashboard - Overview of all query examples
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Students Routes
Route::prefix('students')->name('students.')->group(function () {
    // Basic CRUD
    Route::get('/', [StudentController::class, 'index'])->name('index');
    Route::get('/create', [StudentController::class, 'create'])->name('create');
    Route::post('/', [StudentController::class, 'store'])->name('store');
    Route::get('/{student}', [StudentController::class, 'show'])->name('show');
    Route::get('/{student}/edit', [StudentController::class, 'edit'])->name('edit');
    Route::put('/{student}', [StudentController::class, 'update'])->name('update');
    Route::delete('/{student}', [StudentController::class, 'destroy'])->name('destroy');
    
    // Query Examples
    Route::get('/reports/by-major', [StudentController::class, 'byMajor'])->name('by-major');
    Route::get('/reports/with-credits', [StudentController::class, 'withCredits'])->name('with-credits');
    Route::get('/reports/unregistered', [StudentController::class, 'unregistered'])->name('unregistered');
    Route::get('/reports/top-performers', [StudentController::class, 'topPerformers'])->name('top-performers');
    Route::get('/reports/course-details', [StudentController::class, 'withCourseDetails'])->name('course-details');
    Route::get('/reports/semester-performance', [StudentController::class, 'semesterPerformance'])->name('semester-performance');
});

// Courses Routes
Route::prefix('courses')->name('courses.')->group(function () {
    // Basic CRUD
    Route::get('/', [CourseController::class, 'index'])->name('index');
    Route::get('/create', [CourseController::class, 'create'])->name('create');
    Route::post('/', [CourseController::class, 'store'])->name('store');
    Route::get('/{course}', [CourseController::class, 'show'])->name('show');
    Route::get('/{course}/edit', [CourseController::class, 'edit'])->name('edit');
    Route::put('/{course}', [CourseController::class, 'update'])->name('update');
    Route::delete('/{course}', [CourseController::class, 'destroy'])->name('destroy');
});

// Departments Routes
Route::prefix('departments')->name('departments.')->group(function () {
    Route::get('/', [DepartmentController::class, 'index'])->name('index');
    Route::get('/create', [DepartmentController::class, 'create'])->name('create');
    Route::post('/', [DepartmentController::class, 'store'])->name('store');
    Route::get('/{department}', [DepartmentController::class, 'show'])->name('show');
    Route::get('/{department}/edit', [DepartmentController::class, 'edit'])->name('edit');
    Route::put('/{department}', [DepartmentController::class, 'update'])->name('update');
    Route::delete('/{department}', [DepartmentController::class, 'destroy'])->name('destroy');
});

// Query Examples Routes
Route::prefix('queries')->name('queries.')->group(function () {
    Route::get('/', [QueryExamplesController::class, 'index'])->name('index');
    Route::get('/basic-selects', [QueryExamplesController::class, 'basicSelects'])->name('basic-selects');
    Route::get('/aggregates', [QueryExamplesController::class, 'aggregates'])->name('aggregates');
    Route::get('/joins', [QueryExamplesController::class, 'joins'])->name('joins');
    Route::get('/subqueries', [QueryExamplesController::class, 'subqueries'])->name('subqueries');
    Route::get('/advanced', [QueryExamplesController::class, 'advanced'])->name('advanced');
    
    // Custom query executor
    Route::post('/execute', [QueryExamplesController::class, 'executeCustomQuery'])->name('execute');
});
