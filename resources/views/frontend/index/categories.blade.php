<!-- CATEGORIES SECTION-->
<section class="pt-5">
    <header class="text-center">
        <p class="small text-muted small text-uppercase mb-1">Carefully created collections</p>
        <h2 class="h5 text-uppercase mb-4">Browse our categories</h2>
    </header>
    <div class="row">
        <div class="col-md-4 mb-4 mb-md-0">
            <a class="category-item" href="{!! route('shop',$product_categories[0]->slug) !!}">
                <img class="img-fluid"
                     src="{!! asset('adminBoard/uploaded_images/product_categories/'.$product_categories[0]->image) !!}"
                     alt="">
                <strong class="category-item-title">{!! $product_categories[0]->name !!}</strong>
            </a>
        </div>

        <div class="col-md-4 mb-4 mb-md-0">
            <a class="category-item mb-4" href="{!! route('shop',$product_categories[1]->slug) !!}">
                <img class="img-fluid"
                     src="{!! asset('adminBoard/uploaded_images/product_categories/'.$product_categories[1]->image) !!}"
                     alt="">
                <strong class="category-item-title">{!! $product_categories[1]->name !!}</strong>
            </a>

            <a class="category-item" href="{!! route('shop',$product_categories[2]->slug) !!}">
                <img class="img-fluid"
                     src="{!! asset('adminBoard/uploaded_images/product_categories/'.$product_categories[2]->image) !!}"
                     alt="">
                <strong class="category-item-title">{!! $product_categories[2]->name !!}</strong>
            </a>
        </div>


        <div class="col-md-4">
            <a class="category-item" href="{!! route('shop',$product_categories[3]->slug) !!}">
                <img class="img-fluid"
                     src="{!! asset('adminBoard/uploaded_images/product_categories/'.$product_categories[3]->image) !!}"
                     alt="">
                <strong class="category-item-title">{!! $product_categories[3]->name !!}</strong>
            </a>
        </div>
    </div>
</section>
