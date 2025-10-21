<div class="container-fluid ">
    <div class="container  pt-2">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s" style="margin-top: 5rem !important">
            <h1 class="mb-5" style="margin-top: 3rem;"> Lista de Produtos</h1>
        </div>
        <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.1s">
            <div class="container">
                <div class="row col-md-12 d-flex justify-content-center align-items-center flex-wrap">
                    <div class="form-group col-md-6 mb-5" wire:ignore>
                        <select name="category" wire:model.live='category' id="selectcategory" class="form-select">
                            @if ($categories->count() > 0)
                                <option value="">--Selecionar Categoria--</option>
                                @foreach ($categories as $item)
                                    <option value="{{ $item->id }}">{{ $item->description }}</option>
                                @endforeach
                            @else
                                <option value="">A consulta não retornou nenhum resultado</option>
                            @endif
                        </select>
                    </div>
                </div>
            </div>

            <!-- Team Start -->
            <div class="container ">

                <div class="row ">
                    @if ($items->count() > 0)
                        @foreach ($items as $item)
                            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                                <div class="team-item text-center rounded overflow-hidden card">
                                    <div class=" overflow-hidden m-4 ">
                                        @if ($item->image != null)
                                            <img class="img-fluid" src="{{ asset('/storage/item/' . $item->image) }}"
                                                alt="{{ $item->name ?? '' }}">
                                        @else
                                            <img class="img-fluid" src="{{ asset('/no-image.png') }}"
                                                alt="{{ $item->name ?? '' }}">
                                        @endif
                                    </div>
                                    <h5 class="mb-0">{{ $item->name ?? '' }}</h5>
                                    <small class="fst-italic text-center">
                                        <button class="btn btn-sm " style="background-color: var(--primary);"
                                            wire:click='addToCart({{ $item->id }})'><i
                                                class="text-light fa fa-cart-plus"></i></button>
                                        <button class="btn btn-sm " style="background-color: var(--primary);"
                                            wire:click='viewItem({{ $item->id }})' data-bs-toggle="modal"
                                            data-bs-target="#review-item-site"><i
                                                class="text-light fa fa-eye"></i></button>
                                    </small>
                                </div>
                            </div>
                        @endforeach

                    @endif
                </div>
            </div>
        </div>
        <!-- Team End -->
    </div>
    {{-- Teste aqui --}}
    @include('livewire.site.modals.review-menu')
</div>
<script>
    document.addEventListener('close', function() {
        $("#review-item-site").modal('hide');
    })
</script>

@push('select2')
    <script>
        $(document).ready(function() {
            $('#selectcategory').select2({
                theme: "bootstrap",
                width: '100%'
            });

            $('#selectcategory').change(function(e) {
                e.preventDefault();
                @this.set('category', $('#selectcategory').val());
            });
        });
    </script>
@endpush
