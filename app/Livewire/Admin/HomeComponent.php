<?php

namespace App\Livewire\Admin;
use App\Models\{User, Category, Product, Order};
use Jantinnerezo\LivewireAlert\LivewireAlert;


use Livewire\Component;

class HomeComponent extends Component
{
    use LivewireAlert;
    public $monthOrder = [], $monthOrderCount = [], $deliveryMonth = [], $deliveryMonthCount = [];

    public function render()
    {
         return view('livewire.admin.home-component', [
            'categories' => Category::count(),
            'users' => User::where('profile', '<>', 'client')->count(),
            'items' => Product::count(),
            'order' => Order::count(),
            'orderToday' => Order::whereBetween('created_at', [date('Y-m-d ') . '00:00:00', date('Y-m-d ') . '23:59:59'])
                ->count(),
            // "deliveryChart"=>$this->deliveryChart(),
            // "orderChart"=>$this->OrderChart(),
        ])->layout('layouts.admin.app');
    }



    // Metodo para alimentar o grafico
    public function OrderChart()
    {

        $orders = Order::select('id', 'created_at')
            ->get()->groupBy(function ($data) {
                return   \Carbon\Carbon::parse($data->created_at)->format('M');
            });

        foreach ($orders as $month => $values) {
            $this->monthOrder[] = $month;
            $this->monthOrderCount[] = count($values);
        }
    }

}
