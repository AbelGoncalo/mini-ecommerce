<div>

    <div class="p-3 col-md-12 col-sm-12 mt-5 mb-5 d-flex justify-content-center align-items-start flex-wrap">

        <div class="col-md-12 ">
            <div class="card shadow rounded mt-2">
                <div class="card-header d-flex justify-content-between flex-wrap align-items-center"
                    style="background-color: #222831 !important; color:#fff !important;">
                    <h4 style="font-size:14px; font-weight:600; color:#fff" class=" text-uppercase">Items do Carrinho :
                        {{ count(\Cart::getContent()) }}</h4>
                    <a href="{{ route('site.itens') }}" class="btn btn-sm  text-uppercase"
                        style="background-color: #ffbe33; color:#fff">Vêr produtos</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-sm text-center">
                            <thead>
                                <tr>
                                    <th style="font-size:14px; font-weight:600">Imagem</th>
                                    <th style="font-size:14px; font-weight:600">Descrição</th>
                                    <th style="font-size:14px; font-weight:600">Preço Unitário</th>
                                    <th style="font-size:14px; font-weight:600">Qtd.</th>
                                    <th style="font-size:14px; font-weight:600">Total</th>
                                    <th style="font-size:14px; font-weight:600">...</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($cartContent) > 0)
                                @foreach ($cartContent as $item)
                                <tr>
                                    <td>
                                        <img src="{{ (isset($item->attributes['image']) and $item->attributes['image'] != null) ? asset('/storage/' . $item->attributes['image']) : asset('not-found.png') }}"
                                            class="img-fluid rounded" alt="produto no carrinho"
                                            style="width: 3rem;height:3rem; object-fit:cover">
                                    </td>
                                    <td style="font-size:14px; font-weight:600">{{ $item->name }}</td>
                                    <td style="font-size:14px; font-weight:600">
                                        {{ number_format($item->price, 2, ',', '.') }} Kz</td>
                                    <td style="font-size:14px; font-weight:600">
                                        <input style="width: 100px;" type="number" wire:model='qtd.{{ $item->id }}'
                                            value="{{ $item->quantity }}" name="qtd" id="qtd"
                                            class="form-control form-control-sm">
                                    </td>
                                    <td style="font-size:14px; font-weight:600">
                                        {{ number_format($item->price * $item->quantity, 2, ',', '.') }} Kz</td>
                                    <td style="font-size:14px; font-weight:600">
                                        <button wire:click="increase({{ $item->id }})" class="btn btn-sm btn-success">
                                            <i class="fa fa-check"></i>
                                        </button>
                                        <button wire:click="isTrue({{ $item->id }})" class="btn btn-sm btn-danger">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="6">Nenhum Item Adicionado</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-12  mx-2">
            <div class="card shadow rounded mt-2" style="height:auto;">
                <div class="card-header " style="background: #222831;color:#fff;">
                    <h4 style="font-size:14px; font-weight:600; color:#fff" class=" text-uppercase">Total do Carrinho
                    </h4>

                </div>
                <div class="card-body">
                    <h4 style="font-size:25px; font-weight:600;">Total: {{ number_format(Abs($total), 2, ',', '.') }}
                        Kz</h4>
                    <hr>
                    <p class="text-muted" style="font-size:10px">
                        <i class="fa fa-info-circle"></i> Para Encomendas online apenas há disponibilidade de pagamento
                        por transferência. Feito antes de receber a encomenda
                    </p>
                    <hr>
                </div>
                <div class="card-footer card-cart">
                    @if (auth()->user())
                    <div class="card-footer card-cart">

                        <button {{ count($cartContent)> 0 ? '' : 'disabled' }} type="button"
                            wire:click='finallyOrderAuth'
                            class="btn btn-md " style="background: #ffbe33; color:#fff ">
                            finalizar o pedido
                        </button>

                    </div>
                    @else
                    <div class="card-footer card-cart">
                        <button {{ count($cartContent)> 0 ? '' : 'disabled' }} style="background: #ffbe33;color:#fff;"
                            class="w-100 btn btn-md btn-outline" data-bs-toggle="modal"
                            data-bs-target="#finnaly">Finalizar o pedido</button>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @include('livewire.site.modals.finally-order')
</div>


<script>
    document.addEventListener('refresh', () => {
        window.location.reload();
    });
</script>
