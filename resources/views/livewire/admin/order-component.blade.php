@section('title', 'Encomendas')
<div>
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">PAINEL DE ADMINISTRADOR</h2>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Pedidos</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="row">

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center flex-wrap">


                    <div class="col-md-10 d-flex">
                        <div class="input-group mb-2 mt-2 col-md-4">
                            <input type="date" wire:model.live='startdate' class="form-control form-control-sm"
                                placeholder="Pesquisar por Código">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-search"></i></span>
                            </div>
                        </div>
                        <div class="input-group mb-2 mt-2 col-md-4">
                            <input type="date" wire:model.live='enddate' class="form-control form-control-sm"
                                placeholder="Código">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-search"></i></span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-body">

                    <div class="table-responsive-xl">
                        <table id="example" class="text-center table table-sm table-striped table-hover"
                            style="width:100vw">
                            <thead>
                                <tr>
                                <tr>
                                    <th>Cliente</th>
                                    <th>Telefones</th>
                                    <th>Email</th>
                                    <th>Total</th>
                                    <th>Recibo</th>
                                    <th>Estado</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($orders) and $orders->count() > 0)
                                    @foreach ($orders as $item)
                                        <tr>
                                            <td>{{ $item->customername }} {{ $item->customerlastname }}</td>
                                            <td>
                                                {{ $item->customerphone }} <br>
                                            </td>
                                            <td>
                                                {{ $item->customeremail }} <br>
                                            </td>

                                            <td>
                                                {{ number_format($item->total, 2, ',', '.') }}Kz
                                            </td>


                                            <td>
                                                <i wire:click='download({{ $item->id }})' style="cursor: pointer"
                                                    title="Baixar Comprovativo" class="fa fa-file-pdf fa-3x  text-dark"></i>
                                            </td>

                                            <td>
                                                <select wire:change='changeStatus({{ $item->id }})'
                                                    wire:model='statusvalue.{{ $item->id }}' name="statusvalue"
                                                    id="statusvalue" class="form-control">
                                                    <option value="" selected>{{ $item->status }}</option>
                                                    <option value="Entregue">Entregue</option>
                                                    <option value="Pago">Pago</option>
                                                    <option value="Pendente">Pendente</option>
                                                </select>
                                            </td>

                                            <td>
                                                <button wire:click='viewItems({{ $item->id }},{{ $item->id }})'
                                                    data-toggle="modal" title="Detalhes do pedido" data-target="#detail"
                                                    class="btn btn-primary btn-sm  mt-1"><i
                                                        class="fa fa-list "></i></button>

                                            </td>

                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="10">
                                            <div class="col-md-12 d-flex justify-content-center align-items-center flex-column"
                                                style="height: 25vh">
                                                <i class="fa fa-5x fa-caret-down text-muted"></i>
                                                <p class="text-muted">Nenhuma Pedido Encontrado</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endif

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @include('livewire.admin.modals.details-modal')
    {{-- @include('livewire.client.modals.details-modal') --}}

</div>

<script>
    document.addEventListener('close', function() {
        $("#cupon").modal('hide');
    })
</script>
