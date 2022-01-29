<div wire:ignore>
    <!-- TRENDING PRODUCTS-->
    <section class="py-5">
        <header>
            <p class="small text-muted small text-uppercase mb-1">Made the hard way</p>
            <h2 class="h5 text-uppercase mb-4">Top trending products</h2>
        </header>
        <div class="row">

            @forelse($featuredProducts as $featuredProduct)

                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="product text-center">
                        <div class="position-relative mb-3">
                            <div class="badge text-white badge-"></div>
                            <a class="d-block" href="{!! route('product',$featuredProduct->slug) !!}">
                                <img class="img-fluid w-100"
                                     src="{!! asset('adminBoard/uploaded_images/products/'.$featuredProduct->firstMedia->file_name) !!}"
                                     alt="{!! $featuredProduct->name !!}">
                            </a>
                            <div class="product-overlay">
                                <ul class="mb-0 list-inline">
                                    <li class="list-inline-item m-0 p-0">
                                        <a wire:click.prevent="addToWishList('{!! $featuredProduct->id !!}')"
                                           class="btn btn-sm btn-primary">
                                            <i class="far fa-heart"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item m-0 p-0">
                                        <a wire:click.prevent="addToCart('{!!  $featuredProduct->id !!}')"
                                           class="btn btn-sm btn-secondary">Add to cart</a>
                                    </li>
                                    <li class="list-inline-item mr-0">
                                        <a wire:click.prevent="$emit('showProductModalAction','{!! $featuredProduct->id !!}')"
                                           class="btn btn-sm btn-primary" data-target="#productView"
                                           data-toggle="modal">
                                            <i class="fas fa-expand"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <h6>
                            <a class="reset-anchor" href="{!! route('product',$featuredProduct->slug) !!}">
                                {!! $featuredProduct->name !!}
                            </a>
                        </h6>
                        <p class="small text-muted">$ {!! $featuredProduct->price !!}</p>
                    </div>
                </div>
            @empty
                <h3 class="text-danger text-center font-weight-bolder">No Data</h3>
            @endforelse
        </div>


    </section>

</div>