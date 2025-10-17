<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; 
use App\Http\Controllers\UserController; 
use App\Http\Controllers\Admin\AdminController; // ধাপ ৩.১ এর জন্য
use App\Http\Controllers\Depo\DepoController;   // ধাপ ৩.১ এর জন্য
use App\Http\Controllers\Distributor\DistributorController; // ধাপ ৩.১ এর জন্য


// ১. Auth রুটস যোগ করা (login, register, logout ইত্যাদি)
Auth::routes(); 

// ২. রুট '/' এ লগইন না করা থাকলে লগইন পেজে রিডাইরেক্ট করা
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard.redirect');
    }
    return redirect()->route('login'); 
})->name('welcome');

// ৩. লগইন সফল হওয়ার পর রোল চেক করে সঠিক ড্যাশবোর্ডে পাঠানো
Route::middleware(['auth'])->group(function () {
    
    Route::get('/dashboard-redirect', function () {
        $role = Auth::user()->role;
        if ($role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($role === 'depo') {
            return redirect()->route('depo.dashboard');
        } elseif ($role === 'distributor') {
            return redirect()->route('distributor.dashboard');
        }
        // Salesman বা অন্য কোনো রোল-এর জন্য ডিফল্ট ড্যাশবোর্ড
        return view('dash'); // dash.blade.php দেখাবে
        
    })->name('dashboard.redirect');


    // ৪. রোল-ভিত্তিক গ্রুপ রুটস (মিডলওয়্যার দ্বারা সুরক্ষিত) - এই রুটগুলো ধাপ ৩-এ ব্যবহার হবে

    // Admin Routs
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        // Admin User Management Routs
        Route::get('/users', [UserController::class, 'index'])->name('user.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('user.create');
        Route::post('/users/store', [UserController::class, 'store'])->name('user.store');
        Route::get('/users/edit/{user_id}', [UserController::class, 'update'])->name('user.edit'); 
        Route::post('/users/edit-store', [UserController::class, 'editStore'])->name('user.editStore');
        Route::delete('/users/delete', [UserController::class, 'destroy'])->name('user.delete');
    });

    // Depo Routs
    Route::middleware('depo')->prefix('depo')->name('depo.')->group(function () {
        Route::get('/dashboard', [DepoController::class, 'index'])->name('dashboard');
        // Depo User Management Routs (যদি প্রয়োজন হয়)
        Route::get('/users', [UserController::class, 'index'])->name('user.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('user.create');
        Route::post('/users/store', [UserController::class, 'store'])->name('user.store');
        // ... অন্যান্য Depo রুটস
    });

    // Distributor Routs
    Route::middleware('distributor')->prefix('distributor')->name('distributor.')->group(function () {
        Route::get('/dashboard', [DistributorController::class, 'index'])->name('dashboard');
        // Distributor User Management Routs (যদি প্রয়োজন হয়)
        Route::get('/users', [UserController::class, 'index'])->name('user.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('user.create');
        Route::post('/users/store', [UserController::class, 'store'])->name('user.store');
        // ... অন্যান্য Distributor রুটস
    });

    // Salesman/Default User-এর জন্য কোনো রুট প্রয়োজন হলে এখানে যোগ করুন

});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
