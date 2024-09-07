<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\IntakeController;
use App\Http\Controllers\UniversityController;
use App\Http\Controllers\IntakeCourseController;
use App\Http\Controllers\UniversityCourseController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::resource('university', UniversityController::class)->names('university');
    Route::resource('course', CourseController::class)->names('course');
    Route::resource('intake', IntakeController::class)->names('intake');
    Route::resource('agent', AgentController::class)->names('agent');
    // Route::resource('university-courses', UniversityCourseController::class)->names('university-courses');

    Route::prefix('university-courses')->group(function () {
        Route::get('/', [UniversityCourseController::class, 'index'])->name('university-courses.index');
        Route::get('list', [UniversityCourseController::class, 'list'])->name('university-courses.list');
        Route::get('create', [UniversityCourseController::class, 'create'])->name('university-courses.create');
        Route::post('store', [UniversityCourseController::class, 'store'])->name('university-courses.store');
        Route::get('{course}', [UniversityCourseController::class, 'show'])->name('university-courses.show');
        Route::get('{course}/detail', [UniversityCourseController::class, 'detail'])->name('university-courses.detail');
    });
    // Route::resource('intake-coourses', IntakeCourseController::class)->names('intake');
});
