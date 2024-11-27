<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ClassController;
use App\Http\Controllers\Admin\ClassSubjectController;
use App\Http\Controllers\admin\ClassTeacherController;
use App\Http\Controllers\Admin\ClassTimetableController;
use App\Http\Controllers\Admin\ParentController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\parent\ParentDashboardController;
use App\Http\Controllers\student\StudentDashboardController;
use App\Http\Controllers\teacher\TeacherDashboardController;
use App\Http\Controllers\UserController;
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
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('profile', [UserController::class , 'profile'])->name('admin.profile');

    Route::put('profile', [UserController::class , 'update_profile'])->name('admin.update-profile');

    Route::get('/admin/list', [AdminController::class , 'list'])->name('admin.list');

    Route::get('/admin/add', [AdminController::class , 'add'])->name('admin.add');

    Route::post('/admin/add', [AdminController::class , 'store'])->name('admin.store');

    Route::get('/admin/edit/{id}', [AdminController::class , 'edit'])->name('admin.edit');

    Route::post('/admin/edit/{id}', [AdminController::class , 'update'])->name('admin.update');

    Route::get('/admin/delete/{id}', [AdminController::class , 'delete'])->name('admin.delete');

    //Student Routes
    Route::get('admin/student/list', [StudentController::class , 'student_list'])->name('admin.student.list');

    Route::get('admin/student/add', [StudentController::class , 'student_add'])->name('admin.student.add');

    Route::post('admin/student/add', [StudentController::class , 'student_store'])->name('admin.student.store');

    Route::get('admin/student/edit/{id}', [StudentController::class , 'student_edit'])->name('admin.student.edit');

    Route::put('admin/student/edit/{id}', [StudentController::class , 'student_update'])->name('admin.student.update');

    Route::get('admin/student/delete/{id}', [StudentController::class , 'student_delete'])->name('admin.student.delete');

    //Parent Routes
    Route::get('admin/parent/list', [ParentController::class , 'parent_list'])->name('admin.parent.list');

    Route::get('admin/parent/add', [ParentController::class , 'parent_add'])->name('admin.parent.add');

    Route::post('admin/parent/add', [ParentController::class , 'parent_store'])->name('admin.parent.store');

    Route::get('admin/parent/edit/{id}', [ParentController::class , 'parent_edit'])->name('admin.parent.edit');

    Route::put('admin/parent/edit/{id}', [ParentController::class , 'parent_update'])->name('admin.parent.update');

    Route::get('admin/parent/delete/{id}', [ParentController::class , 'parent_delete'])->name('admin.parent.delete');

    Route::get('admin/parent/my-students/{id}', [ParentController::class , 'my_students'])->name('admin.parent.my_students');

    Route::get('admin/parent/assign-student-parent/{student_id}/{parent_id}', [ParentController::class , 'assign_student_parent'])->name('admin.parent.assign_student_parent');

    Route::get('admin/parent/delete-student-parent/{id}', [ParentController::class , 'delete_student_parent'])->name('admin.parent.delete_student_parent');

    //Teacher Routes
    Route::get('admin/teacher/list', [TeacherController::class , 'teacher_list'])->name('admin.teacher.list');

    Route::get('admin/teacher/add', [TeacherController::class , 'teacher_add'])->name('admin.teacher.add');

    Route::post('admin/teacher/add', [TeacherController::class , 'teacher_store'])->name('admin.teacher.store');

    Route::get('admin/teacher/edit/{id}', [TeacherController::class , 'teacher_edit'])->name('admin.teacher.edit');

    Route::put('admin/teacher/edit/{id}', [TeacherController::class , 'teacher_update'])->name('admin.teacher.update');

    Route::get('admin/teacher/delete/{id}', [TeacherController::class , 'teacher_delete'])->name('admin.teacher.delete');

    //Class Routes
    Route::get('admin/class/list', [ClassController::class , 'class_list'])->name('admin.class.list');

    Route::get('admin/class/add', [ClassController::class , 'class_add'])->name('admin.class.add');

    Route::post('admin/class/add', [ClassController::class , 'class_store'])->name('admin.class.store');

    Route::get('admin/class/edit/{id}', [ClassController::class , 'class_edit'])->name('admin.class.edit');

    Route::post('admin/class/edit/{id}', [ClassController::class , 'class_update'])->name('admin.class.update');

    Route::get('admin/class/delete/{id}', [ClassController::class , 'class_delete'])->name('admin.class.delete');

    //Subject Routes
    Route::get('admin/subject/list', [SubjectController::class , 'subject_list'])->name('admin.subject.list');

    Route::get('admin/subject/add', [SubjectController::class , 'subject_add'])->name('admin.subject.add');

    Route::post('admin/subject/add', [SubjectController::class , 'subject_store'])->name('admin.subject.store');

    Route::get('admin/subject/edit/{id}', [SubjectController::class , 'subject_edit'])->name('admin.subject.edit');

    Route::post('admin/subject/edit/{id}', [SubjectController::class , 'subject_update'])->name('admin.subject.update');

    Route::get('admin/subject/delete/{id}', [SubjectController::class , 'subject_delete'])->name('admin.subject.delete');

    //Class_Subject Routes
    Route::get('admin/class-subject/list', [ClassSubjectController::class , 'list'])->name('admin.class_subject.list');

    Route::get('admin/class-subject/assign', [ClassSubjectController::class , 'assign'])->name('admin.class_subject.assign');

    Route::post('admin/class-subject/assign', [ClassSubjectController::class , 'assign_store'])->name('admin.class_subject.assign_store');

    Route::get('admin/class-subject/edit/{id}', [ClassSubjectController::class , 'edit'])->name('admin.class_subject.edit');

    Route::post('admin/class-subject/edit/{id}', [ClassSubjectController::class , 'update'])->name('admin.class_subject.update');

    Route::get('admin/class-subject/edit_single/{id}', [ClassSubjectController::class , 'edit_single'])->name('admin.class_subject.edit_single');

    Route::post('admin/class-subject/edit_single/{id}', [ClassSubjectController::class , 'update_single'])->name('admin.class_subject.update_single');

    Route::get('admin/class-subject/delete/{id}', [ClassSubjectController::class , 'delete'])->name('admin.class_subject.delete');

    //Class_Teacher Routes

    Route::get('admin/class-teacher/list', [ClassTeacherController::class , 'list'])->name('admin.class_teacher.list');

    Route::get('admin/class-teacher/assign', [ClassTeacherController::class , 'assign'])->name('admin.class_teacher.assign');

    Route::post('admin/class-teacher/assign', [ClassTeacherController::class , 'assign_store'])->name('admin.class_teacher.assign_store');

    Route::get('admin/class-teacher/edit/{id}', [ClassTeacherController::class , 'edit'])->name('admin.class_teacher.edit');

    Route::post('admin/class-teacher/edit/{id}', [ClassTeacherController::class , 'update'])->name('admin.class_teacher.update');

    Route::get('admin/class-teacher/delete/{id}', [ClassTeacherController::class , 'delete'])->name('admin.class_teacher.delete');

    //class timetable

    Route::get('admin/class-timetable', [ClassTimetableController::class , 'index'])->name('admin.class_timetable');

    Route::get('/get-subjects-by-class/{classId}', [ClassTimetableController::class, 'getSubjectsByClass'])->name('get.subjects.by.class');

    Route::get('/get-timetable/{classId}/{subjectId}', [ClassTimetableController::class, 'getTimetable'])->name('get.timetable');

    Route::post('admin/class-timetable/add', [ClassTimetableController::class , 'add'])->name('admin.class_timetable.add');
    //Change Password
    Route::get('admin/change-password', [UserController::class , 'change_password'])->name('admin.change-password');

    Route::post('admin/change-password', [UserController::class , 'update_password'])->name('admin.update-password');

});

