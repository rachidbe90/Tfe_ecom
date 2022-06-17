<?php
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;


    //authentication
    Route::get('user/auth',[\App\Http\Controllers\Frontend\IndexController::class,'userAuth'])->name('user.auth');
    Route::post('user/login',[\App\Http\Controllers\Frontend\IndexController::class,'loginSubmit'])->name('login.submit');
    Route::post('user/register',[\App\Http\Controllers\Frontend\IndexController::class,'registerSubmit'])->name('register.submit');

    // Vérification email
// afficher la page d'avertissement (no-verified user)
   // Route::get('/email/verify', function () { return view('auth.verify-email');  })->middleware('auth')->name('verification.notice');
// traitement de la vérification
    //Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) { $request->fulfill(); return redirect('/home');})->middleware(['auth', 'signed'])->name('verification.verify');
// not send mail verified
    // Route::post('/email/verification-notification', function (Request $request) { $request->user()->sendEmailVerificationNotification(); return back()->with('message', 'Verification link sent!');})->middleware(['auth', 'throttle:6,1'])->name('verification.send');



    //logout
    Route::get('user/logout',[\App\Http\Controllers\Frontend\IndexController::class,'userLogout'])->name('user.logout');

    // index home
    Route::get('/',[\App\Http\Controllers\Frontend\IndexController::class,'home'])->name('home');

    //about us
    Route::get('/about-us',[\App\Http\Controllers\Frontend\IndexController::class,'aboutUs'])->name('about.us');

    //contact-us
    Route::get('contact-us',[\App\Http\Controllers\Frontend\IndexController::class,'contactUs'])->name('contact.us');
    Route::post('contact-submit',[\App\Http\Controllers\Frontend\IndexController::class,'contactSubmit'])->name('contact.submit');

    //Product category
    Route::get('product-category/{slug}/',[\App\Http\Controllers\Frontend\IndexController::class,'productCategory'])->name('product.category');

    //Product detail
    Route::get('product-detail/{slug}/',[\App\Http\Controllers\Frontend\IndexController::class,'productDetail'])->name('product.detail');
    Route::get('/get-product-price/{id}',[\App\Http\Controllers\Backend\ProductController::class,'filterPriceWithSize']);


    //Product Review
    Route::post('product-review/{slug}',[\App\Http\Controllers\ProductReviewController::class,'productReview'])->name('product.review');

    //Cart section
    Route::get('cart',[\App\Http\Controllers\Frontend\CartController::class,'cart'])->name('cart');
    Route::post('cart/store',[\App\Http\Controllers\Frontend\CartController::class,'cartStore'])->name('cart.store');
    Route::post('cart/delete',[\App\Http\Controllers\Frontend\CartController::class,'cartDelete'])->name('cart.delete');
    Route::post('cart/update',[\App\Http\Controllers\Frontend\CartController::class,'cartUpdate'])->name('cart.update');

    //coupon section
    Route::post('coupon/add',[\App\Http\Controllers\Frontend\CartController::class,'couponAdd'])->name('coupon.add');

    //wishlist section
    Route::get('wishlist',[\App\Http\Controllers\Frontend\WishlistController::class,'wishlist'])->name('wishlist');
    Route::post('wishlist/store',[\App\Http\Controllers\Frontend\WishlistController::class,'wishlistStore'])->name('wishlist.store');
    Route::post('wishlist/move-to-cart',[\App\Http\Controllers\Frontend\WishlistController::class,'moveToCart'])->name('wishlist.move.cart');
    Route::post('wishlist/delete',[\App\Http\Controllers\Frontend\WishlistController::class,'wishlistDelete'])->name('wishlist.delete');

    //compare section
    Route::get('compare',[\App\Http\Controllers\Frontend\CompareController::class,'compare'])->name('compare');
    Route::post('compare/store',[\App\Http\Controllers\Frontend\CompareController::class,'compareStore'])->name('compare.store');
    Route::post('compare/move-to-cart',[\App\Http\Controllers\Frontend\CompareController::class,'moveToCart'])->name('compare.move.cart');
    Route::post('compare/move-to-wishlist',[\App\Http\Controllers\Frontend\CompareController::class,'moveToWishlist'])->name('compare.move.wishlist');
    Route::post('compare/delete',[\App\Http\Controllers\Frontend\CompareController::class,'compareDelete'])->name('compare.delete');

    //Checkout Section
    Route::get('checkout',[\App\Http\Controllers\Frontend\CheckoutController::class,'checkout'])->name('checkout')->middleware(['user']);
    Route::POST('checkout-store',[\App\Http\Controllers\Frontend\CheckoutController::class,'checkoutStore'])->name('checkout.store');
    Route::get('complete/{order}',[\App\Http\Controllers\Frontend\CheckoutController::class,'complete'])->name('complete');

    //paypal
    Route::get('paypal/payment/cancel',[\App\Http\Controllers\PaypalController::class,'getCancel']);
    Route::get('paypal/payment/done',[\App\Http\Controllers\PaypalController::class,'getDone']);

    //Shop section
    Route::get('shop',[\App\Http\Controllers\Frontend\IndexController::class,'shop'])->name('shop');
    Route::post('shop-filter',[\App\Http\Controllers\Frontend\IndexController::class,'shopFilter'])->name('shop.filter');

    //search product & autosearch product
    Route::get('autosearch',[\App\Http\Controllers\Frontend\IndexController::class,'autoSearch'])->name('autosearch');
    Route::get('search',[\App\Http\Controllers\Frontend\IndexController::class,'search'])->name('search');


    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);

    //User Dashboard
    Route::group(['prefix'=>'user'],function (){
    Route::get('/dashboard',[\App\Http\Controllers\Frontend\IndexController::class,'userDashboard'])->name('user.dashboard');
    Route::get('/order',[\App\Http\Controllers\Frontend\IndexController::class,'userOrder'])->name('user.order');
    Route::get('/address',[\App\Http\Controllers\Frontend\IndexController::class,'userAddress'])->name('user.address');
    Route::get('/account-detail',[\App\Http\Controllers\Frontend\IndexController::class,'userAccount'])->name('user.account');

    Route::post('/billing/address/{id}',[\App\Http\Controllers\Frontend\IndexController::class,'billingAddress'])->name('billing.address');
    Route::post('/shipping/address/{id}',[\App\Http\Controllers\Frontend\IndexController::class,'shippingAddress'])->name('shipping.address');

    Route::post('/update/account/{id}',[\App\Http\Controllers\Frontend\IndexController::class,'updateAccount'])->name('update.account');
});

