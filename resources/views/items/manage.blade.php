@php
    use App\Models\Item;
@endphp
@extends('layouts.layout-index')
@section('content')
    <!-- ====== MAIN CONTENT ====== -->
    <div class="page-header border-bottom mb-8">
        <div class="container">
            <div class="d-md-flex justify-content-between align-items-center py-4">
                <h1 class="page-title font-size-3 font-weight-medium m-0 text-lh-lg text-info">Manage Inactive Items</h1>
                <nav class="woocommerce-breadcrumb font-size-2">
                    <a href="../home/index.html" class="h-primary">Home</a>
                    <span class="breadcrumb-separator mx-1"><i class="fas fa-angle-right"></i></span>
                    <a href="../shop/v6.html" class="h-primary">Electronics</a>
                    <span class="breadcrumb-separator mx-1"><i class="fas fa-angle-right"></i></span>
                    <a href="../shop/v6.html" class="h-primary">Cameras</a>
                    <span class="breadcrumb-separator mx-1"><i class="fas fa-angle-right"></i></span>Build Your DSLR
                </nav>
            </div>
        </div>
    </div>
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
                                    <option value="asc" @if(request('sortBy') == null || request('sortBy') == 'asc') selected @endif>Asc</option>
                                    <option value="desc"@if(request('sortBy') == 'desc') selected @endif>Desc</option>
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
                    <div id="widgetAccordion">

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


                        <div id="Language" class="widget p-4d875 border">
                            <div id="widgetHeading23" class="widget-head">
                                <a class="d-flex align-items-center justify-content-between text-dark" href="#"
                                   data-toggle="collapse"
                                   data-target="#widgetCollapse23"
                                   aria-expanded="true"
                                   aria-controls="widgetCollapse23">

                                    <h3 class="widget-title mb-0 font-weight-medium font-size-3">Language</h3>

                                    <svg class="mins" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" height="2px">
                                        <path fill-rule="evenodd" fill="rgb(22, 22, 25)" d="M0.000,-0.000 L15.000,-0.000 L15.000,2.000 L0.000,2.000 L0.000,-0.000 Z" />
                                    </svg>

                                    <svg class="plus" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" height="15px">
                                        <path fill-rule="evenodd" fill="rgb(22, 22, 25)" d="M15.000,8.000 L9.000,8.000 L9.000,15.000 L7.000,15.000 L7.000,8.000 L0.000,8.000 L0.000,6.000 L7.000,6.000 L7.000,-0.000 L9.000,-0.000 L9.000,6.000 L15.000,6.000 L15.000,8.000 Z" />
                                    </svg>
                                </a>
                            </div>

                            <div id="widgetCollapse23" class="mt-4 widget-content collapse show"
                                 aria-labelledby="widgetHeading23"
                            >
                                <div class="input-group flex-nowrap w-100">
                                    <div class="input-group-prepend">
                                        <i class="glph-icon flaticon-loupe py-2d75 bg-white-100 border-white-100 text-dark pl-3 pr-0 rounded-0"></i>
                                    </div>
                                    <input name="language" class="form-control bg-white-100 py-2d75 height-4 border-white-100 rounded-0" type="search" value="{{request('language') ?? ''}}" placeholder="Ex: Romanian" aria-label="Search">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- ====== END MAIN CONTENT ====== -->

    <!-- ========== FOOTER ========== -->

@endsection
