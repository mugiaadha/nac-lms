<?php

use App\Http\Controllers\Backoffice\AdminController;
use App\Http\Controllers\Backoffice\CategoryController;
use App\Http\Controllers\Backoffice\InstructorController;
use App\Http\Controllers\FrontOfficeController;
use App\Http\Controllers\ProfileController;
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
    Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::get('/user/password', [UserController::class, 'password'])->name('user.password');

    Route::post('/user/profile-update', [UserController::class, 'updateProfile'])->name('user.profile.update');
    Route::post('/user/password-update', [UserController::class, 'updatePassword'])->name('user.password.update');


    Route::delete('/user/account-delete', [UserController::class, 'profile'])->name('user.account.delete');


    // todo: Add more user routes as needed
    Route::get('/user/courses', [UserController::class, 'courses'])->name('user.courses');
    Route::get('/user/quizzes', [UserController::class, 'quizzes'])->name('user.quizzes');
    Route::get('/user/bookmarks', [UserController::class, 'bookmarks'])->name('user.bookmarks');
    Route::get('/user/messages', [UserController::class, 'messages'])->name('user.messages');
    Route::get('/user/reviews', [UserController::class, 'reviews'])->name('user.reviews');
    Route::get('/user/earnings', [UserController::class, 'earnings'])->name('user.earnings');
    Route::get('/user/account', [UserController::class, 'account'])->name('user.account');
});

// admin routes
Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', [AdminController::class, 'login'])->name('admin.login');

    Route::middleware(['auth', 'roles:admin'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');
        Route::get('/change-password', [AdminController::class, 'changePassword'])->name('admin.change.password');
        Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
        Route::get('/all-category', [CategoryController::class, 'allCategory'])->name('category.all');
        Route::get('/add-category', [CategoryController::class, 'addCategory'])->name('category.add');

        Route::post('/profile/insert-category', [CategoryController::class, 'insertCategory'])->name('category.insert');
        Route::post('/profile/update-profile', [AdminController::class, 'profileUpdate'])->name('admin.profile.update');
        Route::post('/profile/update-password', [AdminController::class, 'profileUpdatePassword'])->name('admin.profile.update-password');
    });
});


// instructor routes
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
