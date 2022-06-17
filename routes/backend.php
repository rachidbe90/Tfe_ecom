<?php


Route::group(['prefix'=>'admin'],function(){
    Route::get('/login',[\App\Http\Controllers\Auth\Admin\LoginController::class,'showLoginForm'])->name('admin.login.form');
    Route::post('/login',[\App\Http\Controllers\Auth\Admin\LoginController::class,'login'])->name('admin.login');
});
//Admin dashboard

Route::group(['prefix'=>'admin','middleware'=>['admin']],function(){
    Route::get('/',[\App\Http\Controllers\Backend\AdminController::class,'admin'])->name('admin');

    //aboutus gestion
    Route::get('aboutus',[\App\Http\Controllers\Frontend\AboutusController::class,'index'])->name('about.index');
    Route::put('aboutus-update',[\App\Http\Controllers\Frontend\AboutusController::class,'aboutUpdate'])->name('about.update');

    // Profile edit
    Route::get('/profile',[\App\Http\Controllers\Backend\AdminController::class,'profile'])->name('profile');
    Route::post('/profile/{id}',[\App\Http\Controllers\Backend\AdminController::class,'profileUpdate'])->name('profile.update');

    // password Change
    Route::get('/password-change',[\App\Http\Controllers\Backend\AdminController::class,'changePassword'])->name('changePassword');
    Route::post('/password-change', [\App\Http\Controllers\Backend\AdminController::class,'changePasswordStore'])->name('update.password');

    // Banner Section
    Route::resource('/banner', \App\Http\Controllers\Backend\BannerController::class);
    Route::post('banner_status',[\App\Http\Controllers\Backend\BannerController::class,'bannerStatus'])->name('banner.status');

    // Category Section
    Route::resource('/category', \App\Http\Controllers\Backend\CategoryController::class);
    Route::post('category_status',[\App\Http\Controllers\Backend\CategoryController::class,'categoryStatus'])->name('category.status');

    Route::post('category/{id}/child',[\App\Http\Controllers\Backend\CategoryController::class,'getChildByParentID']);

    // Product Section
    Route::resource('/product', \App\Http\Controllers\Backend\ProductController::class);
    Route::post('product_status',[\App\Http\Controllers\Backend\ProductController::class,'productStatus'])->name('product.status');

    // Product Attribute section
    Route::post('product-attribute/{id}',[\App\Http\Controllers\Backend\ProductController::class,'addProductAttribute'])->name('product.attribute');
    Route::delete('product-attribute-delete/{id}',[\App\Http\Controllers\Backend\ProductController::class,'addProductAttributeDelete'])->name('product.attribute.destroy');

    // User Section
    Route::resource('/user', \App\Http\Controllers\Backend\UserController::class);
    Route::post('user_status',[\App\Http\Controllers\Backend\UserController::class,'userStatus'])->name('user.status');

    // Coupon Section
    Route::resource('/coupon', \App\Http\Controllers\Backend\CouponController::class);
    Route::post('coupon_status',[\App\Http\Controllers\Backend\CouponController::class,'couponStatus'])->name('coupon.status');

    // Shipping Section
    Route::resource('/shipping', \App\Http\Controllers\Backend\ShippingController::class);
    Route::post('shipping_status',[\App\Http\Controllers\Backend\ShippingController::class,'shippingStatus'])->name('shipping.status');

    // Order Section
    Route::resource('order', \App\Http\Controllers\Frontend\OrderController::class);
    Route::post('order-status',[\App\Http\Controllers\Frontend\OrderController::class,'orderStatus'])->name('order.status');

    //Setting section
    Route::get('settings',[\App\Http\Controllers\Backend\SettingsController::class,'settings'])->name('settings');
    Route::put('settings',[\App\Http\Controllers\Backend\SettingsController::class,'settingsUpdate'])->name('settings.update');

    //SMTP section
    Route::get('smtp',[\App\Http\Controllers\Backend\SettingsController::class,'smtp'])->name('smtp');
    Route::post('smtp-update',[\App\Http\Controllers\Backend\SettingsController::class,'smtpUpdate'])->name('smtp.update');

    //Payment section
    Route::get('payment',[\App\Http\Controllers\Backend\SettingsController::class,'payment'])->name('payment');

    //Paypal
    Route::patch('paypal-settings-update',[\App\Http\Controllers\Backend\SettingsController::class,'paypalUpdate'])->name('paypal.setting.update');

});

Route::group(['prefix' => 'filemanager', 'middleware' => ['web']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

