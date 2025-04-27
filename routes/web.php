<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProfileController;
use App\Models\Employee;
use Illuminate\Support\Facades\Route;

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

    Route::prefix('employee')->group(function () {
        Route::get('/index', [EmployeeController::class, 'index'])->name('employee.index');
        Route::get('/create', [EmployeeController::class, 'create'])->name('employee.create');
        Route::post('/create', [EmployeeController::class, 'store'])->name('employee.store');
        Route::post('/filter', [EmployeeController::class, 'filterEmployees'])->name('employee.filter');
        Route::get('/employee/chart', [EmployeeController::class, 'getDataForGraph'])->name('employee.chart');
        Route::get('/employee/map', [EmployeeController::class, 'getDataForMap'])->name('employee.map');
    });

    Route::prefix('department')->group(function () {
        Route::get('/index', [DepartmentController::class, 'index'])->name('department.index');
        Route::get('/create', [DepartmentController::class, 'create'])->name('department.create');
        Route::post('/create', [DepartmentController::class, 'store'])->name('department.store');
    });
});

require __DIR__ . '/auth.php';
