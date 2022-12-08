@props(['user'])
<div class="product__inner overflow-hidden p-3 p-md-4d875">
    <div class="woocommerce-LoopProduct-link woocommerce-loop-product__link d-block position-relative">
        <div class="woocommerce-loop-product__thumbnail">
            <a href="{{route('users.show', $user)}}" class="d-block"><img src="{{asset('assets/img/users/no-user-image.png')}}" class="img-fluid d-block mx-auto attachment-shop_catalog size-shop_catalog wp-post-image img-fluid" alt="image-description"></a>
        </div>
        <div class="woocommerce-loop-product__body product__body pt-3 bg-white">
            <div class="text-uppercase font-size-1 mb-1 text-truncate">
                @switch($user->status)
                    @case(0) {{__('inactive')}}
                    @break
                    @case(1) {{__('active')}}
                    @break
                    @default {{$user->status}}
                @endswitch
            </div>
            <h2 class="woocommerce-loop-product__title product__title h6 text-lh-md mb-1 text-height-2 crop-text-2 h-dark"><a href="{{route('users.show', $user)}}">{{$user->username}}</a></h2>
                <div class="font-size-2  mb-1 text-truncate"><a href="{{route('users.show', $user)}}" class="text-gray-700">{{$user->first_name}}</a></div>
                <div class="font-size-2  mb-1 text-truncate"><a href="{{route('users.show', $user)}}" class="text-gray-700">{{$user->last_name}}</a></div>
                <div class="font-size-2  mb-1 text-truncate"><a href="{{route('users.show', $user)}}" class="text-gray-700">{{$user->email}}</a></div>
        </div>
        <div class="product__hover d-flex align-items-center">
            <!-- Can put something here to appear when user hovers on the item card  -->
        </div>
    </div>
</div>
<?php
