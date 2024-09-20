<?php

// use App\Http\Controllers\FeedbackController;


use App\Http\Controllers\Admin\FieldController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\API\BookingController;
use App\Http\Controllers\API\OrderProductController;
// use App\Http\Controllers\Api\FeedbackController;
use App\Http\Controllers\Api\FildController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ColorController;
use App\Http\Controllers\API\DiscountProductController;
use App\Http\Controllers\API\FeedbackController;
use App\Http\Controllers\API\HistoryController;
use App\Http\Controllers\API\NotificationController;
use App\Http\Controllers\API\PaymentController as APIPaymentController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\ProductController as APIProductController;
use App\Http\Controllers\API\SizeController;
use App\Http\Controllers\API\SlideShowController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\API\AddToCardController;
use App\Http\Controllers\API\DeliveryController;
use App\Http\Controllers\API\EventController;
use App\Http\Controllers\API\MatchTeamController;
use App\Http\Controllers\API\OptionController as APIOptionController;
use App\Http\Controllers\API\ProfileController;
use App\Http\Controllers\API\ScheduleMatchController as APIScheduleMatchController;
use App\Http\Controllers\Auth\ProfileController as AuthProfileController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ScheduleMatchController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Resources\FeedbackResource;
use App\Models\Post;
use App\Models\ScheduleMatch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\API\FeedbackController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Authentication
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::put('/customers/{id}/role', [AuthController::class, 'updateRole']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

//Profile
Route::put('/profile/update', [ProfileController::class, 'update'])->middleware('auth:sanctum');
Route::get('/me', [AuthController::class, 'index'])->middleware('auth:sanctum');
Route::get('/owner/show/{id}', [AuthController::class, 'show']);

//Field
Route::get('fields/list', [FildController::class, 'index'])->name('field.list');
Route::post('field/create', [FildController::class, 'store'])->name('field.create');
Route::get('/field/show/{id}', [FildController::class, 'show'])->name('field.show');
Route::put('field/update/{id}', [FildController::class, 'update'])->name('field.update');
Route::delete('field/delete/{id}', [FildController::class, 'destroy'])->name('field.delete');

//Order
Route::middleware('auth:sanctum')->group(function () {
    Route::get('orders/list', [OrderProductController::class, 'index']);
    Route::post('orders/create', [OrderProductController::class, 'store']);

    Route::delete('orders/cancel/{id}', [OrderProductController::class, 'cancel']);
    Route::post('/orders/{id}/confirm', [OrderProductController::class, 'confirm']);
    Route::put('orders/reactivate/{id}', [OrderProductController::class, 'reactivate']);
});
Route::get('/order/show/{id}', [OrderProductController::class, 'show']);

//Booking
Route::get('/booking/list', [BookingController::class, 'index']);
Route::post('/booking/create', [BookingController::class, 'store']);
Route::get('/booking/show/{id}', [BookingController::class, 'show']);
Route::put('/booking/accept/{id}', [BookingController::class, 'acceptBooking']);
Route::put('/booking/reject/{id}', [BookingController::class, 'rejectBooking']);
Route::put('/booking/cancel/{id}', [BookingController::class, 'cancelBooking']);

//feedback
Route::apiResource('feedback', FeedbackResource::class);


// Categories API Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/category/list', [CategoryController::class, 'index']);
    Route::post('/category/create', [CategoryController::class, 'store']);
    Route::put('/category/update/{id}', [CategoryController::class, 'update']);
    Route::delete('/category/delete/{id}', [CategoryController::class, 'destroy']);
});
Route::get('/category/show/{id}', [CategoryController::class, 'show']);

// Products API Routes
Route::get('/product/list', [APIProductController::class, 'index']);
Route::post('/product/create', [APIProductController::class, 'store'])->middleware('auth:sanctum');
Route::put('/product/update/{id}', [APIProductController::class, 'update'])->middleware('auth:sanctum');
Route::get('/product/show/{id}', [APIProductController::class, 'show']);
Route::delete('/product/delete/{id}', [APIProductController::class, 'destroy'])->middleware('auth:sanctum');
Route::get('/sizes', [SizeController::class, 'index']);
Route::get('/colors', [ColorController::class, 'index']);

