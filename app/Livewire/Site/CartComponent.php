<?php

namespace App\Livewire\Site;

use Livewire\Component;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use App\Models\{Product, Order, OrderItem, User};
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\Storage;

use Livewire\WithFileUploads;

class CartComponent extends Component
{
    use LivewireAlert, WithFileUploads;

    protected $listeners = ['remove' => 'remove', 'refresh' => 'refresh', 'getTotalItems' => 'getTotalItems'];

    public $edit, $qtd = [], $total, $location = [], $name, $lastname, $receipt,
        $province, $municipality, $street, $phone, $otherPhone, $paymenttype = 'Transferência',
        $otherAddress;



    //Validação de finalização de encomenda
    public $rules = [
        'name' => 'required',
        'lastname' => 'required',
        'province' => 'required',
        'municipality' => 'required',
        'street' => 'required',
        'phone' => 'required',
        'otherPhone' => 'required',
        'paymenttype' => 'required',
        'receipt' => 'required|mimes:pdf'
    ];
    public $messages = [
        'name.required' => 'Obrigatório',
        'lastname.required' => 'Obrigatório',
        'province.required' => 'Obrigatório',
        'municipality.required' => 'Obrigatório',
        'street.required' => 'Obrigatório',
        'phone.required' => 'Obrigatório',
        'otherPhone.required' => 'Obrigatório',
        'paymenttype.required' => 'Obrigatório'
    ];

    public function render()
    {


        return view('livewire.site.cart-component', [
            'cartContent' => Cart::getContent(),
        ])->layout('layouts.site.app');
    }

