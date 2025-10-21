<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\{Order, OrderItem};
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Carbon\Carbon;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class OrderComponent extends Component
{
    use LivewireAlert, WithFileUploads, WithPagination;

    public $startdate = null, $enddate = null, $statusvalue = [], $items = [], $invoiceFile, $edit;
    protected $listeners = ['close' => 'close', 'delete' => 'delete'];

    public function render()
    {
         return view('livewire.admin.order-component', [
            'orders' => $this->orderList($this->startdate, $this->enddate),

        ])->layout('layouts.admin.app');
    }

      public function orderList($startdate, $enddate)
    {
        try {

            if ($startdate != null and  $enddate != null) {
                $initialdate = Carbon::parse($startdate)->format('Y-m-d') . ' 00:00:00';
                $enddate   = Carbon::parse($enddate)->format('Y-m-d') . ' 23:59:59';
                return Order::whereBetween('created_at', [$initialdate, $enddate])
                    ->get();
            } else {

                return Order::get();
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

    public function download($id)
    {
        try {
            $oder = Order::find($id);

            $test =   $this->alert('info', '', [
                'toast' => false,
                'position' => 'center',
                'timer' => 1000,
                'timerProgressBar' => true,
                'text' => 'A PROCESSAR DOWNLOAD...'
            ]);

            return response()->download(storage_path() . '/app/public/receipts/' . $oder->receipt);
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

    public function viewItems($id, $invoiceFile = null)
    {
        try {

            $this->items = OrderItem::where('order_id', '=', $id)->get();

            $this->invoiceFile = $invoiceFile;
            $this->edit = $id;
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

    public function changeStatus($id)
    {
        try {

            $order =  Order::find($id);

            $order->status = $this->statusvalue[$id];
            $order->save();

            if ($order) {
                $this->alert('success', 'SUCESSO', [
                    'toast' => false,
                    'position' => 'center',
                    'showConfirmButton' => true,
                    'confirmButtonText' => 'OK',
                    'text' => 'Estado Alterado.'
                ]);

                $this->dispatch('searchOrder');
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
    

}
