@extends('layouts.layout')

@section('content')

    <div class="page-header border-bottom">
        <div class="container">
            <div class="d-md-flex justify-content-between align-items-center py-4">
                <h1 class="page-title font-size-3 font-weight-medium m-0 text-lh-lg">{{$item->title}}</h1>
                <nav class="woocommerce-breadcrumb font-size-2">
                    <a href="../home/index.html" class="h-primary">Home</a>
                    <span class="breadcrumb-separator mx-1"><i class="fas fa-angle-right"></i></span>
                    <a href="../shop/v4.html" class="h-primary">Shop</a>
                    <span class="breadcrumb-separator mx-1"><i class="fas fa-angle-right"></i></span>Shop Single
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
                                                <span>
                                                    @foreach($item->subjects as $subject)
                                                        <span class="bg-dark text-white rounded py-1 px-3 mr-2 text-xs">{{$subject->title}}</span>
                                                    @endforeach
                                                </span>
                                            </div>
                                            @foreach($item->authors as $author)
                                                <a href="#" class="link-black-100 mx-3 font-weight-medium">{{$author->fullname}}</a>
                                            @endforeach
                                            <div class="woocommerce-product-details__short-description font-size-2 mb-4">
                                                <h2 class="h6 text-lh-md mb-1 text-height-2 crop-text-2 text-gray-600">{{$item->description}}</h2>
                                            </div>

                                            <div class="mb-4">
                                                <label class="form-label font-size-3 font-weight-medium mb-3">Item Format:</label>
                                                <span class="font-size-2 font-weight-medium mb-3">{{$item->type}}</span>

                                            </div>

                                            <div class="mb-4">
                                                <label class="form-label font-size-3 font-weight-medium mb-3">Part Of:</label>
                                                @forelse($item->collections as $collection)
                                                    <span class="font-size-2 font-weight-medium mb-3"><a href="#" class="link-black-100">{{$collection->title}}</a></span>
                                                @empty
                                                    <span class="font-size-2 font-weight-medium mb-3">No Collection</span>
                                                @endforelse
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
                            <div class="woocommerce-tabs wc-tabs-wrapper mb-10 row">
                                <!-- Nav Classic -->
                                <ul class="col-lg-4 col-xl-3 pt-9 border-top d-lg-block tabs wc-tabs nav justify-content-lg-center flex-nowrap flex-lg-wrap overflow-auto overflow-lg-visble" id="pills-tab" role="tablist">
                                    <li class="flex-shrink-0 flex-lg-shrink-1 nav-item mb-3">
                                        <a class="py-1 d-inline-block nav-link font-weight-medium active" id="pills-one-example1-tab" data-toggle="pill" href="#pills-one-example1" role="tab" aria-controls="pills-one-example1" aria-selected="true">
                                            Description
                                        </a>
                                    </li>
                                    <li class="flex-shrink-0 flex-lg-shrink-1 nav-item mb-3">
                                        <a class="py-1 d-inline-block nav-link font-weight-medium" id="pills-two-example1-tab" data-toggle="pill" href="#pills-two-example1" role="tab" aria-controls="pills-two-example1" aria-selected="false">
                                            Item Details
                                        </a>
                                    </li>
                                    <li class="flex-shrink-0 flex-lg-shrink-1 nav-item mb-3">
                                        <a class="py-1 d-inline-block nav-link font-weight-medium" id="pills-three-example1-tab" data-toggle="pill" href="#pills-three-example1" role="tab" aria-controls="pills-three-example1" aria-selected="false">
                                            PDF
                                        </a>
                                    </li>
                                </ul>
                                <!-- End Nav Classic -->

                                <!-- Tab Content -->
                                <div class="tab-content col-lg-8 col-xl-9 border-top" id="pills-tabContent">
                                    <div class="woocommerce-Tabs-panel panel entry-content wc-tab tab-pane fade border-left pl-4 pt-4 pl-lg-6 pt-lg-6 pl-xl-9 pt-xl-9 show active" id="pills-one-example1" role="tabpanel" aria-labelledby="pills-one-example1-tab">
                                        <p class="mb-0">{{$item->description}}</p>
                                    </div>
                                    <div class="woocommerce-Tabs-panel panel entry-content wc-tab tab-pane fade border-left pl-4 pt-4 pl-lg-6 pt-lg-6 pl-xl-9 pt-xl-9" id="pills-two-example1" role="tabpanel" aria-labelledby="pills-two-example1-tab">
                                        <!-- Mockup Block -->
                                        <div class="table-responsive mb-4">
                                            <table class="table table-hover table-borderless">
                                                <tbody>
                                                <tr>
                                                    <th class="px-4 px-xl-5">Publication date: </th>
                                                    <td>{{$item->publisher_when ?? 'Unknown'}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="px-4 px-xl-5">Publisher:</th>
                                                    <td>{{$item->publisher ?? 'Unknown'}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="px-4 px-xl-5">Imprint:</th>
                                                    <td>Corsair</td>
                                                </tr>
                                                <tr>
                                                    <th class="px-4 px-xl-5">Publication City/Country:</th>
                                                    <td>{{$item->publisher_where ?? 'Unknown'}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="px-4 px-xl-5">Language:</th>
                                                    <td>{{$item->language ?? 'Unknown'}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="px-4 px-xl-5">Provider: </th>
                                                    <td>{{$item->provider ?? 'Unknown'}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="px-4 px-xl-5">Rights:</th>
                                                    <td><a href="{{$item->rights ?? ''}}">{{$item->rights ?? 'Unknown'}}</a></td>
                                                </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- End Mockup Block -->
                                    </div>
                                    <div class="woocommerce-Tabs-panel panel entry-content wc-tab tab-pane fade border-left pl-4 pt-4 pl-lg-6 pt-lg-6 pl-xl-9 pt-xl-9" id="pills-three-example1" role="tabpanel" aria-labelledby="pills-three-example1-tab">
                                        <!-- Mockup Block -->
                                        @if($item->pdf_path && file_exists('storage' . '/' . $item->pdf_path))

                                            <iframe id="pdf-js-viewer" src="/assets/PDF.js/web/viewer.html?file=/storage/{{$item->pdf_path}}" title="PDF Viewer"  width="700" height="800"></iframe>

                                            <div class="text-xl font-bold mb-4"><a href="/storage/{{$item->pdf_path}}" target="_blank" class="hover:text-red">Click here to open PDF in a separate window</a></div>

                                            <div class="border border-gray-200 w-full mb-6"></div>
                                        @else <h3 class="text-xl font-bold">No PDF Attached</h3>
                                    @endif
                                        <!-- End Mockup Block -->
                                    </div>

                                </div>
                                <!-- End Tab Content -->
                            </div>
                            <!-- End Features Section -->

                        </div>
                    </main>
                </div>
                <div id="secondary" class="sidebar widget-area order-1" role="complementary">
                    <div id="widgetAccordion">
                        <div class="widget p-4d875 border mb-5">
                            <div class="mb-5">
                                <div class="media d-md-flex">
                                    <a class="d-block" href="#">
                                        <img class="img-fluid" src="https://placehold.it/60x92" alt="Image-Description">
                                    </a>
                                    <div class="media-body ml-3 pl-1">
                                        <h6 class="font-size-2 text-lh-md font-weight-normal">
                                            <a href="#">Lessons Learned from  15 Years as CEO...</a>
                                        </h6>
                                        <span class="font-weight-medium">$37</span>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-5">
                                <div class="media d-md-flex">
                                    <a class="d-block" href="#">
                                        <img class="img-fluid" src="https://placehold.it/60x92" alt="Image-Description">
                                    </a>
                                    <div class="media-body ml-3 pl-1">
                                        <h6 class="font-size-2 text-lh-md font-weight-normal">
                                            <a href="#">Love, Livestock, and Big Life Lessons...</a>
                                        </h6>
                                        <span class="font-weight-medium">$21</span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="media d-md-flex">
                                    <a class="d-block" href="#">
                                        <img class="img-fluid" src="https://placehold.it/60x92" alt="Image-Description">
                                    </a>
                                    <div class="media-body ml-3 pl-1">
                                        <h6 class="font-size-2 text-lh-md font-weight-normal">
                                            <a href="#">Sleeper Cells, Ghost Stories, and Hunt...</a>
                                        </h6>
                                        <span class="font-weight-medium">$182</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="widget border mb-5">

                        </div>
                    </div>
                </div>
            </div>
            <section class="space-bottom-3">
                <div class="container">
                    <header class="mb-5 d-md-flex justify-content-between align-items-center">
                        <h2 class="font-size-7 mb-3 mb-md-0">Customers Also Considered</h2>
                    </header>

                    <div class="js-slick-carousel products no-gutters border-top border-left border-right"
                         data-arrows-classes="u-slick__arrow u-slick__arrow-centered--y"
                         data-arrow-left-classes="fas fa-chevron-left u-slick__arrow-inner u-slick__arrow-inner--left ml-lg-n10"
                         data-arrow-right-classes="fas fa-chevron-right u-slick__arrow-inner u-slick__arrow-inner--right mr-lg-n10"
                         data-slides-show="5"
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
                        <div class="product">
                            <div class="product__inner overflow-hidden p-3 p-md-4d875">
                                <div class="woocommerce-LoopProduct-link woocommerce-loop-product__link d-block position-relative">
                                    <div class="woocommerce-loop-product__thumbnail">
                                        <a href="../shop/single-product-v7.html" class="d-block"><img src="https://placehold.it/120x180" class="img-fluid d-block mx-auto attachment-shop_catalog size-shop_catalog wp-post-image img-fluid" alt="image-description"></a>
                                    </div>
                                    <div class="woocommerce-loop-product__body product__body pt-3 bg-white">
                                        <div class="text-uppercase font-size-1 mb-1 text-truncate"><a href="../shop/single-product-v7.html">Paperback</a></div>
                                        <h2 class="woocommerce-loop-product__title product__title h6 text-lh-md mb-1 text-height-2 crop-text-2 h-dark"><a href="../shop/single-product-v7.html">Think Like a Monk: Train Your Mind for Peace and Purpose Everyday</a></h2>
                                        <div class="font-size-2  mb-1 text-truncate"><a href="../others/authors-single.html" class="text-gray-700">Jay Shetty</a></div>
                                        <div class="price d-flex align-items-center font-weight-medium font-size-3">
                                            <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$</span>29</span>
                                        </div>
                                    </div>
                                    <div class="product__hover d-flex align-items-center">
                                        <a href="../shop/single-product-v7.html" class="text-uppercase text-dark h-dark font-weight-medium mr-auto">
                                            <span class="product__add-to-cart">ADD TO CART</span>
                                            <span class="product__add-to-cart-icon font-size-4"><i class="flaticon-icon-126515"></i></span>
                                        </a>
                                        <a href="../shop/single-product-v7.html" class="mr-1 h-p-bg btn btn-outline-primary border-0">
                                            <i class="flaticon-switch"></i>
                                        </a>
                                        <a href="../shop/single-product-v7.html" class="h-p-bg btn btn-outline-primary border-0">
                                            <i class="flaticon-heart"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="product">
                            <div class="product__inner overflow-hidden p-3 p-md-4d875">
                                <div class="woocommerce-LoopProduct-link woocommerce-loop-product__link d-block position-relative">
                                    <div class="woocommerce-loop-product__thumbnail">
                                        <a href="../shop/single-product-v7.html" class="d-block"><img src="https://placehold.it/120x180" class="img-fluid d-block mx-auto attachment-shop_catalog size-shop_catalog wp-post-image img-fluid" alt="image-description"></a>
                                    </div>
                                    <div class="woocommerce-loop-product__body product__body pt-3 bg-white">
                                        <div class="text-uppercase font-size-1 mb-1 text-truncate"><a href="../shop/single-product-v7.html">Kindle Edition</a></div>
                                        <h2 class="woocommerce-loop-product__title product__title h6 text-lh-md mb-1 text-height-2 crop-text-2 h-dark"><a href="../shop/single-product-v7.html">The Overdue Life of Amy Byler</a></h2>
                                        <div class="font-size-2  mb-1 text-truncate"><a href="../others/authors-single.html" class="text-gray-700">Kelly Harms</a></div>
                                        <div class="price d-flex align-items-center font-weight-medium font-size-3">
                                            <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$</span>29</span>
                                        </div>
                                    </div>
                                    <div class="product__hover d-flex align-items-center">
                                        <a href="../shop/single-product-v7.html" class="text-uppercase text-dark h-dark font-weight-medium mr-auto">
                                            <span class="product__add-to-cart">ADD TO CART</span>
                                            <span class="product__add-to-cart-icon font-size-4"><i class="flaticon-icon-126515"></i></span>
                                        </a>
                                        <a href="../shop/single-product-v7.html" class="mr-1 h-p-bg btn btn-outline-primary border-0">
                                            <i class="flaticon-switch"></i>
                                        </a>
                                        <a href="../shop/single-product-v7.html" class="h-p-bg btn btn-outline-primary border-0">
                                            <i class="flaticon-heart"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="product">
                            <div class="product__inner overflow-hidden p-3 p-md-4d875">
                                <div class="woocommerce-LoopProduct-link woocommerce-loop-product__link d-block position-relative">
                                    <div class="woocommerce-loop-product__thumbnail">
                                        <a href="../shop/single-product-v7.html" class="d-block"><img src="https://placehold.it/120x180" class="img-fluid d-block mx-auto attachment-shop_catalog size-shop_catalog wp-post-image img-fluid" alt="image-description"></a>
                                    </div>
                                    <div class="woocommerce-loop-product__body product__body pt-3 bg-white">
                                        <div class="text-uppercase font-size-1 mb-1 text-truncate"><a href="../shop/single-product-v7.html">Paperback</a></div>
                                        <h2 class="woocommerce-loop-product__title product__title h6 text-lh-md mb-1 text-height-2 crop-text-2 h-dark"><a href="../shop/single-product-v7.html">All You Can Ever Know: A Memoir</a></h2>
                                        <div class="font-size-2  mb-1 text-truncate"><a href="../others/authors-single.html" class="text-gray-700">Jay Shetty</a></div>
                                        <div class="price d-flex align-items-center font-weight-medium font-size-3">
                                            <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$</span>29</span>
                                        </div>
                                    </div>
                                    <div class="product__hover d-flex align-items-center">
                                        <a href="../shop/single-product-v7.html" class="text-uppercase text-dark h-dark font-weight-medium mr-auto">
                                            <span class="product__add-to-cart">ADD TO CART</span>
                                            <span class="product__add-to-cart-icon font-size-4"><i class="flaticon-icon-126515"></i></span>
                                        </a>
                                        <a href="../shop/single-product-v7.html" class="mr-1 h-p-bg btn btn-outline-primary border-0">
                                            <i class="flaticon-switch"></i>
                                        </a>
                                        <a href="../shop/single-product-v7.html" class="h-p-bg btn btn-outline-primary border-0">
                                            <i class="flaticon-heart"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="product">
                            <div class="product__inner overflow-hidden p-3 p-md-4d875">
                                <div class="woocommerce-LoopProduct-link woocommerce-loop-product__link d-block position-relative">
                                    <div class="woocommerce-loop-product__thumbnail">
                                        <a href="../shop/single-product-v7.html" class="d-block"><img src="https://placehold.it/120x180" class="img-fluid d-block mx-auto attachment-shop_catalog size-shop_catalog wp-post-image img-fluid" alt="image-description"></a>
                                    </div>
                                    <div class="woocommerce-loop-product__body product__body pt-3 bg-white">
                                        <div class="text-uppercase font-size-1 mb-1 text-truncate"><a href="../shop/single-product-v7.html">Kindle Edition</a></div>
                                        <h2 class="woocommerce-loop-product__title product__title h6 text-lh-md mb-1 text-height-2 crop-text-2 h-dark"><a href="../shop/single-product-v7.html">The Last Sister (Columbia River Book 1)</a></h2>
                                        <div class="font-size-2  mb-1 text-truncate"><a href="../others/authors-single.html" class="text-gray-700">Kelly Harms</a></div>
                                        <div class="price d-flex align-items-center font-weight-medium font-size-3">
                                            <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$</span>29</span>
                                        </div>
                                    </div>
                                    <div class="product__hover d-flex align-items-center">
                                        <a href="../shop/single-product-v7.html" class="text-uppercase text-dark h-dark font-weight-medium mr-auto">
                                            <span class="product__add-to-cart">ADD TO CART</span>
                                            <span class="product__add-to-cart-icon font-size-4"><i class="flaticon-icon-126515"></i></span>
                                        </a>
                                        <a href="../shop/single-product-v7.html" class="mr-1 h-p-bg btn btn-outline-primary border-0">
                                            <i class="flaticon-switch"></i>
                                        </a>
                                        <a href="../shop/single-product-v7.html" class="h-p-bg btn btn-outline-primary border-0">
                                            <i class="flaticon-heart"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="product">
                            <div class="product__inner overflow-hidden p-3 p-md-4d875">
                                <div class="woocommerce-LoopProduct-link woocommerce-loop-product__link d-block position-relative">
                                    <div class="woocommerce-loop-product__thumbnail">
                                        <a href="../shop/single-product-v7.html" class="d-block"><img src="https://placehold.it/120x180" class="img-fluid d-block mx-auto attachment-shop_catalog size-shop_catalog wp-post-image img-fluid" alt="image-description"></a>
                                    </div>
                                    <div class="woocommerce-loop-product__body product__body pt-3 bg-white">
                                        <div class="text-uppercase font-size-1 mb-1 text-truncate"><a href="../shop/single-product-v7.html">Paperback</a></div>
                                        <h2 class="woocommerce-loop-product__title product__title h6 text-lh-md mb-1 text-height-2 crop-text-2 h-dark"><a href="../shop/single-product-v7.html">Think Like a Monk: Train Your Mind for Peace and Purpose Everyday</a></h2>
                                        <div class="font-size-2  mb-1 text-truncate"><a href="../others/authors-single.html" class="text-gray-700">Jay Shetty</a></div>
                                        <div class="price d-flex align-items-center font-weight-medium font-size-3">
                                            <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$</span>29</span>
                                        </div>
                                    </div>
                                    <div class="product__hover d-flex align-items-center">
                                        <a href="../shop/single-product-v7.html" class="text-uppercase text-dark h-dark font-weight-medium mr-auto">
                                            <span class="product__add-to-cart">ADD TO CART</span>
                                            <span class="product__add-to-cart-icon font-size-4"><i class="flaticon-icon-126515"></i></span>
                                        </a>
                                        <a href="../shop/single-product-v7.html" class="mr-1 h-p-bg btn btn-outline-primary border-0">
                                            <i class="flaticon-switch"></i>
                                        </a>
                                        <a href="../shop/single-product-v7.html" class="h-p-bg btn btn-outline-primary border-0">
                                            <i class="flaticon-heart"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="product">
                            <div class="product__inner overflow-hidden p-3 p-md-4d875">
                                <div class="woocommerce-LoopProduct-link woocommerce-loop-product__link d-block position-relative">
                                    <div class="woocommerce-loop-product__thumbnail">
                                        <a href="../shop/single-product-v7.html" class="d-block"><img src="https://placehold.it/120x180" class="img-fluid d-block mx-auto attachment-shop_catalog size-shop_catalog wp-post-image img-fluid" alt="image-description"></a>
                                    </div>
                                    <div class="woocommerce-loop-product__body product__body pt-3 bg-white">
                                        <div class="text-uppercase font-size-1 mb-1 text-truncate"><a href="../shop/single-product-v7.html">Kindle Edition</a></div>
                                        <h2 class="woocommerce-loop-product__title product__title h6 text-lh-md mb-1 text-height-2 crop-text-2 h-dark"><a href="../shop/single-product-v7.html">The Overdue Life of Amy Byler</a></h2>
                                        <div class="font-size-2  mb-1 text-truncate"><a href="../others/authors-single.html" class="text-gray-700">Kelly Harms</a></div>
                                        <div class="price d-flex align-items-center font-weight-medium font-size-3">
                                            <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$</span>29</span>
                                        </div>
                                    </div>
                                    <div class="product__hover d-flex align-items-center">
                                        <a href="../shop/single-product-v7.html" class="text-uppercase text-dark h-dark font-weight-medium mr-auto">
                                            <span class="product__add-to-cart">ADD TO CART</span>
                                            <span class="product__add-to-cart-icon font-size-4"><i class="flaticon-icon-126515"></i></span>
                                        </a>
                                        <a href="../shop/single-product-v7.html" class="mr-1 h-p-bg btn btn-outline-primary border-0">
                                            <i class="flaticon-switch"></i>
                                        </a>
                                        <a href="../shop/single-product-v7.html" class="h-p-bg btn btn-outline-primary border-0">
                                            <i class="flaticon-heart"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="product">
                            <div class="product__inner overflow-hidden p-3 p-md-4d875">
                                <div class="woocommerce-LoopProduct-link woocommerce-loop-product__link d-block position-relative">
                                    <div class="woocommerce-loop-product__thumbnail">
                                        <a href="../shop/single-product-v7.html" class="d-block"><img src="https://placehold.it/120x180" class="img-fluid d-block mx-auto attachment-shop_catalog size-shop_catalog wp-post-image img-fluid" alt="image-description"></a>
                                    </div>
                                    <div class="woocommerce-loop-product__body product__body pt-3 bg-white">
                                        <div class="text-uppercase font-size-1 mb-1 text-truncate"><a href="../shop/single-product-v7.html">Paperback</a></div>
                                        <h2 class="woocommerce-loop-product__title product__title h6 text-lh-md mb-1 text-height-2 crop-text-2 h-dark"><a href="../shop/single-product-v7.html">All You Can Ever Know: A Memoir</a></h2>
                                        <div class="font-size-2  mb-1 text-truncate"><a href="../others/authors-single.html" class="text-gray-700">Jay Shetty</a></div>
                                        <div class="price d-flex align-items-center font-weight-medium font-size-3">
                                            <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$</span>29</span>
                                        </div>
                                    </div>
                                    <div class="product__hover d-flex align-items-center">
                                        <a href="../shop/single-product-v7.html" class="text-uppercase text-dark h-dark font-weight-medium mr-auto">
                                            <span class="product__add-to-cart">ADD TO CART</span>
                                            <span class="product__add-to-cart-icon font-size-4"><i class="flaticon-icon-126515"></i></span>
                                        </a>
                                        <a href="../shop/single-product-v7.html" class="mr-1 h-p-bg btn btn-outline-primary border-0">
                                            <i class="flaticon-switch"></i>
                                        </a>
                                        <a href="../shop/single-product-v7.html" class="h-p-bg btn btn-outline-primary border-0">
                                            <i class="flaticon-heart"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="product">
                            <div class="product__inner overflow-hidden p-3 p-md-4d875">
                                <div class="woocommerce-LoopProduct-link woocommerce-loop-product__link d-block position-relative">
                                    <div class="woocommerce-loop-product__thumbnail">
                                        <a href="../shop/single-product-v7.html" class="d-block"><img src="https://placehold.it/120x180" class="img-fluid d-block mx-auto attachment-shop_catalog size-shop_catalog wp-post-image img-fluid" alt="image-description"></a>
                                    </div>
                                    <div class="woocommerce-loop-product__body product__body pt-3 bg-white">
                                        <div class="text-uppercase font-size-1 mb-1 text-truncate"><a href="../shop/single-product-v7.html">Kindle Edition</a></div>
                                        <h2 class="woocommerce-loop-product__title product__title h6 text-lh-md mb-1 text-height-2 crop-text-2 h-dark"><a href="../shop/single-product-v7.html">The Last Sister (Columbia River Book 1)</a></h2>
                                        <div class="font-size-2  mb-1 text-truncate"><a href="../others/authors-single.html" class="text-gray-700">Kelly Harms</a></div>
                                        <div class="price d-flex align-items-center font-weight-medium font-size-3">
                                            <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$</span>29</span>
                                        </div>
                                    </div>
                                    <div class="product__hover d-flex align-items-center">
                                        <a href="../shop/single-product-v7.html" class="text-uppercase text-dark h-dark font-weight-medium mr-auto">
                                            <span class="product__add-to-cart">ADD TO CART</span>
                                            <span class="product__add-to-cart-icon font-size-4"><i class="flaticon-icon-126515"></i></span>
                                        </a>
                                        <a href="../shop/single-product-v7.html" class="mr-1 h-p-bg btn btn-outline-primary border-0">
                                            <i class="flaticon-switch"></i>
                                        </a>
                                        <a href="../shop/single-product-v7.html" class="h-p-bg btn btn-outline-primary border-0">
                                            <i class="flaticon-heart"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

@endsection
