<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});


Route::get('/dashboard', function () {
    return view('frontend.dashboard.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/',[UserController::class,'index'])->name('index');

Route::middleware('auth')->group(function () {
    Route::post('/profile/store', [UserController::class, 'profileStore'])->name('profile.store');
    Route::get('/user/logout', [UserController::class, 'userLogout'])->name('user.logout');
    Route::get('/change/password', [UserController::class, 'changePassword'])->name('change.password');
    Route::post('/user/password/update', [UserController::class, 'passwordUpdate'])->name('user.password.update');


});

//Admin
Route::middleware(['admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/admin/profile', [AdminController::class, 'adminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'adminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change-password', [AdminController::class, 'adminChangePassword'])->name('admin.change_password');
    Route::post('/admin/update-password', [AdminController::class, 'adminUpdatePassword'])->name('admin.update_password');
//category
    Route::controller(CategoryController::class)->group(function () {
        //category
        Route::get('/all/categories', 'allCategories')->name('all.categories');
        Route::get('/add/category', 'addCategory')->name('add.category');
        Route::post('/category/store', 'storeCategory')->name('category.store');
        Route::get('/edit/category/{id}', 'editCategory')->name('edit.category');
        Route::post('/update/category/{id}', 'updateCategory')->name('update.category');
        Route::get('/delete/category/{id}', 'deleteCategory')->name('delete.category');

        //city
        Route::get('/all/cities', 'allCities')->name('all.cities');

        Route::post('/city/store', 'storeCity')->name('city.store');
        Route::get('/edit/city/{id}', 'editCity')->name('edit.city');
        Route::post('/update/city', 'updateCity')->name('update.city');
        Route::get('/delete/city/{id}', 'deleteCity')->name('delete.city');



    });
});


Route::get('/admin/login', [AdminController::class, 'adminLogin'])->name('admin.login');
Route::post('/admin/login-submit', [AdminController::class, 'adminLoginSubmit'])->name('admin.login_submit');
Route::get('/admin/logout', [AdminController::class, 'adminLogout'])->name('admin.logout');
Route::get('/admin/forget-password', [AdminController::class, 'adminForgetPassword'])->name('admin.forget_password');
Route::post('/admin/password-submit', [AdminController::class, 'adminPasswordSubmit'])->name('admin.password_submit');
Route::get('/admin/reset-password/{token}/{email}', [AdminController::class, 'adminResetPassword'])->name('admin.reset_password');
Route::post('/admin/reset-password-submit', [AdminController::class, 'adminResetPasswordSubmit'])->name('admin.reset_password_submit');

//Client

Route::middleware(['client'])->group(function () {
    Route::get('/client/dashboard', [ClientController::class, 'clientDashboard'])->name('client.dashboard');
    Route::get('/client/profile', [ClientController::class, 'clientProfile'])->name('client.profile');
    Route::post('/client/profile/store', [ClientController::class, 'clientProfileStore'])->name('client.profile.store');
    Route::get('/client/change-password', [ClientController::class, 'clientChangePassword'])->name('client.change_password');
    Route::post('/client/update-password', [ClientController::class, 'clientUpdatePassword'])->name('client.update_password');

});

Route::get('/client/login', [ClientController::class, 'clientLogin'])->name('client.login');
Route::post('/client/login-submit', [ClientController::class, 'clientLoginSubmit'])->name('client.login_submit');
Route::get('/client/register', [ClientController::class, 'clientRegister'])->name('client.register');
Route::post('/client/register-submit', [ClientController::class, 'clientRegisterSubmit'])->name('client.register_submit');
Route::get('/client/logout', [ClientController::class, 'clientLogout'])->name('client.logout');

require __DIR__ . '/auth.php';
