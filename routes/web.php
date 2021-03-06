<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\Content\AdvertisementBanerController;
use App\Http\Controllers\Admin\Content\FAQController;
use App\Http\Controllers\Admin\Content\MenuController;
use App\Http\Controllers\Admin\Content\PageController;
use App\Http\Controllers\Admin\Content\PostController;
use App\Http\Controllers\Admin\Market\BrandController;
use App\Http\Controllers\Admin\Content\CategoryController as ContentCategoryController;
use App\Http\Controllers\Admin\Market\CategoryController;
use App\Http\Controllers\Admin\Content\CommentController as ContentCommentController;
use App\Http\Controllers\Admin\Market\CategorySpecController;
use App\Http\Controllers\Admin\Market\CommentController;
use App\Http\Controllers\Admin\Market\DeliveryController;
use App\Http\Controllers\Admin\Market\DiscountController;
use App\Http\Controllers\Admin\Market\GalleryController;
use App\Http\Controllers\Admin\Market\OrderController;
use App\Http\Controllers\Admin\Market\PaymentController;
use App\Http\Controllers\Admin\Market\ProductColorController;
use App\Http\Controllers\Admin\Market\ProductController;
use App\Http\Controllers\Admin\Market\ProductSpecController;
use App\Http\Controllers\Admin\Market\ProductStoreController;
use App\Http\Controllers\Admin\Market\PropertyController;
use App\Http\Controllers\Admin\Market\PropertyValueController;
use App\Http\Controllers\Admin\Market\StoreController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\Notify\EmailController;
use App\Http\Controllers\Admin\Notify\EmailFileController;
use App\Http\Controllers\Admin\Notify\SMSController;
use App\Http\Controllers\Admin\Setting\SettingController;
use App\Http\Controllers\Admin\Ticket\TicketAdminController;
use App\Http\Controllers\Admin\Ticket\TicketCategoryController;
use App\Http\Controllers\Admin\Ticket\TicketController;
use App\Http\Controllers\Admin\Ticket\TicketPriorityController;
use App\Http\Controllers\Admin\User\AdminUserController;
use App\Http\Controllers\Admin\User\CustomerController;
use App\Http\Controllers\Admin\User\PermissionController;
use App\Http\Controllers\Admin\User\RoleController;
use App\Http\Controllers\app\CartController;
use App\Http\Controllers\app\CompareController;
use App\Http\Controllers\app\HomeController;
use App\Http\Controllers\app\PageController as AppPageController;
use App\Http\Controllers\app\PaymentController as AppPaymentController;
use App\Http\Controllers\app\ProductController as AppProductController;
use App\Http\Controllers\app\ProductsController;
use App\Http\Controllers\app\SearchController;
use App\Http\Controllers\app\ShippingController;
use App\Http\Controllers\app\UserController;
use App\Http\Controllers\Auth\AuthController;
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

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

Route::namespace('Auth')->group(function () {

    Route::get('/login', [AuthController::class, 'index'])->name('auth.index');
    Route::get('/register', function () {
        return redirect('/login');
    });
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

    Route::post('/check-email', [AuthController::class, 'checkEmail'])->name('auth.check-email');
    Route::post('/check-verification-code', [AuthController::class, 'checkVerificationCode'])->name('auth.check-verification-code');
    Route::post('/set-passwords', [AuthController::class, 'setPasswords'])->name('auth.set-passwords');
    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::get('/forgot-password/{email}', [AuthController::class, 'forgotPassword'])->name('auth.forgot-password');
    Route::get('/change-password', [AuthController::class, 'changePasswordForm'])->name('auth.change-password-form')->middleware('auth');
    Route::post('/change-password', [AuthController::class, 'changePassword'])->name('auth.change-password')->middleware('auth');

    Route::get('/send-verification-code', [AuthController::class, 'sendVCodeAgain'])->name('auth.send-verification-code');



    // login using google
    Route::get('/auth/redirect-to-google', [AuthController::class, 'redirectToGoogle'])->name('auth.redirect-to-google');
    Route::get('/auth/google-callback', [AuthController::class, 'googleCallback'])->name('auth.google-callback');
});

/*
|--------------------------------------------------------------------------
| App Routes
|--------------------------------------------------------------------------
*/

