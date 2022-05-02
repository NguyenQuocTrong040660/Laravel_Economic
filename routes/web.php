<?php

use Illuminate\Support\Facades\Route;


//Home index Frontend
Route::get('/','App\Http\Controllers\HomeController@index')->name('homefrontend');

/*khi lick home thi tra v views/home*/
Route::get('/home', function () {
    return view('home');
});

//CATEGORY
Route::get('/category/{slug}/{id}',[
    'as' =>'category.product',
    'uses'=> 'App\Http\Controllers\categorycontroller@indexfrontend'
]);

//-- product.detail từ list.php
Route::get('/chi-tiet-san-pham/{product_id}','App\Http\Controllers\ProductController@detail_product')->name('detail.product');

//Cart
Route::prefix('cart')->group(function (){
    Route::post('/','App\Http\Controllers\CartController@saveCart')->name('cart_product');
    Route::get('/show','App\Http\Controllers\CartController@show_cart')->name('show_cart');
    //ajax
    Route::get('/gio-hang','App\Http\Controllers\CartController@show_cartAjax')->name('show_cartAjax');
    //ajax
    Route::get('/delete/{rowId}','App\Http\Controllers\CartController@delete_cart')->name('cart_delete');
    Route::post('/cart_update_quantity','App\Http\Controllers\CartController@cart_update_quantity')->name('cart_update_quantity');
});

//Cart ajax
Route::get('/add-to-cart/{id}','App\Http\Controllers\CartController@addToCartAjax')->name('addToCart');
Route::get('updatecart/{key}/{qty}','App\Http\Controllers\CartController@updatecartAjax');

//Hien thi so luong 1234 khi them cart
Route::get('/so-luong-gio-hang','App\Http\Controllers\CartController@hienThiSlgThemCart')->name('slg_AdtoCart');

Route::get('/delete-cart/{product_id}','App\Http\Controllers\CartController@deletecartAjax')->name('deletecart');

//Check_Count

//Thanh Toan VNPay
   //  Route::post('/vnPay','App\Http\Controllers\CheckAcount@vnPay_Payment')->name('vnPay');
  //   Route::get('/return-vnPay','App\Http\Controllers\CheckAcount@return_vnpay')->name('return-vnpay');
 //login de thanhtoan
Route::get('/login','App\Http\Controllers\CheckAcount@checkcount')->name('check_acount');
//logout
Route::get('/logout','App\Http\Controllers\CheckAcount@logout')->name('logout_checkout');
//
Route::post('thanh-toan-gio-hang','App\Http\Controllers\CheckAcount@checkLogin')->name('login_custom');
//has login => thanhtoan
Route::get('/thanh-toan','App\Http\Controllers\CheckAcount@thanhtoan')->name('thanhtoan');
Route::post('/thanhtoan','App\Http\Controllers\CheckAcount@storeShipping')->name('thanhtoan_address');
Route::get('/thanhtoan/payment','App\Http\Controllers\CheckAcount@payment')->name('payment');
//
//register_customer equal //login de thanhtoan
Route::post('/dangki','App\Http\Controllers\CheckAcount@registerCustomer')->name('register_customer');

//shipping_oder save address
Route::post('/thanh-toan/gui-don-hang','App\Http\Controllers\CheckAcount@shipping_oder')->name('shipping_oder');



//Tinh Phi van chuyen
Route::post('/thanh-toan/','App\Http\Controllers\CheckAcount@TinhPhiVanChuyen')->name('tinh-phi-van-chuyen');

//delete Phi Vanchuyen
Route::get('/thanh-toan/xoa-phi','App\Http\Controllers\CheckAcount@xoaPhiVanChuyen')->name('delete_fee_ship');


//Login facebook
Route::get('/login-facebook','App\Http\Controllers\CheckAcount@login_facebook')->name('login_facebook');
Route::get('/login/callback','App\Http\Controllers\CheckAcount@callback_facebook');

//tim kiem san pham
Route::post('/search-product','App\Http\Controllers\ProductController@searchProduct')->name('search_product');

//lich su don hang
Route::get('/home/history-order','App\Http\Controllers\OrderController@history_order')->name('history_order');

//xem chi tiet don hang

Route::get('/home-view-order/{order_code}','App\Http\Controllers\OrderController@view_order_frontend')->name('view_order_frontend');

//EndFrontend
//Start ADmin
//LOGIN_ADMIN
 Route::prefix('Login')->group(function (){
     Route::post('/','App\Http\Controllers\AdminController@login')->name('admin.login');

 });


//ADMIN_>MENU or CATEGOGY

