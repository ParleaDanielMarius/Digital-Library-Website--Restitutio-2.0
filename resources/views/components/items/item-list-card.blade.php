@props(['item'])

<div class="product__inner overflow-hidden p-3 p-md-4d875">
    <div class="woocommerce-LoopProduct-link woocommerce-loop-product__link row position-relative">
        <div class="col woocommerce-loop-product__thumbnail mb-3 mb-md-0">
            <a href="../shop/single-product-v4.html" class="d-block"><img src="@if($item->cover_path && file_exists('storage' . '/' . $item->cover_path)){{asset('storage/' . $item->cover_path)}} @else{{asset('/images/no-item-image.png')}}@endif" class="img-fluid d-block mx-auto attachment-shop_catalog size-shop_catalog wp-post-image img-fluid" alt="image-description"></a>
        </div>
        <div class="col-md woocommerce-loop-product__body product__body pt-3 bg-white mb-3 mb-md-0">
            <div class="text-uppercase font-size-1 mb-1 text-truncate"><a href="../shop/single-product-v4.html">COLLECTION</a></div>
            <h2 class="woocommerce-loop-product__title product__title h6 text-lh-md mb-1 crop-text-2 h-dark"><a href="../shop/single-product-v4.html" tabindex="0">{{$item->title}}</a></h2>
            @forelse($item->authors as $author)
                <div class="font-size-2  mb-2 text-truncate"><a href="../others/authors-single.html" class="text-gray-700">{{$author->fullname}}</a></div>
            @empty
                <div class="font-size-2  mb-2 text-truncate"><a class="text-gray-700">Unknown Author</a></div>
            @endforelse
            <p class="font-size-2 mb-2 crop-text-2">{{$item->description}}</p>
        </div>
        <div class="col-md-auto d-flex align-items-center">
            <a href="../shop/single-product-v4.html" class="text-uppercase text-dark h-dark font-weight-medium mr-4" data-toggle="tooltip" data-placement="right" title="" data-original-title="ADD TO CART">
                <span class="product__add-to-cart">ADD TO CART</span>
                <span class="product__add-to-cart-icon font-size-4"><i class="flaticon-icon-126515"></i></span>
            </a>
            <a href="../shop/single-product-v4.html" class="mr-1 h-p-bg btn btn-outline-primary border-0">
                <i class="flaticon-switch"></i>
            </a>
            <a href="../shop/single-product-v4.html" class="h-p-bg btn btn-outline-primary border-0">
                <i class="flaticon-heart"></i>
            </a>
        </div>
    </div>
</div>
