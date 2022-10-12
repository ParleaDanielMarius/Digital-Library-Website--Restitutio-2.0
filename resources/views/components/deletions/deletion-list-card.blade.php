@props(['deletion'])

<div class="product__inner overflow-hidden p-3 p-md-4d875">
    <div class="woocommerce-LoopProduct-link woocommerce-loop-product__link row position-relative">
        <div class="col woocommerce-loop-product__thumbnail mb-3 mb-md-0" style='max-height: 30%; max-width: 30%; display: table'>
            <a href="{{route('deletions.show', $deletion)}}" class="d-block"><img style='max-height: 50%; max-width: 50%; object-fit: contain' src="@if($deletion->cover_path && file_exists('storage' . '/' . $deletion->cover_path)){{asset('storage/' . $deletion->cover_path)}} @else{{asset('/images/no-item-image.png')}}@endif" class="img-fluid d-block mx-auto attachment-shop_catalog size-shop_catalog wp-post-image img-fluid" alt="image-description"></a>
        </div>
        <div class="col-md woocommerce-loop-product__body product__body pt-3 bg-white mb-3 mb-md-0">
            <h2 class="woocommerce-loop-product__title product__title h6 text-lh-md mb-1 crop-text-2 h-dark"><a href="{{route('deletions.show', $deletion)}}" tabindex="0">{{$deletion->title}}</a></h2>
            <p class="font-size-2 mb-2 crop-text-2">{{$deletion->description}}</p>
        </div>
        <div class="woocommerce-loop-product__body product__body pt-3 bg-white">
            <div class="font-size-2  mb-1 text-truncate"><i class="text-gray-500">D: {{$deletion->deleted_at}}</i></div>
            <div class="font-size-2  mb-1 text-truncate"><i class="text-gray-500">R: {{$deletion->restored_at ?? 'Not restored'}}</i></div>
        </div>
    </div>
</div>
