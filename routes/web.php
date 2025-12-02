<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Gate;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth'])->group(function () {
    
    Route::get('/admin/users', [AdminController::class, 'index'])
        ->middleware('can:admin')
        ->name('admin.users');

    
    Route::post('/admin/users/{user}/role', [AdminController::class, 'updateRole'])
        ->middleware('can:admin')
        ->name('admin.updateRole');
});

Route::middleware(['auth', 'can:nastavnik'])->group(function () {
    Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('/tasks/view', [TaskController::class, 'index'])->name('tasks.view');
    Route::post('/tasks/update', [TaskController::class, 'update'])->name('tasks.update');
    
});

Route::middleware(['auth', 'can:student'])->group(function () {
    Route::get('/see', [StudentController::class, 'index'])->name('student.see');
    Route::post('/student/prijavi/{task}', [StudentController::class, 'prijava'])->name('student.prijavi');
});

Route::get('/lang/{locale}', function($locale){
    session(['locale' => $locale]);
    return back();
})->name('lang.switch');

require __DIR__.'/auth.php';
