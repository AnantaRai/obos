<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ConfirmationController;
use App\Http\Controllers\CouponsController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\FeedBackController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ReportController;
use App\Mail\OrderPlaced;
use App\Models\Order;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::get('/', [LandingPageController::class, 'index'])->name('landing-page');

Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/shop/{product}', [ShopController::class, 'show'])->name('shop.show');

Route::group(['middleware' => 'auth', 'prefix' => 'cart'], function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::post('/', [CartController::class, 'store'])->name('cart.store');
    Route::patch('/{product}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/{product}', [CartController::class, 'destroy'])->name('cart.destroy');
});

Route::group(['middleware' => 'auth', 'prefix' => 'coupon'], function () {
    Route::post('/', [CouponsController::class, 'store'])->name('coupon.store');
    Route::delete('/', [CouponsController::class, 'destroy'])->name('coupon.destroy');
});

Route::group(['middleware' => 'auth', 'prefix' => 'checkout'], function () {
    Route::get('/', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/', [CheckoutController::class, 'store'])->name('checkout.store');
});

Route::get('/thankyou', [ConfirmationController::class, 'index'])->name('confirmation.index');

Route::get('empty', function () {
    Cart::destroy();
});

Route::group(['middleware' => 'auth'], function() {
    Route::get('/my-profile', [UsersController::class, 'edit'])->name('users.edit');
    Route::patch('/my-profile', [UsersController::class, 'update'])->name('users.update');
    Route::get('/my-orders', [OrdersController::class, 'index'])->name('orders.index');
    Route::get('/my-order/{order}', [OrdersController::class, 'show'])->name('orders.show');
    Route::post('/orders/{order}', [OrdersController::class, 'update'])->name('orders.update');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/code', function() {
    return session()->get('coupon')['name'] ?? null;;
});

Route::post('/newsletter', NewsletterController::class);

Route::get('/admin/print/{orderId}', function($id) {
        $order = Order::find($id);
        $products = $order->products;
        $payment = $order->payment;
        $deliveryCharge = 150;
        return view('pdf', compact('order', 'products', 'payment','deliveryCharge'));
})->middleware('admin.user')->name('order.print');

Route::get('/admin/report', [ReportController::class, 'index'])->middleware('admin.user')->name('report.index');

Route::get('/feedback', [FeedbackController::class, 'create'])->name('feedback.create');
Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');

Route::get('/mailable', function() {
    $order = Order::find(7);
    return new OrderPlaced($order);
});

require __DIR__ . '/auth.php';

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
