
@extends('layouts.layout-index')

@section('title', $author->fullname)

@section('content')

    <main id="content">
        <div class="space-bottom-2 space-bottom-lg-3">
            <div class="pb-lg-1">
                <div class="page-header border-bottom">
                    <div class="container">
                        <div class="d-md-flex justify-content-between align-items-center py-4">
                            <h1 class="page-title font-size-3 font-weight-medium m-0 text-lh-lg">{{__('authors')['authors']}}</h1>
{{--                            Breadcrumbs--}}
                            <nav class="woocommerce-breadcrumb font-size-2">
                                <a href="{{route('home')}}" class="h-primary">{{__('home')}}</a>
                                <span class="breadcrumb-separator mx-1"><i class="fas fa-angle-right"></i></span>
                                <a href="{{route('authors.index')}}" class="h-primary">{{__('browse')['browse authors']}}</a>
                                <span class="breadcrumb-separator mx-1"><i class="fas fa-angle-right"></i></span>
                                <span>{{$author->fullname}}</span>
                            </nav>
                        </div>
                    </div>
                </div>
{{--                Author Details (Admin Only) & Actions --}}
                @auth()
                    <table class="table table-hover table-borderless">
                        <tbody>
{{--                        Author Details--}}
                        @if(auth()->user()->isAdmin())
                            <tr>
                                <th class="px-4 px-xl-5">{{__('authors')['created_by']}}: </th>
                                <td>{{$author->user->username ?? 'No Value'}}</td>
                            </tr>
                            <tr>
                                <th class="px-4 px-xl-5">{{__('authors')['created_at']}}: </th>
                                <td>{{$author->created_at ?? 'No Value'}}</td>
                            </tr>
                            <tr>
                                <th class="px-4 px-xl-5">{{__('authors')['updated_by']}}: </th>
                                <td>{{$author->user->username ?? 'No Value'}}</td>
                            </tr>
                            <tr>
                                <th class="px-4 px-xl-5">{{__('authors')['updated_at']}}: </th>
                                <td>{{$author->updated_at ?? 'No Value'}}</td>
                            </tr>
                        @endif
{{--                        Author Actions (Edit, Delete)--}}
                        <tr>
                            <th class="px-4 px-xl-5">{{__('actions')}}: </th>
{{--                            Author Edit--}}
                            <td>
                                <a href="{{route('authors.edit', $author)}}"><i class="fa-solid fa-pencil"></i>
                                    {{__('librarian')['edit author']}}</a>
                            </td>
{{--                            Author Delete--}}
                            <td>
                                <a href="#" type="button" data-toggle="modal" data-target="#deleteModal"><i class="fa-solid fa-trash"></i>
                                    {{__('librarian')['delete author']}}</a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
{{--                    Delete Modal--}}
                    @include('partials.authors._deleteModal')
                @endauth
{{--                Author Banner--}}
                <section class="space-bottom-2 space-bottom-lg-3">
                    <div class="bg-gray-200 space-bottom-2 space-bottom-md-0">
                        <div class="container space-top-2 space-top-wd-3 px-3">
                            <div class="row">
{{--                                <div class="col-lg-4 col-wd-3 d-flex">--}}
{{--                                    <img class="img-fluid mb-5 mb-lg-0 mt-auto" src="{{asset('assets/img/authors/edit.png')}}" alt="Image-Description">--}}
{{--                                </div>--}}
                                <div class="col-lg-8 col-wd-9">
                                    <div class="mb-8">
{{--                                        Number of Items--}}
                                        <span class="text-gray-400 font-size-2">{{__('authors')['items_count']}} {{$author->items_count}}</span>
{{--                                        Author Fullname--}}
                                        <h6 class="font-size-7 ont-weight-medium mt-2 mb-3 pb-1">
                                            {{$author->fullname}}
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
{{--                Author Items View--}}
                <form action="" class="woocommerce-ordering mb-4 m-md-0" method="GET">
                    <div class="container">
                        <header class="mb-5">
                            <h2 class="font-size-7 mb-0">{{__('authors')['authors items']}}</h2>
                        </header>
                        <div class="site-content space-bottom-3" id="content">
                            <div class="container">
                                <div class="row">
                                    <div id="primary" class="content-area order-2">
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
                                                <div id="widgetCollapse20" class="subjects_container mt-4 widget-content collapse show"
                                                     aria-labelledby="widgetHeading20"
                                                >
                                                    <div class="subject_wrapper input-group flex-nowrap w-100">
                                                        <div class="input-group-prepend">
                                                            <i class="glph-icon flaticon-loupe py-2d75 bg-white-100 border-white-100 text-dark pl-3 pr-0 rounded-0"></i>
                                                        </div>
                                                        <input name="subjects[]" class="form-control bg-white-100 py-2d75 height-5 border-white-100 rounded-0" type="search" value="{{request('subjects')[0] ?? ''}}" placeholder="Ex: Istorie" aria-label="Search">
                                                        <button class="add_subject_field rounded">
                                                            <span style="font-size:16px; font-weight:bold;">+</span>
                                                        </button>
                                                    </div>
                                                    @if(request('subjects'))
                                                        @foreach(request('subjects') as $key => $value)
                                                            @if($key != 0)
                                                                <div class="subject_wrapper input-group flex-nowrap w-100"> <div class="input-group-prepend"> <i class="glph-icon flaticon-loupe py-2d75 bg-white-100 border-white-100 text-dark pl-3 pr-0 rounded-0"></i> </div> <input value="{{$value ?? ''}}" name="subjects[]" class="form-control bg-white-100 py-2d75 height-5 border-white-100 rounded-0" type="search" placeholder="Ex: Istorie" aria-label="Search"/> <button class="delete rounded"> <span style="font-size:16px; font-weight:bold;">-</span> </button> </div>
                                                            @endif
                                                        @endforeach
                                                    @endif
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
                                                        <h3 class="widget-title mb-0 font-weight-medium font-size-3">{{__('items')['contributors']}}</h3>
                                                        <svg class="mins" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" height="2px">
                                                            <path fill-rule="evenodd" fill="rgb(22, 22, 25)" d="M0.000,-0.000 L15.000,-0.000 L15.000,2.000 L0.000,2.000 L0.000,-0.000 Z" />
                                                        </svg>
                                                        <svg class="plus" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" height="15px">
                                                            <path fill-rule="evenodd" fill="rgb(22, 22, 25)" d="M15.000,8.000 L9.000,8.000 L9.000,15.000 L7.000,15.000 L7.000,8.000 L0.000,8.000 L0.000,6.000 L7.000,6.000 L7.000,-0.000 L9.000,-0.000 L9.000,6.000 L15.000,6.000 L15.000,8.000 Z" />
                                                        </svg>
                                                    </a>
                                                </div>
                                                <div id="widgetCollapse21" class="authors_container mt-4 widget-content collapse show"
                                                     aria-labelledby="widgetHeading21"
                                                >
                                                    <div class="author_wrapper input-group flex-nowrap w-100">
                                                        <div class="input-group-prepend">
                                                            <i class="glph-icon flaticon-loupe py-2d75 bg-white-100 border-white-100 text-dark pl-3 pr-0 rounded-0"></i>
                                                        </div>
                                                        <input name="authors[]" class="form-control bg-white-100 py-2d75 height-5 border-white-100 rounded-0" type="search" value="{{request('authors')[0] ?? ''}}" placeholder="Ex: Mihai Eminescu"/>
                                                        <button class="add_author_field rounded">
                                                            <span style="font-size:16px; font-weight:bold;">+</span>
                                                        </button>
                                                    </div>
                                                    @if(request('authors'))
                                                        @foreach(request('authors') as $key => $value)
                                                            @if($key != 0)
                                                                <div class="author_wrapper input-group flex-nowrap w-100"><div class="input-group-prepend"><i class="glph-icon flaticon-loupe py-2d75 bg-white-100 border-white-100 text-dark pl-3 pr-0 rounded-0"></i></div> <input name="authors[]" value="{{$value ?? ''}}" class="form-control bg-white-100 py-2d75 height-5 border-white-100 rounded-0" type="search" placeholder="Ex: Mihai Eminescu Eminescu"/><button class="delete rounded"><span style="font-size:16px; font-weight:bold;">-</span></button></div>
                                                            @endif
                                                        @endforeach
                                                    @endif
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
                                                        <input name="language" class="form-control bg-white-100 py-2d75 height-5 border-white-100 rounded-0" type="search" value="{{request('language') ?? ''}}" placeholder="Ex: Română" aria-label="Search">
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
                                                <div id="widgetCollapse22" class="mt-3 widget-content collapse show type-form-div"
                                                     aria-labelledby="widgetHeading22"
                                                >
                                                    <label hidden for="type">{{__('items')['type']}}</label>
                                                    <select  name="type" id="type" class="border border-gray-200 rounded p-2 w-full type-format">
                                                        <option value="" @if(request('type') === null) selected @endif>{{__('none')}}</option>
                                                        <option value="Carte" @if(request('type') == 'Carte') selected @endif>{{__('items')['book']}}</option>
                                                        <option value="Carte Veche" @if(request('type') == 'Carte Veche') selected @endif>{{__('items')['old book']}}</option>
                                                        <option value="Manuscris" @if(request('type') == 'Manuscris') selected @endif>{{__('items')['manuscript']}}</option>
                                                        <option value="Hartă" @if(request('type') == 'Hartă') selected @endif>{{__('items')['map']}}</option>
                                                        <option value="Serial" @if(request('type') == 'Serial') selected @endif>{{__('items')['serial']}}</option>
                                                        <option value="Ex Libris" @if(request('type') == 'Ex Libris') selected @endif>{{__('items')['ex libris']}}</option>
                                                        <option value="Fotografie" @if(request('type') == 'Fotografie') selected @endif>{{__('items')['photograph']}}</option>
                                                        <option value="Document" @if(request('type') == 'Document') selected @endif>{{__('items')['document']}}</option>
                                                        <option value="Carte poștală" @if(request('type') == 'Carte poștală') selected @endif>{{__('items')['postcard']}}</option>
                                                        <option value="Other" @if(request('type') == 'Other') selected @endif>{{__('items')['other']}}</option>
                                                        @if(request('additionalType'))
                                                            <input required class="additionalType my-2 form-control bg-white-100 py-2d75 height-5 border-white-100 rounded-0" value="{{request('additionalType')}}" placeholder="Type" type="text" name="additionalType"/>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>