//Discount
Route::get('/discount/list', [DiscountProductController::class, 'index'])->name('discount.list');
Route::post('/discount/create', [DiscountProductController::class, 'store'])->name('discount.create');
Route::get('/discount/show/{id}', [DiscountProductController::class, 'show'])->name('discount.show');
Route::put('/discount/update/{id}', [DiscountProductController::class, 'update'])->name('discount.update');
Route::delete('/discount/delete/{id}', [DiscountProductController::class, 'destroy'])->name('discount.destroy');

//Slide show
Route::get('/slideshow/list', [SlideShowController::class, 'index'])->name('slideshow.list');

//History
Route::get('/histories/list', [HistoryController::class, 'index'])->name('history.list');
Route::post('/histories/create', [HistoryController::class, 'store'])->name('history.store');
Route::get('/customer/bookings/{id}', [BookingController::class, 'getBookingsByUserId']);
Route::delete('/customer/bookings/delete/{id}', [BookingController::class, 'destroy'])->name('booking.destroy');
Route::get('/customer/orders/{id}', [OrderProductController::class, 'getOrdersByUserId']);

//Notifications
Route::get('/notifications/list/{id}', [NotificationController::class, 'getNotificationsByUserId']);
Route::get('/notification/show/{id}', [NotificationController::class, 'show']);
Route::put('/notification/update/{id}', [NotificationController::class, 'updateNotification']);
Route::delete('/notifications/delete/{id}', [NotificationController::class, 'destroy']);
Route::post('/notifications/store', [NotificationController::class, 'store']);

//Payment
Route::post('/stripe/payment', [StripePaymentController::class, 'makePayment']);
Route::post('/payment/create', [APIPaymentController::class, 'createPayment']);
Route::get('/payment/list', [APIPaymentController::class, 'index']);
Route::put('/update/payment/booking/{id}', [BookingController::class, 'updateStatusPaymentBooking']);
Route::put('/update/payment/order/{id}', [OrderProductController::class, 'updateStatusPaymentOrder']);
Route::delete('/customer/orders/delete/{id}', [OrderProductController::class,'deleteOrder']);

//Chart
Route::middleware('auth:sanctum')->group(function () {
    Route::get('cart/list', [AddToCardController::class, 'index']);
    Route::post('cart/create', [AddToCardController::class, 'store']);
    Route::get('cart/show/{id}', [AddToCardController::class, 'show']);
    Route::put('cart/update/{id}', [AddToCardController::class, 'update']);
    Route::delete('cart/delete/{id}', [AddToCardController::class, 'destroy']);
});

//match 
Route::post('/post/match', [MatchTeamController::class,'store']);
Route::get('/match/list', [MatchTeamController::class,'index']);
Route::get('/match/delete/{id}', [MatchTeamController::class,'destroy']);

//Schedule
Route::post('/schedule/create', [APIScheduleMatchController::class,'store']);
Route::get('/schedule/list', [APIScheduleMatchController::class,'index']);

//Post team find partner
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/posts', [PostController::class, 'store']);
    Route::get('/post/list', [PostController::class, 'index']);
    Route::delete('/posts/{id}', [PostController::class, 'destroy']);
    
});
Route::put('/post/update/{id}', [PostController::class, 'updatePostStatus']);
Route::get('/post/show/{id}', [PostController::class, 'show']);
Route::put('/post/modify/{id}', [PostController::class, 'update']); 

//Events
Route::post('/event/create', [EventController::class,'store']);
Route::get('/event/list/{id}', [EventController::class,'index']);
Route::get('/event/show/{id}', [EventController::class,'show']);

//Feedbacks
Route::middleware('auth:sanctum')->group(function () {

    Route::get('/feedbacks/{id}', [FeedbackController::class, 'index']);
    Route::post('feedback/create', [FeedbackController::class, 'store']);
    Route::get('feedback/show/{id}', [FeedbackController::class, 'show']);
    Route::put('feedback/update/{id}', [FeedbackController::class, 'update']);
    Route::delete('feedback/delete/{id}', [FeedbackController::class, 'destroy']);
});

//option
Route::get('/options', [APIOptionController::class, 'index']);