Route::prefix('admin')->group(function (){
    Route::get('/trangchu','App\Http\Controllers\AdminController@trangindexAdmin')->name('trangchuAdmin');
    Route::get('/', function () {
        return view('login');
    });
    Route::prefix('categories')->group(function () {


        //khi nguoi dung click vao danh muc san pham "partial.slider"
        Route::get('/','App\Http\Controllers\categorycontroller@index')->name('category.index');

        //index cua category , click vao add(category.create) to categorycontrolle goi ham 'create()'
        Route::get('/create', 'App\Http\Controllers\categorycontroller@create')->name('category.create');
        // form them danh muc san pham
        Route::POST('/store','App\Http\Controllers\categorycontroller@store')->name('category.store');

        //imdex : edit danh muc sp
        Route::get('/edit/{id}','App\Http\Controllers\categorycontroller@edit')->name('category.edit');

        //index : delete dmsp
        Route::get('/delete/{id}','App\Http\Controllers\categorycontroller@delete')->name('category.delete');

        // edit->form post action:update
        Route::post('/update/{id}','App\Http\Controllers\categorycontroller@update')->name('category.update');

    });
    Route::prefix('menu')->group(function () {


        //khi nguoi dung click vao danh muc san pham "partial.slider"
        Route::get('/','App\Http\Controllers\menuController@index')->name('menu.index');
        Route::get('/Add','App\Http\Controllers\menuController@Add')->name('menu.add');
        Route::POST('/store','App\Http\Controllers\menuController@store')->name('menu.store');

        //khi nguoi dung menu->edit
        Route::get('/edit/{id}','App\Http\Controllers\menuController@edit')->name('menu.edit');
        Route::POST('/update/{id}','App\Http\Controllers\menuController@update')->name('menu.update');
        Route::get('/delete/{id}','App\Http\Controllers\menuController@delete')->name('menu.delete');

    });
    Route::prefix('product')->group(function (){
        Route::get('/','App\Http\Controllers\ProductController@index')->name('product.index');
        Route::get('/add','App\Http\Controllers\ProductController@add')->name('product.add');
        Route::post('/store','App\Http\Controllers\ProductController@store')->name('product.store');
        Route::get('/edit/{id}','App\Http\Controllers\ProductController@edit')->name('product.edit');
        Route::get('/delete/{id}','App\Http\Controllers\ProductController@delete')->name('product.delete');
        Route::post('/update/{id}','App\Http\Controllers\ProductController@update')->name('product.update');
    });
    Route::prefix('slider')->group(function(){

        Route::get('/','App\Http\Controllers\SliderController@index')->name('slider.index');
        Route::get('/add','App\Http\Controllers\SliderController@add')->name('slider.add');
        Route::POST('/store','App\Http\Controllers\SliderController@store')->name('slider.store');
        Route::get('/edit/{id}','App\Http\Controllers\SliderController@edit')->name('slider.edit');

        Route::post('/update/{id}','App\Http\Controllers\SliderController@update')->name('slider.update');

        Route::get('/delete/{id}','App\Http\Controllers\SliderController@destroy')->name('slider.delete');
    });
    Route::prefix('delivery')->group(function(){

        Route::get('/','App\Http\Controllers\feeShipManager@feeShipManager')->name('feeShipManager');
        //Delivery
        Route::POST('/select-delivery','App\Http\Controllers\feeShipManager@select_delivery')->name('delivery');


         Route::POST('/insert_delivery','App\Http\Controllers\feeShipManager@insert_delivery')->name('insert_delivery');
        Route::POST('/update','App\Http\Controllers\feeShipManager@update_delivery')->name('update_delivery');
        Route::POST('/select_feeship','App\Http\Controllers\feeShipManager@select_feeship')->name('select_feeship');
    });

      Route::prefix('order')->group(function(){

          Route::get('/','App\Http\Controllers\OrderController@manage_order')->name('OrderManager');
          //Delivery
          Route::get('/view_order/{order_code}','App\Http\Controllers\OrderController@view_order')->name('view_order');
          Route::post('/view_order/handel_order_status','App\Http\Controllers\OrderController@handel_order_status')->name('handel_order_status');



      });

       Route::prefix('DoanhThu')->group(function(){

           Route::get('/','App\Http\Controllers\OrderController@DoanhThu')->name('DoanhThu');
           //Delivery

            Route::post('/','App\Http\Controllers\OrderController@DoanhThuByDate')->name('loc-doanh-thu');
           Route::post('/nowday','App\Http\Controllers\OrderController@filter_order_now_day')->name('filter_order_now_day');

            ///Su kien loc doanh thu theo tuan thang nam





       });
});



Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
