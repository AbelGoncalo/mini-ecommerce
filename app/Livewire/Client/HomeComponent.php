<?php

namespace App\Livewire\Client;

use Livewire\Component;

class HomeComponent extends Component
{
    public function render()
    {
        return view('livewire.client.home-component')->layout('layouts.client.app');;
    }
}
