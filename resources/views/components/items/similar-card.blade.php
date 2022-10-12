@props(['item'])
@php
    use App\Models\Item
@endphp

<div class="product">
    <div class="product__inner overflow-hidden p-3 p-md-4d875" style="max-height: 350px ; max-width: 350px ; min-height: 350px ; min-width: 250px">
        <div class="woocommerce-LoopProduct-link woocommerce-loop-product__link d-block position-relative">
            <div class="woocommerce-loop-product__thumbnail">
                <a href="{{route('items.show', $item->slug)}}" class="d-block"><img style="height: 200px ; max-width: 250px" src="@if($item->cover_path && file_exists('storage' . '/' . $item->cover_path)){{asset('storage/' . $item->cover_path)}} @else{{asset('assets/img/items/no-item-image.png')}}@endif" class="img-fluid d-block mx-auto attachment-shop_catalog size-shop_catalog wp-post-image img-fluid" alt="image-description"></a>
            </div>
            <div class="woocommerce-loop-product__body product__body pt-3 bg-white">
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
                <h2 class="woocommerce-loop-product__title product__title h6 text-lh-md mb-1 text-height-2 crop-text-2 h-dark"><a href="{{route('items.show', $item->slug)}}">{{$item->title}}</a></h2>
                @forelse($item->authors->take(3) as $author)
                    <div class="font-size-2  mb-1 text-truncate"><a href="{{route('authors.show', $author->slug)}}" class="text-gray-700">{{$author->fullname}}</a></div>
                @empty
                    <div class="font-size-2  mb-1 text-truncate"><a href="" class="text-gray-700">Unknown</a></div>
                @endforelse
            </div>
            <div class="product__hover d-flex align-items-center">

            </div>
        </div>
    </div>
</div>
