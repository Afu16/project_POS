<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('auth.login');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', function () {
    if (Auth::user()->role === 'admin') {
        return redirect('/admin/dashboard');
    } else {
        return redirect('/kasir/dashboard');
    }
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard'); // bikin view-nya sendiri
    });

    Route::get('/kasir/dashboard', function () {
        return view('kasir.dashboard'); // bikin view-nya juga
    });
});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard'); // bikin view-nya sendiri
    });

    Route::get('/kasir/dashboard', function () {
        return view('kasir.dashboard'); // bikin view-nya juga
    });
});


require __DIR__.'/auth.php';
