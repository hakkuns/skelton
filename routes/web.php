<?php

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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/**
 * Admin routes
 */
Route::namespace('Admin')->group(function () {
    Route::get('admin/login', 'LoginController@showLoginForm')->name('admin.login');
    Route::post('admin/login', 'LoginController@login')->name('admin.login');
    Route::get('admin/logout', 'LoginController@logout')->name('admin.logout');
});
Route::group(['prefix' => 'admin', 'middleware' => ['employee'], 'as' => 'admin.' ], function () {
    Route::namespace('Admin')->group(function () {
        Route::get('/', 'DashboardController@index')->name('dashboard');

        Route::resource('products', 'ProductController');
        Route::get('remove-image-product', 'ProductController@removeImage')->name('product.remove.image');
        Route::get('remove-image-thumb', 'ProductController@removeThumbnail')->name('product.remove.thumb');
         
        Route::resource('customers', 'CustomerController');
        Route::resource('customers.address', 'CustomerAddressController');
        
        Route::resource('categories', 'CategoryController');
        Route::get('remove-image-category', 'CategoryController@removeImage')->name('category.remove.image');

        Route::resource('orders', 'OrderController');
        Route::resource('order-statuses', 'OrderStatusController');

        Route::resource('addresses', 'AddressController');
        Route::resource('attributes', 'AttributeController');
        Route::resource('attributes.values', 'AttributeValueController');
        Route::resource('brands', 'BrandController');

        Route::resource('employees', 'EmployeeController');
        Route::get('employees/{id}/profile', 'EmployeeController@getProfile')->name('employee.profile');
        Route::put('employees/{id}/profile', 'EmployeeController@updateProfile')->name('employee.profile.update');

    });
});


Auth::routes();
Route::namespace('Auth')->group(function () {
    Route::get('cart/login', 'CartLoginController@showLoginForm')->name('cart.login');
    Route::post('cart/login', 'CartLoginController@login')->name('cart.login');
    Route::get('logout', 'LoginController@logout');
});
Route::namespace('Front')->group(function () {
    Route::get('/', 'HomeController@index')->name('home');

    Route::group(['middleware' => ['auth', 'web']], function () {
        Route::get('account', 'AccountController@index')->name('account');
        Route::resource('customer.address', 'CustomerAddressController');
        Route::get('checkout', 'CheckoutController@index')->name('checkout.index');
        Route::post('checkout', 'CheckoutController@store')->name('checkout.store');
        Route::get('checkout/execute', 'CheckoutController@executePayPalPayment')->name('checkout.execute');
        Route::post('checkout/execute', 'CheckoutController@charge')->name('checkout.execute');
        Route::get('checkout/cancel', 'CheckoutController@cancel')->name('checkout.cancel');
        Route::get('checkout/success', 'CheckoutController@success')->name('checkout.success');
        Route::get('account', 'AccountController@index')->name('account');
    });

    Route::resource('cart', 'CartController');
    Route::get("category/{slug}", 'CategoryController@getCategory')->name('front.category.slug');
    Route::get("{product}", 'ProductController@show')->name('front.get.product');
});
