<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\Category\CategoryController;
use App\Http\Controllers\Backend\Category\BrandController;
use App\Http\Controllers\Backend\Category\SubCategoryController;
use App\Http\Controllers\Backend\Category\CouponController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Frontend\FrontProductController;
use App\Http\Controllers\PaymentController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');


Route::group(['prefix' => 'admin', 'middleware' => ['admin:admin']], function () {
    Route::get('/login', [AdminController::class, 'loginForm']);
    Route::post('/login', [AdminController::class, 'store'])->name('admin.login');
});

Route::middleware(['auth:sanctum,admin', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('admin/dashboard', function () {
        return view('admin.home');
    })->name('dashboard');
});

Route::get('/admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');

Route::get('/admin/profile', [AdminProfileController::class, 'AdminProfile'])->name('admin.profile');

Route::get('/admin/profile/edit', [AdminProfileController::class, 'AdminProfileEdit'])->name('admin.profile.edit');

Route::post('/admin/profile/store', [AdminProfileController::class, 'AdminProfileStore'])->name('admin.profile.store');

Route::get('/admin/change/password', [AdminProfileController::class, 'AdminChangePassword'])->name('admin.change.password');

Route::post('/update/change/password', [AdminProfileController::class, 'AdminUpdateChangePassword'])->name('update.change.password');



// Route::middleware(['auth:sanctum,web', config('jetstream.auth_session'), 'verified'])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });
// User ALL Routes

Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
    $id = Auth::user()->id;
    $user = User::find($id);
    return view('frontend.profile.user_profile', compact('user'));
});

Route::get('/', [IndexController::class, 'index'])->name('user.home');
Route::get('/user/logout', [IndexController::class, 'UserLogout'])->name('user.logout');

Route::get('/user/profile', [IndexController::class, 'UserProfile'])->name('user.profile');

Route::get('/user/order', [IndexController::class, 'UserOrder'])->name('user.order');

Route::post('/user/profile/store', [IndexController::class, 'UserProfileStore'])->name('user.profile.store');

Route::get('/user/change/password', [IndexController::class, 'UserChangePassword'])->name('change.password');

Route::post('/user/password/update', [IndexController::class, 'UserPasswordUpdate'])->name('user.password.update');

// Admin Category  All Routes
Route::prefix('admin/category')->group(function () {
    Route::get('/view', [CategoryController::class, 'CategoryView'])->name('categories');
    Route::post('/store', [CategoryController::class, 'StoreCategory'])->name('store.category');
    Route::get('/delete/{id}', [CategoryController::class, 'CategoryDelete'])->name('category.delete');
    Route::get('/edit/{id}', [CategoryController::class, 'CategoryEdit'])->name('category.edit');
    Route::post('/update/{id}', [CategoryController::class, 'CategoryUpdate'])->name('category.update');


    // Admin SubCategory  All Routes
    Route::get('/sub/view', [SubCategoryController::class, 'SubCategoryView'])->name('sub.category');
    Route::post('/sub/store', [SubCategoryController::class, 'StoreSubCategory'])->name('store.subcategory');
    Route::get('/sub/delete/{id}', [SubCategoryController::class, 'SubCategoryDelete'])->name('subcategory.delete');
    Route::get('/sub/edit/{id}', [SubCategoryController::class, 'SubCategoryEdit'])->name('subcategory.edit');
    Route::post('/sub/update/{id}', [SubCategoryController::class, 'SubCategoryUpdate'])->name('subcategory.update');
    Route::get('/subcategory/ajax/{category_id}', [ProductController::class, 'GetSubCategory']);
});


// Admin Brand  All Routes
Route::prefix('admin/brand')->group(function () {
    Route::get('/view', [BrandController::class, 'BrandView'])->name('all.brand');
    Route::post('/store', [BrandController::class, 'StoreBrand'])->name('store.brand');
    Route::get('/delete/{id}', [BrandController::class, 'BrandDelete'])->name('brand.delete');
    Route::get('/edit/{id}', [BrandController::class, 'BrandEdit'])->name('brand.edit');
    Route::post('/update/{id}', [BrandController::class, 'BrandUpdate'])->name('brand.update');
});

