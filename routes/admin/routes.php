<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\{
    HomeComponent,
    CategoryComponent,
    CustomerComponent,
    ItemComponent,
    UserComponent,
    OrderComponent
};
use App\Livewire\Auth\MyAccount;

Route::middleware(['admin'])->group(function () {

    Route::get('/painel/admin', HomeComponent::class)->name('panel.admin.home');
    Route::get('/painel/admin/categorias', CategoryComponent::class)->name('panel.admin.categories');
    Route::get('/painel/admin/items', ItemComponent::class)->name('panel.admin.items');
    // Route::get('/painel/admin/relatorios',ReportComponent::class)->name('panel//.admin.report');
    Route::get('/painel/admin/utilizadores', UserComponent::class)->name('panel.admin.user');
    Route::get('/painel/admin/pedidos', OrderComponent::class)->name('panel.admin.orders');
    Route::get('/painel/admin/clientes', CustomerComponent::class)->name('panel.admin.customers');
    Route::get('/painel/admin/minha-conta', MyAccount::class)->name('panel.admin.account');
});
