@extends('layouts.layout-index')

@section('content')

    <div class="page-header border-bottom">
        <div class="container">
            <div class="d-md-flex justify-content-between align-items-center py-4">
                <h1 class="page-title font-size-3 font-weight-medium m-0 text-lh-lg">{{$item->title}}</h1>
                <nav class="woocommerce-breadcrumb font-size-2">
                    <a href="{{route('home')}}" class="h-primary">Home</a>
                    <span class="breadcrumb-separator mx-1"><i class="fas fa-angle-right"></i></span>
                    <a href="{{route('items.index')}}" class="h-primary">Items</a>
                    <span class="breadcrumb-separator mx-1"><i class="fas fa-angle-right"></i></span>{{$item->title}}
                </nav>
            </div>
        </div>
    </div>
    <div class="site-content" id="content">
        <div class="container">
            <div class="row  space-top-2">
                <div id="primary" class="content-area">
                    <main id="main" class="site-main ">
                        <div class="product">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-5 woocommerce-product-gallery woocommerce-product-gallery--with-images images">
                                        <figure class="woocommerce-product-gallery__wrapper mb-0">
                                            <div class="u-slick">
                                                <div class="js-slide">
                                                    <img src="@if($item->cover_path && file_exists('storage' . '/' . $item->cover_path)){{asset('storage/' . $item->cover_path)}} @else{{asset('/images/no-item-image.png')}}@endif" alt="Image Description" class="mx-auto img-fluid">
                                                </div>

                                            </div>
                                        </figure>
                                    </div>
                                    <div class="col-lg-7 pl-lg-0 summary entry-summary">
                                        <div class="px-lg-4 px-xl-6">
                                            <h1 class="product_title entry-title font-size-7 mb-3 crop-text-2">{{$item->title_long ?? $item->title}}</h1>
                                            <div class="font-size-2 mb-4">

                                            </div>
                                            <div class="woocommerce-product-details__short-description font-size-2 mb-4">
                                                <h2 class="h6 text-lh-md mb-1 text-height-2 crop-text-2 text-gray-600">{{$item->description}}</h2>
                                            </div>

                                            <div class="mb-4">
                                                <label class="form-label font-size-3 font-weight-medium mb-3">Item Format:</label>
                                                <span class="font-size-3 font-weight-medium mb-3">{{$item->type}}</span>

                                            </div>

                                            <div class="mb-4">

                                            </div>

                                        </div>
                                        <div class="px-lg-4 px-xl-7 py-5 d-flex align-items-center">
                                            <ul class="list-unstyled nav">
                                                <li class="mr-6 mb-4 mb-md-0">
                                                    <a href="#" class="h-primary"><i class="flaticon-heart mr-2"></i> Add to Wishlist</a>
                                                </li>
                                                <li class="mr-6">
                                                    <a href="#" class="h-primary"><i class="flaticon-share mr-2"></i> Share</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Features Section -->
                            @include('partials.items._show-features')
                            <!-- End Features Section -->

                        </div>
                    </main>
                </div>
                <div id="secondary" class="sidebar widget-area order-1" role="complementary">
                    <div id="widgetAccordion">
                        <div class="widget p-4d875 border mb-5">
                            <label class="form-label font-size-3 font-weight-medium mb-3">Author(s):</label>
                            <table class="table table-hover table-borderless">
                                <tbody>
                                @forelse($item->authors as $author)
                                    <tr>
                                        <th class="px-4 px-xl-5">Author: </th>
                                        <td><a href="{{route('authors.show', $author)}}" class="link-black-100">{{$author->fullname}}</a></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <th class="px-4 px-xl-5">Author: </th>
                                        <td><a href="#" class="link-black-100">No Author</a></td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>


                        <div id="tertiary" class="sidebar widget-area order-1" role="complementary">
                            <div id="widgetAccordion3">
                                <div class="widget p-4d875 border mb-5">
                                    <label class="form-label font-size-3 font-weight-medium mb-3">Subject(s):</label>
                                    <table class="table table-hover table-borderless">
                                        <tbody>
                                        @forelse($item->subjects as $subject)
                                            <tr>
                                                <th class="px-4 px-xl-5">Subject: </th>
                                                <td>{{$subject->title}}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <th class="px-4 px-xl-5">Subject: </th>
                                                <td>No Subjects</td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="widget p-4d875 border mb-5">
                            <label class="form-label font-size-3 font-weight-medium mb-3">Collection(s):</label>
                            <table class="table table-hover table-borderless">
                                <tbody>
                                @forelse($item->collections as $collection)
                                    <tr>
                                        <th class="px-4 px-xl-5">Part of: </th>
                                        <td><a href="{{route('collections.show', $collection)}}" class="link-black-100">{{$collection->title}}</a></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <th class="px-4 px-xl-5">Part of: </th>
                                        <td><a href="#" class="link-black-100">No Collection</a></td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <section class="space-bottom-3">
                <div class="container">
                    <header class="mb-5 d-md-flex justify-content-between align-items-center">
                        <h2 class="font-size-7 mb-3 mb-md-0">Similar Items</h2>
                    </header>

                    <div class="js-slick-carousel products no-gutters border-top border-left border-right"
                         data-arrows-classes="u-slick__arrow u-slick__arrow-centered--y"
                         data-arrow-left-classes="fas fa-chevron-left u-slick__arrow-inner u-slick__arrow-inner--left ml-lg-n10"
                         data-arrow-right-classes="fas fa-chevron-right u-slick__arrow-inner u-slick__arrow-inner--right mr-lg-n10"
                         data-slides-show="10"
                         data-responsive='[{
                               "breakpoint": 1500,
                               "settings": {
                                 "slidesToShow": 4
                               }
                            },{
                               "breakpoint": 1199,
                               "settings": {
                                 "slidesToShow": 3
                               }
                            }, {
                               "breakpoint": 992,
                               "settings": {
                                 "slidesToShow": 2
                               }
                            }, {
                               "breakpoint": 554,
                               "settings": {
                                 "slidesToShow": 2
                               }
                            }]'>
                        @forelse($similarItems as $item)
                            <x-items.similar-card :item="$item"></x-items.similar-card>
                        @empty
                        @endforelse
                    </div>
                </div>
            </section>
        </div>
    </div>

@endsection
