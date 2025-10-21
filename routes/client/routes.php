<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Client\{ReviewComponent,MyOrderComponent,OrderComponent,HomeComponent,PaymentComponent};


Route::get('/local',HomeComponent::class)->name('client.home');
Route::get('/fazer/pedidos',OrderComponent::class)->name('client.orders');
Route::get('/meus/pedidos',MyOrderComponent::class)->name('client.my.orders');



