<?php
use App\Http\Middleware\validuser;
use App\Http\Middleware\store_validuser;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\store_pannel_Controller;


Route::get('/', function () {
    return view('login');
});

Route::post('/', [RegistrationController::class, 'login'])->name('login');

Route::get('/registration', function () {
    return view('registration');
});

Route::post('/registration', [RegistrationController::class, 'registration'])->name('registration');

Route::get('/home', function () {
    return view('home');
})->Middleware(validuser::class);

Route::get('/home', [RegistrationController::class, 'getapidata'])->name('home')->middleware(validuser::class);

Route::get('/category/{jewelery}', [RegistrationController::class, 'category'])->name('jwellery')->middleware(validuser::class);
Route::get('/category/{electronics}', [RegistrationController::class, 'category'])->name('watch')->middleware(validuser::class);
Route::get('/category/{men\'s clothing}', [RegistrationController::class, 'category'])->name('men_shirts')->middleware(validuser::class);
Route::get('/category/{women\'s clothing}', [RegistrationController::class, 'category'])->name('bracelet')->middleware(validuser::class);


Route::get('/profile', function () {
    return view('profile');
})->name('profile')->Middleware(validuser::class);


Route::get('/logout',[RegistrationController::class,'logout'])->name('logout');


Route::get('/product/{id}/{c}',[RegistrationController::class,'singleproduct'])->name('singleproduct')->Middleware(validuser::class);

Route::get('/buy/{id}/{c}',[RegistrationController::class,'buy'])->name('buy')->Middleware(validuser::class);

Route::get('/addcards/{id}/{c}',[RegistrationController::class,'addcards'])->name('addcards')->Middleware(validuser::class);


Route::post('/order',[RegistrationController::class,'order'])->name('order')->Middleware(validuser::class);


Route::get('/addcard', function () {
    return view('addcard');
})->name('card')->Middleware(validuser::class);


Route::get('/results', function () {
   
    return view('results');
})->name('results')->middleware(ValidUser::class);

Route::get('/remove_product/{id}',[RegistrationController::class,'remove_product'])->name('remove_product')->Middleware(validuser::class);

Route::get('/about', function () {
    return view('about');
})->name('about')->Middleware(validuser::class);

Route::get('/order_placed',[RegistrationController::class,'order_placed'])->name('order_placed')->Middleware(validuser::class);

Route::get('/forget_password', function () {
    return view('forget_password');
});

Route::post('/forget_password',[RegistrationController::class,'forget_password'])->name('forget_password');




// STORE PANNEL ROUTES

Route::get('/store/login',function(){
    return view('store_pannel.store_login');
});


Route::post('/store/login',[store_pannel_Controller::class,'store_login'])->name('store_login');




Route::get('/store/registration',function(){
    return view('store_pannel.store_registration');
});

Route::post('/store/registration',[store_pannel_Controller::class,'store_registration'])->name('store_registration');

Route::get('/store/home',function(){
    return view('store_pannel.store_home');
})->name('store_home')->middleware(store_validuser::class);


Route::get('/store/orders',function(){
    return view('store_pannel.store_orders');
})->middleware(store_validuser::class);


Route::get('/store/orders',[store_pannel_Controller::class,'store_orders'])->name('store_orders')->middleware(store_validuser::class);

Route::get('/store/profile',function(){
    return view('store_pannel.store_profile');
})->name('store_profile')->middleware(store_validuser::class);
    Route::get('/store/products',function(){
        return view('store_pannel.store_products');
    })->name('store_products')->middleware(store_validuser::class);
    
    Route::get('/store/product',[store_pannel_Controller::class,'store_product'])->name('store_product')->middleware(store_validuser::class);
    
    Route::get('/store/update/{data_stage}/{order_refrence}',[store_pannel_Controller::class,'store_update'])->name('store_update')->middleware(store_validuser::class);

    Route::get('/store/logout',[store_pannel_Controller::class,'store_logout'])->name('store_logout')->middleware(store_validuser::class);

    Route::post('/products/store', [store_pannel_Controller::class, 'store'])->name('products.store')->middleware(store_validuser::class);
    
    Route::get('/products/store/edit/{id}', [store_pannel_Controller::class, 'store_edit'])->name('products.store_edit')->middleware(store_validuser::class);
    Route::get('/products/store/delete/{id}', [store_pannel_Controller::class, 'store_delete'])->name('products.store_delete')->middleware(store_validuser::class);
    Route::post('/products/store/edit', [store_pannel_Controller::class, 'store_product_edit'])->name('store_product_edit')->middleware(store_validuser::class);
    
    
    Route::get('/store/forget_password', function () {
        return view('store_pannel.store_forget_password');
    });
    
    Route::post('/store/forget_password',[store_pannel_Controller::class,'store_forget_password'])->name('store_forget_password');
    
        