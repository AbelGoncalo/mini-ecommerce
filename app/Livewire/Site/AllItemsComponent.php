<?php

namespace App\Livewire\Site;

use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

use App\Models\{Product, Category};
use Darryldecode\Cart\Facades\CartFacade as Cart;


class AllItemsComponent extends Component
{
    use LivewireAlert;

    public $category, $item, $name, $stars = 1, $itemid;
    protected $listeners = ['close' => 'close'];


    public function render()
    {

        return view('livewire.site.all-items-component', [
            'items' => $this->getItems($this->category),
            'categories' => $this->getCategories(),
        ])->layout('layouts.site.app');
    }

    //Pegar todos os items {filtrando pela categoria}
    public function getItems()
    {
        try {


            if (isset($this->category) and $this->category != null) {

                return  Product::where('category_id', '=', $this->category)
                    ->where('quantity', '>', 0)
                    ->where('status', '=', 'DISPONIVEL')
                    ->get();
            } else {

           

                return  Product::where('quantity', '>', 0)
                    ->where('status', '=', 'DISPONIVEL')
                    ->get();
            }
        } catch (\Throwable $th) {
            dd($th->getMessage());
            $this->alert('error', 'ERRO', [
                'toast' => false,
                'position' => 'center',
                'showConfirmButton' => true,
                'confirmButtonText' => 'OK',
                'text' => 'Falha ao realizar operação'
            ]);
        }
    }

    //Pegar todos as categorias
    public function getCategories()
    {
        try {
            return  Category::get();
        } catch (\Throwable $th) {
            dd($th->getMessage());
            $this->alert('error', 'ERRO', [
                'toast' => false,
                'position' => 'center',
                'showConfirmButton' => true,
                'confirmButtonText' => 'OK',
                'text' => 'Falha ao realizar operação'
            ]);
        }
    }

    //Adicionar produto no carrinho
    public function addToCart($id)
    {
        try {

            $item = Product::find($id);
            if ($item->status == 'INDISPONIVEL') {
                $this->alert('warning', 'AVISO', [
                    'toast' => false,
                    'position' => 'center',
                    'showConfirmButton' => true,
                    'confirmButtonText' => 'OK',
                    'text' => 'ITEM INDISPONÍVEL'
                ]);
            } else {

                if ($item->quantity == 0) {
                    $this->alert('warning', 'AVISO', [
                        'toast' => false,
                        'position' => 'center',
                        'showConfirmButton' => true,
                        'confirmButtonText' => 'OK',
                        'text' => 'ITEM INDISPONÍVEL'
                    ]);
                } else {

                    Cart::add(array(
                        'id' => $item->id,
                        'name' => $item->description,
                        'price' => $item->price,
                        'quantity' => 1,
                        'attributes' => array(
                            'image' => $item->image,
                        )
                    ));

                    $this->alert('success', 'SUCESSO', [
                        'toast' => false,
                        'position' => 'center',
                        'timer' => '1000',
                        'text' => 'Item ' . $item->description . ', adicionado'
                    ]);
                    $this->dispatch('getTotalItems');
                }
            }
        } catch (\Throwable $th) {

            dd($th->getMessage());
            $this->alert('error', 'ERRO', [
                'toast' => false,
                'position' => 'center',
                'showConfirmButton' => true,
                'confirmButtonText' => 'OK',
                'text' => 'Falha ao realizar operação'
            ]);
        }
    }

    public function viewItem($id)
    {
        try {

            $this->item =  Product::find($id);



            $this->itemid =  Product::find($id)->id;
        } catch (\Throwable $th) {
            dd($th->getMessage());

            $this->alert('error', 'ERRO', [
                'toast' => false,
                'position' => 'center',
                'showConfirmButton' => true,
                'confirmButtonText' => 'OK',
                'text' => 'Falha ao realizar operação'
            ]);
        }
    }
}
