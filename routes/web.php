<?php

use App\Http\Controllers\SettingsController;
use App\Http\Controllers\Admin\FeedbackController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\FieldController;
use App\Http\Controllers\Admin\MailSettingController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\ChatCotroller;
use App\Http\Controllers\Admin\ClientController as AdminClientController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ProgressController as AdminProgressController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\SettingController;
// use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SlideshowController; // Add this line
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SlideshowAdminController; // Add this line
use App\Http\Controllers\ClientController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\ProgressController;
use Faker\Core\File;
use GuzzleHttp\Psr7\Response;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('auth.login');
});

Route::get('/test-mail', function () {
    \Mail::raw('Hi, welcome!', function ($message) {
        $message->to('ajayydavex@gmail.com')->subject('Testing mail');
    });
    dd('sent');
});

Route::get('/dashboard', function () {
    return view('front.dashboard');
})->middleware(['front'])->name('dashboard');

require __DIR__ . '/front_auth.php';

// Admin routes
Route::get('/admin/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('admin.dashboard');

require __DIR__ . '/auth.php';
Route::get('/storage/{filename}', function ($filename) {
    $path = storage_path('app/public/' . $filename);
    if (!File::exists($path)) {
        abort(404);
    }
    $file = File::get($path);
    $type = File::mimeType($path);
    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);
    return $response;
})->where('filename', '.*');

// routes/web.php
Route::get('/dropdown', function () {
    return view('dropdown');
});


Route::namespace('App\Http\Controllers\Admin')->name('admin.')->prefix('admin')
    ->group(function () {
        Route::resource('roles', 'RoleController');
        Route::resource('permissions', 'PermissionController');
        Route::resource('users', 'UserController');
        Route::resource('clients', 'ClientController');
        Route::resource('schedules', 'ScheduleController');
        Route::resource('progresses', 'ProgressController');
        Route::resource('products', 'ProductController');
        Route::resource('categories', 'CategoryController');
        Route::get('/profile', [ProfileController::class, 'list'])->name('profile');
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
        Route::put('/profile-update', [ProfileController::class, 'update'])->name('profile.update');
    });

//Booking
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

//Users
Route::get('/users/create', [UserController::class, 'createAccount'])->name('users.create');
Route::post('/register/store', [UserController::class, 'register'])->name('register.store');
Route::get('/admin/loginform', [UserController::class, 'loginform'])->name('admin.loginform');
Route::post('/admin/users', [UserController::class, 'store'])->name('admin.users.store');

//Categories
Route::get('/admin/categories', [CategoryController::class, 'index'])->name('admin.categories.index');

//Clients
Route::get('/admin/clients', [AdminClientController::class, 'index'])->name('admin.clients.index');

//Client's progress
Route::get('/client/progress/{id}', [AdminProgressController::class, 'progress'])->name('client.progresses.index');
