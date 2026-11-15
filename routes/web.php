<?php

use App\Http\Controllers\MahasiswaController;
use Illuminate\Support\Facades\Route;

// Menu HOME
Route::get('/', [MahasiswaController::class, 'home'])->name('home');

// Menu ADMIN /admin, /admin/create, /admin/{nim}/edit, dst.
Route::resource('admin', MahasiswaController::class)
    ->except('show') //menecualikan show karena tdk terpakai
    ->parameters(['admin' => 'mahasiswa']);