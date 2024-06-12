<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\PropertyController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

Route::get('/', HomeController::class)
    ->name('home');

Route::get('/home', function () {
    return view('home');
})
    ->middleware(['auth', 'verified'])
    ->name('home');


Route::resource('categories', CategoryController::class)
    ->middleware(['auth', 'verified']);

//    ->name('dashboard');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::resource('properties', PropertyController::class)
    ->middleware(['auth', 'verified']);

Route::get('/property', function () {
    return view('home');
})
    ->middleware(['auth', 'verified'])
    ->name('home');





//Route::get('/login', function () {
//    return view('auth.login');
//})->middleware('guest')->name('login');
//
//Route::post('/login', function (Request $request) {
//    $credentials = $request->validate([
//        'email' => ['required', 'email'],
//        'password' => ['required'],
//    ]);
//
//    if (Auth::attempt($credentials, $request->boolean('remember'))) {
//        $request->session()->regenerate();
//
//        return redirect()->intended('/');
//    }
//
//    return back()->withErrors([
//        'email' => 'The provided credentials do not match our records.',
//    ]);
//})->middleware('guest');
//
//Route::get('/register', function () {
//    return view('auth.register');
//})->middleware('guest')->name('register');
//
//Route::post('/register', function (Request $request) {
//    $request->validate([
//        'name' => ['required', 'string', 'max:255'],
//        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
//        'password' => ['required', 'confirmed', 'min:8'],
//    ]);
//
//    $user = User::create([
//        'name' => $request->name,
//        'email' => $request->email,
//        'password' => Hash::make($request->password),
//    ]);
//
//    Auth::login($user);
//
//    return redirect('/');
//})->middleware('guest');
//
//Route::post('/logout', function (Request $request) {
//    Auth::logout();
//
//    $request->session()->invalidate();
//    $request->session()->regenerateToken();
//
//    return redirect('/');
//})->name('logout');

//Route::middleware([
//    'auth:sanctum',
//    config('jetstream.auth_session'),
//    'verified',
//])->group(function () {
//    Route::get('/dashboard', function () {
//        return view('dashboard');
//    })->name('dashboard');
//});

//Route::get('/', function () {
//    return view('home');
//})->name('home');
//
