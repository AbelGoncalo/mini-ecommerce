<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Auth\{Login,Logout,Signup};

Route::get('/auth/login',Login::class)->name('auth.login');
Route::get('/auth/criar-conta',Signup::class)->name('auth.signup');
Route::get('/auth/sair',Logout::class)->name('auth.logout')->middleware(['auth']);
