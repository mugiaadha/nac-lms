<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\FrontOfficeController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\ProfileController;
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

require __DIR__ . '/auth.php';

Route::get('/', [FrontOfficeController::class, 'index'])->name('home');

Route::group(['prefix' => 'dashboard'], function () {
    Route::get('/', [FrontOfficeController::class, 'dashboard'])->name('dashboard');
    Route::get('/logout', [FrontOfficeController::class, 'logout'])->name('dashboard.logout');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'roles:student'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', [AdminController::class, 'login'])->name('admin.login');

    Route::middleware(['auth', 'roles:admin'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');
        Route::get('/change-password', [AdminController::class, 'changePassword'])->name('admin.change.password');
        Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');

        Route::post('/profile/update-profile', [AdminController::class, 'profileUpdate'])->name('admin.profile.update');
        Route::post('/profile/update-password', [AdminController::class, 'profileUpdatePassword'])->name('admin.profile.update-password');
    });
});

Route::group(['prefix' => 'instructor'], function () {
    Route::get('/login', [InstructorController::class, 'login'])->name('instructor.login');

    Route::middleware(['auth', 'roles:instructor'])->group(function () {
        Route::get('/dashboard', [InstructorController::class, 'dashboard'])->name('instructor.dashboard');
        Route::get('/profile', [InstructorController::class, 'profile'])->name('instructor.profile');
        Route::get('/change-password', [InstructorController::class, 'changePassword'])->name('instructor.change.password');
        Route::get('/logout', [InstructorController::class, 'logout'])->name('instructor.logout');

        Route::post('/profile/update-profile', [InstructorController::class, 'profileUpdate'])->name('instructor.profile.update');
        Route::post('/profile/update-password', [InstructorController::class, 'profileUpdatePassword'])->name('instructor.profile.update-password');
    });
});
