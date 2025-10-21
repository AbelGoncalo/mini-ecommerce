<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithFileUploads;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Str;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CategoryComponent extends Component
{
    use LivewireAlert, WithFileUploads;
    public $description, $name, $image, $edit, $search;

    protected $rules = [
        'description' => 'required|unique:categories,description',
        'name' => 'required|unique:categories,description'
    ];

    protected $messages = [
        'description.required' => 'Obrigatório',
        'description.unique' => 'Já Existe',
        'name.required' => 'Obrigatório'
    ];

    protected $listeners = ['close' => 'close', 'delete' => 'delete'];




    public function render()
    {

        if (Category::count()==0) {
            $data = ['Tecnologia', 'Moda', 'Beleza e Saúde', 'Esportes e Lazer', 'Automotivo'];
            foreach ($data as $value) {
                Category::create([
                    'name' => $value,
                    'description' => $value,
                    'user_id' => Auth::user()->id
                ]);
            }
        }
        return view('livewire.admin.category-component', [
            'categories' => $this->searchCategory($this->search),
        ])->layout('layouts.admin.app');
    }

    //Salvar Categoria
    public function save()
    {
        //$this->validate($this->rules, $this->messages);
        try {
            $imageString = '';
            if ($this->image) {
                $imageString = md5($this->image->getClientOriginalName()) . '.' .
                    $this->image->getClientOriginalExtension();
                $this->image->storeAs('public/', $imageString);
            }

            Category::create([
                'name' => $this->name,
                'description' => $this->description,
                'image' => $imageString,
                'user_id' => Auth::user()->id
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

    //Editar categoria
    public function editCategory($id)
    {


        try {

            $category = Category::find($id);
            $this->edit = $category->id;
            $this->description = $category->description;
            $this->name = $category->name;

            $this->image = $category->image;
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

    //Update categoria
    public function update()
    {
        $this->validate([
            'description' => 'required|unique:categories,description,' . $this->edit,
            'name' => 'required|unique:categories,name,' . $this->edit

        ], $this->messages);

        try {

            if ($this->image and !is_string($this->image)) {
                $imageString = md5($this->image->getClientOriginalName()) . '.' .
                    $this->image->getClientOriginalExtension();
                $this->image->storeAs('public/', $imageString);

                Category::find($this->edit)->update([
                    'description' => $this->description,
                    'name' => $this->name,
                    'image' => $imageString,
                ]);
            } else {
                Category::find($this->edit)->update([
                    'description' => $this->description,
                    'name' => $this->name,

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

    //confirmar exclusao de  categoria
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

    //excluir categoria
    public function delete()
    {

        try {

            $category = Category::find($this->edit);
            Category::destroy($this->edit);

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

    //Pesquisar Categoria
    public function searchCategory($search)
    {
        try {

            if ($search != null) {
                return Category::where('description', 'like', '%' . $search . '%')
                    ->get();
            } else {
                return Category::get();
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
        $this->description = '';
        $this->image = '';
        $this->edit = '';
        $this->name = '';
        $this->search = '';
    }


}
