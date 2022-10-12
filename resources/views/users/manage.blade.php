@php
    use App\Models\User;
@endphp
@extends('layouts.layout-index')
@section('title', __('admin')['manage users'])
@section('content')
    <div class="page-header border-bottom mb-8">
        <div class="container">
            <div class="d-md-flex justify-content-between align-items-center py-4">
                <h1 class="page-title font-size-3 font-weight-medium m-0 text-lh-lg text-info">{{__('admin')['manage users']}}</h1>
{{--                Breadcrumbs--}}
                <nav class="woocommerce-breadcrumb font-size-2">
                    <a href="{{route('home')}}" class="h-primary">{{__('home')}}</a>
                    <span class="breadcrumb-separator mx-1"><i class="fas fa-angle-right"></i></span>{{__('admin')['manage users']}}
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
                                    {!! __('Showing') !!}
                                    <span>{{ $users->firstItem() }}</span>
                                    {!! __('to') !!}
                                    <span>{{ $users->lastItem() }}</span>
                                    {!! __('of') !!}
                                    <span>{{ $users->total() }}</span>
                                    {!! __('results') !!}
                                </p>
                            </div>
                            <div class="shop-control-bar__right d-md-flex align-items-center">
{{--                                Sort Select--}}
                                <label for="sortBy">{{__('sort')['sort']}}</label>
                                <select id="sortBy" name="sortBy" onchange="this.form.submit()" class="js-select selectpicker dropdown-select sortby"
                                        data-style="border-bottom shadow-none outline-none py-2">
                                    <option value="latest" @if(request('sortBy') === 'latest') selected @endif>Sort by Latest</option>
                                    <option value="asc" @if(request('sortBy') == null || request('sortBy') == 'asc') selected @endif>Asc</option>
                                    <option value="desc" @if(request('sortBy') == 'desc') selected @endif>Desc</option>
                                </select>
{{--                                Order Select--}}
                                <label for="orderBy">{{__('order')['order']}}</label>
                                <select id="orderBy" name="orderBy" onchange="this.form.submit()" class="js-select selectpicker dropdown-select orderby"
                                        data-style="border-bottom shadow-none outline-none py-2"
                                        data-width="fit">
                                    <option value="10" @if($users->perPage() == 10) selected @endif>Show 10</option>
                                    <option value="15" @if($users->perPage() == 15) selected @endif>Show 15</option>
                                    <option value="20" @if($users->perPage() == 20) selected @endif>Show 20</option>
                                    <option value="25" @if($users->perPage() == 25) selected @endif>Show 25</option>
                                    <option value="30" @if($users->perPage() == 30) selected @endif>Show 30</option>
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

                        <!-- Tab Content -->
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-one" role="tabpanel" aria-labelledby="pills-one-tab">
{{--                                    Individual User Card (GRID) components: 'user-card'--}}
                                <ul class="products list-unstyled row no-gutters row-cols-2 row-cols-lg-3 row-cols-wd-5 border-top border-left mb-6">
                                    @forelse($users as $user)
                                        <li class="product col">
                                            <x-users.user-card :user="$user"></x-users.user-card>
                                        </li>
                                    @empty
                                        No Users Found
                                    @endforelse
                                </ul>
                            </div>
                            <div class="tab-pane fade" id="pills-two" role="tabpanel" aria-labelledby="pills-two-tab">
{{--                                    Individual User Card (LIST) components: 'user-list-card'--}}
                                <ul class="products list-unstyled mb-6">
                                    @forelse($users as $user)
                                        <li class="product product__list">
                                            <x-users.user-list-card :user="$user"></x-users.user-list-card>
                                        </li>
                                    @empty
                                        No Users Found
                                        @endforelse
                                </ul>
                            </div>
                        </div>
                    {{ $users->links('vendor.pagination.bootstrap-5') }}

                </div>
                <div id="secondary" class="sidebar widget-area order-1" role="complementary">
{{--                    Search Accordion--}}
                    <div id="widgetAccordion">
                        <div id="woocommerce_product_categories-2" class="widget p-4d875 border woocommerce widget_product_categories">
{{--                            Username--}}
                            <div id="widgetHeadingOne" class="widget-head">
                                <a class="d-flex align-items-center justify-content-between text-dark" href="#"
                                   data-toggle="collapse"
                                   data-target="#widgetCollapseOne"
                                   aria-expanded="true"
                                   aria-controls="widgetCollapseOne">
                                    <h3 class="widget-title mb-0 font-weight-medium font-size-3">Username</h3>
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
                                    <input name="username" class="form-control bg-white-100 py-2d75 height-4 border-white-100 rounded-0" type="search" value="{{request('username') ?? ''}}" placeholder="Username" aria-label="Search">
                                </div>
                                <button class="btn btn-outline-primary mt-2 btn-sm" type="submit">Search</button>
                            </div>
                        </div>
{{--                        First Name--}}
                        <div id="First Name" class="widget widget_search widget_author p-4d875 border">
                            <div id="widgetHeading20" class="widget-head">
                                <a class="d-flex align-items-center justify-content-between text-dark" href="#"
                                   data-toggle="collapse"
                                   data-target="#widgetCollapse20"
                                   aria-expanded="true"
                                   aria-controls="widgetCollapse20">
                                    <h3 class="widget-title mb-0 font-weight-medium font-size-3">First Name</h3>
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
                                    <input name="first_name" class="form-control bg-white-100 py-2d75 height-4 border-white-100 rounded-0" type="search" value="{{request('first_name') ?? ''}}" placeholder="First name" aria-label="Search">
                                </div>
                            </div>
                        </div>
{{--                        Last Name--}}
                        <div id="Last Name" class="widget widget_search widget_author p-4d875 border">
                            <div id="widgetHeading21" class="widget-head">
                                <a class="d-flex align-items-center justify-content-between text-dark" href="#"
                                   data-toggle="collapse"
                                   data-target="#widgetCollapse21"
                                   aria-expanded="true"
                                   aria-controls="widgetCollapse21">
                                    <h3 class="widget-title mb-0 font-weight-medium font-size-3">Last Name</h3>
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
                                    <input name="last_name" class="form-control bg-white-100 py-2d75 height-4 border-white-100 rounded-0" type="search" value="{{request('last_name') ?? ''}}" placeholder="Last name" aria-label="Search">
                            </div>
                        </div>
                        </div>
{{--                        Email--}}
                        <div id="Email" class="widget p-4d875 border">
                            <div id="widgetHeading23" class="widget-head">
                                <a class="d-flex align-items-center justify-content-between text-dark" href="#"
                                   data-toggle="collapse"
                                   data-target="#widgetCollapse23"
                                   aria-expanded="true"
                                   aria-controls="widgetCollapse23">
                                    <h3 class="widget-title mb-0 font-weight-medium font-size-3">Email</h3>
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
                                <div class="input-group flex-nowrap w-100">
                                    <div class="input-group-prepend">
                                        <i class="glph-icon flaticon-loupe py-2d75 bg-white-100 border-white-100 text-dark pl-3 pr-0 rounded-0"></i>
                                    </div>
                                    <input name="email" class="form-control bg-white-100 py-2d75 height-4 border-white-100 rounded-0" type="search" value="{{request('email') ?? ''}}" placeholder="Email address" aria-label="Search">
                            </div>
                        </div>
                        </div>
{{--                        Location--}}
                        <div id="Location" class="widget p-4d875 border">
                            <div id="widgetHeading22" class="widget-head">
                                <a class="d-flex align-items-center justify-content-between text-dark" href="#"
                                   data-toggle="collapse"
                                   data-target="#widgetCollapse22"
                                   aria-expanded="true"
                                   aria-controls="widgetCollapse22">
                                    <h3 class="widget-title mb-0 font-weight-medium font-size-3">Location</h3>
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
                                <div class="input-group flex-nowrap w-100">
                                    <div class="input-group-prepend">
                                        <i class="glph-icon flaticon-loupe py-2d75 bg-white-100 border-white-100 text-dark pl-3 pr-0 rounded-0"></i>
                                    </div>
                                    <input name="location" class="form-control bg-white-100 py-2d75 height-4 border-white-100 rounded-0" type="search" value="{{request('location') ?? ''}}" placeholder="Location" aria-label="Search">
                                </div>
                            </div>
                        </div>
{{--                        Status--}}
                        <div id="Status" class="widget p-4d875 border">
                            <div id="widgetHeading23" class="widget-head">
                                <a class="d-flex align-items-center justify-content-between text-dark" href="#"
                                   data-toggle="collapse"
                                   data-target="#widgetCollapse23"
                                   aria-expanded="true"
                                   aria-controls="widgetCollapse23">
                                    <h3 class="widget-title mb-0 font-weight-medium font-size-3">Status</h3>
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
                                    <label hidden for="status">Status</label>
                                    <select name="status" id="status" class="border border-gray-200 rounded p-2 w-full">
                                        <option value="Active" @if(request('status') == 'Active') selected @endif>Active</option>
                                        <option value="Inactive" @if(request('status') == 'Inactive') selected @endif>Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