Route::prefix('teacher')->middleware('teacher')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('teacher.dashboard');
    Route::get('change-password', [UserController::class , 'change-password'])->name('teacher.change-password');
    Route::post('change-password', [UserController::class , 'update-password'])->name('teacher.update-password');

    Route::get('profile', [UserController::class , 'profile'])->name('teacher.profile');

    Route::put('profile', [UserController::class , 'update_profile'])->name('teacher.update-profile');

    Route::get('my-classes', [TeacherDashboardController::class , 'my_classes'])->name('teacher.my_classes');

    Route::get('my-students', [TeacherDashboardController::class , 'my_students'])->name('teacher.my_students');
});

Route::prefix('parent')->middleware('parent')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('parent.dashboard');
    Route::get('change-password', [UserController::class , 'change-password'])->name('parent.change-password');
    Route::post('change-password', [UserController::class , 'update-password'])->name('parent.update-password');

    Route::get('profile', [UserController::class , 'profile'])->name('parent.profile');

    Route::put('profile', [UserController::class , 'update_profile'])->name('parent.update-profile');

    Route::get('my-students', [ParentDashboardController::class , 'my_students'])->name('parent.my_students');

    Route::get('my-students-subjects/{id}', [ParentDashboardController::class , 'my_students_subjects'])->name('parent.my_students_subjects');
});

Route::prefix('student')->middleware('student')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('student.dashboard');
    Route::get('change-password', [UserController::class , 'change-password'])->name('student.change-password');
    Route::post('change-password', [UserController::class , 'update-password'])->name('student.update-password');

    Route::get('profile', [UserController::class , 'profile'])->name('student.profile');

    Route::put('profile', [UserController::class , 'update_profile'])->name('student.update-profile');

    Route::get('my-subjects', [StudentDashboardController::class , 'my_subjects'])->name('student.my_subjects');

    Route::get('my-timetable', [StudentDashboardController::class , 'my_timetable'])->name('student.my_timetable');
});
