@extends('layouts.layout-index')
@section('title', 'Home')

@section('content')
    <!-- ===== MAIN CONTENT ==== -->

    <!-- ===== HEADER ==== -->
    <section class="space-bottom-3">
        <div class="bg-gray-200 space-2 space-lg-0 bg-img-hero" style="background-image: url(../../assets/img/1920x588/img1.jpg);">
            <div class="container">
                <div class="js-slick-carousel u-slick"
                     data-pagi-classes="text-center u-slick__pagination position-absolute right-0 left-0 mb-n8 mb-lg-4 bottom-0">
                    <div class="js-slide">
                        <div class="hero row min-height-588 align-items-center">
                            <div class="col-lg-7 col-wd-6 mb-4 mb-lg-0">
                                <div class="media-body mr-wd-4 align-self-center mb-4 mb-md-0">
                                    <p class="hero__pretitle text-uppercase font-weight-bold text-gray-400 mb-2"
                                       data-scs-animation-in="fadeInUp"
                                       data-scs-animation-delay="200">BCU Carol I</p>
                                    <h2 class="hero__title font-size-14 mb-4"
                                        data-scs-animation-in="fadeInUp"
                                        data-scs-animation-delay="300">
                                        <span class="hero__title-line-1 font-weight-regular d-block">Welcome To</span>
                                        <span class="hero__title-line-2 font-weight-bold d-block">Restitutio</span>
                                    </h2>
                                    <a href="{{route('items.index')}}" class="btn btn-dark btn-wide rounded-0 hero__btn"
                                       data-scs-animation-in="fadeInLeft"
                                       data-scs-animation-delay="400">Browse Items</a>
                                </div>
                            </div>
                            <div class="col-lg-5 col-wd-6"
                                 data-scs-animation-in="fadeInRight"
                                 data-scs-animation-delay="500">
                                <p>
                                    RESTITUTIO is the digital platform of the ‘Carol I’ Central University Library which gathers digitized collections of manuscripts, old and rare books, press, journals and other serial publications, current Romanian and foreign books, iconographic resources, cartographic resources and audio-video resources. RESTITUTIO gives library users an innovative tool for the discovery of information, which can be found in the bibliographic description. Searching can be done simply by inserting into the search box the term of interest and the given results are ordered by relevance. Also, you can use the advanced search by using multiple search criteria (title, author, subject, publication date) or you can search using the list of authors, subjects and publication dates.
                                    Digitized resources are grouped into categories, depending on the types of documents. RESTITUTIO is an Open Access repository.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="js-slide">
                        <div class="hero row min-height-588 align-items-center">
                            <div class="col-lg-7 col-wd-6 mb-4 mb-lg-0">
                                <div class="media-body mr-wd-4 align-self-center mb-4 mb-md-0">
                                    <p class="hero__pretitle text-uppercase font-weight-bold text-gray-400 mb-2"
                                       data-scs-animation-in="fadeInUp"
                                       data-scs-animation-delay="200">The Bookworm Editors'</p>
                                    <h2 class="hero__title font-size-14 mb-4"
                                        data-scs-animation-in="fadeInUp"
                                        data-scs-animation-delay="300">
                                        <span class="hero__title-line-1 font-weight-regular d-block">Featured Books of the</span>
                                        <span class="hero__title-line-2 font-weight-bold d-block">February</span>
                                    </h2>
                                    <a href="{{route('items.index')}}" class="btn btn-dark btn-wide rounded-0 hero__btn"
                                       data-scs-animation-in="fadeInLeft"
                                       data-scs-animation-delay="400">Browse Items</a>
                                </div>
                            </div>
                            <div class="col-lg-5 col-wd-6"
                                 data-scs-animation-in="fadeInRight"
                                 data-scs-animation-delay="500">
                                <img class="img-fluid" src="https://placehold.it/800x420" alt="image-description">
                            </div>
                        </div>
                    </div>

                    <div class="js-slide">
                        <div class="hero row min-height-588 align-items-center">
                            <div class="col-lg-7 col-wd-6 mb-4 mb-lg-0">
                                <div class="media-body mr-wd-4 align-self-center mb-4 mb-md-0">
                                    <p class="hero__pretitle text-uppercase font-weight-bold text-gray-400 mb-2"
                                       data-scs-animation-in="fadeInUp"
                                       data-scs-animation-delay="200">The Bookworm Editors'</p>
                                    <h2 class="hero__title font-size-14 mb-4"
                                        data-scs-animation-in="fadeInUp"
                                        data-scs-animation-delay="300">
                                        <span class="hero__title-line-1 font-weight-regular d-block">Featured Books of the</span>
                                        <span class="hero__title-line-2 font-weight-bold d-block">February</span>
                                    </h2>
                                    <a href="../shop/v1.html" class="btn btn-dark btn-wide rounded-0 hero__btn"
                                       data-scs-animation-in="fadeInLeft"
                                       data-scs-animation-delay="400">See More</a>
                                </div>
                            </div>
                            <div class="col-lg-5 col-wd-6"
                                 data-scs-animation-in="fadeInRight"
                                 data-scs-animation-delay="500">
                                <img class="img-fluid" src="https://placehold.it/800x420" alt="image-description">
                            </div>
                        </div>
                    </div>

                    <div class="js-slide">
                        <div class="hero row min-height-588 align-items-center">
                            <div class="col-lg-7 col-wd-6 mb-4 mb-lg-0">
                                <div class="media-body mr-wd-4 align-self-center mb-4 mb-md-0">
                                    <p class="hero__pretitle text-uppercase font-weight-bold text-gray-400 mb-2"
                                       data-scs-animation-in="fadeInUp"
                                       data-scs-animation-delay="200">The Bookworm Editors'</p>
                                    <h2 class="hero__title font-size-14 mb-4"
                                        data-scs-animation-in="fadeInUp"
                                        data-scs-animation-delay="300">
                                        <span class="hero__title-line-1 font-weight-regular d-block">Featured Books of the</span>
                                        <span class="hero__title-line-2 font-weight-bold d-block">February</span>
                                    </h2>
                                    <a href="../shop/v1.html" class="btn btn-dark btn-wide rounded-0 hero__btn"
                                       data-scs-animation-in="fadeInLeft"
                                       data-scs-animation-delay="400">See More</a>
                                </div>
                            </div>
                            <div class="col-lg-5 col-wd-6"
                                 data-scs-animation-in="fadeInRight"
                                 data-scs-animation-delay="500">
                                <img class="img-fluid" src="https://placehold.it/800x420" alt="image-description">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="space-bottom-2 space-bottom-xl-3 product-4-1-4">
        <div class="container">
            <header class="d-md-flex justify-content-between align-items-center mb-4 pb-xl-1">
                <h2 class="font-size-7 font-weight-medium mb-4 mb-lg-0">Latest Items</h2>
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
            <div class="container">
                <div class="js-slick-carousel u-slick"
                     data-pagi-classes="text-center u-slick__pagination position-absolute right-0 left-0 mb-n8 mb-lg-4 bottom-0">
                    <div class="js-slide">
                        <div class="hero row min-height-588 align-items-center">
                            <div class="col-lg-7 col-wd-6 mb-4 mb-lg-0">
                                <img class="img-fluid rounded" style="height: 550px" src="{{asset('/assets/img/statuie-Carol1-800x800.jpg')}}" alt="image-description">
                            </div>

                            <div class="col-lg-5 col-wd-6"
                                 data-scs-animation-in="fadeInRight"
                                 data-scs-animation-delay="500">
                                <h2 class="hero__title font-size-14 mb-4"
                                    data-scs-animation-in="fadeInUp"
                                    data-scs-animation-delay="300">
                                    <span class="hero__title-line-1 font-weight-bold d-block"><i>“An institution for the well-being of the university youth“</i></span>
                                </h2>
                                <p>
                                    In a letter addressed to the President of the Council of Ministers, a document that can be considered a true founding act, King Carol I declared his desire to “set up an institution for the well-being of the university youth from all the universities of the Country, endowed with a permanently open library.”
                                </p>
                                <p>
                                    The future place of culture was to be certified by law as a state institution, under the administration of the Ministry of Cults and Public Instruction.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>





    <!-- ===== END MAIN CONTENT ======-->
@endsection






