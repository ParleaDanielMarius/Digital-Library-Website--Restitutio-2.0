@php
    use App\Models\Item;
@endphp
@extends('layouts.layout-index')
@section('title', __('browse')['browse items'])
@section('content')
<div class="page-header border-bottom mb-8">
    <div class="container">
        <div class="d-md-flex justify-content-between align-items-center py-4">
            <h1 class="page-title font-size-3 font-weight-medium m-0 text-lh-lg">{{__('browse')['browse items']}}</h1>
{{--            Breadcrumbs--}}
            <nav class="woocommerce-breadcrumb font-size-2">
                <a href="{{route('home')}}" class="h-primary">{{__('home')}}</a>
                <span class="breadcrumb-separator mx-1"><i class="fas fa-angle-right"></i></span>
                <span>{{__('browse')['browse items']}}</span>
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
{{--                        Pagination details--}}
                        <p class="woocommerce-result-count m-0">
                            {!! __('pagination')['showing'] !!}
                            <span>{{ $items->firstItem() }}</span>
                            {!! __('pagination')['to'] !!}
                            <span>{{ $items->lastItem() }}</span>
                            {!! __('pagination')['of'] !!}
                            <span>{{ $items->total() }}</span>
                            {!! __('pagination')['results'] !!}
                        </p>
                    </div>
                    <div class="shop-control-bar__right d-md-flex align-items-center">
{{--                            Sort Select--}}
                        <label for="sortBy" hidden>{{__('sort')['sort']}}</label>
                            <select id="sortBy" name="sortBy" onchange="this.form.submit()" class="js-select selectpicker dropdown-select sortby"
                                    data-style="border-bottom shadow-none outline-none py-2">
                                <option value="latest" @if(request('sortBy') === 'latest') selected @endif>{{__('sort')['latest']}}</option>
                                <option value="asc" @if(request('sortBy') == null || request('sortBy') == 'asc') selected @endif>{{__('sort')['asc']}}</option>
                                <option value="desc" @if(request('sortBy') == 'desc') selected @endif>{{__('sort')['desc']}}</option>
                            </select>
{{--                            Order Select--}}
                        <label for="orderBy" hidden>{{__('order')['order']}}</label>
                            <select id="orderBy" name="orderBy" onchange="this.form.submit()" class="js-select selectpicker dropdown-select orderby"
                                    data-style="border-bottom shadow-none outline-none py-2"
                                    data-width="fit">
                                <option value="10" @if($items->perPage() == 10) selected @endif>{{__('show')}} 10</option>
                                <option value="15" @if($items->perPage() == 15) selected @endif>{{__('show')}} 15</option>
                                <option value="20" @if($items->perPage() == 20) selected @endif>{{__('show')}} 20</option>
                                <option value="25" @if($items->perPage() == 25) selected @endif>{{__('show')}} 25</option>
                                <option value="30" @if($items->perPage() == 30) selected @endif>{{__('show')}} 30</option>
                            </select>
                        <ul class="nav nav-tab ml-lg-4 justify-content-center justify-content-md-start ml-md-auto" id="pills-tab" role="tablist">
                            <li class="nav-item border">
                                <a class="nav-link p-0 height-38 width-38 justify-content-center d-flex align-items-center active" id="pills-one-tab" data-toggle="pill" href="#pills-one" role="tab" aria-controls="pills-one" aria-selected="true">
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
                                <a class="nav-link p-0 height-38 width-38 justify-content-center d-flex align-items-center" id="pills-two-tab" data-toggle="pill" href="#pills-two" role="tab" aria-controls="pills-two" aria-selected="false">
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
                    <div class="tab-pane fade show active" id="pills-one" role="tabpanel" aria-labelledby="pills-one-tab">
{{--                        Individual Item Card (GRID) component: 'item-card'--}}
                        <ul class="products list-unstyled row no-gutters row-cols-2 row-cols-lg-3 row-cols-wd-5 border-top border-left mb-6">
                            @forelse($items as $item)
                            <li class="product col">
                                <x-items.item-card :item="$item"></x-items.item-card>
                            </li>
                            @empty
                                {{__('no results')}}
                            @endforelse
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="pills-two" role="tabpanel" aria-labelledby="pills-two-tab">
{{--                        Individual Item Card (LIST) component: 'item-list-card'--}}
                        <ul class="products list-unstyled mb-6">
                            @forelse($items as $item)
                                <li class="product product__list">
                                    <x-items.item-list-card :item="$item"></x-items.item-list-card>
                                </li>
                            @empty
                            {{__('no results')}}
                            @endforelse
                        </ul>
                    </div>
                </div>
                {{ $items->links('vendor.pagination.bootstrap-5') }}
            </div>
{{--            Search Accordion--}}
            <div id="secondary" class="sidebar widget-area order-1" role="complementary">
                <div id="widgetAccordion">
{{--                    Title Search--}}
                    <div id="titleTab" class="widget p-4d875 border woocommerce widget_product_categories">
                        <div id="widgetHeadingOne" class="widget-head">
                            <a class="d-flex align-items-center justify-content-between text-dark" href="#"
                               data-toggle="collapse"
                               data-target="#widgetCollapseOne"
                               aria-expanded="true"
                               aria-controls="widgetCollapseOne">
                                <h3 class="widget-title mb-0 font-weight-medium font-size-3">{{__('items')['title']}}</h3>
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
{{--                    Subjects Search--}}
                    <div id="subjectsTab" class="widget widget_search widget_author p-4d875 border">
                        <div id="widgetHeading20" class="widget-head">
                            <a class="d-flex align-items-center justify-content-between text-dark" href="#"
                               data-toggle="collapse"
                               data-target="#widgetCollapse20"
                               aria-expanded="true"
                               aria-controls="widgetCollapse20">
                                <h3 class="widget-title mb-0 font-weight-medium font-size-3">{{__('subjects')['subjects']}}</h3>
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
                            <div class="input-group flex-nowrap w-100">
                                <div class="input-group-prepend">
                                    <i class="glph-icon flaticon-loupe py-2d75 bg-white-100 border-white-100 text-dark pl-3 pr-0 rounded-0"></i>
                                </div>
                            <input name="subjects" class="form-control bg-white-100 py-2d75 height-5 border-white-100 rounded-0" type="search" value="{{request('subjects') ?? ''}}" placeholder="Ex: History, Politics" aria-label="Search">
                        </div>
                    </div>
                    </div>
{{--                    Authors Search--}}
                    <div id="authorsTab" class="widget widget_search widget_author p-4d875 border">
                        <div id="widgetHeading21" class="widget-head">
                            <a class="d-flex align-items-center justify-content-between text-dark" href="#"
                               data-toggle="collapse"
                               data-target="#widgetCollapse21"
                               aria-expanded="true"
                               aria-controls="widgetCollapse21">
                                <h3 class="widget-title mb-0 font-weight-medium font-size-3">{{__('authors')['authors']}}</h3>
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
                            <div class="input-group flex-nowrap w-100">
                                <div class="input-group-prepend">
                                    <i class="glph-icon flaticon-loupe py-2d75 bg-white-100 border-white-100 text-dark pl-3 pr-0 rounded-0"></i>
                                </div>
                            <input name="authors" class="form-control bg-white-100 py-2d75 height-5 border-white-100 rounded-0" type="search" value="{{request('authors') ?? ''}}" placeholder="Ex: Eminescu, Eliade" aria-label="Search">
                        </div>
                    </div>
                    </div>
{{--                    Language Search--}}
                    <div id="languageTab" class="widget p-4d875 border">
                        <div id="widgetHeading23" class="widget-head">
                            <a class="d-flex align-items-center justify-content-between text-dark" href="#"
                               data-toggle="collapse"
                               data-target="#widgetCollapse23"
                               aria-expanded="true"
                               aria-controls="widgetCollapse23">
                                <h3 class="widget-title mb-0 font-weight-medium font-size-3">{{__('items')['language']}}</h3>
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
                                <input name="language" class="form-control bg-white-100 py-2d75 height-5 border-white-100 rounded-0" type="search" value="{{request('language') ?? ''}}" placeholder="Ex: Romanian" aria-label="Search">
                            </div>
                        </div>
                    </div>
{{--                    Year Search--}}
                    <div id="yearTab" class="widget widget_search widget_author p-4d875 border">
                        <div id="widgetHeading24" class="widget-head">
                            <a class="d-flex align-items-center justify-content-between text-dark" href="#"
                               data-toggle="collapse"
                               data-target="#widgetCollapse24"
                               aria-expanded="true"
                               aria-controls="widgetCollapse24">
                                <h3 class="widget-title mb-0 font-weight-medium font-size-3">{{__('items')['publisher_year']}}</h3>
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
                        >
                            <div class="input-group flex-nowrap">
                                <input name="year_from" min="1800" max="2500" class="form-control bg-white-100 py-2d75 height-5 border-white-100 rounded-0" type="number" value="{{request('year_from') ?? ''}}" placeholder="{{__('from')}}" aria-label="year_from">
                                <div class="input-group-prepend">
                                    <i class="glph-icon flaticon-arrow py-2d75 bg-white-100 border-white-100 text-dark pr-0 rounded-0"></i>
                                </div>
                                <input name="year_to" min="1800" max="2500" class="form-control bg-white-100 py-2d75 height-5 border-white-100 rounded-0" type="number" value="{{request('year_to') ?? ''}}" placeholder="{{__('to')}}" aria-label="year_to">
                            </div>
                        </div>
                    </div>
{{--                    Month Search--}}
                    <div id="monthTab" class="widget widget_search widget_author p-4d875 border">
                        <div id="widgetHeading25" class="widget-head">
                            <a class="d-flex align-items-center justify-content-between text-dark" href="#"
                               data-toggle="collapse"
                               data-target="#widgetCollapse25"
                               aria-expanded="true"
                               aria-controls="widgetCollapse25">
                                <h3 class="widget-title mb-0 font-weight-medium font-size-3">{{__('items')['publisher_month']}}</h3>
                                <svg class="mins" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" height="2px">
                                    <path fill-rule="evenodd" fill="rgb(22, 22, 25)" d="M0.000,-0.000 L15.000,-0.000 L15.000,2.000 L0.000,2.000 L0.000,-0.000 Z" />
                                </svg>
                                <svg class="plus" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" height="15px">
                                    <path fill-rule="evenodd" fill="rgb(22, 22, 25)" d="M15.000,8.000 L9.000,8.000 L9.000,15.000 L7.000,15.000 L7.000,8.000 L0.000,8.000 L0.000,6.000 L7.000,6.000 L7.000,-0.000 L9.000,-0.000 L9.000,6.000 L15.000,6.000 L15.000,8.000 Z" />
                                </svg>
                            </a>
                        </div>
                        <div id="widgetCollapse25" class="mt-4 widget-content collapse show"
                             aria-labelledby="widgetHeading25"
                        >
                            <div class="input-group flex-nowrap">
                                <input name="month_from" type="number" min="01" max="12" class="form-control bg-white-100 py-2d75 height-5 border-white-100 rounded-0" value="{{request('month_from') ?? ''}}" placeholder="{{__('from')}}" aria-label="month_from">
                                <div class="input-group-prepend">
                                    <i class="glph-icon flaticon-arrow py-2d75 bg-white-100 border-white-100 text-dark pr-0 rounded-0"></i>
                                </div>
                                <input name="month_to" type="number" min="01" max="12" class="form-control bg-white-100 py-2d75 height-5 border-white-100 rounded-0" value="{{request('month_to') ?? ''}}" placeholder="{{__('to')}}" aria-label="month_to">
                            </div>
                        </div>
                    </div>
{{--                    Format Search--}}
                    <div id="formatTab" class="widget p-4d875 border">
                        <div id="widgetHeading22" class="widget-head">
                            <a class="d-flex align-items-center justify-content-between text-dark" href="#"
                               data-toggle="collapse"
                               data-target="#widgetCollapse22"
                               aria-expanded="true"
                               aria-controls="widgetCollapse22">
                                <h3 class="widget-title mb-0 font-weight-medium font-size-3">{{__('items')['type']}}</h3>
                                <svg class="mins" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" height="2px">
                                    <path fill-rule="evenodd" fill="rgb(22, 22, 25)" d="M0.000,-0.000 L15.000,-0.000 L15.000,2.000 L0.000,2.000 L0.000,-0.000 Z" />
                                </svg>
                                <svg class="plus" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" height="15px">
                                    <path fill-rule="evenodd" fill="rgb(22, 22, 25)" d="M15.000,8.000 L9.000,8.000 L9.000,15.000 L7.000,15.000 L7.000,8.000 L0.000,8.000 L0.000,6.000 L7.000,6.000 L7.000,-0.000 L9.000,-0.000 L9.000,6.000 L15.000,6.000 L15.000,8.000 Z" />
                                </svg>
                            </a>
                        </div>
                        <div id="widgetCollapse22" class="mt-3 widget-content collapse show"
                             aria-labelledby="widgetHeading22"
                        >
                            <label hidden for="type">{{__('items')['type']}}</label>
                            <select  name="type" id="type" class="border border-gray-200 rounded p-2 w-full">
                                <option value="" @if(request('type') === null) selected @endif>{{__('none')}}</option>
                                <option value="{{Item::type_Book}}" @if(request('type') === Item::type_Book) selected @endif>{{__('items')['book']}}</option>
                                <option value="{{Item::type_OldBook}}" @if(request('type') === Item::type_OldBook) selected @endif>{{__('items')['old book']}}</option>
                                <option value="{{Item::type_Map}}" @if(request('type') === Item::type_Map) selected @endif>{{__('items')['map']}}</option>
                                <option value="{{Item::type_Manuscript}}" @if(request('type') === Item::type_Manuscript) selected @endif>{{__('items')['manuscript']}}</option>
                                <option value="{{Item::type_Periodic}}" @if(request('type') === Item::type_Periodic) selected @endif>{{__('items')['periodic']}}</option>
                            </select>
                        </div>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>

@endsection
