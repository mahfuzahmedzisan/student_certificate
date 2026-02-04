<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\StudentController;

Route::middleware(['auth:admin', 'admin', 'adminVerify'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::controller(AdminController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::get('/view/{id}', 'view')->name('view');
            Route::get('/trash', 'trash')->name('trash');
        });
  
});
Route::middleware(['auth:admin', 'admin', 'adminVerify'])->name('student.')->prefix('student')->group(function () {
    Route::controller(StudentController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::get('/view/{id}', 'view')->name('view');
            Route::get('/status/{id}', 'status')->name('status');
            Route::get('/trash', 'trash')->name('trash');
        });
  
});
