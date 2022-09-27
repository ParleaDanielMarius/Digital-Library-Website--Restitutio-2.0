@props(['deletion'])
<div class="product__inner overflow-hidden p-3 p-md-4d875">
    <div class="woocommerce-LoopProduct-link woocommerce-loop-product__link d-block position-relative">
        <div class="woocommerce-loop-product__thumbnail">
            <a href="{{route('deletions.show', $deletion)}}" class="d-block"><img src="@if($deletion->cover_path && file_exists('storage' . '/' . $deletion->cover_path)){{asset('storage/' . $deletion->cover_path)}} @else{{asset('assets/img/items/no-item-image.png')}}@endif" class="img-fluid d-block mx-auto attachment-shop_catalog size-shop_catalog wp-post-image img-fluid" alt="image-description"></a>
        </div>
        <div class="woocommerce-loop-product__body product__body pt-3 bg-white">
            <h2 class="woocommerce-loop-product__title product__title h6 text-lh-md mb-1 text-height-2 crop-text-2 h-dark"><a href="{{route('deletions.show', $deletion)}}">{{$deletion->title}}</a></h2>
            <div class="font-size-2  mb-1 text-truncate"><i class="text-gray-500">D: {{$deletion->deleted_at}}</i></div>
            <div class="font-size-2  mb-1 text-truncate"><i class="text-gray-500">R: {{$deletion->restored_at ?? 'Not restored'}}</i></div>
        </div>
        <div class="product__hover d-flex align-items-center">
            <!-- Can put something here to appear when user hovers on the item card  -->
        </div>
    </div>
</div>
