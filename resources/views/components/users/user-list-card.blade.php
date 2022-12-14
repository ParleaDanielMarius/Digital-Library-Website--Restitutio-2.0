@props(['user'])

<div class="product__inner overflow-hidden p-3 p-md-4d875">
    <div class="woocommerce-LoopProduct-link woocommerce-loop-product__link row position-relative">
        <div class="col-md woocommerce-loop-product__body product__body pt-3 bg-white mb-3 mb-md-0">
            <div class="text-uppercase font-size-1 mb-1 text-truncate">
                @switch($user->status)
                    @case(0) {{__('inactive')}}
                    @break
                    @case(1) {{__('active')}}
                    @break
                    @default {{$user->status}}
                @endswitch
            </div>
            <h2 class="woocommerce-loop-product__title product__title h6 text-lh-md mb-1 crop-text-2 h-dark"><a href="{{route('users.show', $user)}}" tabindex="0">{{$user->username}}</a></h2>
                <div class="font-size-2  mb-2 text-truncate"><a href="{{route('users.show', $user)}}" class="text-gray-700">{{$user->first_name}}</a></div>
                <div class="font-size-2  mb-2 text-truncate"><a href="{{route('users.show', $user)}}" class="text-gray-700">{{$user->last_name}}</a></div>
                <div class="font-size-2  mb-2 text-truncate"><a href="{{route('users.show', $user)}}" class="text-gray-700">{{$user->email}}</a></div>
        </div>
        <div class="col-md-auto d-flex align-items-center">

        </div>
    </div>
</div>
