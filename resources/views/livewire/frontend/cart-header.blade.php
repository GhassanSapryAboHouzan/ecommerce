<div class="d-flex">
    <li class="nav-item"><a class="nav-link" href="{!! route('cart') !!}">
            <i class="fas fa-dolly-flatbed mr-1 text-gray"></i>
            <small class="text-gray">( {!! $cartProductsCount !!} )</small>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{!! route('wishList') !!}">
            <i class="far fa-heart mr-1"></i>
            <small class="text-gray">( {!! $wishListProductsCount !!} )</small>
        </a>
    </li>
</div>
