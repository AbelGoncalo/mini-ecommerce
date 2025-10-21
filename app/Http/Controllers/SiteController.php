<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    //
    public function index()
    {
        try {

            return view('livewire.site.pages.home');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Falha ao realizar Operação');
        }
    }

    public function about()
    {
        try {

            return view('livewire.site.pages.about');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Falha ao realizar Operação');
        }
    }

    public function getItens()
    {
        try {
            $items = Product::get();
            return view('livewire.site.pages.menu', compact('items'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Falha ao realizar Operação');
        }
    }

    public function getCart()
    {
        try {
            return view('livewire.site.pages.cart');
        } catch (\Throwable $th) {

            dd($th->getMessage());
            return redirect()->back()->with('error', 'Falha ao realizar Operação');
        }
    }
}
