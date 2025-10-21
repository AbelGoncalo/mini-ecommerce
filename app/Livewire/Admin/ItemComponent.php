<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;
use App\Models\{Product, Category};
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;

class ItemComponent extends Component
{
    use LivewireAlert, WithFileUploads, WithPagination;
    public $description, $price, $edit, $search, $category_id, $name,  $image, $quantity, $searchCategory;
    protected $rules = [
        'description' => 'required|unique:items,description',
        'name' => 'required|unique:items,name',
        'price' => 'required',
        'category_id' => 'required',
        'quantity' => 'required|min:1'
    ];
    protected $messages = [
        'description.required' => 'Obrigatório',
        'description.unique' => 'Já Existe',
        'price.required' => 'Obrigatório',
        'category_id.required' => 'Obrigatório',
        'quantity.required' => 'Obrigatório',
        'quantity.min' => 'Deve ser maior que zero'
    ];
    protected $listeners = ['close' => 'close', 'delete' => 'delete', 'changeStatus' => 'changeStatus'];

    public function mount()
    {
        $this->price = 0;
    }
    public function render()
    {
        return view('livewire.admin.item-component', [
            'items' => $this->searchItem($this->search, $this->searchCategory),
            'categories' => $this->getCategories(),
        ])->layout('layouts.admin.app');
    }

    public function getCategories()
    {
        try {
            return Category::get();
        } catch (\Throwable $th) {
          

            $this->alert('error', 'ERRO', [
                'toast' => false,
                'position' => 'center',
                'showConfirmButton' => true,
                'confirmButtonText' => 'OK',
                'text' => 'Falha ao realizar operação'
            ]);
        }
    }

    //Salvar Producto
    public function save()
    {

        // $this->validate($this->rules,$this->messages);

        try {
            //Verificar se o price é nulo

            if ($this->price <= 0) {
                $this->alert('warning', 'AVISO', [
                    'toast' => false,
                    'position' => 'center',
                    'showConfirmButton' => true,
                    'confirmButtonText' => 'OK',
                    'text' => 'Preço não pode ser nulo!!!.'
                ]);

                return;
            }

            $imageString = '';

            if ($this->image) {
                $imageString = md5($this->image->getClientOriginalName()) . '.' .
                    $this->image->getClientOriginalExtension();
                $this->image->storeAs('/public/item', $imageString);
            }

            //Obtendo a descrição da categoria selecionada
            $newItem =  Product::create([
                'name' => $this->name,
                'description' => $this->description,
                'price' => $this->price,
                'quantity' => $this->quantity,
                'image' => $imageString,
                'category_id' => $this->category_id,
            ]);


            $this->alert('success', 'SUCESSO', [
                'toast' => false,
                'position' => 'center',
                'showConfirmButton' => true,
                'confirmButtonText' => 'OK',
                'text' => 'Operação Realizada Com Sucesso.'
            ]);

            $this->clear();
        } catch (\Throwable $th) {

           

            $this->alert('error', 'ERRO', [
                'toast' => false,
                'position' => 'center',
                'showConfirmButton' => true,
                'confirmButtonText' => 'OK',
                'text' => 'Falha ao realizar operação'
            ]);
        }
    }

    //Editar Item
    public function editItem($id)
    {

        try {
            $item = Product::find($id);
            $this->edit = $item->id;
            $this->name = $item->name;
            $this->image = $item->image;
            $this->description = $item->description;
            $this->price = $item->price;
            $this->category_id = $item->category_id;
            $this->quantity = $item->quantity;
        } catch (\Throwable $th) {
           
            $this->alert('error', 'ERRO', [
                'toast' => false,
                'position' => 'center',
                'showConfirmButton' => true,
                'confirmButtonText' => 'OK',
                'text' => 'Falha ao realizar operação'
            ]);
        }
    }

