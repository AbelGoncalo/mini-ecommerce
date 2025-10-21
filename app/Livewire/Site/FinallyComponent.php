<?php

namespace App\Livewire\Site;

use App\Models\Order;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class FinallyComponent extends Component
{

    use LivewireAlert;
    public $search = '';
    protected $listeners = ['searchOrder' => 'render', 'redirect' => 'redirect'];

    public function mount()
    {
        $this->search = session('finddetail');
    }
    public function render()
    {
        return view('livewire.site.finally-component', [
            'orders' => $this->searchOrder($this->search),
            'status' => $this->getStatus($this->search)
        ])->layout('livewire.site.options.info');
    }

    public function searchOrder($search)
    {
        try {
            if (isset($search) and $search != null) {
                return Order::join('order_items', 'orders.id', 'order_items.order_id')
                    ->select('order_items.item', 'order_items.quantity')
                    ->where('finddetail', '=', $search)
                    ->get();
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

    public function getStatus($search)
    {
        try {
            if (isset($search) and $search != null) {
                $status =  Order::where('finddetail', '=', $this->search)
                    ->first();

                if ($status == 'Entregue') {
                    $this->dispatch('redirect');
                    return $status;
                } else {
                    return $status;
                }
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
}
