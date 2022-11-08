
@extends('layouts.layout-index')
@section('title', __('browse')['browse authors'])

@section('content')
    <div class="page-header border-bottom mb-8">
        <div class="container">
            <div class="d-md-flex justify-content-between align-items-center py-4">
                <h1 class="page-title font-size-3 font-weight-medium m-0 text-lh-lg">{{__('browse')['browse authors']}}</h1>
                {{--                Breadcrumbs--}}
                <nav class="woocommerce-breadcrumb font-size-2">
                    <a href="{{route('home')}}" class="h-primary">{{__('home')}}</a>
                    <span class="breadcrumb-separator mx-1"><i class="fas fa-angle-right"></i></span>
                    <span>{{__('browse')['browse authors']}}</span>
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
{{--                                Pagination Details--}}
                                <p class="woocommerce-result-count m-0">
                                    {!! __('pagination')['showing'] !!}
                                    <span>{{ $authors->firstItem() }}</span>
                                    {!! __('pagination')['to'] !!}
                                    <span>{{ $authors->lastItem() }}</span>
                                    {!! __('pagination')['of'] !!}
                                    <span>{{ $authors->total() }}</span>
                                    {!! __('pagination')['results'] !!}
                                </p>
                            </div>
                            <div class="shop-control-bar__right d-md-flex align-items-center">
{{--                                Sort Select--}}
                                <label for="sortBy" hidden>{{__('sort')['sort']}}</label>
                                <select name="sortBy" id="sortBy" onchange="this.form.submit()" class="js-select selectpicker dropdown-select sortby"
                                        data-style="border-bottom shadow-none outline-none py-2">
                                    <option value="latest" @if(request('sortBy') === 'latest') selected @endif>{{__('sort')['latest']}}</option>
                                    <option value="asc" @if(request('sortBy') == null || request('sortBy') == 'asc') selected @endif>{{__('sort')['asc']}}</option>
                                    <option value="desc" @if(request('sortBy') == 'desc') selected @endif>{{__('sort')['desc']}}</option>
                                </select>
{{--                                Order Select--}}
                                <label for="orderBy" hidden>{{__('order')['order']}}</label>
                                <select id="orderBy" name="orderBy" onchange="this.form.submit()" class="js-select selectpicker dropdown-select orderby"
                                        data-style="border-bottom shadow-none outline-none py-2"
                                        data-width="fit">
                                    <option value="10" @if($authors->perPage() == 10) selected @endif>{{__('show')}} 10</option>
                                    <option value="15" @if($authors->perPage() == 15) selected @endif>{{__('show')}} 15</option>
                                    <option value="20" @if($authors->perPage() == 20) selected @endif>{{__('show')}} 20</option>
                                    <option value="25" @if($authors->perPage() == 25) selected @endif>{{__('show')}} 25</option>
                                    <option value="30" @if($authors->perPage() == 30) selected @endif>{{__('show')}} 30</option>
                                </select>
                                <ul class="nav nav-tab ml-lg-4 justify-content-center justify-content-md-start ml-md-auto" id="pills-tab" role="tablist">
                                    <li class="nav-item border">
                                        <a class="nav-link p-0 height-38 width-38 justify-content-center d-flex align-items-center" id="pills-two-tab" data-toggle="pill" href="#pills-two" role="tab" aria-controls="pills-two" aria-selected="true">
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
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-two" role="tabpanel" aria-labelledby="pills-two-tab">
    {{--                                Individual Collection Card components: 'collection-list-card'--}}
                                <ul class="products list-unstyled mb-6">
                                    @forelse($authors as $author)
                                        <li class="product product__list">
                                            <x-authors.author-list-card :author="$author"></x-authors.author-list-card>
                                        </li>
                                    @empty
                                        {{__('no results')}}
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    {{ $authors->links('vendor.pagination.bootstrap-5') }}
                </div>
                {{--                Search Accordion--}}
                <div id="secondary" class="sidebar widget-area order-1" role="complementary">
                    <div id="widgetAccordion">
{{--                        Title Search--}}
                        <div id="titleTab" class="widget p-4d875 border woocommerce widget_product_categories">
                            <div id="widgetHeadingOne" class="widget-head">
                                <a class="d-flex align-items-center justify-content-between text-dark" href="#"
                                   data-toggle="collapse"
                                   data-target="#widgetCollapseOne"
                                   aria-expanded="true"
                                   aria-controls="widgetCollapseOne">
                                    <h3 class="widget-title mb-0 font-weight-medium font-size-3">{{__('authors')['fullname']}}</h3>
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
                                    <input name="search" class="form-control bg-white-100 py-2d75 height-5 border-white-100 rounded-0" type="search" value="{{request('search') ?? ''}}" placeholder="Ex: Floare Albastra" aria-label="Search">
                                </div>
                                <button class="btn btn-outline-primary mt-2 btn-sm" type="submit">{{__('search')}}</button>
                            </div>
                        </div>
{{--                        Subjects Search--}}
                        <div id="subjectsTab" class="widget widget_search widget_author p-4d875 border">
                            <div id="widgetHeadingTwo" class="widget-head">
                                <a class="d-flex align-items-center justify-content-between text-dark" href="#"
                                   data-toggle="collapse"
                                   data-target="#widgetCollapseTwo"
                                   aria-expanded="true"
                                   aria-controls="widgetCollapseTwo">
                                    <h3 class="widget-title mb-0 font-weight-medium font-size-3">{{__('subjects')['subjects']}}</h3>
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
                                <div class="input-group flex-nowrap w-100">
                                    <div class="input-group-prepend">
                                        <i class="glph-icon flaticon-loupe py-2d75 bg-white-100 border-white-100 text-dark pl-3 pr-0 rounded-0"></i>
                                    </div>
                                    <input name="subjects" class="form-control bg-white-100 py-2d75 height-5 border-white-100 rounded-0" type="search" value="{{request('subjects') ?? ''}}" placeholder="Ex: Istorie" aria-label="Search">
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
