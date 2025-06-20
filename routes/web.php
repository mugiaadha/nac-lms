<?php

use App\Http\Controllers\Backoffice\AdminController;
use App\Http\Controllers\Backoffice\CategoryController;
use App\Http\Controllers\Backoffice\InstructorController;
use App\Http\Controllers\Backoffice\SubCategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FrontOfficeController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/instructor/register', [HomeController::class, 'register'])->name('instructor.register');

Route::group(['prefix' => 'dashboard'], function () {
    Route::get('/', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('/logout', [HomeController::class, 'logout'])->name('dashboard.logout');


    Route::group(['prefix' => 'profile'], function () {
        Route::get('/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::get('/info', [FrontOfficeController::class, 'profile'])->name('profile.info');
        Route::get('/password', [FrontOfficeController::class, 'password'])->name('profile.password');
        Route::post('/update', [FrontOfficeController::class, 'updateProfile'])->name('profile.update');
        Route::post('/update-password', [FrontOfficeController::class, 'updatePassword'])->name('profile.update.password');
    });
})->middleware(['auth', 'verified', 'roles:student'])->name('dashboard');

Route::middleware(['auth', 'roles:student'])->group(function () {
    // todo: Add more user routes as needed
    Route::get('/user/courses', [FrontOfficeController::class, 'courses'])->name('user.courses');
    Route::get('/user/quizzes', [FrontOfficeController::class, 'quizzes'])->name('user.quizzes');
    Route::get('/user/bookmarks', [FrontOfficeController::class, 'bookmarks'])->name('user.bookmarks');
    Route::get('/user/messages', [FrontOfficeController::class, 'messages'])->name('user.messages');
    Route::get('/user/reviews', [FrontOfficeController::class, 'reviews'])->name('user.reviews');
    Route::get('/user/earnings', [FrontOfficeController::class, 'earnings'])->name('user.earnings');
    Route::get('/user/account', [FrontOfficeController::class, 'account'])->name('user.account');
    Route::delete('/user/account-delete', [FrontOfficeController::class, 'profile'])->name('user.account.delete');
});

// admin routes
Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', [AdminController::class, 'login'])->name('admin.login');

    Route::middleware(['auth', 'roles:admin'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/change-password', [AdminController::class, 'changePassword'])->name('admin.change.password');
        Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
        Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');
        Route::post('/profile/update-profile', [AdminController::class, 'profileUpdate'])->name('admin.profile.update');
        Route::post('/profile/update-password', [AdminController::class, 'profileUpdatePassword'])->name('admin.profile.update-password');

        // category
        Route::group(['prefix' => 'category'], function () {
            Route::get('/all', [CategoryController::class, 'index'])->name('category.all');
            Route::get('/add', [CategoryController::class, 'add'])->name('category.add');
            Route::get('/edit-category/{id}', [CategoryController::class, 'edit'])->name('category.edit');
            Route::get('/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');
            Route::post('/insert', [CategoryController::class, 'insert'])->name('category.insert');
            Route::post('/update', [CategoryController::class, 'update'])->name('category.update');
        });

        // sub category
        Route::group(['prefix' => 'sub-category'], function () {
            Route::get('/all', [SubCategoryController::class, 'index'])->name('sub-category.all');
            Route::get('/add', [SubCategoryController::class, 'add'])->name('sub-category.add');
            Route::get('/edit/{id}', [SubCategoryController::class, 'edit'])->name('sub-category.edit');
            Route::get('/delete/{id}', [SubCategoryController::class, 'delete'])->name('sub-category.delete');
            Route::post('/insert', [SubCategoryController::class, 'insert'])->name('sub-category.insert');
            Route::post('/update', [SubCategoryController::class, 'update'])->name('sub-category.update');
        });
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
