<?php

use App\Livewire\Courses\CourseIndex;
use App\Livewire\Courses\CreateCourse;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');


Route::middleware(['auth'])->group(function () {
    Route::get('courses', CourseIndex::class)->name('course.index');
    Route::get('courses/create', CreateCourse::class)->name('course.create');
});

require __DIR__ . '/auth.php';