Route::namespace('App')->group(function () {

    //home
    Route::get('/', [HomeController::class, 'index'])->name('app.home');

    //search
    Route::get('/search', [HomeController::class, 'search'])->name('app.search');

    //search-page
    Route::get('/search-filter/{search?}', [SearchController::class, 'index'])->name('app.search.index');

    //comparison
    Route::get('/compare-products/{first_product?}/{second_product?}', [CompareController::class, 'index'])->name('app.compare.index');

    //product
    Route::prefix('product')->group(function () {
        Route::get('/{product}', [AppProductController::class, 'index'])->name('app.product.index');
        Route::get('/{comment}/like', [AppProductController::class, 'likeComment'])->name('app.product.like-comment');
        Route::post('/{product}/send-comment', [AppProductController::class, 'sendComment'])->name('app.product.send-comment');
        Route::post('/{product}/toggle-product', [AppProductController::class, 'toggleProduct'])->name('app.product.toggle-product');
        Route::post('/{product}/get-price', [AppProductController::class, 'getPrice'])->name('app.product.get-price');
    });

    //products
    Route::prefix('products')->group(function () {
        Route::get('/amazing-sales', [ProductsController::class, 'amazingSales'])->name('app.products.amazing-sales');
        Route::get('/recommended', [ProductsController::class, 'recommended'])->name('app.products.recommended');
        Route::get('/category/{category}', [ProductsController::class, 'categoryProducts'])->name('app.products.category-products');
        Route::get('/brand/{brand}', [ProductsController::class, 'brandProducts'])->name('app.products.brand-products');
        Route::get('/last-visited-products', [ProductsController::class, 'lastVisitedProducts'])->name('app.products.last-visited-products');
    });

    //pages
    Route::get('page/{page:slug}', [AppPageController::class, 'index'])->name('app.pages.index');


    //brands
    Route::get('/brands', [HomeController::class, 'brands'])->name('app.brand.index');



    //cart
    Route::prefix('cart')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('app.cart.index');
        Route::get('/increment/{cart_item}', [CartController::class, 'increaseQuantity'])->name('app.cart.increment');
        Route::get('/decrement/{cart_item}', [CartController::class, 'decreaseQuantity'])->name('app.cart.decrement');
        Route::get('/destroy/{cart_item}', [CartController::class, 'destroy'])->name('app.cart.destroy');
        Route::post('/store-order', [CartController::class, 'storeOrder'])->name('app.cart.store-order');
    });

    //shipping
    Route::prefix('shipping')->middleware('auth')->group(function () {
        Route::get('/{order}', [ShippingController::class, 'index'])->name('app.shipping.index');
        Route::get('/{order}/select-address/{address}', [ShippingController::class, 'selectAddress'])->name('app.shipping.select-address');
        Route::get('/{order}/select-delivery/{delivery}', [ShippingController::class, 'selectDelivery'])->name('app.shipping.select-delivery');
        Route::get('/{order}/store-payment', [ShippingController::class, 'storePayment'])->name('app.shipping.store-payment');
    });

    //payment
    Route::prefix('payment')->group(function () {
        Route::get('result', [AppPaymentController::class, 'result'])->name('app.payment.result');
        Route::get('/{order}', [AppPaymentController::class, 'index'])->name('app.payment.index');
        Route::post('/{order}/check-coupon', [AppPaymentController::class, 'checkCoupon'])->name('app.payment.check-coupon');
        Route::get('/{order}/remove-coupon/{coupon}', [AppPaymentController::class, 'removeCoupon'])->name('app.payment.remove-coupon');
        Route::get('/{order}/store', [AppPaymentController::class, 'store'])->name('app.payment.store');
    });

    //user profile
    Route::prefix('user')->middleware('auth')->group(function () {

        //profile
        Route::get('profile', [UserController::class, 'profile'])->name('app.user.profile');
        Route::put('profile/update/{user}', [UserController::class, 'profileUpdate'])->name('app.user.profile.update');

        //address
        Route::get('addresses', [UserController::class, 'addresses'])->name('app.user.addresses');
        Route::post('addresses/store', [UserController::class, 'addressesStore'])->name('app.user.addresses.store');
        Route::get('addresses/{address}/change-status', [UserController::class, 'addressesChangeStatus'])->name('app.user.addresses.change-status');
        Route::delete('addresses/{address}/destroy', [UserController::class, 'addressesDestroy'])->name('app.user.addresses.destroy');

        //orders
        Route::get('orders', [UserController::class, 'orders'])->name('app.user.orders');
        Route::get('orders/{order}', [UserController::class, 'orderDetails'])->name('app.user.orders.details');
        Route::get('orders/{order}/factor', [UserController::class, 'factor'])->name('app.user.orders.factor');

        //favorites
        Route::get('favorites', [UserController::class, 'favorites'])->name('app.user.favorites');
        Route::get('favorites/{product}/toggle', [AppProductController::class, 'toggleFavorite'])->name('app.user.favorites.toggle');


        //tickets
        Route::get('tickets', [UserController::class, 'tickets'])->name('app.user.tickets');
        Route::get('tickets/{ticket}', [UserController::class, 'showTicket'])->name('app.user.tickets.show-ticket');
        Route::post('tickets/store', [UserController::class, 'storeTicket'])->name('app.user.tickets.store-ticket');
        Route::get('tickets/{ticket}/destroy', [UserController::class, 'destroyTicket'])->name('app.user.tickets.destroy-ticket');
    });

    //cities
    Route::get('provinces/{province}/cities', [UserController::class, 'getCities'])->name('app.province.get-cities')->middleware('auth');
});


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::namespace('Admin')->prefix('admin')->middleware('isAdmin')->group(function () {

    Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.home');

    //market
    Route::namespace('Market')->prefix('market')->group(function () {

        //category
        Route::prefix('category')->group(function () {
            Route::get('/', [CategoryController::class, 'index'])->name('admin.market.category.index');
            Route::get('/create', [CategoryController::class, 'create'])->name('admin.market.category.create');
            Route::post('/store', [CategoryController::class, 'store'])->name('admin.market.category.store');
            Route::get('/edit/{productCategory}', [CategoryController::class, 'edit'])->name('admin.market.category.edit');
            Route::put('/update/{productCategory}', [CategoryController::class, 'update'])->name('admin.market.category.update');
            Route::delete('/delete/{productCategory}', [CategoryController::class, 'destroy'])->name('admin.market.category.destroy');
            Route::get('/status/{productCategory}', [CategoryController::class, 'status'])->name('admin.market.category.status');
        });

        //category-spec
        Route::prefix('category-spec')->group(function () {
            Route::get('/', [CategorySpecController::class, 'index'])->name('admin.market.category-spec.index');
            Route::get('/create/{productCategory}', [categorySpecController::class, 'create'])->name('admin.market.category-spec.create');
            Route::post('/store/{productCategory}', [categorySpecController::class, 'store'])->name('admin.market.category-spec.store');
            Route::get('/edit/{spec}', [categorySpecController::class, 'edit'])->name('admin.market.category-spec.edit');
            Route::put('/update/{spec}', [categorySpecController::class, 'update'])->name('admin.market.category-spec.update');
            Route::delete('/delete/{spec}', [categorySpecController::class, 'destroy'])->name('admin.market.category-spec.destroy');
            Route::get('/status/{spec}', [categorySpecController::class, 'status'])->name('admin.market.category-spec.status');
            Route::get('/manage/{productCategory}', [categorySpecController::class, 'manage'])->name('admin.market.category-spec.manage');
        });

        //property
        Route::prefix('property')->group(function () {
            Route::get('/', [PropertyController::class, 'index'])->name('admin.market.property.index');
            Route::get('/create', [PropertyController::class, 'create'])->name('admin.market.property.create');
            Route::post('/store', [PropertyController::class, 'store'])->name('admin.market.property.store');
            Route::get('/edit/{property}', [PropertyController::class, 'edit'])->name('admin.market.property.edit');
            Route::put('/update/{property}', [PropertyController::class, 'update'])->name('admin.market.property.update');
            Route::delete('/delete/{property}', [PropertyController::class, 'destroy'])->name('admin.market.property.destroy');
            Route::get('/status/{property}', [PropertyController::class, 'status'])->name('admin.market.property.status');

            //value
            Route::prefix('value')->group(function () {
                Route::get('/{property}', [PropertyValueController::class, 'index'])->name('admin.market.property.value.index');
                Route::get('/{property}/create', [PropertyValueController::class, 'create'])->name('admin.market.property.value.create');
                Route::post('/{property}/store', [PropertyValueController::class, 'store'])->name('admin.market.property.value.store');
                Route::get('/edit/{value}', [PropertyValueController::class, 'edit'])->name('admin.market.property.value.edit');
                Route::put('/update/{value}', [PropertyValueController::class, 'update'])->name('admin.market.property.value.update');
                Route::delete('/delete/{value}', [PropertyValueController::class, 'destroy'])->name('admin.market.property.value.destroy');
            });
        });

        //product
        Route::prefix('product')->group(function () {
            Route::get('/', [ProductController::class, 'index'])->name('admin.market.product.index');
            Route::get('/create', [ProductController::class, 'create'])->name('admin.market.product.create');
            Route::post('/store', [ProductController::class, 'store'])->name('admin.market.product.store');
            Route::get('/edit/{product}', [ProductController::class, 'edit'])->name('admin.market.product.edit');
            Route::put('/update/{product}', [ProductController::class, 'update'])->name('admin.market.product.update');
            Route::delete('/delete/{product}', [ProductController::class, 'destroy'])->name('admin.market.product.destroy');
            Route::get('/status/{product}', [ProductController::class, 'status'])->name('admin.market.product.status');

            //color
            Route::prefix('color')->group(function () {
                Route::get('/{product}', [ProductColorController::class, 'index'])->name('admin.market.product.color.index');
                Route::get('/{product}/create', [ProductColorController::class, 'create'])->name('admin.market.product.color.create');
                Route::post('/{product}/store', [ProductColorController::class, 'store'])->name('admin.market.product.color.store');
                Route::get('/edit/{color}', [ProductColorController::class, 'edit'])->name('admin.market.product.color.edit');
                Route::put('/update/{color}', [ProductColorController::class, 'update'])->name('admin.market.product.color.update');
                Route::delete('/delete/{color}', [ProductColorController::class, 'destroy'])->name('admin.market.product.color.destroy');
            });

            //store
            Route::prefix('store')->group(function () {
                Route::get('/{product}', [ProductStoreController::class, 'index'])->name('admin.market.product.store.index');
                // Route::get('/{product}/create', [ProductColorController::class, 'create'])->name('admin.market.product.store.create');
                // Route::post('/{product}/store', [ProductColorController::class, 'store'])->name('admin.market.product.store.store');
                // Route::get('/edit/{store}', [ProductColorController::class, 'edit'])->name('admin.market.product.store.edit');
                // Route::put('/update/{store}', [ProductColorController::class, 'update'])->name('admin.market.product.store.update');
                // Route::delete('/delete/{store}', [ProductColorController::class, 'destroy'])->name('admin.market.product.store.destroy');
            });

            //spec
            Route::prefix('spec')->group(function () {
                Route::get('/{product}', [ProductSpecController::class, 'index'])->name('admin.market.product.spec.index');
                Route::get('/{product}/create', [ProductSpecController::class, 'create'])->name('admin.market.product.spec.create');
                Route::post('/{product}/store', [ProductSpecController::class, 'store'])->name('admin.market.product.spec.store');
                Route::get('/edit/{spec}', [ProductSpecController::class, 'edit'])->name('admin.market.product.spec.edit');
                Route::put('/update/{spec}', [ProductSpecController::class, 'update'])->name('admin.market.product.spec.update');
                Route::delete('/delete/{spec}', [ProductSpecController::class, 'destroy'])->name('admin.market.product.spec.destroy');
            });

            //gallery
            Route::prefix('gallery')->group(function () {
                Route::get('/{product}', [GalleryController::class, 'index'])->name('admin.market.product.gallery.index');
                Route::post('/{product}/store', [GalleryController::class, 'store'])->name('admin.market.product.gallery.store');
                Route::delete('/delete/{image}', [GalleryController::class, 'destroy'])->name('admin.market.product.gallery.destroy');
            });
        });

        //brand
        Route::prefix('brand')->group(function () {
            Route::get('/', [BrandController::class, 'index'])->name('admin.market.brand.index');
            Route::get('/create', [BrandController::class, 'create'])->name('admin.market.brand.create');
            Route::post('/store', [BrandController::class, 'store'])->name('admin.market.brand.store');
            Route::get('/edit/{brand}', [BrandController::class, 'edit'])->name('admin.market.brand.edit');
            Route::put('/update/{brand}', [BrandController::class, 'update'])->name('admin.market.brand.update');
            Route::delete('/delete/{brand}', [BrandController::class, 'destroy'])->name('admin.market.brand.destroy');
            Route::get('/status/{brand}', [BrandController::class, 'status'])->name('admin.market.brand.status');
        });

        //store
        Route::prefix('store')->group(function () {
            Route::get('/', [StoreController::class, 'index'])->name('admin.market.store.index');
            Route::get('{product}/add-to-store', [StoreController::class, 'addToStore'])->name('admin.market.store.add-to-store');
            Route::post('{product}/store', [StoreController::class, 'store'])->name('admin.market.store.store');
            Route::get('{product}/edit', [StoreController::class, 'edit'])->name('admin.market.store.edit');
            Route::put('{product}/update', [StoreController::class, 'update'])->name('admin.market.store.update');
        });


        //comment
        Route::prefix('comment')->group(function () {
            Route::get('/', [CommentController::class, 'index'])->name('admin.market.comment.index');
            Route::get('/show/{comment}', [CommentController::class, 'show'])->name('admin.market.comment.show');
            Route::post('/store/{comment}', [CommentController::class, 'store'])->name('admin.market.comment.store');
            Route::get('/edit/{comment}', [CommentController::class, 'edit'])->name('admin.market.comment.edit');
            Route::put('/update/{comment}', [CommentController::class, 'update'])->name('admin.market.comment.update');
            Route::get('/status/{comment}', [CommentController::class, 'status'])->name('admin.market.comment.status');
            Route::get('/approve/{comment}', [CommentController::class, 'approve'])->name('admin.market.comment.approve');
        });

        //delivery
        Route::prefix('delivery')->group(function () {
            Route::get('/', [DeliveryController::class, 'index'])->name('admin.market.delivery.index');
            Route::get('/create', [DeliveryController::class, 'create'])->name('admin.market.delivery.create');
            Route::post('/store', [DeliveryController::class, 'store'])->name('admin.market.delivery.store');
            Route::get('/edit/{delivery_method}', [DeliveryController::class, 'edit'])->name('admin.market.delivery.edit');
            Route::put('/update/{delivery_method}', [DeliveryController::class, 'update'])->name('admin.market.delivery.update');
            Route::delete('/delete/{delivery_method}', [DeliveryController::class, 'destroy'])->name('admin.market.delivery.destroy');
            Route::get('/status/{delivery_method}', [DeliveryController::class, 'status'])->name('admin.market.delivery.status');
        });

        //discount
        Route::prefix('discount')->group(function () {

            //coupons
            Route::get('/coupon', [DiscountController::class, 'coupon'])->name('admin.market.discount.coupon');
            Route::get('/coupon/create', [DiscountController::class, 'couponCreate'])->name('admin.market.discount.coupon.create');
            Route::post('/coupon/store', [DiscountController::class, 'couponStore'])->name('admin.market.discount.coupon.store');
            Route::get('/coupon/{discount}/edit', [DiscountController::class, 'couponEdit'])->name('admin.market.discount.coupon.edit');
            Route::put('/coupon/{discount}/update', [DiscountController::class, 'couponUpdate'])->name('admin.market.discount.coupon.update');
            Route::delete('/coupon/{discount}/destroy', [DiscountController::class, 'couponDestroy'])->name('admin.market.discount.coupon.destroy');

            //public discounts
            Route::get('/public-discount', [DiscountController::class, 'publicDiscount'])->name('admin.market.discount.public');
            Route::get('/public-discount/create', [DiscountController::class, 'publicDiscountCreate'])->name('admin.market.discount.public.create');
            Route::post('/public-discount/store', [DiscountController::class, 'publicDiscountStore'])->name('admin.market.discount.public.store');
            Route::get('/public-discount/{discount}/edit', [DiscountController::class, 'publicDiscountEdit'])->name('admin.market.discount.public.edit');
            Route::put('/public-discount/{discount}/update', [DiscountController::class, 'publicDiscountUpdate'])->name('admin.market.discount.public.update');
            Route::delete('/public-discount/{discount}/destroy', [DiscountController::class, 'publicDiscountDestroy'])->name('admin.market.discount.public.destroy');

            //amazing sales
            Route::get('/amazing-discount', [DiscountController::class, 'amazingDiscount'])->name('admin.market.discount.amazing');
            Route::get('/amazing-discount/create', [DiscountController::class, 'amazingDiscountCreate'])->name('admin.market.discount.amazing.create');
            Route::post('/amazing-discount/store', [DiscountController::class, 'amazingDiscountStore'])->name('admin.market.discount.amazing.store');
            Route::get('/amazing-discount/{discount}/edit', [DiscountController::class, 'amazingDiscountEdit'])->name('admin.market.discount.amazing.edit');
            Route::put('/amazing-discount/{discount}/update', [DiscountController::class, 'amazingDiscountUpdate'])->name('admin.market.discount.amazing.update');
            Route::delete('/amazing-discount/{discount}/destroy', [DiscountController::class, 'amazingDiscountDestroy'])->name('admin.market.discount.amazing.destroy');
        });


        //order
        Route::prefix('order')->group(function () {
            Route::get('/', [OrderController::class, 'index'])->name('admin.market.order.index');
            Route::get('/new-orders', [OrderController::class, 'newOrders'])->name('admin.market.order.newOrders');
            Route::get('/processing', [OrderController::class, 'processing'])->name('admin.market.order.processing');
            Route::get('/delivering', [OrderController::class, 'delivering'])->name('admin.market.order.delivering');
            Route::get('/unpaid', [OrderController::class, 'unpaid'])->name('admin.market.order.unpaid');
            Route::get('/expired', [OrderController::class, 'expired'])->name('admin.market.order.expired');
            Route::get('/returned', [OrderController::class, 'returned'])->name('admin.market.order.returned');
            Route::get('/{order}/change-status', [OrderController::class, 'changeStatus'])->name('admin.market.order.change-status');
            Route::get('/{order}/change-delivery-status', [OrderController::class, 'changeDeliveryStatus'])->name('admin.market.order.change-delivery-status');
            Route::delete('/{order}/destroy', [OrderController::class, 'destroy'])->name('admin.market.order.destroy');
            Route::get('/{order}/show', [OrderController::class, 'show'])->name('admin.market.order.show');
        });

        //payment
        Route::prefix('payment')->group(function () {
            Route::get('/all', [PaymentController::class, 'all'])->name('admin.market.payment.all');
            Route::get('/online', [PaymentController::class, 'online'])->name('admin.market.payment.online');
            Route::get('/offline', [PaymentController::class, 'offline'])->name('admin.market.payment.offline');
            Route::get('/cash', [PaymentController::class, 'cash'])->name('admin.market.payment.cash');
            Route::get('{payment}/cancel', [PaymentController::class, 'cancel'])->name('admin.market.payment.cancel');
            Route::get('{payment}/refund', [PaymentController::class, 'refund'])->name('admin.market.payment.refund');
            Route::get('{payment}/show', [PaymentController::class, 'show'])->name('admin.market.payment.show');
        });
    });


    //content
    Route::namespace('Content')->prefix('content')->group(function () {

        //category
        Route::prefix('category')->group(function () {
            Route::get('/', [ContentCategoryController::class, 'index'])->name('admin.content.category.index');
            Route::get('/create', [ContentCategoryController::class, 'create'])->name('admin.content.category.create');
            Route::post('/store', [ContentCategoryController::class, 'store'])->name('admin.content.category.store');
            Route::get('/edit/{postCategory}', [ContentCategoryController::class, 'edit'])->name('admin.content.category.edit');
            Route::put('/update/{postCategory}', [ContentCategoryController::class, 'update'])->name('admin.content.category.update');
            Route::delete('/delete/{postCategory}', [ContentCategoryController::class, 'destroy'])->name('admin.content.category.destroy');
            Route::get('/status/{postCategory}', [ContentCategoryController::class, 'status'])->name('admin.content.category.status');
        });

        //post
        Route::prefix('post')->group(function () {
            Route::get('/', [PostController::class, 'index'])->name('admin.content.post.index');
            Route::get('/create', [PostController::class, 'create'])->name('admin.content.post.create');
            Route::post('/store', [PostController::class, 'store'])->name('admin.content.post.store');
            Route::get('/edit/{post}', [PostController::class, 'edit'])->name('admin.content.post.edit');
            Route::put('/update/{post}', [PostController::class, 'update'])->name('admin.content.post.update');
            Route::delete('/delete/{post}', [PostController::class, 'destroy'])->name('admin.content.post.destroy');
            Route::get('/status/{post}', [PostController::class, 'status'])->name('admin.content.post.status');
            Route::get('/commentable/{post}', [PostController::class, 'commentable'])->name('admin.content.post.commentable');
        });


        //comment
        Route::prefix('comment')->group(function () {
            Route::get('/', [ContentCommentController::class, 'index'])->name('admin.content.comment.index');
            Route::get('/show/{comment}', [ContentCommentController::class, 'show'])->name('admin.content.comment.show');
            Route::post('/store/{comment}', [ContentCommentController::class, 'store'])->name('admin.content.comment.store');
            Route::get('/edit/{comment}', [ContentCommentController::class, 'edit'])->name('admin.content.comment.edit');
            Route::put('/update/{comment}', [ContentCommentController::class, 'update'])->name('admin.content.comment.update');
            Route::get('/status/{comment}', [ContentCommentController::class, 'status'])->name('admin.content.comment.status');
            Route::get('/approve/{comment}', [ContentCommentController::class, 'approve'])->name('admin.content.comment.approve');
        });

        //Menu
        Route::prefix('menu')->group(function () {
            Route::get('/', [MenuController::class, 'index'])->name('admin.content.menu.index');
            Route::get('/create', [MenuController::class, 'create'])->name('admin.content.menu.create');
            Route::post('/store', [MenuController::class, 'store'])->name('admin.content.menu.store');
            Route::get('/edit/{menu}', [MenuController::class, 'edit'])->name('admin.content.menu.edit');
            Route::put('/update/{menu}', [MenuController::class, 'update'])->name('admin.content.menu.update');
            Route::delete('/delete/{menu}', [MenuController::class, 'destroy'])->name('admin.content.menu.destroy');
            Route::get('/status/{menu}', [MenuController::class, 'status'])->name('admin.content.menu.status');
        });

        //advertisement baners
        Route::prefix('advertisement-baner')->group(function () {
            Route::get('/', [AdvertisementBanerController::class, 'index'])->name('admin.content.advertisement-baner.index');
            Route::get('/create', [AdvertisementBanerController::class, 'create'])->name('admin.content.advertisement-baner.create');
            Route::post('/store', [AdvertisementBanerController::class, 'store'])->name('admin.content.advertisement-baner.store');
            Route::get('/edit/{baner}', [AdvertisementBanerController::class, 'edit'])->name('admin.content.advertisement-baner.edit');
            Route::put('/update/{baner}', [AdvertisementBanerController::class, 'update'])->name('admin.content.advertisement-baner.update');
            Route::delete('/delete/{baner}', [AdvertisementBanerController::class, 'destroy'])->name('admin.content.advertisement-baner.destroy');
            Route::get('/status/{baner}', [AdvertisementBanerController::class, 'status'])->name('admin.content.advertisement-baner.status');
        });

        //FAQ
        Route::prefix('faq')->group(function () {
            Route::get('/', [FAQController::class, 'index'])->name('admin.content.faq.index');
            Route::get('/create', [FAQController::class, 'create'])->name('admin.content.faq.create');
            Route::post('/store', [FAQController::class, 'store'])->name('admin.content.faq.store');
            Route::get('/edit/{faq}', [FAQController::class, 'edit'])->name('admin.content.faq.edit');
            Route::put('/update/{faq}', [FAQController::class, 'update'])->name('admin.content.faq.update');
            Route::delete('/delete/{faq}', [FAQController::class, 'destroy'])->name('admin.content.faq.destroy');
            Route::get('/status/{faq}', [FAQController::class, 'status'])->name('admin.content.faq.status');
        });

        //page
        Route::prefix('page')->group(function () {
            Route::get('/', [PageController::class, 'index'])->name('admin.content.page.index');
            Route::get('/create', [PageController::class, 'create'])->name('admin.content.page.create');
            Route::post('/store', [PageController::class, 'store'])->name('admin.content.page.store');
            Route::get('/edit/{page}', [PageController::class, 'edit'])->name('admin.content.page.edit');
            Route::put('/update/{page}', [PageController::class, 'update'])->name('admin.content.page.update');
            Route::delete('/delete/{page}', [PageController::class, 'destroy'])->name('admin.content.page.destroy');
            Route::get('/status/{page}', [PageController::class, 'status'])->name('admin.content.page.status');
        });
    });


    //users
    Route::namespace('User')->prefix('user')->group(function () {

        //admin-user
        Route::prefix('admin-user')->group(function () {
            Route::get('/', [AdminUserController::class, 'index'])->name('admin.user.admin-user.index');
            Route::get('/create', [AdminUserController::class, 'create'])->name('admin.user.admin-user.create');
            Route::post('/store', [AdminUserController::class, 'store'])->name('admin.user.admin-user.store');
            Route::get('/edit/{admin}', [AdminUserController::class, 'edit'])->name('admin.user.admin-user.edit');
            Route::put('/update/{admin}', [AdminUserController::class, 'update'])->name('admin.user.admin-user.update');
            Route::delete('/delete/{admin}', [AdminUserController::class, 'destroy'])->name('admin.user.admin-user.destroy');
            Route::get('/status/{admin}', [AdminUserController::class, 'status'])->name('admin.user.admin-user.status');
            Route::get('/activation/{admin}', [AdminUserController::class, 'activation'])->name('admin.user.admin-user.activation');
            Route::get('/{admin}/roles', [AdminUserController::class, 'roles'])->name('admin.user.admin-user.roles');
            Route::post('/set-role/{admin}', [AdminUserController::class, 'setRole'])->name('admin.user.admin-user.set-role');
        });

        //customer
        Route::prefix('customer')->group(function () {
            Route::get('/', [CustomerController::class, 'index'])->name('admin.user.customer.index');
            Route::get('/create', [CustomerController::class, 'create'])->name('admin.user.customer.create');
            Route::post('/store', [CustomerController::class, 'store'])->name('admin.user.customer.store');
            Route::get('/edit/{user}', [CustomerController::class, 'edit'])->name('admin.user.customer.edit');
            Route::put('/update/{user}', [CustomerController::class, 'update'])->name('admin.user.customer.update');
            Route::delete('/delete/{user}', [CustomerController::class, 'destroy'])->name('admin.user.customer.destroy');
            Route::get('/status/{user}', [CustomerController::class, 'status'])->name('admin.user.customer.status');
            Route::get('/activation/{user}', [CustomerController::class, 'activation'])->name('admin.user.customer.activation');
            Route::get('/change-user-type/{user}', [CustomerController::class, 'changeUserType'])->name('admin.user.customer.change-user-type');
        });

        //role
        Route::prefix('role')->group(function () {
            Route::get('/', [RoleController::class, 'index'])->name('admin.user.role.index');
            Route::get('/create', [RoleController::class, 'create'])->name('admin.user.role.create');
            Route::post('/store', [RoleController::class, 'store'])->name('admin.user.role.store');
            Route::get('/edit/{role}', [RoleController::class, 'edit'])->name('admin.user.role.edit');
            Route::put('/update/{role}', [RoleController::class, 'update'])->name('admin.user.role.update');
            Route::delete('/delete/{role}', [RoleController::class, 'destroy'])->name('admin.user.role.destroy');
            Route::get('/status/{role}', [RoleController::class, 'status'])->name('admin.user.role.status');
        });

        //permission
        Route::prefix('permission')->group(function () {
            Route::get('/{role}/edit', [PermissionController::class, 'edit'])->name('admin.user.permission.edit');
            Route::put('/{role}/update', [PermissionController::class, 'update'])->name('admin.user.permission.update');
        });
    });

    //notify
    Route::namespace('Notify')->prefix('notify')->group(function () {


        //email
        Route::prefix('email')->group(function () {
            Route::get('/', [EmailController::class, 'index'])->name('admin.notify.email.index');
            Route::get('/create', [EmailController::class, 'create'])->name('admin.notify.email.create');
            Route::post('/store', [EmailController::class, 'store'])->name('admin.notify.email.store');
            Route::get('/edit/{email}', [EmailController::class, 'edit'])->name('admin.notify.email.edit');
            Route::put('/update/{email}', [EmailController::class, 'update'])->name('admin.notify.email.update');
            Route::delete('/delete/{email}', [EmailController::class, 'destroy'])->name('admin.notify.email.destroy');
            Route::get('/status/{email}', [EmailController::class, 'status'])->name('admin.notify.email.status');
        });

        //email files
        Route::prefix('email-files')->group(function () {
            Route::get('/{email}', [EmailFileController::class, 'index'])->name('admin.notify.email-files.index');
            Route::get('/{email}/create', [EmailFileController::class, 'create'])->name('admin.notify.email-files.create');
            Route::post('/{email}/store', [EmailFileController::class, 'store'])->name('admin.notify.email-files.store');
            Route::get('/edit/{file}', [EmailFileController::class, 'edit'])->name('admin.notify.email-files.edit');
            Route::put('/update/{file}', [EmailFileController::class, 'update'])->name('admin.notify.email-files.update');
            Route::delete('/delete/{file}', [EmailFileController::class, 'destroy'])->name('admin.notify.email-files.destroy');
            Route::get('/status/{file}', [EmailFileController::class, 'status'])->name('admin.notify.email-files.status');
        });

        //sms
        Route::prefix('sms')->group(function () {
            Route::get('/', [SMSController::class, 'index'])->name('admin.notify.sms.index');
            Route::get('/create', [SMSController::class, 'create'])->name('admin.notify.sms.create');
            Route::post('/store', [SMSController::class, 'store'])->name('admin.notify.sms.store');
            Route::get('/edit/{sms}', [SMSController::class, 'edit'])->name('admin.notify.sms.edit');
            Route::put('/update/{sms}', [SMSController::class, 'update'])->name('admin.notify.sms.update');
            Route::delete('/delete/{sms}', [SMSController::class, 'destroy'])->name('admin.notify.sms.destroy');
            Route::get('/status/{sms}', [SMSController::class, 'status'])->name('admin.notify.sms.status');
        });
    });

    //tikcets
    Route::namespace('Ticket')->prefix('ticket')->group(function () {

        //tickets category
        Route::prefix('category')->group(function () {
            Route::get('/', [TicketCategoryController::class, 'index'])->name('admin.ticket.category.index');
            Route::get('/create', [TicketCategoryController::class, 'create'])->name('admin.ticket.category.create');
            Route::post('/store', [TicketCategoryController::class, 'store'])->name('admin.ticket.category.store');
            Route::get('/edit/{category}', [TicketCategoryController::class, 'edit'])->name('admin.ticket.category.edit');
            Route::put('/update/{category}', [TicketCategoryController::class, 'update'])->name('admin.ticket.category.update');
            Route::delete('/delete/{category}', [TicketCategoryController::class, 'destroy'])->name('admin.ticket.category.destroy');
            Route::get('/status/{category}', [TicketCategoryController::class, 'status'])->name('admin.ticket.category.status');
        });

        //tickets priority
        Route::prefix('priority')->group(function () {
            Route::get('/', [TicketPriorityController::class, 'index'])->name('admin.ticket.priority.index');
            Route::get('/create', [TicketPriorityController::class, 'create'])->name('admin.ticket.priority.create');
            Route::post('/store', [TicketPriorityController::class, 'store'])->name('admin.ticket.priority.store');
            Route::get('/edit/{priority}', [TicketPriorityController::class, 'edit'])->name('admin.ticket.priority.edit');
            Route::put('/update/{priority}', [TicketPriorityController::class, 'update'])->name('admin.ticket.priority.update');
            Route::delete('/delete/{priority}', [TicketPriorityController::class, 'destroy'])->name('admin.ticket.priority.destroy');
            Route::get('/status/{priority}', [TicketPriorityController::class, 'status'])->name('admin.ticket.priority.status');
        });

        //tickets admin
        Route::prefix('admin')->group(function () {
            Route::get('/', [TicketAdminController::class, 'index'])->name('admin.ticket.admin.index');
            Route::get('/all', [TicketAdminController::class, 'all'])->name('admin.ticket.admin.all');
            Route::get('/set/{admin}', [TicketAdminController::class, 'set'])->name('admin.ticket.admin.set');
            Route::delete('/delete/{admin}', [TicketAdminController::class, 'destroy'])->name('admin.ticket.admin.destroy');
        });

        //tickets main
        Route::get('/', [TicketController::class, 'index'])->name('admin.ticket.index');
        Route::get('/new-tickets', [TicketController::class, 'newTickets'])->name('admin.ticket.new-tickets');
        Route::get('/closed-tickets', [TicketController::class, 'closedTickets'])->name('admin.ticket.closed-tickets');
        Route::get('/opened-tickets', [TicketController::class, 'openedTickets'])->name('admin.ticket.opened-tickets');
        Route::get('/show/{ticket}', [TicketController::class, 'show'])->name('admin.ticket.show');
        Route::post('/answer/{ticket}', [TicketController::class, 'answer'])->name('admin.ticket.answer');
        Route::get('/status/{ticket}', [TicketController::class, 'status'])->name('admin.ticket.status');
    });

    //setting
    Route::namespace('Setting')->prefix('setting')->group(function () {

        Route::get('/', [SettingController::class, 'index'])->name('admin.setting.index');
        Route::post('/store', [SettingController::class, 'store'])->name('admin.setting.store');
        Route::get('/edit/{setting}', [SettingController::class, 'edit'])->name('admin.setting.edit');
        Route::put('/update/{setting}', [SettingController::class, 'update'])->name('admin.setting.update');
    });

    //notifications
    Route::get('/notifications/read-all', [NotificationController::class, 'readAll'])->name('admin.notifications.read-all');
});



Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
