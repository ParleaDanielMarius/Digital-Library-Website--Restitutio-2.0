@extends('layouts.layout-index')
@section('title', $deletion->title)
@section('content')

    <div class="page-header border-bottom">
        <div class="container">
            <div class="d-md-flex justify-content-between align-items-center py-4">
                <h1 class="page-title font-size-3 font-weight-medium m-0 text-lh-lg">{{$deletion->title}}</h1>
{{--                Breadcrumbs--}}
                <nav class="woocommerce-breadcrumb font-size-2">
                    <a href="{{route('home')}}" class="h-primary">Home</a>
                    <span class="breadcrumb-separator mx-1"><i class="fas fa-angle-right"></i></span>
                    <a href="{{route('deletions.manage')}}" class="h-primary">{{__('admin')['manage deleted items']}}</a>
                    <span class="breadcrumb-separator mx-1"><i class="fas fa-angle-right"></i></span>{{$deletion->title}}
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
                                @forelse($authors as $key=>$author)
                                    <tr>
                                        <th class="px-4 px-xl-5">{{$contributions[$key]}}: </th>
                                        <td><a href="#" class="link-black-100">{{$author}}</a></td>
                                    </tr>
                                @empty
                                    <tr>
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
        </div>
    </div>

@endsection
