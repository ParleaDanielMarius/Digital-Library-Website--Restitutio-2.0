@extends('layouts.layout-index')

@section('content')

    <div class="page-header border-bottom">
        <div class="container">
            <div class="d-md-flex justify-content-between align-items-center py-4">
                <h1 class="page-title font-size-3 font-weight-medium m-0 text-lh-lg">{{$deletion->title}}</h1>
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
                                                    <img src="@if($deletion->cover_path && file_exists('storage' . '/' . $deletion->cover_path)){{asset('storage/' . $deletion->cover_path)}} @else{{asset('/images/no-item-image.png')}}@endif" alt="Image Description" class="mx-auto img-fluid">
                                                </div>

                                            </div>
                                        </figure>
                                    </div>
                                    <div class="col-lg-7 pl-lg-0 summary entry-summary">
                                        <div class="px-lg-4 px-xl-6">
                                            <h1 class="product_title entry-title font-size-7 mb-3 crop-text-2">{{$deletion->title_long ?? $deletion->title}}</h1>
                                            <div class="font-size-2 mb-4">

                                            </div>
                                            <div class="woocommerce-product-details__short-description font-size-2 mb-4">
                                                <h2 class="h6 text-lh-md mb-1 text-height-2 crop-text-2 text-gray-600">{{$deletion->description}}</h2>
                                            </div>

                                            <div class="mb-4">
                                                <label class="form-label font-size-3 font-weight-medium mb-3">Item Format:</label>
                                                <span class="font-size-3 font-weight-medium mb-3">{{$deletion->type}}</span>

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
                        @include('partials.deletions._show-features')
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
                                @forelse($authors as $author)
                                    <tr>
                                        <th class="px-4 px-xl-5">Author: </th>
                                        <td><a href="#" class="link-black-100">{{$author}}</a></td>
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
                                    @forelse($subjects as $subject)
                                        <tr>
                                            <th class="px-4 px-xl-5">Subject: </th>
                                            <td>{{$subject}}</td>
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
                            @forelse($collections as $collection)
                                <tr>
                                    <th class="px-4 px-xl-5">Part of: </th>
                                    <td><a href="#" class="link-black-100">{{$collection}}</a></td>
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
