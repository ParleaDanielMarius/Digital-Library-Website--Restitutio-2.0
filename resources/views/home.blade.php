@extends('layouts.layout')
@section('title', 'Home')

@section('content')
    <!-- ===== MAIN CONTENT ==== -->
    <section class="space-bottom-2 space-bottom-xl-3">
        <div class="container">
            <div class="row">
                <div class="offset-xl-3 offset-wd-2 col-lg-8 col-xl-9 col-wd-10">
                    <div class="bg-img-hero img-fluid bg-gradient-dark-1 mb-6 mb-xl-0 ml-xl-2d75 ml-wd-11" style="background-image: url({{asset('assets/img/900x506/img1.jpg')}});">
                        <div class="space-top-2 space-top-xl-4 px-4 px-md-5 px-lg-7 pb-3">
                            <ul class="u-slick pl-0 mb-0">
                                    <div class="d-block d-md-flex media">
                                        <div class="media-body align-self-center mb-4 mb-xl-0">
                                            <h2 class="font-size-15 d-flex mb-4">
                                                <span class="font-weight-normal d-block text-white">Restitutio</span>

                                            </h2>
                                            <p class="text-white">I have no clue what to put here</p>
                                        </div>
                                        <img src="https://placehold.it/250x293" class="img-fluid" alt="This place is for a future image. What Image? I have no clue">
                                    </div>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="space-bottom-2 space-bottom-xl-3 product-4-1-4">
        <div class="container">
            <header class="d-md-flex justify-content-between align-items-center mb-4 pb-xl-1">
                <h2 class="font-size-7 font-weight-medium mb-4 mb-lg-0">Latest Books</h2>
                <ul class="nav justify-content-md-center nav-gray-700 flex-nowrap flex-md-wrap overflow-auto overflow-md-visible" id="featuredBooks" role="tablist">
                    <li class="nav-item mx-5 mb-1 flex-shrink-0 flex-md-shrink-1">
                        <a class="nav-link px-0 active" id="featured-tab" data-toggle="tab" href="#featured" role="tab" aria-controls="featured" aria-selected="true">Latest</a>
                    </li>
                    <li class="nav-item mx-5 mb-1 flex-shrink-0 flex-md-shrink-1">
                        <a class="nav-link px-0" id="onsale-tab" data-toggle="tab" href="#onsale" role="tab" aria-controls="onsale" aria-selected="false">Periodics</a>
                    </li>
                    <li class="nav-item mx-5 mb-1 flex-shrink-0 flex-md-shrink-1">
                        <a class="nav-link px-0" id="mostviewed-tab" data-toggle="tab" href="#mostviewed" role="tab" aria-controls="mostviewed" aria-selected="false">Manuscripts</a>
                    </li>
                </ul>
            </header>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="featured" role="tabpanel" aria-labelledby="featured-tab">
                    <div class="row no-gutters border-top border-left">
                        <div class="col-lg-12">
                            <div class="row no-gutters products row-cols-6">
                                @foreach($latestItems as $item)
                                <x-items.latest-card :item="$item"></x-items.latest-card>
                                @endforeach
                            </div>
                        </div>


                    </div>
                </div>
                <div class="tab-pane fade" id="onsale" role="tabpanel" aria-labelledby="onsale-tab">
                    <div class="row no-gutters border-top border-left">
                        <div class="col-lg-12">
                            <div class="row no-gutters products row-cols-6">
                                @foreach($latestPeriodics as $periodic)
                                    <x-items.latest-card :item="$periodic"></x-items.latest-card>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
                <div class="tab-pane fade" id="mostviewed" role="tabpanel" aria-labelledby="mostviewed-tab">
                    <div class="row no-gutters border-top border-left">
                        <div class="col-lg-12">
                            <div class="row no-gutters products row-cols-6">
                                @foreach($latestManuscripts as $manuscript)
                                    <x-items.latest-card :item="$manuscript"></x-items.latest-card>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="space-bottom-2 space-bottom-xl-3">
        <div class="bg-gray-200">
            <div class="space-2 space-xl-3">
                <div class="container">
                    <header class="d-md-flex justify-content-between align-items-center mb-5">
                        <h2 class="font-size-7 mb-4 mb-lg-0">Featured Categories</h2>
                        <a href="../shop/v4.html" class="d-flex">All Categories<span class="flaticon-next font-size-3 ml-2"></span></a>
                    </header>
                    <ul class="nav justify-content-between flex-nowrap pb-2 py-md-3 js-slick-carousel u-slick"
                        data-pagi-classes="d-xl-none text-center u-slick__pagination mb-n7 position-absolute right-0 left-0 bottom-0"
                        data-arrows-classes="d-none d-xl-block u-slick__arrow u-slick__arrow-centered--y bg-transparent border-0 text-dark"
                        data-arrow-left-classes="fas flaticon-back u-slick__arrow-inner u-slick__arrow-inner--left ml-lg-n5" data-arrow-right-classes="fas flaticon-next u-slick__arrow-inner u-slick__arrow-inner--right mr-lg-n5"
                        data-slides-show="7"
                        data-responsive='[{
                        "breakpoint": 1500,
                           "settings": {
                             "slidesToShow": 6
                           }
                        }, {
                           "breakpoint": 992,
                           "settings": {
                             "slidesToShow": 4
                           }
                        }, {
                           "breakpoint": 768,
                           "settings": {
                             "slidesToShow": 3
                           }
                        }, {
                           "breakpoint": 554,
                           "settings": {
                             "slidesToShow": 1
                           }
                        }]'>
                        <li class="nav-item">
                            <a class="nav-link font-weight-medium px-0" href="../shop/v4.html">
                                <div class="text-center">
                                    <figure class="d-md-block mb-0 text-primary-indigo">
                                        <i class="glyph-icon flaticon-gallery font-size-12"></i>
                                    </figure>
                                    <span class="tabtext font-size-3 font-weight-medium text-dark">Arts & Photography</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-weight-medium px-0" href="../shop/v4.html">
                                <div class="text-center">
                                    <figure class="d-md-block mb-0 text-tangerine">
                                        <i class="glyph-icon flaticon-cook font-size-12"></i>
                                    </figure>
                                    <span class="tabtext font-size-3 font-weight-medium text-dark">Food & Drink</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-weight-medium px-0" href="../shop/v4.html">
                                <div class="text-center">
                                    <figure class="d-md-block mb-0 text-chili">
                                        <i class="glyph-icon flaticon-like font-size-12"></i>
                                    </figure>
                                    <span class="tabtext font-size-3 font-weight-medium text-dark">Romance</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-weight-medium px-0" href="../shop/v4.html">
                                <div class="text-center">
                                    <figure class="d-md-block mb-0 text-carolina">
                                        <i class="glyph-icon flaticon-doctor font-size-12"></i>
                                    </figure>
                                    <span class="tabtext font-size-3 font-weight-medium text-dark">Health</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-weight-medium px-0" href="../shop/v4.html">
                                <div class="text-center">
                                    <figure class="d-md-block mb-0 text-punch">
                                        <i class="glyph-icon flaticon-resume font-size-12"></i>
                                    </figure>
                                    <span class="tabtext font-size-3 font-weight-medium text-dark">Biography</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-weight-medium px-0" href="../shop/v4.html">
                                <div class="text-center">
                                    <figure class="d-md-block mb-0 text-tangerine">
                                        <i class="icon glyph-icon flaticon-jogging font-size-12"></i>
                                    </figure>
                                    <span class="tabtext font-size-3 font-weight-medium text-dark">Sports</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-weight-medium px-0" href="../shop/v4.html">
                                <div class="text-center">
                                    <figure class="d-md-block mb-0 text-chili">
                                        <i class="icon glyph-icon flaticon-baby-boy font-size-12"></i>
                                    </figure>
                                    <span class="tabtext font-size-3 font-weight-medium text-dark">Children</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-weight-medium px-0" href="../shop/v4.html">
                                <div class="text-center">
                                    <figure class="d-md-block mb-0 text-chili">
                                        <i class="glyph-icon flaticon-like font-size-12"></i>
                                    </figure>
                                    <span class="tabtext font-size-3 font-weight-medium text-dark">Romance</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-weight-medium px-0" href="../shop/v4.html">
                                <div class="text-center">
                                    <figure class="d-md-block mb-0 text-chili">
                                        <i class="icon glyph-icon flaticon-baby-boy font-size-12"></i>
                                    </figure>
                                    <span class="tabtext font-size-3 font-weight-medium text-dark">Children</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-weight-medium px-0" href="../shop/v4.html">
                                <div class="text-center">
                                    <figure class="d-md-block mb-0 text-tangerine">
                                        <i class="icon glyph-icon flaticon-jogging font-size-12"></i>
                                    </figure>
                                    <span class="tabtext font-size-3 font-weight-medium text-dark">Sports</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </section>





    <!-- ===== END MAIN CONTENT ======-->
@endsection