    public function mount()
    {

        try {

            foreach (Cart::getContent() as $key => $item) {
                $this->qtd[$key] = $item->quantity;
                $this->total += Abs($item->price * $item->quantity);
            }

            if (Cart::isEmpty()) {

                $this->alert('warning', 'Carrinho vazio', [
                    'text' => 'Adicione produtos ao carrinho antes de prosseguir.',
                    'position' => 'center',
                    'toast' => false,
                ]);

                return redirect()->back();
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

    //Metodo para remover item do carrinho
    public function isTrue($id)
    {
        try {
            $this->edit = $id;
            $this->alert('warning', 'Confirmar', [
                'icon' => 'warning',
                'position' => 'center',
                'toast' => false,
                'text' => "Deseja realmente remover este item? Não pode reverter a ação",
                'showConfirmButton' => true,
                'showCancelButton' => true,
                'cancelButtonText' => 'Cancelar',
                'confirmButtonText' => 'Remover',
                'confirmButtonColor' => '#3085d6',
                'cancelButtonColor' => '#d33',
                'onConfirmed' => 'remove'
            ]);
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

    //Metodo para remover item do carrinho
    public function remove()
    {
        try {

            Cart::remove($this->edit);
            $this->total = 0;

            $this->alert('success', 'SUCESSO', [
                'toast' => false,
                'position' => 'center',
                'timer' => '1000',
                'timerProgressBar' => true,
                'text' => 'Sua encomenda foi realizada com sucesso'
            ]);

            foreach (Cart::getContent() as $key => $item) {
                $this->total += Abs($item->price * $item->quantity);
            }


            if (count(\Cart::getContent()) == 0) {


                Cart::clear();

                return redirect()->route('site.home');
            }

            $this->dispatch('getTotalItems');
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

    //Acrescentar quantidade
    public function increase($id)
    {

        try {

            $item = Product::find($id);
            $this->total = 0;

            if ($this->qtd[$id] > $item->quantity) {

                $this->alert('warning', 'AVISO', [
                    'toast' => false,
                    'position' => 'center',
                    'timer' => '1000',
                    'timerProgressBar' => true,
                    'text' => 'Quantidade Superior a disponível'
                ]);
            } else {
                # code...
                Cart::remove($id);

                Cart::add(array(
                    'id' => $item->id,
                    'name' => $item->description,
                    'price' => $item->price,
                    'quantity' => $this->qtd[$id],
                    'attributes' => array(
                        'image' => $item->image,

                    )
                ));

                foreach (Cart::getContent() as $key => $item) {
                    $this->total += Abs($item->price * $item->quantity);
                }

                $this->alert('success', 'SUCESSO', [
                    'toast' => false,
                    'position' => 'center',
                    'timer' => '1000',
                    'timerProgressBar' => true,
                    'text' => 'Item ' . $item->description . ', adicionado'
                ]);
                $this->dispatch('getTotalItems');
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

    public function finallyOrder()
    {
        // Validação
        $this->validate($this->rules, $this->messages);

        // Se o carrinho estiver vazio
        if (Cart::isEmpty()) {
            $this->alert('warning', 'Carrinho vazio', [
                'text' => 'Adicione produtos antes de finalizar a encomenda.',
                'position' => 'center',
                'toast' => false,
            ]);
            return;
        }

        DB::beginTransaction();
        try {
            // Upload do comprovativo (se existir)




            $receiptString = null;

            if ($this->receipt && $this->receipt->isValid()) {
                if (!Storage::disk('public')->exists('receipts')) {
                    Storage::disk('public')->makeDirectory('receipts');
                }
                $receiptString = md5($this->receipt->getClientOriginalName()) . '.' .
                    $this->receipt->getClientOriginalExtension();

                // Garante que o diretório existe
                $path = storage_path('app/public/receipts');
                if (!file_exists($path)) {
                    mkdir($path, 0755, true);
                }

                $this->receipt->storeAs('receipts', $receiptString, 'public');
            }

            // Código único para a encomenda
            $code = 'DLS' . rand(1000, 9999);

            // Criação do pedido
            $order = Order::create([
                'user_id' => auth()->check() ? auth()->id() : null,
                'total' => (Cart::getTotal() - session('cupondiscount', 0)) + session('locationvalue', 0),
                'locationprice' => session('locationvalue', 0),
                'customername' => $this->name,
                'customerlastname' => $this->lastname,
                'customerprovince' => $this->province,
                'customermunicipality' => $this->municipality,
                'customerstreet' => $this->street,
                'customerphone' => $this->phone,
                'customerotherphone' => $this->otherPhone,
                'customerpaymenttype' => $this->paymenttype,
                'receipt' => $receiptString,
                'customerotheraddress' => $this->otherAddress,
                'finddetail' => $code,
            ]);

            // Gravar cada item do carrinho
            foreach (Cart::getContent() as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->id,
                    'item' => $item->name,
                    'price' => $item->price,
                    'quantity' => $item->quantity,
                    'subtotal' => $item->price * $item->quantity,
                ]);
            }

            DB::commit();

            // Limpar carrinho e campos
            $this->clearFields();
            Cart::clear();

            // Guardar o código da encomenda na sessão
            session()->put('finddetail', $code);

            // Notificação de sucesso
            $this->alert('success', 'Encomenda realizada!', [
                'text' => 'A sua encomenda foi realizada com sucesso!',
                'toast' => false,
                'position' => 'center',
                'timer' => 2000,
            ]);

            return redirect()->to('/minhas/encomendas');
        } catch (\Throwable $th) {
            DB::rollBack();

            dd($th->getMessage());

            $this->alert('error', 'Erro', [
                'text' => 'Ocorreu um erro ao processar a sua encomenda. Tente novamente.',
                'toast' => false,
                'position' => 'center',
                'showConfirmButton' => true,
            ]);
        }
    }



    public function clearFields()
    {
        try {
            $this->name = '';
            $this->lastname = '';
            $this->province = '';
            $this->municipality = '';
            $this->street = '';
            $this->phone = '';
            $this->otherPhone = '';
            $this->paymenttype = '';
            $this->otherAddress = '';
            Cart::clear();
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
