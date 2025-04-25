<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ManageController;
use App\Http\Controllers\Admin\ManageOrderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Client\CouponController;
use App\Http\Controllers\Client\RestaurantController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\FrontEnd\CartController;
use App\Http\Controllers\FrontEnd\HomeController;
use App\Http\Controllers\FrontEnd\OrderController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/dashboard', function () {
    return view('frontend.dashboard.profile');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', [UserController::class, 'index'])->name('index');

Route::middleware('auth')->group(function () {
    Route::post('/profile/store', [UserController::class, 'profileStore'])->name('profile.store');
    Route::get('/user/logout', [UserController::class, 'userLogout'])->name('user.logout');
    Route::get('/change/password', [UserController::class, 'changePassword'])->name('change.password');
    Route::post('/user/password/update', [UserController::class, 'passwordUpdate'])->name('user.password.update');

    // Get Wishlist data for user
    Route::get('/all/wishlist', [HomeController::class, 'AllWishlist'])->name('all.wishlist');
    Route::get('/remove/wishlist/{id}', [HomeController::class, 'RemoveWishlist'])->name('remove.wishlist');
// user order
    Route::controller(ManageOrderController::class)->group(function(){
        Route::get('/user/order/list', 'UserOrderList')->name('user.order.list');
        Route::get('/user/order/details/{id}', 'UserOrderDetails')->name('user.order.details');
        Route::get('/user/invoice/download/{id}', 'UserInvoiceDownload')->name('user.invoice.download');

    });

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
    //manage
    Route::controller(ManageController::class)->group(function () {
        //product
        Route::get('/admin/all/product', 'AdminAllProduct')->name('admin.all.product');
        Route::get('/admin/add/product', 'AdminAddProduct')->name('admin.add.product');
        Route::post('/admin/store/product', 'AdminStoreProduct')->name('admin.product.store');
        Route::get('/admin/edit/product/{id}', 'AdminEditProduct')->name('admin.edit.product');
        Route::post('/admin/update/product', 'AdminUpdateProduct')->name('admin.product.update');
        Route::get('/admin/delete/product/{id}', 'AdminDeleteProduct')->name('admin.delete.product');

        //pending
        Route::get('/pending/restaurant', 'PendingRestaurant')->name('pending.restaurant');
        Route::get('/clientChangeStatus', 'ClientChangeStatus');
        Route::get('/approve/restaurant', 'ApproveRestaurant')->name('approve.restaurant');

        //banner
        Route::get('/all/banner', 'AllBanner')->name('all.banner');
        Route::post('/banner/store', 'BannerStore')->name('banner.store');
        Route::get('/edit/banner/{id}', 'EditBanner');
        Route::post('/banner/update', 'BannerUpdate')->name('banner.update');
        Route::get('/delete/banner/{id}', 'DeleteBanner')->name('delete.banner');
    });
    Route::controller(ManageOrderController::class)->group(function(){
        Route::get('/pending/order', 'PendingOrder')->name('pending.order');
        Route::get('/confirm/order', 'ConfirmOrder')->name('confirm.order');
        Route::get('/processing/order', 'ProcessingOrder')->name('processing.order');
        Route::get('/delivered/order', 'DeliveredOrder')->name('delivered.order');
        Route::get('/admin/order/details/{id}', 'AdminOrderDetails')->name('admin.order.details');

        Route::get('/pening_to_confirm/{id}', 'PendingToConfirm')->name('pening_to_confirm');
        Route::get('/confirm_to_processing/{id}', 'ConfirmToProcessing')->name('confirm_to_processing');
        Route::get('/processing_to_delivered/{id}', 'ProcessingToDeliver')->name('processing_to_delivered');

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
Route::middleware('client')->group(function () {
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

Route::middleware(['client','status'])->group(function () {

    //menu
    Route::controller(RestaurantController::class)->group(function () {
        Route::get('/all/menu', 'allMenu')->name('all.menu');
        Route::get('/add/menu', 'addMenu')->name('add.menu');
        Route::post('/menu/store', 'storeMenu')->name('menu.store');
        Route::get('/edit/menu/{id}', 'editMenu')->name('edit.menu');
        Route::post('/update/menu/{id}', 'updateMenu')->name('update.menu');
        Route::get('/delete/menu/{id}', 'deleteMenu')->name('delete.menu');

        //product
        Route::get('/all/product', 'AllProduct')->name('all.product');
        Route::get('/add/product', 'AddProduct')->name('add.product');
        Route::post('/store/product', 'StoreProduct')->name('product.store');
        Route::get('/edit/product/{id}', 'EditProduct')->name('edit.product');
        Route::post('/update/product', 'UpdateProduct')->name('product.update');
        Route::get('/delete/product/{id}', 'DeleteProduct')->name('delete.product');


        //gallery
        Route::get('/all/gallery', 'AllGallery')->name('all.gallery');
        Route::get('/add/gallery', 'AddGallery')->name('add.gallery');
        Route::post('/store/gallery', 'StoreGallery')->name('gallery.store');
        Route::get('/edit/gallery/{id}', 'EditGallery')->name('edit.gallery');
        Route::post('/update/gallery', 'UpdateGallery')->name('gallery.update');
        Route::get('/delete/gallery/{id}', 'DeleteGallery')->name('delete.gallery');
    });
    //Coupon
    Route::controller(CouponController::class)->group(function () {
        Route::get('/all/coupon', 'AllCoupon')->name('all.coupon');
        Route::get('/add/coupon', 'AddCoupon')->name('add.coupon');
        Route::post('/store/coupon', 'StoreCoupon')->name('coupon.store');
        Route::get('/edit/coupon/{id}', 'EditCoupon')->name('edit.coupon');
        Route::post('/update/coupon', 'UpdateCoupon')->name('coupon.update');
        Route::get('/delete/coupon/{id}', 'DeleteCoupon')->name('delete.coupon');

    });
    Route::controller(ManageOrderController::class)->group(function(){
        Route::get('/all/client/orders', 'AllClientOrders')->name('all.client.orders');
        Route::get('/client/order/details/{id}', 'ClientOrderDetails')->name('client.order.details');
    });});




// that will bo for all users
Route::get('/changeStatus',[RestaurantController::class,'changeStatus']);

Route::controller(HomeController::class)->group(function(){
    Route::get('/restaurant/details/{id}', 'RestaurantDetails')->name('res.details');
    Route::post('/add-wish-list/{id}', 'AddWishList');
});
Route::controller(CartController::class)->group(function(){
    Route::get('/add_to_cart/{id}', 'AddToCart')->name('add_to_cart');
    Route::post('/cart/update-quantity', 'updateCartQuantity')->name('cart.updateQuantity');
    Route::post('/cart/remove', 'CartRemove')->name('cart.remove');

    Route::post('/apply-coupon', 'ApplyCoupon');
    Route::get('/remove-coupon', 'CouponRemove');
    Route::get('/checkout', 'ShopCheckout')->name('checkout');
});
Route::controller(OrderController::class)->group(function(){
    Route::post('/cash_order', 'CashOrder')->name('cash_order');

});
require __DIR__ . '/auth.php';
