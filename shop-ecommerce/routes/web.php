<?php

use Illuminate\Support\Facades\Route;
/*--========Admin-=======--*/
use App\Http\Controllers\Admin\User\LoginController;
use App\Http\Controllers\Client\LoginCustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\StaffController;
use App\Http\Controllers\admin\SliderController;
use App\Http\Controllers\admin\DiscountController;
use App\Http\Controllers\admin\ProviderController;
use App\Http\Controllers\Admin\ImportController;
/*================Client===============-*/
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\RatingController;
use App\Http\Controllers\Client\CustomerController;
use \App\Http\Controllers\Admin\UploadController;
use \App\Http\Controllers\Admin\RoleController;

/*==========Admin====================*/
// Route::get('/list',[ProductController::class,'index'])->name('admin.products');

  Route::get('/admin/user/login',[LoginController::class,'index'])->name('admin.login');
  Route::post('admin/user/login/store/',[LoginController::class,'store'])->name('check_login_admin');
/*==========Logout Admin====================*/
Route::get('/admin/logout',[LoginController::class,'logout'])->name('logout.admin');
/*--------Check  Login admin-----------*/
Route::middleware(['checkloginadmin'])->prefix('/admin')->group(function(){
     // Thống kê
      Route::get('/',[DashboardController::class,'index'])->name('admin.dashboard') ;
      //Products
      Route::middleware(['checkrole'])->prefix('/products')->group(function(){
        Route::get('/list',[ProductController::class,'index'])->name('admin.products.list');
        Route::post('/list',[ProductController::class,'search']);
        Route::post('/active',[ProductController::class,'active']);
        
       Route::get('/add',[ProductController::class,'create'])->name('admin.product.add');
       Route::post('/add',[ProductController::class,'store']);//handle
       Route::DELETE('/destroy',[ProductController::class,'destroy'])->name('product.delete');//handle
       Route::get('/edit/{id}',[ProductController::class,'show'])->name('product.edit');
      Route::post('/edit/{id}',[ProductController::class,'update']);//handle
    
       });
       //provider
       Route::middleware(['checkrole'])->prefix('/providers')->group(function(){
        Route::get('/list',[ProviderController::class,'index'])->name('admin.providers.list');      
       Route::get('/add',[ProviderController::class,'create'])->name('admin.providers.add');
       Route::post('/add',[ProviderController::class,'store']);//handle
       Route::DELETE('/destroy',[ProviderController::class,'destroy'])->name('providers.delete');//handle
       Route::get('/list/{id}',[ProviderController::class,'show'])->name('providers.edit');
      Route::post('/list/{id}',[ProviderController::class,'update']);//handle
    
       });
       //Category
       Route::middleware(['checkrole'])->prefix('/group-products')->group(function(){
         Route::get('/list',[CategoryController::class,'index'])->name('admin.categories.list');
         Route::get('/add',[CategoryController::class,'create'])->name('admin.categories.add');
         Route::post('/add',[CategoryController::class,'store']);
         Route::get('/edit/{id}',[CategoryController::class,'show'])->name('admin.categories.edit');
         Route::post('/edit/{id}',[CategoryController::class,'update']);
         Route::DELETE('/destroy',[CategoryController::class,'destroy']);
       });
       //Discounts
       Route::middleware(['checkrole'])->prefix('/discounts')->group(function(){
         Route::get('/list',[DiscountController::class,'index'])->name('admin.discounts.list');
         Route::post('/list',[DiscountController::class,'search']);
         Route::get('/add',[DiscountController::class,'create'])->name('admin.discounts.add');
         Route::post('/add',[DiscountController::class,'store']);
         Route::get('/edit/{id}',[DiscountController::class,'show']);
         Route::post('/edit/{id}',[DiscountController::class,'update']);
         Route::DELETE('/destroy',[DiscountController::class,'destroy']);
       });
       //Import
       Route::middleware(['checkrole'])->prefix('/imports')->group(function(){
         Route::get('/list',[ImportController::class,'index'])->name('admin.imports.list');
         Route::post('/list',[ImportController::class,'search']);
        Route::get('/add',[ImportController::class,'create'])->name('admin.imports.add');
        Route::post('/add',[ImportController::class,'store']);//handle
        Route::post('/addDB',[ImportController::class,'save']);//handle
        Route::get('/show/{id}',[ImportController::class,'importdetail']);
        Route::DELETE('/destroy',[ImportController::class,'destroy']);//handle
        Route::get('/edit/{menu}',[ImportController::class,'show']);
       Route::post('/edit/{menu}',[ImportController::class,'update']);//handle
        });
       //Orders
       Route::middleware(['checkrole'])->prefix('/orders')->group(function(){
         Route::get('/list',[OrderController::class,'index'])->name('admin.orders');//handle
         Route::post('/list',[OrderController::class,'search']);
        Route::get('/show/{id}',[OrderController::class,'showDetail']);
        Route::get('print/{id}',[OrderController::class,'print']);
        Route::get('/add',[OrderController::class,'create']);
        Route::post('/add',[OrderController::class,'store']);//handle
        Route::DELETE('/destroy',[OrderController::class,'destroy']);//handle
        Route::get('/edit/{id}',[OrderController::class,'show']);
       Route::post('/edit/{id}',[OrderController::class,'update']);//handle
        });
    
      //Upload
      Route::post('upload/services', [UploadController::class, 'store']);

      //Staff
      Route::middleware(['checkrole'])->prefix('/staffs')->group(function(){
        Route::get('/list',[StaffController::class,'index'])->name('admin.staffs');//handle
        Route::post('/list',[StaffController::class,'search']);
        Route::post('/list/filter',[StaffController::class,'filter']);
       Route::get('/add',[StaffController::class,'create']);
       Route::post('/checkEmail',[StaffController::class,'checkEmailExist']);
       Route::post('/add',[StaffController::class,'store']);//handle
       Route::DELETE('/destroy',[StaffController::class,'destroy']);//handle
       Route::get('/edit/{id}',[StaffController::class,'show']);
      Route::post('/edit/{id}',[StaffController::class,'update']);//handle
       });
      //Customer
       Route::middleware(['checkrole'])->prefix('/customers')->group(function(){
        Route::get('/list',[\App\Http\Controllers\Admin\CustomerController::class,'index'])->name('admin.customers');//handle
        Route::post('/list',[\App\Http\Controllers\Admin\CustomerController::class,'search']);
        Route::post('/list/filter',[\App\Http\Controllers\Admin\CustomerController::class,'filter']);
       Route::get('/add',[\App\Http\Controllers\Admin\CustomerController::class,'create']);
       Route::post('/checkEmail',[\App\Http\Controllers\Admin\CustomerController::class,'checkEmailExist']);
       Route::post('/add',[\App\Http\Controllers\Admin\CustomerController::class,'store']);//handle
       Route::DELETE('/destroy',[\App\Http\Controllers\Admin\CustomerController::class,'destroy']);//handle
       Route::get('/edit/{id}',[\App\Http\Controllers\Admin\CustomerController::class,'show']);
      Route::post('/edit/{id}',[\App\Http\Controllers\Admin\CustomerController::class,'update']);//handle
       });
       //sliders
       Route::middleware(['checkrole'])->prefix('/sliders')->group(function(){
        Route::get('/list',[SliderController::class,'index'])->name('admin.sliders.list');//handle
        Route::post('/list',[SliderController::class,'search']);
       Route::get('/add',[SliderController::class,'create'])->name('admin.sliders.add');
       Route::post('/add',[SliderController::class,'store']);//handle
       Route::DELETE('/destroy',[SliderController::class,'destroy']);//handle
       Route::get('/edit/{id}',[SliderController::class,'show']);
      Route::post('/edit/{id}',[SliderController::class,'update']);//handle
       });
       //ratings
       Route::middleware(['checkrole'])->prefix('/ratings')->group(function(){
         Route::get('/list',[RatingController::class,'index'])->name('admin.ratings.list');
         
         Route::post('/list',[RatingController::class,'searchPoint']);
       });
       // Role
        //role
      Route::middleware(['checkrole'])->prefix('/roles')->group(function(){
        Route::get('/list',[RoleController::class,'index'])->name('admin.roles');//handle
        Route::post('/add',[RoleController::class,'store']);
        Route::get('/add',[RoleController::class,'create']);
        Route::get('/edit/{id}',[RoleController::class,'show']);
        Route::post('/edit/{id}',[RoleController::class,'update']);//handle
        Route::DELETE('/destroy',[RoleController::class,'destroy']);//handl
      
       });
       
    

  });


  /*====================CUSTOMER-LOGIN=========================*/

  Route::get('/login',[LoginCustomerController::class,'index'])->name('login');
  Route::post('/login/store/',[LoginCustomerController::class,'store'])->name('check_login');
  Route::get('/registery',[LoginCustomerController::class,'showRegistery'])->name('registery');
  Route::post('/registery/store/',[LoginCustomerController::class,'storeRegistery'])->name('check_registery');
  Route::get('/logout',[LoginCustomerController::class,'logout'])->name('logout');
  // forgot password
  Route::get('/login/forgot-password/',[LoginCustomerController::class,'showFormCheckEmailForgotPassword'])->name('forgot_password');
  Route::post('/login/forgot-password/',[LoginCustomerController::class,'storeFormCheckEmailForgotPassword']);

  Route::get('/login/forgot-password/send-otp',[LoginCustomerController::class,'showFormSentOTP']);
  Route::post('/login/forgot-password/send-otp',[LoginCustomerController::class,'storeFormSentOTP']);

  Route::get('/login/reset-password/',[LoginCustomerController::class,'showResetPassword'])->name('resetpassword');
  Route::post('/login/reset-password/',[LoginCustomerController::class,'storeResetPassword']);


  /*====================CUSTOMER=========================*/

  Route::prefix('/')->group(function(){

  Route::get('/',[HomeController::class,'index'])->name('home') ;
  Route::get('/products',[HomeController::class,'showListProducts'])->name('home.products') ;
  Route::get('/detail-product/{id}-{slug}.html', [ProductController::class,'showDetailProduct'])->name('detail-product');
  Route::get('/products/{id}-{slug}.html', [HomeController::class,'showListProductSortby']);
  Route::post('/services/load-product',[HomeController::class,'loadProduct']);
  /*------------------------------------------------Cart------------------------------------------------*/
  Route::post('/add-cart', [CartController::class,'index']);
  Route::get('/carts', [CartController::class,'show'])->name('home.carts');
  Route::post('/carts', [CartController::class,'checkLoginPermission']);
  Route::post('/update-cart', [CartController::class,'update']);
  Route::get('/cart/delete/{id}', [CartController::class,'remove']);
   /*--------------------------ratings------------------------------------------------*/

   
   Route::post('/rating-add',[RatingController::class,'create']);


  /*--------------------------CheckOut------------------------------------------------*/
  Route::get('/checkout', [CartController::class,'showCheckOut'])->middleware(['checklogincustomer'])->middleware(['checkorderlogic']);
  // thanh toan COD
  Route::post('/checkout', [CartController::class,'checkOut'])->middleware(['checkorderlogic']);
  // thanh toan VNPAY
  Route::post('/checkoutVNPay', [CartController::class,'checkOutVNPay'])->name('home.checkoutVNPAY');
  Route::get('/checkoutVNPay/vnpay-return', [CartController::class,'storeVNPay'])->name('vnpay.return');
  // xuat hoa don ra màn hinh

  // về cửa hàng
  Route::get('/about', [HomeController::class,'aboutStore'])->name('home.about');
  Route::get('/contact', [HomeController::class,'contactStore'])->name('home.contact');

  /*----------------------------Profile Customer --------------------*/
  Route::middleware(['checklogincustomer'])->prefix('/myprofile')->group(function(){
    Route::get('/',[CustomerController::class,'index'])->name('home.profile') ;
    Route::post('/store',[CustomerController::class,'updateClient']) ;
    Route::get('/invoices/{id}',[CustomerController::class,'showDetailOrder'])->name('home.profile.invoices') ;
    Route::post('/change_password',[CustomerController::class,'changePassword']) ;
  });
 
   
   
  });
  /*Route::middleware(['checklogincustomer'])->prefix('/payment')->group(function(){
   
  });*/