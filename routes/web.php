<?php

use App\Livewire\Dashboard;
use App\Livewire\Users\UserIndex;
use App\Livewire\Courses\CourseIndex;
use Illuminate\Support\Facades\Route;
use App\Livewire\Courses\CreateCourse;

Route::view('/', 'welcome');

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');


Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', Dashboard::class)->name('dashboard');
    Route::get('courses', CourseIndex::class)->name('course.index');
    Route::get('courses/create', CreateCourse::class)->name('course.create');
    Route::get('users', UserIndex::class)->name('user.index');
});

require __DIR__ . '/auth.php';