@endsection

@section('separate scripts')
    <script>
        let addField = false;
        const typeSelect = $(".type-format");
        const typeP = $(".type-form-div");

        $(typeSelect).change(function() {
            if($(this).val() === "Other" && $(".additionalType").length < 1) {
                AddField();
            } else {
                RemoveField();
            }
        })

        function AddField() {
            $(typeP).append('<input required class="additionalType my-2 form-control bg-white-100 py-2d75 height-5 border-white-100 rounded-0" placeholder="Type" type="text" name="additionalType"/>')
            addField = true;
        }

        function RemoveField() {
            $(".additionalType").remove();
            addField = false;
        }
    </script>

    <script>
        $(document).ready(function() {
            // Applies to all
            var max_fields = 5;

            // Author Variables
            var container_authors = $("div.authors_container")
            var add_button_authors = $(".add_author_field")

            // Subject Variables
            var container_subjects = $("div.subjects_container")
            var add_button_subjects = $(".add_subject_field")


            // AUTHORS
            $(add_button_authors).click(function(e) {
                e.preventDefault();
                if($('div.author_wrapper').length < max_fields) {
                    $(container_authors).append('<div class="author_wrapper input-group flex-nowrap w-100"><div class="input-group-prepend"><i class="glph-icon flaticon-loupe py-2d75 bg-white-100 border-white-100 text-dark pl-3 pr-0 rounded-0"></i></div> <input name="authors[]" class="form-control bg-white-100 py-2d75 height-5 border-white-100 rounded-0" type="search" placeholder="Ex: Mihai Eminescu"/><button class="delete rounded"><span style="font-size:16px; font-weight:bold;">-</span></button></div>')
                } else {
                    alert('You reached the limit!')
                }
            })
            $(container_authors).on("click", ".delete", function(e) {
                e.preventDefault();
                $(this).parent('div').remove();
            })


            // SUBJECTS
            $(add_button_subjects).click(function(e) {
                e.preventDefault();
                if($('div.subject_wrapper').length < max_fields) {
                    $(container_subjects).append('<div class="subject_wrapper input-group flex-nowrap w-100"> <div class="input-group-prepend"> <i class="glph-icon flaticon-loupe py-2d75 bg-white-100 border-white-100 text-dark pl-3 pr-0 rounded-0"></i> </div> <input name="subjects[]" class="form-control bg-white-100 py-2d75 height-5 border-white-100 rounded-0" type="search" placeholder="Ex: Istorie" aria-label="Search"/> <button class="delete rounded"> <span style="font-size:16px; font-weight:bold;">-</span> </button> </div>')
                } else {
                    alert('You reached the limit!')
                }
            })

            $(container_subjects).on("click", ".delete", function(e) {
                e.preventDefault();
                $(this).parent('div').remove();
            })
        })
    </script>
@endsection
