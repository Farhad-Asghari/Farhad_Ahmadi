<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;

Route::get('/', function () {
    return redirect()->route('login');
});

// Available for users who are not signed in
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/register', [AuthController::class, 'regsiter'])
        ->name('register.store');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.store');
});

// Available for signed-in users
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [
        CourseController::class, 'index'
    ])->name('dashboard');

    Route::post('/courses', [
        CourseController::class, 'store'
    ])->name('courses.store');

    Route::get('/courses/{course}/edit', [
        CourseController::class, 'edit'
    ])->whereNumber('course')->name('courses.edit');

    Route::get('/courses/{course}', [
        CourseController::class, 'show'
    ])->whereNumber('course')->name('courses.show');

    Route::put('/courses/{course}', [
        CourseController::class, 'update'
    ])->whereNumber('course')->name('courses.update');

    Route::delete('/courses/{course}', [
        CourseController::class, 'destroy'
    ])->whereNumber('course')->name('courses.destroy');

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');
});