// Admin Coupon  All Routes
Route::prefix('admin/coupon')->group(function () {
    Route::get('/view', [CouponController::class, 'CouponView'])->name('all.coupon');
    Route::post('/store', [CouponController::class, 'StoreCoupon'])->name('store.coupon');
    Route::get('/delete/{id}', [CouponController::class, 'DeleteCoupon'])->name('coupon.delete');
    Route::get('/edit/{id}', [CouponController::class, 'EditCoupon'])->name('coupon.edit');
    Route::post('/update/{id}', [CouponController::class, 'UpdateCoupon'])->name('coupon.update');
});

// Admin Newslater  All Routes
Route::prefix('admin/newslater')->group(function () {
    Route::get('/view', [CouponController::class, 'NewslaterView'])->name('all.newslater');
    Route::get('/delete/{id}', [CouponController::class, 'DeleteNewslater'])->name('newslater.delete');

    // Frontent Newslater All Routes
    Route::post('/store', [HomeController::class, 'StoreNewslater'])->name('store.newslater');
});

// Admin Product  All Routes
Route::prefix('admin/product')->group(function () {
    Route::get('/all', [ProductController::class, 'AllProduct'])->name('all.product');
    Route::get('/add', [ProductController::class, 'AddProduct'])->name('add.product');
    Route::post('/store', [ProductController::class, 'StoreProduct'])->name('store.product');
    Route::get('/inactive/{id}', [ProductController::class, 'InactiveProduct'])->name('inactive.product');
    Route::get('/active/{id}', [ProductController::class, 'ActiveProduct'])->name('active.product');
    Route::get('/delete/{id}', [ProductController::class, 'DeleteProduct'])->name('product.delete');
    Route::get('/view/{id}', [ProductController::class, 'ViewProduct'])->name('admin.view.product');
    Route::get('/edit/{id}', [ProductController::class, 'EditProduct'])->name('edit.product');
    Route::post('/update/withoutphoto/{id}', [ProductController::class, 'UpdateProductWithoutPhoto'])->name('update.withoutphoto.product');
    Route::post('/update/photo/{id}', [ProductController::class, 'UpdateProductPhoto'])->name('update.photo.product');
});

// Admin Order  All Routes
Route::prefix('admin')->group(function () {
    Route::get('/order/new', [OrderController::class, 'NewOrder'])->name('admin.new.order');
    Route::get('/order/view/{id}', [OrderController::class, 'ViewOrder'])->name('view.order');

    Route::get('/payment/accept/{id}', [OrderController::class, 'PaymentAccept'])->name('admin.payment.accept');
    Route::get('/payment/cancel/{id}', [OrderController::class, 'PaymentCancel'])->name('admin.payment.cancel');

    Route::get('view/payment/accept', [OrderController::class, 'ViewAllAcceptPayment'])->name('view.accept.payment');
    Route::get('/view/order/cancel', [OrderController::class, 'ViewAllCancelOrder'])->name('view.cancel.order');
    Route::get('/view/payment/process', [OrderController::class, 'ViewAllProcessPayment'])->name('view.process.payment');
    Route::get('/view/payment/success', [OrderController::class, 'ViewAllSuccessPayment'])->name('view.success.payment');

    Route::get('/process/delivery/{id}', [OrderController::class, 'ProcessDelivery'])->name('admin.process.delivery');
    Route::get('/success/delivery/{id}', [OrderController::class, 'DeliveryDone'])->name('admin.delivery.done');
});


// Admin Blog  All Routes
Route::prefix('admin/blog/category')->group(function () {
    Route::get('/view', [PostController::class, 'BlogCatList'])->name('add.blog.categorylist');
    Route::post('/store', [PostController::class, 'StoreBlogCat'])->name('store.blog.category');
    Route::get('/delete/{id}', [PostController::class, 'DeleteBlogCat'])->name('delete.blog.category');
    Route::get('/edit/{id}', [PostController::class, 'EditBlogCat'])->name('edit.blog.category');
    Route::post('/update/{id}', [PostController::class, 'UpdateBlogCat'])->name('update.blog.category');
});

// Admin Blog  All Routes
Route::prefix('admin/blog/post')->group(function () {
    Route::get('/view', [PostController::class, 'AllBlogPost'])->name('all.blogpost');
    Route::get('/add', [PostController::class, 'CreateBlogPost'])->name('add.blogpost');
    Route::post('/store', [PostController::class, 'StoreBlogPost'])->name('store.blogpost');
    Route::get('/delete/{id}', [PostController::class, 'DeleteBlogPost'])->name('delete.blogpost');
    Route::get('/edit/{id}', [PostController::class, 'EditBlogPost'])->name('edit.blogpost');
    Route::post('/update/{id}', [PostController::class, 'UpdateBlogPost'])->name('update.blogpost');
});

