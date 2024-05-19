<?php

use App\Http\Controllers\PosController;
use App\Http\Controllers\PurchasedController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController,
    ReportController,
    InvoiceController,
    ProductController,
    ProductGetController,
    StoreController,
    StoreSelectionController,
    UserController,
    OrderController};

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

/** * * *  Handle the store selection after the user signs in */
Route::group(['as'=>'store.', 'prefix'=>'storeselection', 'middleware'=>'auth'], function() {
    Route::get('', [StoreSelectionController::class, 'storeselection'])->name('selection');
    Route::post('', [StoreSelectionController::class, 'processstoreselection'])->name('process.selection');
});

// Redirect to the login page when I hit the home page
Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::group(['middleware' => ['auth', 'selected.store'], 'prefix' => '{store}'], function() {

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::group(['as' => 'profile.'], function() {
        Route::get('profile', function() {
            return view('profile', [
                'user' => Auth()->user(),
            ]);
        })->name('index');
        Route::patch('/profile/{profile}', [HomeController::class, 'updatePassword'])->name('update');
    });

    Route::group(['as' => 'product.'], function() {
        Route::get('management/products', [ProductController::class, 'index'])->name('index');
        Route::post('management/products', [ProductController::class, 'store'])->name('store');
        Route::patch('management/products/{product}', [ProductController::class, 'update'])->name('update');
        Route::delete('management/products/{product}', [ProductController::class, 'destroy'])->name('destroy');
    });

    Route::group(['as' => 'user.', 'middleware' => ['role:admin|Super Admin|manager']], function() {
        Route::get('management/users', [UserController::class, 'index'])->name('index');
        Route::post('management/users', [UserController::class, 'store'])->name('store');
        Route::patch('management/users/{user}', [UserController::class, 'update'])->name('update');
        Route::delete('management/users/{user}', [UserController::class, 'destroy'])->name('destroy');
    });

    Route::group(['as' => 'order.'], function() {
        Route::get('management/orders', [OrderController::class, 'index'])->name('index');
        Route::delete('management/orders/{order}', [OrderController::class, 'destroy'])->name('destroy');
    });

    Route::group(['as' => 'pos.'], function() {
        Route::get('pos', [PosController::class, 'index'])->name('index');
        Route::get('pos/product', [ProductGetController::class, 'viewproduct'])->name('viewproduct');
        Route::post('pos', [PosController::class, 'store'])->name('store');
    });

    Route::group(['as' => 'report.'], function() {
        Route::get('reports', [ReportController::class, 'index'])->name('index');
        Route::get('orders/data', [ReportController::class, 'getOrdersData'])->name('orders.data');
    });

    Route::group(['as' => 'purchased.'], function() {
        Route::get('purchased', [PurchasedController::class, 'index'])->name('index');
    });

    Route::group(['as' => 'invoice.'], function() {
        Route::get('invoice/{invoice}', [PurchasedController::class, 'show'])->name('show');
        Route::get('print/{invoice}', [PurchasedController::class, 'generateinvoice'])->name('print');
    });

});
