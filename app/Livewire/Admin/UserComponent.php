<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserComponent extends Component
{

    use LivewireAlert, WithFileUploads;
    public $name, $gender, $phone, $email, $profile, $photo, $edit, $search;
    protected $rules = [
        'name' => 'required',
        'gender' => 'required',
        'phone' => 'required',
        'profile' => 'required',
        'email' => 'required|unique:users,email',
    ];
    protected $messages = [
        'name.required' => 'Obrigatório',
        'gender.required' => 'Obrigatório',
        'phone.required' => 'Obrigatório',
        'profile.required' => 'Obrigatório',
        'email.required' => 'Obrigatório',
        'email.unique' => 'Já está a ser usado.',
    ];

    protected $listeners = ['close' => 'close', 'delete' => 'delete', 'changeStatus' => 'changeStatus'];

    public function render()
    {
        return view('livewire.admin.user-component', [
            'users' => $this->searchUsers($this->search)
        ])->layout('layouts.admin.app');
    }

    //Salvar Usuarios
    public function save()
    {
        $this->validate($this->rules, $this->messages);


        try {
            $photoString = '';
            if ($this->photo) {
                $photoString = md5($this->photo->getClientOriginalName()) . '.' .
                    $this->photo->getClientOriginalExtension();
                $this->photo->storeAs('public/user', $photoString);
            }

            User::create([
                'name' => $this->name,
                'gender' => $this->gender,
                'photo' => $photoString,
                'phone' => $this->phone,
                'profile' => $this->profile,
                'email' => $this->email,
                'password' => Hash::make($this->email),
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

    //Editar Usuarios
    public function editUser($id)
    {

        try {

            $user = User::find($id);
            $this->edit = $user->id;
            $this->name = $user->name;
            $this->gender = $user->gender;
            $this->photo = $user->photo;
            $this->phone = $user->phone;
            $this->profile = $user->profile;
            $this->email = $user->email;
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

    //confirmar exclusao de  Usuarios
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

    //confirmar mudança de estado da conta  de  Usuarios
    public function confirmChangeStatus($id)
    {
        try {
            $this->edit = $id;

            $this->alert('warning', 'Confirmar', [
                'icon' => 'warning',
                'position' => 'center',
                'toast' => false,
                'text' => "Deseja realmente alterar o estado desta conta?",
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

    //Update Usuarios
    public function update()
    {
        $this->validate([
            'name' => 'required',
            'gender' => 'required',
            'phone' => 'required',
            'profile' => 'required',
            'email' => 'required|unique:users,email,' . $this->edit,
        ], $this->messages);

        try {


            if ($this->photo and !is_string($this->photo)) {
                $photoString = md5($this->photo->getClientOriginalName()) . '.' .
                    $this->photo->getClientOriginalExtension();
                $this->photo->storeAs('public/', $photoString);

                User::find($this->edit)->update([
                    'name' => $this->name,
                    'gender' => $this->gender,
                    'photo' => $photoString,
                    'phone' => $this->phone,
                    'profile' => $this->profile,
                    'email' => $this->email,
                ]);
            } else {
                User::find($this->edit)->update([
                    'name' => $this->name,
                    'gender' => $this->gender,
                    'phone' => $this->phone,
                    'profile' => $this->profile,
                    'email' => $this->email,
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

    //excluir Usuarios
    public function delete()
    {
        try {

            $user = User::find($this->edit);
            User::destroy($this->edit);

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

    //excluir Usuarios
    public function changeStatus()
    {
        try {

            $user  = User::find($this->edit);

            if ($user->status == 1) {
                $user->status = 0;
                $user->save();
            } else if ($user->status == 0) {
                $user->status = 1;
                $user->save();
            }

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

    //Pesquisar Usuarios
    public function searchUsers($search)
    {
        try {
            if ($search != null) {
                return User::where('name', 'like', '%' . $search . '%')
                    ->where('profile', '=', 'administrador')
                    ->where('id', '<>', Auth::user()->id)
                    ->latest()
                    ->get();
            } else {


                return User::where('profile', '=', 'administrador')
                    ->where('id', '<>', Auth::user()->id)
                    ->latest()->get();
            }
        } catch (\Throwable $th) {
        ;

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
        $this->name = '';

        $this->gender = '';
        $this->phone = '';
        $this->email = '';
        $this->profile = '';
        $this->edit = '';
        $this->search = '';
    }
}
