@php
    use App\Models\Item;
@endphp
@extends('layouts.layout-index')
@section('content')
    <!-- ====== MAIN CONTENT ====== -->
    <div class="page-header border-bottom mb-8">
        <div class="container">
            <div class="d-md-flex justify-content-between align-items-center py-4">
                <h1 class="page-title font-size-3 font-weight-medium m-0 text-lh-lg">{{$collection->title}}</h1>
                <nav class="woocommerce-breadcrumb font-size-2">
                    <a href="../home/index.html" class="h-primary">Home</a>
                    <span class="breadcrumb-separator mx-1"><i class="fas fa-angle-right"></i></span>
                    <a href="../shop/v6.html" class="h-primary">Electronics</a>
                    <span class="breadcrumb-separator mx-1"><i class="fas fa-angle-right"></i></span>
                    <a href="../shop/v6.html" class="h-primary">Cameras</a>
                    <span class="breadcrumb-separator mx-1"><i class="fas fa-angle-right"></i></span>Build Your DSLR
                </nav>
            </div>
            @auth()
                <table class="table table-hover table-borderless">
                    <tbody>
                    @if(auth()->user()->isAdmin())
                        <tr>
                            <th class="px-4 px-xl-5">Created by: </th>
                            <td>{{$collection->user->username ?? 'No Value'}}</td>
                        </tr>
                        <tr>
                            <th class="px-4 px-xl-5">Created at: </th>
                            <td>{{$collection->created_at ?? 'No Value'}}</td>
                        </tr>
                        <tr>
                            <th class="px-4 px-xl-5">Updated by: </th>
                            <td>{{$collection->user->username ?? 'No Value'}}</td>
                        </tr>
                        <tr>
                            <th class="px-4 px-xl-5">Updated at: </th>
                            <td>{{$collection->updated_at ?? 'No Value'}}</td>
                        </tr>
                    @endif
                    <tr>
                        <th class="px-4 px-xl-5">Actions: </th>
                            <td>
                                <a href="{{route('collections.edit', $collection)}}"><i class="fa-solid fa-pencil"></i>
                                    Edit Collection</a>
                            </td>
                            <td>
                                <a href="#" type="button" data-toggle="modal" data-target="#deleteModal"><i class="fa-solid fa-trash"></i>
                                    Delete Collection</a>
                            </td>
                            <td>
                                <a href="#" type="button" data-toggle="modal" data-target="#statusModal"><i class="fa-solid fa-power-off"></i>
                                    Change Status</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            @include('partials.collections._deleteModal')
            @include('partials.collections._statusModal')
            @endauth
        </div>
    </div>
    <section class="space-bottom-2 space-bottom-lg-3">
        <div class="bg-gray-200 space-bottom-2 space-bottom-md-0">
            <div class="container space-top-2 space-top-wd-3 px-3">
                <div class="row">
                    <div class="col-lg-4 col-wd-3 d-flex">
                        <img class="img-fluid mb-5 mb-lg-0 mt-auto" src="@if($collection->cover_path && file_exists('storage' . '/' . $collection->cover_path)){{asset('storage/' . $collection->cover_path)}} @else{{asset('assets/img/collections/no-collection-image.png')}}@endif" alt="Image-Description">
                    </div>
                    <div class="col-lg-8 col-wd-9">
                        <div class="mb-8">
                            <span class="text-gray-400 font-size-2">Number of items: {{$collection->items_count}}</span>
                            <h6 class="font-size-7 ont-weight-medium mt-2 mb-3 pb-1">
                                {{$collection->title}}
                            </h6>
                            <p class="mb-0">{{$collection->description}} </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="site-content space-bottom-3" id="content">
        <div class="container">
            <div class="row">
                <div id="primary" class="content-area order-2">
                    <form action="" class="woocommerce-ordering mb-4 m-md-0" method="GET">
                    <div class="shop-control-bar d-lg-flex justify-content-between align-items-center mb-5 text-center text-md-left">
                        <div class="shop-control-bar__left mb-4 m-lg-0">
                            <p class="woocommerce-result-count m-0">
                                {!! __('Showing') !!}
                                <span>{{ $items->firstItem() }}</span>
                                {!! __('to') !!}
                                <span>{{ $items->lastItem() }}</span>
                                {!! __('of') !!}
                                <span>{{ $items->total() }}</span>
                                {!! __('results') !!}
                            </p>
                        </div>

                        <div class="shop-control-bar__right d-md-flex align-items-center">
                                <!-- Select -->
                                <select onchange="this.form.submit()" class="js-select selectpicker dropdown-select orderby" name="sortBy"
                                        data-style="border-bottom shadow-none outline-none py-2">
                                    <option value="latest" @if(request('sortBy') === 'latest') selected @endif>Sort by Latest</option>
                                    <option value="asc" @if(request('sortBy') == null || request('sortBy') == 'asc') selected @endif>Sort Asc</option>
                                    <option value="desc"@if(request('sortBy') == 'desc') selected @endif>Sort Desc</option>
                                </select>
                                <!-- End Select -->



                                <!-- Select -->
                                <select name="orderBy" onchange="this.form.submit()" class="js-select selectpicker dropdown-select orderby"
                                        data-style="border-bottom shadow-none outline-none py-2"
                                        data-width="fit">
                                    <option value="10" @if($items->perPage() == 10) selected @endif>Show 10</option>
                                    <option value="15" @if($items->perPage() == 15) selected @endif>Show 15</option>
                                    <option value="20" @if($items->perPage() == 20) selected @endif>Show 20</option>
                                    <option value="25" @if($items->perPage() == 25) selected @endif>Show 25</option>
                                    <option value="30" @if($items->perPage() == 30) selected @endif>Show 30</option>
                                </select>
                                <!-- End Select -->


                            <ul class="nav nav-tab ml-lg-4 justify-content-center justify-content-md-start ml-md-auto" id="pills-tab" role="tablist">
                                <li class="nav-item border">
                                    <a class="nav-link p-0 height-38 width-38 justify-content-center d-flex align-items-center active" id="pills-one-example1-tab" data-toggle="pill" href="#pills-one-example1" role="tab" aria-controls="pills-one-example1" aria-selected="true">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="17px" height="17px">
                                            <path fill-rule="evenodd" fill="rgb(25, 17, 11)" d="M-0.000,0.000 L3.000,0.000 L3.000,3.000 L-0.000,3.000 L-0.000,0.000 Z" />
                                            <path fill-rule="evenodd" fill="rgb(25, 17, 11)" d="M7.000,0.000 L10.000,0.000 L10.000,3.000 L7.000,3.000 L7.000,0.000 Z" />
                                            <path fill-rule="evenodd" fill="rgb(25, 17, 11)" d="M14.000,0.000 L17.000,0.000 L17.000,3.000 L14.000,3.000 L14.000,0.000 Z" />
                                            <path fill-rule="evenodd" fill="rgb(25, 17, 11)" d="M-0.000,7.000 L3.000,7.000 L3.000,10.000 L-0.000,10.000 L-0.000,7.000 Z" />
                                            <path fill-rule="evenodd" fill="rgb(25, 17, 11)" d="M7.000,7.000 L10.000,7.000 L10.000,10.000 L7.000,10.000 L7.000,7.000 Z" />
                                            <path fill-rule="evenodd" fill="rgb(25, 17, 11)" d="M14.000,7.000 L17.000,7.000 L17.000,10.000 L14.000,10.000 L14.000,7.000 Z" />
                                            <path fill-rule="evenodd" fill="rgb(25, 17, 11)" d="M-0.000,14.000 L3.000,14.000 L3.000,17.000 L-0.000,17.000 L-0.000,14.000 Z" />
                                            <path fill-rule="evenodd" fill="rgb(25, 17, 11)" d="M7.000,14.000 L10.000,14.000 L10.000,17.000 L7.000,17.000 L7.000,14.000 Z" />
                                            <path fill-rule="evenodd" fill="rgb(25, 17, 11)" d="M14.000,14.000 L17.000,14.000 L17.000,17.000 L14.000,17.000 L14.000,14.000 Z" />
                                        </svg>
                                    </a>
                                </li>
                                <li class="nav-item border">
                                    <a class="nav-link p-0 height-38 width-38 justify-content-center d-flex align-items-center" id="pills-two-example1-tab" data-toggle="pill" href="#pills-two-example1" role="tab" aria-controls="pills-two-example1" aria-selected="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="23px" height="17px">
                                            <path fill-rule="evenodd" fill="rgb(25, 17, 11)" d="M-0.000,0.000 L3.000,0.000 L3.000,3.000 L-0.000,3.000 L-0.000,0.000 Z" />
                                            <path fill-rule="evenodd" fill="rgb(25, 17, 11)" d="M7.000,0.000 L23.000,0.000 L23.000,3.000 L7.000,3.000 L7.000,0.000 Z" />
                                            <path fill-rule="evenodd" fill="rgb(25, 17, 11)" d="M-0.000,7.000 L3.000,7.000 L3.000,10.000 L-0.000,10.000 L-0.000,7.000 Z" />
                                            <path fill-rule="evenodd" fill="rgb(25, 17, 11)" d="M7.000,7.000 L23.000,7.000 L23.000,10.000 L7.000,10.000 L7.000,7.000 Z" />
                                            <path fill-rule="evenodd" fill="rgb(25, 17, 11)" d="M-0.000,14.000 L3.000,14.000 L3.000,17.000 L-0.000,17.000 L-0.000,14.000 Z" />
                                            <path fill-rule="evenodd" fill="rgb(25, 17, 11)" d="M7.000,14.000 L23.000,14.000 L23.000,17.000 L7.000,17.000 L7.000,14.000 Z" />
                                        </svg>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Tab Content -->
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-one-example1" role="tabpanel" aria-labelledby="pills-one-example1-tab">
                            <!-- Mockup Block -->
                            <ul class="products list-unstyled row no-gutters row-cols-2 row-cols-lg-3 row-cols-wd-5 border-top border-left mb-6">
                                @forelse($items as $item)
                                    <li class="product col">
                                        <x-items.item-card :item="$item"></x-items.item-card>
                                    </li>
                                @empty
                                @endforelse
                            </ul>
                            <!-- End Mockup Block -->
                        </div>
                        <div class="tab-pane fade" id="pills-two-example1" role="tabpanel" aria-labelledby="pills-two-example1-tab">
                            <!-- Mockup Block -->
                            <ul class="products list-unstyled mb-6">
                                @forelse($items as $item)
                                    <li class="product product__list">
                                        <x-items.item-list-card :item="$item"></x-items.item-list-card>
                                    </li>
                                @empty
                                    No Product Found
                                    @endforelse
                                    </li>

                            </ul>
                            <!-- End Mockup Block -->
                        </div>
                    </div>
                    <!-- End Tab Content -->

                    {{ $items->links('vendor.pagination.bootstrap-5') }}

                </div>
                <div id="secondary" class="sidebar widget-area order-1" role="complementary">
                            <div id="woocommerce_product_categories-2" class="widget p-4d875 border woocommerce widget_product_categories">
                                <div id="widgetHeadingOne" class="widget-head">
                                    <a class="d-flex align-items-center justify-content-between text-dark" href="#"
                                       data-toggle="collapse"
                                       data-target="#widgetCollapseOne"
                                       aria-expanded="true"
                                       aria-controls="widgetCollapseOne">

                                        <h3 class="widget-title mb-0 font-weight-medium font-size-3">Search</h3>

                                        <svg class="mins" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" height="2px">
                                            <path fill-rule="evenodd" fill="rgb(22, 22, 25)" d="M0.000,-0.000 L15.000,-0.000 L15.000,2.000 L0.000,2.000 L0.000,-0.000 Z" />
                                        </svg>

                                        <svg class="plus" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" height="15px">
                                            <path fill-rule="evenodd" fill="rgb(22, 22, 25)" d="M15.000,8.000 L9.000,8.000 L9.000,15.000 L7.000,15.000 L7.000,8.000 L0.000,8.000 L0.000,6.000 L7.000,6.000 L7.000,-0.000 L9.000,-0.000 L9.000,6.000 L15.000,6.000 L15.000,8.000 Z" />
                                        </svg>
                                    </a>
                                </div>

                                <div id="widgetCollapseOne" class="mt-3 widget-content collapse show"
                                     aria-labelledby="widgetHeadingOne"
                                >
                                    <div class="input-group flex-nowrap w-100">
                                        <div class="input-group-prepend">
                                            <i class="glph-icon flaticon-loupe py-2d75 bg-white-100 border-white-100 text-dark pl-3 pr-0 rounded-0"></i>
                                        </div>
                                        <input name="search" class="form-control bg-white-100 py-2d75 height-4 border-white-100 rounded-0" type="search" value="{{request('search') ?? ''}}" placeholder="Search" aria-label="Search">
                                    </div>
                                    <button class="btn btn-outline-primary btn-sm" type="submit">Search</button>

                                </div>
                            </div>

                            <div id="Subjects" class="widget widget_search widget_author p-4d875 border">
                                <div id="widgetHeading20" class="widget-head">
                                    <a class="d-flex align-items-center justify-content-between text-dark" href="#"
                                       data-toggle="collapse"
                                       data-target="#widgetCollapse20"
                                       aria-expanded="true"
                                       aria-controls="widgetCollapse20">

                                        <h3 class="widget-title mb-0 font-weight-medium font-size-3">Subjects</h3>

                                        <svg class="mins" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" height="2px">
                                            <path fill-rule="evenodd" fill="rgb(22, 22, 25)" d="M0.000,-0.000 L15.000,-0.000 L15.000,2.000 L0.000,2.000 L0.000,-0.000 Z" />
                                        </svg>

                                        <svg class="plus" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" height="15px">
                                            <path fill-rule="evenodd" fill="rgb(22, 22, 25)" d="M15.000,8.000 L9.000,8.000 L9.000,15.000 L7.000,15.000 L7.000,8.000 L0.000,8.000 L0.000,6.000 L7.000,6.000 L7.000,-0.000 L9.000,-0.000 L9.000,6.000 L15.000,6.000 L15.000,8.000 Z" />
                                        </svg>
                                    </a>
                                </div>

                                <div id="widgetCollapse20" class="mt-4 widget-content collapse show"
                                     aria-labelledby="widgetHeading20"
                                >
                                    <select  name="subjects[]" id="subjects[]" class="border border-gray-200 rounded p-2 w-full" multiple multiselect-search="true">
                                        @foreach($subjects as $subject)
                                            <option value="{{$subject->title}}"
                                                    @if(request('subjects'))
                                                    @foreach(request('subjects') as $subjectSelected)
                                                    @if($subject->title == $subjectSelected) selected @endif
                                                @endforeach
                                                @endif
                                            >{{$subject->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div id="Authors" class="widget widget_search widget_author p-4d875 border">
                                <div id="widgetHeading21" class="widget-head">
                                    <a class="d-flex align-items-center justify-content-between text-dark" href="#"
                                       data-toggle="collapse"
                                       data-target="#widgetCollapse21"
                                       aria-expanded="true"
                                       aria-controls="widgetCollapse21">

                                        <h3 class="widget-title mb-0 font-weight-medium font-size-3">Author</h3>

                                        <svg class="mins" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" height="2px">
                                            <path fill-rule="evenodd" fill="rgb(22, 22, 25)" d="M0.000,-0.000 L15.000,-0.000 L15.000,2.000 L0.000,2.000 L0.000,-0.000 Z" />
                                        </svg>

                                        <svg class="plus" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" height="15px">
                                            <path fill-rule="evenodd" fill="rgb(22, 22, 25)" d="M15.000,8.000 L9.000,8.000 L9.000,15.000 L7.000,15.000 L7.000,8.000 L0.000,8.000 L0.000,6.000 L7.000,6.000 L7.000,-0.000 L9.000,-0.000 L9.000,6.000 L15.000,6.000 L15.000,8.000 Z" />
                                        </svg>
                                    </a>
                                </div>

                                <div id="widgetCollapse21" class="mt-4 widget-content collapse show"
                                     aria-labelledby="widgetHeading21"
                                >
                                    <select  name="authors[]" id="authors[]" class="border border-gray-200 rounded p-2 w-full" multiple multiselect-search="true">
                                        @foreach($authors as $author)
                                            <option value="{{$author->fullname}}"
                                                    @if(request('authors'))
                                                    @foreach(request('authors') as $authorSelected)
                                                    @if($author->fullname == $authorSelected) selected @endif
                                                @endforeach
                                                @endif
                                            >{{$author->fullname}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div id="Format" class="widget p-4d875 border">
                                <div id="widgetHeading23" class="widget-head">
                                    <a class="d-flex align-items-center justify-content-between text-dark" href="#"
                                       data-toggle="collapse"
                                       data-target="#widgetCollapse23"
                                       aria-expanded="true"
                                       aria-controls="widgetCollapse23">

                                        <h3 class="widget-title mb-0 font-weight-medium font-size-3">Format</h3>

                                        <svg class="mins" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" height="2px">
                                            <path fill-rule="evenodd" fill="rgb(22, 22, 25)" d="M0.000,-0.000 L15.000,-0.000 L15.000,2.000 L0.000,2.000 L0.000,-0.000 Z" />
                                        </svg>

                                        <svg class="plus" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" height="15px">
                                            <path fill-rule="evenodd" fill="rgb(22, 22, 25)" d="M15.000,8.000 L9.000,8.000 L9.000,15.000 L7.000,15.000 L7.000,8.000 L0.000,8.000 L0.000,6.000 L7.000,6.000 L7.000,-0.000 L9.000,-0.000 L9.000,6.000 L15.000,6.000 L15.000,8.000 Z" />
                                        </svg>
                                    </a>
                                </div>

                                <div id="widgetCollapse23" class="mt-3 widget-content collapse show"
                                     aria-labelledby="widgetHeading23"
                                >
                                    <select  name="type[]" id="type[]" class="border border-gray-200 rounded p-2 w-full" multiple multiselect-search="false">
                                        <option value="{{Item::type_Book}}" @if(request('type') === Item::type_Book) selected @endif>{{Item::type_Book}}</option>
                                        <option value="{{Item::type_OldBook}}" @if(request('type') === Item::type_OldBook) selected @endif>{{Item::type_OldBook}}</option>
                                        <option value="{{Item::type_Map}}" @if(request('type') === Item::type_Map) selected @endif>{{Item::type_Map}}</option>
                                        <option value="{{Item::type_Manuscript}}" @if(request('type') === Item::type_Manuscript) selected @endif>{{Item::type_Manuscript}}</option>
                                        <option value="{{Item::type_Periodic}}" @if(request('type') === Item::type_Periodic) selected @endif>{{Item::type_Periodic}}</option>
                                    </select>

                                </div>
                            </div>
                    </form>
                        <div id="Language" class="widget p-4d875 border">
                            <div id="widgetHeading22" class="widget-head">
                                <a class="d-flex align-items-center justify-content-between text-dark" href="#"
                                   data-toggle="collapse"
                                   data-target="#widgetCollapse22"
                                   aria-expanded="true"
                                   aria-controls="widgetCollapse22">

                                    <h3 class="widget-title mb-0 font-weight-medium font-size-3">Language</h3>

                                    <svg class="mins" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" height="2px">
                                        <path fill-rule="evenodd" fill="rgb(22, 22, 25)" d="M0.000,-0.000 L15.000,-0.000 L15.000,2.000 L0.000,2.000 L0.000,-0.000 Z" />
                                    </svg>

                                    <svg class="plus" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" height="15px">
                                        <path fill-rule="evenodd" fill="rgb(22, 22, 25)" d="M15.000,8.000 L9.000,8.000 L9.000,15.000 L7.000,15.000 L7.000,8.000 L0.000,8.000 L0.000,6.000 L7.000,6.000 L7.000,-0.000 L9.000,-0.000 L9.000,6.000 L15.000,6.000 L15.000,8.000 Z" />
                                    </svg>
                                </a>
                            </div>

                            <div id="widgetCollapse22" class="mt-4 widget-content collapse show"
                                 aria-labelledby="widgetHeading22"
                            >
                                <ul class="product-categories">
                                    <li class="custom-control custom-checkbox mb-2 pb-2">
                                        <input type="checkbox" class="custom-control-input" id="brandEnglish">
                                        <label class="custom-control-label" for="brandEnglish">English</label>
                                    </li>
                                    <li class="custom-control custom-checkbox mb-2 pb-2">
                                        <input type="checkbox" class="custom-control-input" id="brandGerman">
                                        <label class="custom-control-label" for="brandGerman">German</label>
                                    </li>
                                    <li class="custom-control custom-checkbox mb-2 pb-2">
                                        <input type="checkbox" class="custom-control-input" id="brandFrench">
                                        <label class="custom-control-label" for="brandFrench">French</label>
                                    </li>
                                    <li class="custom-control custom-checkbox mb-2 pb-2">
                                        <input type="checkbox" class="custom-control-input" id="brandSpanish">
                                        <label class="custom-control-label" for="brandSpanish">Spanish</label>
                                    </li>
                                    <li class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="brandTurkish">
                                        <label class="custom-control-label" for="brandTurkish">Turkish</label>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div id="woocommerce_price_filter-2" class="widget p-4d875 border woocommerce widget_price_filter">
                            <div id="widgetHeadingTwo" class="widget-head">
                                <a class="d-flex align-items-center justify-content-between text-dark" href="#"
                                   data-toggle="collapse"
                                   data-target="#widgetCollapseTwo"
                                   aria-expanded="true"
                                   aria-controls="widgetCollapseTwo">

                                    <h3 class="widget-title mb-0 font-weight-medium font-size-3">Filter by price</h3>

                                    <svg class="mins" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" height="2px">
                                        <path fill-rule="evenodd" fill="rgb(22, 22, 25)" d="M0.000,-0.000 L15.000,-0.000 L15.000,2.000 L0.000,2.000 L0.000,-0.000 Z" />
                                    </svg>

                                    <svg class="plus" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" height="15px">
                                        <path fill-rule="evenodd" fill="rgb(22, 22, 25)" d="M15.000,8.000 L9.000,8.000 L9.000,15.000 L7.000,15.000 L7.000,8.000 L0.000,8.000 L0.000,6.000 L7.000,6.000 L7.000,-0.000 L9.000,-0.000 L9.000,6.000 L15.000,6.000 L15.000,8.000 Z" />
                                    </svg>
                                </a>
                            </div>

                            <div id="widgetCollapseTwo" class="mt-4 widget-content collapse show"
                                 aria-labelledby="widgetHeadingTwo"
                            >
                                <form method="get" action="https://themes.woocommerce.com/storefront/shop/">
                                    <div class="price_slider_wrapper">
                                        <div class="price_slider ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" style=""><div class="ui-slider-range ui-widget-header ui-corner-all" style="left: 0%; width: 100%;"></div><span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0" style="left: 0%;"></span><span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0" style="left: 98%;"></span></div>
                                        <div class="price_slider_amount">
                                            <input type="text" id="min_price" name="min_price" value="2" data-min="2" placeholder="Min price" style="display: none;">
                                            <input type="text" id="max_price" name="max_price" value="1495" data-max="1495" placeholder="Max price" style="display: none;">
                                            <button type="submit" class="button d-none">Filter</button>
                                            <div class="mx-auto price_label mt-2" style="">
                                                Price: <span class="from">£2</span> — <span class="to">£1,495</span>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div id="Review" class="widget p-4d875 border">
                            <div id="widgetHeading24" class="widget-head">
                                <a class="d-flex align-items-center justify-content-between text-dark" href="#"
                                   data-toggle="collapse"
                                   data-target="#widgetCollapse24"
                                   aria-expanded="true"
                                   aria-controls="widgetCollapse24">

                                    <h3 class="widget-title mb-0 font-weight-medium font-size-3">By Review</h3>

                                    <svg class="mins" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" height="2px">
                                        <path fill-rule="evenodd" fill="rgb(22, 22, 25)" d="M0.000,-0.000 L15.000,-0.000 L15.000,2.000 L0.000,2.000 L0.000,-0.000 Z" />
                                    </svg>

                                    <svg class="plus" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" height="15px">
                                        <path fill-rule="evenodd" fill="rgb(22, 22, 25)" d="M15.000,8.000 L9.000,8.000 L9.000,15.000 L7.000,15.000 L7.000,8.000 L0.000,8.000 L0.000,6.000 L7.000,6.000 L7.000,-0.000 L9.000,-0.000 L9.000,6.000 L15.000,6.000 L15.000,8.000 Z" />
                                    </svg>
                                </a>
                            </div>

                            <div id="widgetCollapse24" class="mt-4 widget-content collapse show"
                                 aria-labelledby="widgetHeading24"
                                 data-parent="#widgetAccordion">
                                <div class="form-group d-flex align-items-center justify-content-between font-size-1 text-lh-md text-secondary mb-2 pb-1">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="rating5">
                                        <label class="custom-control-label" for="rating5">
                                            <span class="d-block text-yellow-darker mt-plus-3">
                                            <span class="fas fa-star font-size-2 mr-1"></span>
                                            <span class="fas fa-star font-size-2 mr-1"></span>
                                            <span class="fas fa-star font-size-2 mr-1"></span>
                                            <span class="fas fa-star font-size-2 mr-1"></span>
                                            <span class="fas fa-star font-size-2 "></span>
                                          </span>
                                        </label>
                                    </div>
                                    <small class="font-size-2 text-gray-600">24</small>
                                </div>
                                <div class="form-group d-flex align-items-center justify-content-between font-size-1 text-lh-md text-secondary mb-2 pb-1">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="rating4">
                                        <label class="custom-control-label" for="rating4">
                                            <span class="d-block text-yellow-darker mt-plus-3">
                                            <span class="fas fa-star font-size-2 mr-1"></span>
                                            <span class="fas fa-star font-size-2 mr-1"></span>
                                            <span class="fas fa-star font-size-2 mr-1"></span>
                                            <span class="fas fa-star font-size-2 mr-1"></span>
                                            <span class="far fa-star font-size-2 "></span>
                                          </span>
                                        </label>
                                    </div>
                                    <small class="font-size-2 text-gray-600">15</small>
                                </div>
                                <div class="form-group d-flex align-items-center justify-content-between font-size-1 text-lh-md text-secondary mb-2 pb-1">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="rating3">
                                        <label class="custom-control-label" for="rating3">
                                            <span class="d-block text-yellow-darker mt-plus-3">
                                            <span class="fas fa-star font-size-2 mr-1"></span>
                                            <span class="fas fa-star font-size-2 mr-1"></span>
                                            <span class="fas fa-star font-size-2 mr-1"></span>
                                            <span class="far fa-star font-size-2 mr-1"></span>
                                            <span class="far fa-star font-size-2 "></span>
                                          </span>
                                        </label>
                                    </div>
                                    <small class="font-size-2 text-gray-600">43</small>
                                </div>
                                <div class="form-group d-flex align-items-center justify-content-between font-size-1 text-lh-md text-secondary mb-2 pb-1">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="rating2">
                                        <label class="custom-control-label" for="rating2">
                                            <span class="d-block text-yellow-darker mt-plus-3">
                                            <span class="fas fa-star font-size-2 mr-1"></span>
                                            <span class="fas fa-star font-size-2 mr-1"></span>
                                            <span class="far fa-star font-size-2 mr-1"></span>
                                            <span class="far fa-star font-size-2 mr-1"></span>
                                            <span class="far fa-star font-size-2"></span>
                                          </span>
                                        </label>
                                    </div>
                                    <small class="font-size-2 text-gray-600">78</small>
                                </div>
                                <div class="form-group d-flex align-items-center justify-content-between font-size-1 text-lh-md text-secondary mb-0">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="rating1">
                                        <label class="custom-control-label" for="rating1">
                                            <span class="d-block text-yellow-darker mt-plus-3">
                                            <span class="fas fa-star font-size-2 mr-1"></span>
                                            <span class="far fa-star font-size-2 mr-1"></span>
                                            <span class="far fa-star font-size-2 mr-1"></span>
                                            <span class="far fa-star font-size-2 mr-1"></span>
                                            <span class="far fa-star font-size-2"></span>
                                          </span>
                                        </label>
                                    </div>
                                    <small class="font-size-2 text-gray-600">21</small>
                                </div>
                            </div>
                        </div>

                        <div id="Featuredbooks" class="widget p-4d875 border">
                            <div id="widgetHeading25" class="widget-head">
                                <a class="d-flex align-items-center justify-content-between text-dark" href="#"
                                   data-toggle="collapse"
                                   data-target="#widgetCollapse25"
                                   aria-expanded="true"
                                   aria-controls="widgetCollapse25">

                                    <h3 class="widget-title mb-0 font-weight-medium font-size-3">Featured Books</h3>

                                    <svg class="mins" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" height="2px">
                                        <path fill-rule="evenodd" fill="rgb(22, 22, 25)" d="M0.000,-0.000 L15.000,-0.000 L15.000,2.000 L0.000,2.000 L0.000,-0.000 Z" />
                                    </svg>

                                    <svg class="plus" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" height="15px">
                                        <path fill-rule="evenodd" fill="rgb(22, 22, 25)" d="M15.000,8.000 L9.000,8.000 L9.000,15.000 L7.000,15.000 L7.000,8.000 L0.000,8.000 L0.000,6.000 L7.000,6.000 L7.000,-0.000 L9.000,-0.000 L9.000,6.000 L15.000,6.000 L15.000,8.000 Z" />
                                    </svg>
                                </a>
                            </div>

                            <div id="widgetCollapse25" class="mt-5 widget-content collapse show"
                                 aria-labelledby="widgetHeading25"
                                 data-parent="#widgetAccordion">
                                <div class="mb-5">
                                    <div class="media d-md-flex">
                                        <a class="d-block" href="../shop/single-product-v6.html">
                                            <img class="img-fluid" src="https://placehold.it/60x92" alt="Image-Description">
                                        </a>
                                        <div class="media-body ml-3 pl-1">
                                            <h6 class="font-size-2 text-lh-md font-weight-normal">
                                                <a href="../shop/single-product-v6.html">Lessons Learned from  15 Years as CEO...</a>
                                            </h6>
                                            <span class="font-weight-medium">$37</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-5">
                                    <div class="media d-md-flex">
                                        <a class="d-block" href="../shop/single-product-v6.html">
                                            <img class="img-fluid" src="https://placehold.it/60x92" alt="Image-Description">
                                        </a>
                                        <div class="media-body ml-3 pl-1">
                                            <h6 class="font-size-2 text-lh-md font-weight-normal">
                                                <a href="../shop/single-product-v6.html">Love, Livestock, and Big Life Lessons...</a>
                                            </h6>
                                            <span class="font-weight-medium">$21</span>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="media d-md-flex">
                                        <a class="d-block" href="../shop/single-product-v6.html">
                                            <img class="img-fluid" src="https://placehold.it/60x92" alt="Image-Description">
                                        </a>
                                        <div class="media-body ml-3 pl-1">
                                            <h6 class="font-size-2 text-lh-md font-weight-normal">
                                                <a href="../shop/single-product-v6.html">Sleeper Cells, Ghost Stories, and Hunt...</a>
                                            </h6>
                                            <span class="font-weight-medium">$182</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ====== END MAIN CONTENT ====== -->

    <!-- ========== FOOTER ========== -->

@endsection