    //Update Item
    public function update()
    {

        $this->validate([
            'description' => 'required|unique:products,description,' . $this->edit,
            'price' => 'required',
            'category_id' => 'required'
        ], $this->messages);

        try {

            if ($this->quantity <= 0) {
                $this->alert('warning', 'AVISO', [
                    'toast' => false,
                    'position' => 'center',
                    'showConfirmButton' => true,
                    'confirmButtonText' => 'OK',
                    'text' => 'Quantidade tem de ser maior que zero !!!.'
                ]);
                return;
            }

            if ($this->image and !is_string($this->image)) {
                $imageString = md5($this->image->getClientOriginalName()) . '.' .
                    $this->image->getClientOriginalExtension();
                $this->image->storeAs('public/', $imageString);

                Product::find($this->edit)->update([
                    'description' => $this->description,
                    'price' => $this->price,
                    'name' => $this->name,
                    'quantity' => $this->quantity,
                    'image' => $imageString,
                    'category_id' => $this->category_id,
                ]);
            } else {
                Product::find($this->edit)->update([
                    'description' => $this->description,
                    'price' => $this->price,
                    'name' => $this->name,
                    'quantity' => $this->quantity,
                    'category_id' => $this->category_id,

                ]);
            }

            $this->dispatch('close');
            $this->alert('success', 'SUCESSO', [
                'toast' => false,
                'position' => 'center',
                'showConfirmButton' => true,
                'confirmButtonText' => 'OK',
                'text' => 'Operação Realizada Com Sucesso.'
            ]);

            $this->clear();
        } catch (\Throwable $th) {
           
            $this->alert('error', 'ERRO', [
                'toast' => false,
                'position' => 'center',
                'showConfirmButton' => true,
                'confirmButtonText' => 'OK',
                'text' => 'Falha ao realizar operação'
            ]);
        }
    }

    
    public function confirm($id)
    {


        try {
            $this->edit = $id;

            $this->alert('warning', 'Confirmar', [
                'icon' => 'warning',
                'position' => 'center',
                'toast' => false,
                'text' => "Deseja realmente excluir? Não pode reverter a ação",
                'showConfirmButton' => true,
                'showCancelButton' => true,
                'cancelButtonText' => 'Cancelar',
                'confirmButtonText' => 'Excluir',
                'confirmButtonColor' => '#3085d6',
                'cancelButtonColor' => '#d33',
                'onConfirmed' => 'delete'
            ]);
        } catch (\Throwable $th) {
        

            $this->alert('error', 'ERRO', [
                'toast' => false,
                'position' => 'center',
                'showConfirmButton' => true,
                'confirmButtonText' => 'OK',
                'text' => 'Falha ao realizar operação'
            ]);
        }
    }

    
    public function delete()
    {

        try {

            Product::destroy($this->edit);
            $this->alert('success', 'SUCESSO', [
                'toast' => false,
                'position' => 'center',
                'showConfirmButton' => true,
                'confirmButtonText' => 'OK',
                'text' => 'Operação Realizada Com Sucesso.'
            ]);

            $this->clear();
        } catch (\Throwable $th) {
    

            $this->alert('error', 'ERRO', [
                'toast' => false,
                'position' => 'center',
                'showConfirmButton' => true,
                'confirmButtonText' => 'OK',
                'text' => 'Falha ao realizar operação'
            ]);
        }
    }

   
    public function searchItem($search, $category)
    {
        try {

            if ($search != null) {

                return Product::where('name', 'like', '%' . $search . '%')->latest()
                    ->get();
            } elseif ($category != null) {

                return Product::where('category_id', '=', $category)->latest()
                    ->get();
            } else {

                return Product::get();
            }
        } catch (\Throwable $th) {

            $this->alert('error', 'ERRO', [
                'toast' => false,
                'position' => 'center',
                'showConfirmButton' => true,
                'confirmButtonText' => 'OK',
                'text' => 'Falha ao realizar operação'
            ]);
        }
    }

    //Limpar campos
    public function clear()
    {
        $this->description  = '';
        $this->price  = 0;
        $this->quantity  = 0;
        $this->edit  = '';
        $this->search  = '';
        $this->image  = '';
        $this->category_id = '';
        $this->name = '';
    }

    //confirmar mudança de estado da conta  de  Usuarios
    public function confirmChangeStatus($id)
    {
        try {
            $this->edit = $id;

            $this->alert('warning', 'Confirmar', [
                'icon' => 'warning',
                'position' => 'center',
                'toast' => false,
                'text' => "Deseja realmente alterar o estado deste item?",
                'showConfirmButton' => true,
                'showCancelButton' => true,
                'cancelButtonText' => 'Cancelar',
                'confirmButtonText' => 'Mudar',
                'confirmButtonColor' => '#3085d6',
                'cancelButtonColor' => '#d33',
                'onConfirmed' => 'changeStatus'
            ]);
        } catch (\Throwable $th) {
            $this->alert('error', 'ERRO', [
                'toast' => false,
                'position' => 'center',
                'showConfirmButton' => true,
                'confirmButtonText' => 'OK',
                'text' => 'Falha ao realizar operação'
            ]);
        }
    }

    //mudar status do item
    public function changeStatus()
    {
        try {

            $item  = Product::find($this->edit);

            ($item->status == 'DISPONIVEL') ? $item->status = 'INDISPONIVEL' : $item->status = 'DISPONIVEL';
            $item->save();

            $this->alert('success', 'SUCESSO', [
                'toast' => false,
                'position' => 'center',
                'showConfirmButton' => true,
                'confirmButtonText' => 'OK',
                'text' => 'Operação Realizada Com Sucesso.'
            ]);
            $this->clear();
        } catch (\Throwable $th) {
            $this->alert('error', 'ERRO', [
                'toast' => false,
                'position' => 'center',
                'showConfirmButton' => true,
                'confirmButtonText' => 'OK',
                'text' => 'Falha ao realizar operação'
            ]);
        }
    }

    public function exportPdf()
    {
        try {

            $total = 0;
            $data = $this->searchItem($this->search, '');

            if ($data->count() > 0) {
                foreach ($data as  $value) {
                    $total += $value->price;
                }

                $pdfContent = new Dompdf();
                $pdfContent = Pdf::loadView('livewire.report.items', [
                    'data' => $data,

                ])->setPaper('a4', 'portrait')->output();
                return response()->streamDownload(
                    fn() => print($pdfContent),
                    "Relatório-de-Produtos.pdf"
                );
            }
        } catch (\Throwable $th) {

          
            $this->alert('warning', 'AVISO', [
                'toast' => false,
                'position' => 'center',
                'showConfirmButton' => true,
                'confirmButtonText' => 'OK',
                'text' => 'Sem dados para exportar'
            ]);
        }
    }
}
