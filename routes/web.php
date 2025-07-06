<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\Jenis_barangController;
use App\Http\Controllers\TransaksiController;

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

Route::resource('admin/barangs', BarangController::class);

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('transaksis', TransaksiController::class);
});

Route::resource('admin/jenis_barangs', Jenis_barangController::class);

Route::prefix('kasir')->name('kasir.')->group(function () {
    Route::resource('transaksis', TransaksiController::class);
});



require __DIR__.'/auth.php';
