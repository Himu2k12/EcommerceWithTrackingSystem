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



Auth::routes();

Route::get('/', 'WelcomeController@index');
//Route::get('/home', 'HomeController@index')->name('home');




//admin routes start from here
Route::get('/order-view', 'AdminWelcomeController@viewOrder');
Route::get('/details-order-view/{id}', 'AdminWelcomeController@detailsOrder');
Route::get('/location-history', 'AdminWelcomeController@locationHistory');
Route::get('/view-on-map/{id}', 'AdminWelcomeController@showlocation');

Route::get('/Confirm-delivery/{id}', 'AdminWelcomeController@confirmDelivery');

Route::get('/admin-view', 'AdminWelcomeController@ShowDashboard');
Route::get('/admin-view-customer', 'AdminWelcomeController@ShowCustomer');
Route::get('/admin-view-dealer', 'AdminWelcomeController@ShowDealer');

Route::get('/admin-disable-brand/{id}', 'AdminWelcomeController@disableBrandInfo');
Route::get('/admin-active-brand/{id}', 'AdminWelcomeController@activeBrandInfo');
Route::get('/view-brand-details/{id}', 'AdminWelcomeController@viewBrandDetails');
Route::get('/admin-create-delivery-man', 'AdminWelcomeController@CreateDeliveryMan');
Route::post('/save-delivery', 'AdminWelcomeController@saveDel');

Route::get('/add-brand', 'BrandController@addBrand');
Route::post('/new-brand', 'BrandController@saveBrandInfo');
Route::get('/manage-brand', 'BrandController@managebrandInfo');
Route::get('/disabled-brand/{id}', 'BrandController@disabledbrandInfo');
Route::get('/active-brand/{id}', 'BrandController@activebrandInfo');
Route::get('/edit-brand/{id}', 'BrandController@editbrandInfo');
Route::post('/update-brand', 'BrandController@updatebrandInfo');
Route::get('/add-product', 'ProductController@addProduct');
Route::post('/new-product', 'ProductController@saveProductInfo');
Route::get('/manage-product', 'ProductController@manageProductInfo');
Route::get('/view-product/{id}', 'ProductController@viewProductInfo');
Route::get('/edit-product/{id}', 'ProductController@editProductInfo');
Route::post('/update-product', 'ProductController@updateProductInfo');
Route::get('/disabled-product/{id}', 'ProductController@disabledProductInfo');
Route::get('/activate-product/{id}', 'ProductController@activeProductInfo');


Route::get('/add-category', 'CategoryController@addCategory');
Route::post('/new-category', 'CategoryController@newCategory');
Route::get('/manage-category', 'CategoryController@manageCategoryInfo');
Route::get('/disable-category/{id}', 'CategoryController@disabledCategoryInfo');
Route::get('/active-category/{id}', 'CategoryController@activeCategoryInfo');
Route::get('/edit-category/{id}', 'CategoryController@editCategoryInfo');
Route::post('/update-category', 'CategoryController@updateCategoryInfo');



Route::get('/add-product-cart/{id}', 'CartController@addToCart');
Route::post('/update-cart', 'CartController@updateCartById');
Route::get('/remove-from-cart/{id}', 'CartController@removeCartById');
Route::post('/add-cart-from-details', 'CartController@addToCartFromDetails');
Route::get('/product-details/{id}', 'ProductController@viewProductDetails');
Route::get('/cart-content', 'CartController@showCart');
Route::post('/confirm-order', 'OrderController@makeOrder');
Route::get('/my-order', 'OrderController@myOrders');
Route::get('/order-tracking', 'OrderController@trackOrder');
Route::get('/delivery-home', 'OrderController@setDeliveryManOnOrder');
Route::post('/allocate-deliveryman', 'OrderController@saveAllocation');
Route::post('/check-order', 'OrderController@SearchOrder');
Route::post('/my-tracking', 'OrderController@SearchMyOrder');


//track controller

Route::post('/getDirection', 'TrackController@saveLocation');