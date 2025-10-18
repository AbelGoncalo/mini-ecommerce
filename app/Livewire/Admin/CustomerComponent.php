<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;
use App\Models\{User};

class CustomerComponent extends Component
{
    use LivewireAlert, WithFileUploads;
    protected $listeners = ['delete' => 'delete'];


    public $name, $phone,$email,$country,$edit,$search;

    protected $rules = [
        'name'=>'required',
        'phone'=>'required',
        'country'=>'required',
        'email'=>'required|unique:users,email',
        'password'=>'required',
    ];

    public function render()
    {

        return view('livewire.admin.customer-component',[
            'customers'=>$this->getCustomer()
        ])->layout('layouts.admin.app');
    }


     public function getCustomer()
    {
        try {

            return User::where('profile', '=','client')->get();

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
