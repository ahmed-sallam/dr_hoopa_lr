<?php

use App\Livewire\Admin\AbandonedCartIndex;
use App\Livewire\Admin\OrderIndex;
use App\Livewire\Admin\PaymentIndex;
use App\Livewire\Dashboard;
use App\Livewire\Client\Home;
use App\Livewire\Users\UserIndex;
use App\Livewire\Admin\User\UserEdit;
use App\Livewire\Admin\User\UserView;
use App\Livewire\Client\ClientCourse;
use App\Livewire\Client\ClientLesson;
use App\Livewire\Courses\CourseIndex;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\User\RoleIndex;
use App\Livewire\Client\ClientCourses;
use App\Livewire\Courses\CreateCourse;
use App\Livewire\Admin\Category\CategoryIndex;

// Route::view('/', 'welcome');
Route::get("/", Home::class)->name("home");
Route::get("courses", ClientCourses::class)->name("client.courses.index");
Route::get("courses/{id}", ClientCourse::class)->name("client.course.view");
Route::get("courses/{courseId}/lesson/{lessonId}", ClientLesson::class)->name("client.lesson.view");


// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');


Route::middleware(['auth'])->group(function () {
    // new admin routes
    Route::get('admin', Dashboard::class)->name('admin.dashboard');
    Route::get('admin/courses', CourseIndex::class)->name('admin.course.index');
    Route::get('admin/courses/create', CreateCourse::class)->name('admin.course.create');
    Route::get('admin/users', \App\Livewire\Admin\User\UserIndex::class)->name('admin.user.index');
    Route::get('admin/users/{id}', UserView::class)->name('admin.user.view');
    Route::get('admin/users/{id}/edit', UserEdit::class)->name('admin.user.edit');
    Route::get('admin/roles', RoleIndex::class)->name('admin.role.index');
    Route::get('admin/categories', CategoryIndex::class)->name('admin.category.index');

    // admin finance
    Route::prefix('finance')->group(function () {
        // Redirect /finance to /finance/cart
        Route::redirect('/', '/finance/cart')->name('admin.finance.index');
        Route::get('/cart', AbandonedCartIndex::class)->name('admin.finance.abandoned-cart.index');
        Route::get('/orders', OrderIndex::class)->name('admin.finance.orders.index');
        Route::get('/payments', PaymentIndex::class)->name('admin.finance.payments.index');
    });


    // old admin routes
    Route::get('dashboard', Dashboard::class)->name('dashboard');
    Route::get('old-admin/courses', CourseIndex::class)->name('course.index');
    Route::get('old-admin/courses/create', CreateCourse::class)->name('course.create');
    Route::get('old-admin/users', UserIndex::class)->name('user.index');
});

require __DIR__ . '/auth.php';