// Add to Wishlist
Route::get('/add-to-wishlist/{id}', [WishlistController::class, 'AddToWishlist'])->name('add.wishlist');

// Route::group(['prefix'=>'user','middleware' => ['user','auth'],'namespace'=>'User'],function(){

//     // Wishlist page
//     Route::get('/wishlist', [WishlistController::class, 'ViewWishlist'])->name('wishlist');

//     Route::get('/get-wishlist-product', [WishlistController::class, 'GetWishlistProduct']);

//     Route::get('/wishlist-remove/{id}', [WishlistController::class, 'RemoveWishlistProduct']);

//     Route::post('/stripe/order', [StripeController::class, 'StripeOrder'])->name('stripe.order');

//     Route::post('/cash/order', [CashController::class, 'CashOrder'])->name('cash.order');

//     Route::get('/my/orders', [AllUserController::class, 'MyOrders'])->name('my.orders');

//     Route::get('/order_details/{order_id}', [AllUserController::class, 'OrderDetails']);

//     Route::get('/invoice_download/{order_id}', [AllUserController::class, 'InvoiceDownload']);

//     Route::post('/return/order/{order_id}', [AllUserController::class, 'ReturnOrder'])->name('return.order');

//     Route::get('/return/order/list', [AllUserController::class, 'ReturnOrderList'])->name('return.order.list');

//     Route::get('/cancel/orders', [AllUserController::class, 'CancelOrders'])->name('cancel.orders');


//     /// Order Traking Route 
//     Route::post('/order/tracking', [AllUserController::class, 'OrderTraking'])->name('order.tracking');    

//     });

// Add to Cart
Route::prefix('cart')->group(function () {
    Route::get('/add/{id}', [CartController::class, 'AddToCart'])->name('add.cart'); // dùng để add cart nhanh khi chưa có quick view
    Route::get('/check', [CartController::class, 'Check']);
    Route::get('/view', [CartController::class, 'ShowCart'])->name('show.cart');
    Route::get('/remove/{rowId}', [CartController::class, 'RemoveCart'])->name('remove.cart');
    Route::post('/update/{rowId}', [CartController::class, 'UpdateCart'])->name('update.cart');
    Route::get('/quick-view/{id}', [CartController::class, 'Viewproduct'])->name('view.product'); // show modal quick view
    Route::post('/quick/add', [CartController::class, 'InsertCart'])->name('insert.into.cart'); // Thêm sản phẩm vào cart khi người dùng click Quick View
    Route::get('user/checkout', [CartController::class, 'Checkout'])->name('user.checkout');
});

Route::get('user/wishlist', [WishlistController::class, 'wishlist'])->name('user.wishlist');
Route::get('user/view/detail/order/{id}', [IndexController::class, 'DetailOrder'])->name('user.view.detail.order');

// Frontend routes
Route::get('product/details/{id}/{product_name}', [FrontProductController::class, 'ProductView']);
Route::post('cart/product/add/{id}', [FrontProductController::class, 'AddToCart'])->name('store.product.cart'); // add to cart when user visit details product

// Frontend Coupon Option
Route::post('/coupon-apply', [CartController::class, 'CouponApply'])->name('apply.coupon');
Route::get('/coupon-remove', [CartController::class, 'CouponRemove'])->name('remove.coupon');

// Blog Post routes
Route::get('/blog-post', [BlogController::class, 'Blog'])->name('blog.post');
Route::get('/blog/single/{id}', [BlogController::class, 'BlogSingle'])->name('blog.single');
// Multi language Blog routes
Route::get('/language/english', [BlogController::class, 'English'])->name('language.english');
Route::get('/language/vietnam', [BlogController::class, 'Vietnam'])->name('language.vietnam');

// Payment routes
Route::get('/payment', [CartController::class, 'PaymentPage'])->name('payment.step');
Route::post('/user/payment/process', [PaymentController::class, 'PaymenProcess'])->name('payment.process');
Route::post('/user/strip/charge', [PaymentController::class, 'StripeCharge'])->name('stripe.charge');

Route::get('/subcategory/{id}', [FrontProductController::class, 'ProductSubCate'])->name('view.subcategory');
Route::get('/category/{id}', [FrontProductController::class, 'ProductCate'])->name('view.category');
