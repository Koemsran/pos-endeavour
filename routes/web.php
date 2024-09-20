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
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\SettingController;
// use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SlideshowController; // Add this line
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SlideshowAdminController; // Add this line
use App\Http\Controllers\MailController;
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
        Route::put('orders/{id}/reactivate', [OrderController::class, 'reactivate'])
            ->name('orders.reactivate');

        Route::resource('roles', 'RoleController');
        Route::resource('permissions', 'PermissionController');
        Route::resource('users', 'UserController');
        Route::resource('posts', 'PostController');
        Route::resource('fields', 'FieldController');
        Route::resource('bookings', 'BookingController');
        Route::resource('settings', 'SettingController');
        Route::resource('slideshow', 'SlideShowController');
        Route::resource('products', 'ProductController');
        Route::resource('categories', 'CategoryController');
        Route::resource('payments', 'PaymentController');
        Route::resource('admin/feedbacks', FeedbackController::class);
        Route::resource('orders', 'OrderController');
        Route::resource('discounts', 'DiscountController');
        Route::resource('chats', 'ChatCotroller');
        Route::get('/profile', [ProfileController::class, 'list'])->name('profile');
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
        Route::put('/profile-update', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('/mail', [MailSettingController::class, 'index'])->name('mail.index');
        Route::put('/mail-update/{mailsetting}', [MailSettingController::class, 'update'])->name('mail.update');
    });

//booking
Route::get('/admin/bookings/{id}/cancel', [BookingController::class, 'cancel'])->name('admin.bookings.cancel');
Route::get('/admin/bookings/{id}/rebook', [BookingController::class, 'reStore'])->name('admin.bookings.rebook');
Route::get('/admin/bookings/{id}/accept', [BookingController::class, 'accept'])->name('admin.bookings.accept');
Route::get('/admin/bookings/{id}/reject', [BookingController::class, 'reject'])->name('admin.bookings.reject');
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

//User
Route::get('/users/create', [UserController::class, 'createAccount'])->name('users.create');
Route::post('/register/store', [UserController::class, 'register'])->name('register.store');
Route::get('/admin/loginform', [UserController::class, 'loginform'])->name('admin.loginform');
Route::post('/admin/users', [UserController::class, 'store'])->name('admin.users.store');

// Chat routes
Route::middleware(['auth'])->group(function () {
    Route::get('/chats/list', [ChatCotroller::class, 'index'])->name('chats.index');
    Route::post('/chats/create', [ChatCotroller::class, 'store'])->name('chats.store');
});

//Category
Route::get('/admin/categories', [CategoryController::class, 'index'])->name('admin.categories.index');

//Order
Route::get('/admin/orders/{id}/cancel', [OrderController::class, 'cancel'])->name('admin.orders.cancel');
Route::get('/admin/orders/{id}/accept', [OrderController::class, 'confirm'])->name('admin.orders.confirm');

//payment
Route::get('/payment/list', [PaymentController::class, 'index'])->name('admin.payment.list');
Route::get('/payment/form', [PaymentController::class, 'showPaymentForm'])->name('payment.form');
Route::get('/payment/month', [PaymentController::class, 'showPaymentFormMonth'])->name('payment.month');
Route::post('/payment/intent', [PaymentController::class, 'createPaymentIntent'])->name('payment.intent');
Route::post('/stripe/payment', [PaymentController::class, 'makePayment'])->name('payment.process');

//orders
Route::get('/admin/orders', function () {
    return "Route reached";
});

Route::get('/admin/orders', [OrderController::class, 'index']);
Route::get('/admin/orders', [OrderController::class, 'index'])->name('admin.orders.index');
Route::get('/admin/orders/confirm/{id}', [OrderController::class, 'confirm'])->name('admin.orders.confirm');
Route::get('/admin/orders/cancel/{id}', [OrderController::class, 'cancel'])->name('admin.orders.cancel');
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('orders', [OrderController::class, 'index'])->name('admin.orders.index');
    Route::get('orders/confirm/{id}', [OrderController::class, 'confirm'])->name('admin.orders.confirm');
    Route::get('orders/cancel/{id}', [OrderController::class, 'cancel'])->name('admin.orders.cancel');
});

//setting
Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
Route::post('/settings', [SettingController::class, 'store'])->name('settings.store');
Route::get('/settings/{id}/edit', [SettingController::class, 'edit'])->name('settings.edit');
Route::delete('/settings/{id}', [SettingController::class, 'destroy'])->name('settings.destroy');

//password
Route::put('/profile/password', [SettingController::class, 'checkPassword'])->name('admin.profile.checkPassword');
Route::put('/profile/password/update', [SettingController::class, 'updatePassword'])->name('admin.profile.updatePassword');
