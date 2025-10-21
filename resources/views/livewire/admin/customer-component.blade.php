@section('title','Clientes')

<div>
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">PAINEL DE ADMINISTRADOR</h2>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Clientes</a></li>
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
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="search" wire:model.live='search' name="search" id="search" class="form-control rounded" placeholder="Pesquisar Utilizador">
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table id="example" class="text-center table table-sm table-striped table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Telefone</th>
                                    <th>Email</th>
                                    <th>Conta</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>
                            <tbody>


                                @if (isset($customers) and $customers->count() > 0)
                                    @foreach ($customers as $customer)
                                    <tr>

                                        <td>{{$customer->name}}</td>
                                        <td>{{$customer->phone}}</td>
                                        <td>{{$customer->email}}</td>
                                        @if ($customer->status == '1')
                                        <td><span class="badge badge-success" style="cursor: pointer" wire:click='confirmChangeStatus({{$customer->id}})'>Ativa</span>
                                        </td>
                                        @else
                                        <td>
                                            <span class="badge badge-danger" style="cursor: pointer" wire:click='confirmChangeStatus({{$customer->id}})'>Inativa</span>
                                        </td>



                                        @endif
                                        <td>
                                            <button wire:click='editUser({{$customer->id}})' data-toggle="modal" data-target="#user" class="btn btn-sm btn-primary mt-1"><i class="fa fa-edit"></i></button>
                                            <button wire:click='confirm({{$customer->id}})' class="btn btn-sm btn-danger mt-1"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>

                                    @endforeach
                                @else
                                <tr>
                                    <td colspan="9">
                                        <div class="col-md-12 d-flex justify-content-center align-items-center flex-column" style="height: 25vh">
                                            <i class="fa fa-5x fa-caret-down text-muted"></i>
                                            <p class="text-muted">Nenhum Utilizador Encontrado</p>
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
    {{-- @include('livewire.admin.modals.customer-modal') --}}

</div>
<script>
    document.addEventListener('close',function(){
       $("#user").modal('hide');
    })
</script>




