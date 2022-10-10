@props(['item'])
@php
    use App\Models\Item
@endphp

<div class="product__inner overflow-hidden p-3 p-md-4d875">
    <div class="woocommerce-LoopProduct-link woocommerce-loop-product__link row position-relative">
        <div class="col woocommerce-loop-product__thumbnail mb-3 mb-md-0" style='max-height: 30%; max-width: 30%; display: table'>
            <a href="{{route('items.show', $item)}}" class="d-block"><img style='max-height: 50%; max-width: 50%; object-fit: contain' src="@if($item->cover_path && file_exists('storage' . '/' . $item->cover_path)){{asset('storage/' . $item->cover_path)}} @else{{asset('/images/no-item-image.png')}}@endif" class="img-fluid d-block mx-auto attachment-shop_catalog size-shop_catalog wp-post-image img-fluid" alt="image-description"></a>
        </div>
        <div class="col-md woocommerce-loop-product__body product__body pt-3 bg-white mb-3 mb-md-0">
            <div class="text-uppercase font-size-1 mb-1 text-truncate">
                <a class="text-primary">
                    @switch($item->type)
                        @case(Item::type_Book)
                            {{__('items')['book']}}
                            @break
                        @case(Item::type_OldBook)
                            {{__('items')['old book']}}
                            @break
                        @case(Item::type_Manuscript)
                            {{__('items')['manuscript']}}
                            @break
                        @case(Item::type_Map)
                            {{__('items')['map']}}
                            @break
                        @case(Item::type_Periodic)
                            {{__('items')['periodic']}}
                            @break
                        @default {{__('unknown')}}
                    @endswitch
                </a>
            </div>
            <h2 class="woocommerce-loop-product__title product__title h6 text-lh-md mb-1 crop-text-2 h-dark"><a href="{{route('items.show', $item)}}" tabindex="0">{{$item->title}}</a></h2>
            @forelse($item->authors->take(3) as $author)
                <div class="font-size-2  mb-2 text-truncate"><a href="{{route('authors.show', $author)}}" class="text-gray-700">{{$author->fullname}}</a></div>
            @empty
                <div class="font-size-2  mb-2 text-truncate"><a class="text-gray-700">Unknown</a></div>
            @endforelse
            <p class="font-size-2 mb-2 crop-text-2">{{$item->description}}</p>
        </div>
    </div>
</div>
