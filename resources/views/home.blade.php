@extends('layouts.layout-index')
@section('title', 'Home')

@section('content')
    <section class="space-bottom-3">
        <div class="bg-gray-200 space-2 space-lg-0 bg-img-hero" style="background-image: url({{asset('/assets/img/1920x588/img1.jpg')}});">
            <div class="container">
{{--                Hero Carousel--}}
                <div class="js-slick-carousel u-slick"
                     data-pagi-classes="text-center u-slick__pagination position-absolute right-0 left-0 mb-n8 mb-lg-4 bottom-0"
                     data-speed="800"
                     data-autoplay="true"
                     data-pause-hover="true">
                    <div class="js-slide">
                        <div class="hero row min-height-588 align-items-center">
                            <div class="col-lg-7 col-wd-6 mb-4 mb-lg-0">
                                <div class="media-body mr-wd-4 align-self-center mb-4 mb-md-0">
                                    <p class="hero__pretitle text-uppercase font-weight-bold text-gray-400 mb-2"
                                       data-scs-animation-in="fadeInUp"
                                       data-scs-animation-delay="200">
                                        <img src="{{asset('/assets/img/Logo-BCU-v2.png')}}" class="img-fluid" style="max-height: 100px; max-width: 300px" alt="Logo-BCU-v2.png">
                                    </p>
                                    <h2 class="hero__title font-size-14 mb-4"
                                        data-scs-animation-in="fadeInUp"
                                        data-scs-animation-delay="300">
                                        <span class="hero__title-line-1 font-weight-regular d-block">{{__('welcome to')}}</span>
                                        <span class="hero__title-line-2 font-weight-bold d-block">Restitutio</span>
                                    </h2>
                                    <a href="{{route('items.index')}}" class="btn btn-dark btn-wide rounded-0 hero__btn"
                                       data-scs-animation-in="fadeInLeft"
                                       data-scs-animation-delay="400">{{__('browse')['browse items']}}</a>
                                </div>
                            </div>
                            <div class="col-lg-5 col-wd-6"
                                 data-scs-animation-in="fadeInRight"
                                 data-scs-animation-delay="500">
                                <p>
                                    {{__('restitutio description')}}
                                </p>
                            </div>
                        </div>
                    </div>
{{--                    Featured Collections--}}
                    @forelse($featuredCollections as $featuredCollection)
                    <div class="js-slide">
                        <div class="hero row min-height-588 align-items-center">
                            <div class="col-lg-7 col-wd-6 mb-4 mb-lg-0">
                                <div class="media-body mr-wd-4 align-self-center mb-4 mb-md-0">
                                    <p class="hero__pretitle text-uppercase font-weight-bold text-gray-400 mb-2"
                                       data-scs-animation-in="fadeInUp"
                                       data-scs-animation-delay="200">Restitutio</p>
                                    <h2 class="hero__title font-size-14 mb-4"
                                        data-scs-animation-in="fadeInUp"
                                        data-scs-animation-delay="300">
                                        <span class="hero__title-line-1 font-weight-regular d-block">{{__('featured collection')}}</span>
                                        <span class="hero__title-line-2 font-weight-bold d-block">{{$featuredCollection->title}}</span>
                                    </h2>
                                    <a href="{{route('collections.show', $featuredCollection)}}" class="btn btn-dark btn-wide rounded-0 hero__btn"
                                       data-scs-animation-in="fadeInLeft"
                                       data-scs-animation-delay="400">{{__('discover')}}</a>
                                </div>
                            </div>
                            <div class="col-lg-5 col-wd-6"
                                 data-scs-animation-in="fadeInRight"
                                 data-scs-animation-delay="500">
                                <img alt="Featured collection" class="img-fluid rounded" style="height: 450px; width: 350px" src="@if($featuredCollection->cover_path && file_exists('storage' . '/' . $featuredCollection->cover_path)){{asset('storage/' . $featuredCollection->cover_path)}} @else{{asset('assets/img/collections/no-collection-image.png')}}@endif">
                            </div>
                        </div>
                    </div>
                    @empty
                    @endforelse
                </div>
            </div>
        </div>
    </section>
{{--    Latest Items, Periodics, Manuscripts--}}
    <section class="space-bottom-2 space-bottom-xl-3 product-4-1-4">
        <div class="container">
            <header class="d-md-flex justify-content-between align-items-center mb-4 pb-xl-1">
                <h2 class="font-size-7 font-weight-medium mb-4 mb-lg-0">{{__('latest')}}</h2>
                <ul class="nav justify-content-md-center nav-gray-700 flex-nowrap flex-md-wrap overflow-auto overflow-md-visible" id="featuredBooks" role="tablist">
                    <li class="nav-item mx-5 mb-1 flex-shrink-1 flex-md-shrink-1">
                        <a class="nav-link px-0 active" id="latestItems-tab" data-toggle="tab" href="#latestItems-Panel" role="tab" aria-controls="latestItems-Panel" aria-selected="true">{{__('items')['items']}}</a>
                    </li>
                    <li class="nav-item mx-5 mb-1 flex-shrink-1 flex-md-shrink-1">
                        <a class="nav-link px-0" id="latestPeriodics-tab" data-toggle="tab" href="#latestPeriodics-Panel" role="tab" aria-controls="latestPeriodics-Pane" aria-selected="false">{{__('items')['periodics']}}</a>
                    </li>
                    <li class="nav-item mx-5 mb-1 flex-shrink-1 flex-md-shrink-1">
                        <a class="nav-link px-0" id="latestManuscripts-tab" data-toggle="tab" href="#latestManuscripts-Panel" role="tab" aria-controls="latestManuscripts-Panel" aria-selected="false">{{__('items')['manuscripts']}}</a>
                    </li>
                </ul>
            </header>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="latestItems-Panel" role="tabpanel" aria-labelledby="featured-tab">
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
                <div class="tab-pane fade" id="latestPeriodics-Panel" role="tabpanel" aria-labelledby="onsale-tab">
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
                <div class="tab-pane fade" id="latestManuscripts-Panel" role="tabpanel" aria-labelledby="mostviewed-tab">
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
{{--    BCU Carol Quote And Image--}}
    <section class="space-bottom-2 space-bottom-xl-3">
        <div class="bg-gray-200">
            <div class="container">
                <div class="js-slick-carousel u-slick">
                    <div class="js-slide">
                        <div class="hero row min-height-588 align-items-center">
                            <div class="col-lg-7 col-wd-6 mb-4 mb-lg-0">
                                <img class="img-fluid rounded-md" style='height: 75%; width: 75%; object-fit: contain' src="{{asset('/assets/img/statuie-Carol1-800x800.jpg')}}" alt="image-description">
                            </div>

                            <div class="col-lg-5 col-wd-6"
                                 data-scs-animation-in="fadeInRight"
                                 data-scs-animation-delay="500">
                                <h2 class="hero__title font-size-14 mb-4"
                                    data-scs-animation-in="fadeInUp"
                                    data-scs-animation-delay="300">
                                    <span class="hero__title-line-1 font-weight-bold d-block">
                                        <b class="text-yellow-darker">"</b><i class="text-blue-bcu" style="font-family: 'verdana',serif">{{__('carol quote')}}</i><b class="text-yellow-darker">“</b>
                                    </span>
                                </h2>
                                <p>
                                    {{__('carol letter1')}}
                                </p>
                                <p>
                                    {{__('carol letter2')}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection






