<div>
    <table class="table">
        <thead class="bg-light">
        <tr>
            <th class="border-0" scope="col">
                <strong class="text-small text-uppercase">Product</strong>
            </th>
            <th class="border-0" scope="col">
                <strong class="text-small text-uppercase">Price</strong>
            </th>
            <th class="border-0" scope="col">
                <strong class="text-small text-uppercase">Move To Cart</strong>
            </th>
            <th class="border-0" scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @forelse($wishlistItems as $wishlistItem)
            <tr x-data="{ show: true }" x-show="show">
                <th class="pl-0 border-0" scope="row">
                    <div class="media align-items-center">
                        <a class="reset-anchor d-block animsition-link"
                           href="{!! route('product',$wishlistItem->model->slug) !!}">
                            <img
                                src="{!! asset('adminBoard/uploaded_images/products/'.$wishlistItem->model->firstMedia->file_name) !!}"
                                alt="{!! $wishlistItem->model->name  !!}" width="70"/>
                        </a>
                        <div class="media-body ml-3">
                            <strong class="h6">
                                <a class="reset-anchor animsition-link"
                                   href="{!! route('product',$wishlistItem->model->slug) !!}">
                                    {!! $wishlistItem->model->name  !!}
                                </a>
                            </strong>
                        </div>
                    </div>
                </th>

                <td class="align-middle border-0">
                    <p class="mb-0 small">$ {!! $wishlistItem->model->price  !!}</p>
                </td>


                <td class="align-middle border-0">
                    <a wire:click.prevent="$emit('moveToCart','{!! $wishlistItem->rowId !!}')"
                       x-on:click="show = false"
                       class="reset-anchor">
                        Move To Cart
                    </a>
                </td>

                <td class="align-middle border-0">
                    <a wire:click.prevent="$emit('removeItemFromWishList','{!! $wishlistItem->rowId !!}')"
                       x-on:click="show = false"
                       class="reset-anchor">
                        <i class="fas fa-trash-alt small text-muted"></i>
                    </a>
                </td>

            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center text-danger pt-5">Wish List Empty</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
