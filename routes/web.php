<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SubjectController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AuthController::class, 'login'])->name('login');

Route::post('login', [AuthController::class, 'AuthLogin'])->name('AuthLogin');

Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('forgot-password', [AuthController::class, 'forgot_password'])->name('forgot_password');

Route::post('forgot-password', [AuthController::class, 'send_forgot_password'])->name('send_forgot_password');

Route::get('reset-password/{token}', [AuthController::class, 'reset_password'])->name('reset_password');

Route::post('reset-password/{token}', [AuthController::class, 'update_password'])->name('update_password');



Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name(
        'admin.dashboard'
    );
    Route::get('/admin/list', [AdminController::class , 'list'])->name('admin.list');

    Route::get('/admin/add', [AdminController::class , 'add'])->name('admin.add');

    Route::post('/admin/add', [AdminController::class , 'store'])->name('admin.store');

    Route::get('/admin/edit/{id}', [AdminController::class , 'edit'])->name('admin.edit');

    Route::post('/admin/edit/{id}', [AdminController::class , 'update'])->name('admin.update');

    Route::get('/admin/delete/{id}', [AdminController::class , 'delete'])->name('admin.delete');

    Route::get('admin/class/list', [ClassController::class , 'class_list'])->name('admin.class.list');

    Route::get('admin/class/add', [ClassController::class , 'class_add'])->name('admin.class.add');

    Route::post('admin/class/add', [ClassController::class , 'class_store'])->name('admin.class.store');

    Route::get('admin/class/edit/{id}', [ClassController::class , 'class_edit'])->name('admin.class.edit');

    Route::post('admin/class/edit/{id}', [ClassController::class , 'class_update'])->name('admin.class.update');

    Route::get('admin/class/delete/{id}', [ClassController::class , 'class_delete'])->name('admin.class.delete');

    Route::get('admin/subject/list', [SubjectController::class , 'subject_list'])->name('admin.subject.list');

    Route::get('admin/subject/add', [SubjectController::class , 'subject_add'])->name('admin.subject.add');

    Route::post('admin/subject/add', [SubjectController::class , 'subject_store'])->name('admin.subject.store');

    Route::get('admin/subject/edit/{id}', [SubjectController::class , 'subject_edit'])->name('admin.subject.edit');

    Route::post('admin/subject/edit/{id}', [SubjectController::class , 'subject_update'])->name('admin.subject.update');

    Route::get('admin/subject/delete/{id}', [SubjectController::class , 'subject_delete'])->name('admin.subject.delete');
});

Route::prefix('teacher')->middleware('teacher')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('teacher.dashboard');
});

Route::prefix('parent')->middleware('parent')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('parent.dashboard');
});

Route::prefix('student')->middleware('student')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('student.dashboard');
});
