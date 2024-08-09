<?php
use App\Http\Middleware\validuser;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;


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


Route::get('/product/{id}',[RegistrationController::class,'singleproduct'])->name('singleproduct')->Middleware(validuser::class);

Route::get('/buy/{id}',[RegistrationController::class,'buy'])->name('buy')->Middleware(validuser::class);

Route::get('/addcards/{id}',[RegistrationController::class,'addcards'])->name('addcards')->Middleware(validuser::class);


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
