<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Register web routes for your application.
| Routes will be assigned to the "web" middleware group.
|
*/

// Public Routes
Route::get('/', "HomeController");
// Route::get('/', "UserController@index")->name('home');
Route::get('/products', "ProductController@index")->name('products.index');
Route::get('/best-customers', "CustomerController@index")->name('best.customers');
Route::get('/contact', "ContactController@index")->name('contact.index');
Route::post('/contact', "ContactController@store")->name('contact.store');
Route::get('/about', "AboutController@index")->name('about');

// // Authentication Routes
Route::get('/login', "LoginController@showLoginForm")->name('login');
Route::post('/login', "LoginController@login")->name('login');
Route::view('/showRegisterForm', 'Staff.pages.registration')->name('showRegisterForm');
Route::post('/register', "UserController@createUser")->name('register');

// // Cart Routes


Route::get('/shop', "ShopController@categories")->name("shop.index");
Route::post('/shop/products', 'ShopController@getProductsByCategory')->name('shop.getProductsByCategory');


// Protected User Routes (Requires Authentication)
Route::middleware(['auth'])->group(
    function () {
        Route::get('/cart/{product}/add', "CartController@addToCart")->name("cart.add");
        Route::delete('/cart/{id}', "CartController@removeFromCart");
        Route::patch('/cart/{id}', "CartController@updateQuantity");
        Route::get('/cart', "CartController@viewCart")->name("cart.index");
        Route::get('/checkout', "CheckoutController@index")->name('checkout.index');
        Route::post('/checkout', "CheckoutController:@process")->name('checkout.process');
        Route::get('wishlist', 'WishlistController@index')->name('wishlist.index');
        Route::get('wishlist/{product}/add', 'WishlistController@addToWish')->name('wishlist.add');
        Route::delete('wishlist/{productId}/remove', 'WishlistController@remove')->name('wishlist.remove');
        // Admin-Only Routes for Roles & Permissions
        Route::prefix('admin')->name('admin.')->group(function () {
            Route::resource('/dashboard', "DashboardController");
            Route::resource('roles', "RoleController");
            Route::resource('permissions', "PermissionController");
            Route::resource('products', "ProductController");
            Route::resource('categories', "CategoryController");
            Route::resource('roles', "RoleController");
            Route::resource('tickets', "TicketController");
            // Define the assign-permission route correctly here
            Route::post('/roles/{role}/assign-permission', "RoleController@assignPermission")->name('roles.assign-permission');
            // Route::patch('products/{id}/toggle-status', [ProductController@toggleStatus'])->name('products.toggleStatus');
            Route::resource('assignRole', "AssignRoleController");
            Route::resource('discounts', "DiscountController");
            Route::resource('sliders', "SliderController");
        });
        // Route::get('categories', "CategoryController@index")->name('categories.index');
        Route::get('/product/{product}', "ProductController@show")->name('product.show');
        Route::get('/product/{productId}/discount', "OrderController@getProductDiscount")->name('orders.getProductDiscount');
        Route::resource('shipping_addresses', "ShippingAddressController");
        Route::resource('billing_addresses', "BillingAddressController");
        Route::resource('orders', "OrderController");
        // Route::get('/stats', "OrderController@stats")->name('orders.stats');
        Route::post('/logout', "LoginController@logout")->name('logout');
    }
);


// Fallback Route (404 Page)
Route::fallback(function () {
    return view('errors.404');
});
