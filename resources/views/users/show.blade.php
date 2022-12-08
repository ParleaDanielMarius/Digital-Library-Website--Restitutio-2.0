@extends('layouts.layout-index')
@section('title', 'Manage User')
@section('content')

    <main id="content">
        <div class="space-bottom-2 space-bottom-lg-3">
            <div class="pb-lg-1">
                <div class="page-header border-bottom">
                    <div class="container">
                        <div class="d-md-flex justify-content-between align-items-center py-4">
                            <h1 class="page-title font-size-3 font-weight-medium m-0 text-lh-lg">{{$user->username}}</h1>
{{--                            Breadcrumbs--}}
                            <nav class="woocommerce-breadcrumb font-size-2">
                                <a href="{{route('home')}}" class="h-primary">{{__('home')}}</a>
                                <span class="breadcrumb-separator mx-1"><i class="fas fa-angle-right"></i></span>
                                <span>{{$user->username}}</span>
                            </nav>
                        </div>
                    </div>
                </div>
{{--                Actions Edit, Change Status (Not Protected since route is admin only)--}}
                    <table class="table table-hover table-borderless">
                        <tbody>
                        <tr>
                            <th class="px-4 px-xl-5">Actions: </th>
                            <td>
                                <a href="{{route('users.edit', $user)}}"><i class="fa-solid fa-pencil"></i>
                                    Edit User</a>
                            </td>
                            <td>
                                <a href="#" type="button" data-toggle="modal" data-target="#statusModal"><i class="fa-solid fa-power-off"></i>
                                    Change Status</a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
{{--                Modals--}}
                    @include('partials.users._statusModal')
                <section class="space-bottom-2 space-bottom-lg-3">
                    <div class="bg-gray-200 space-bottom-2 space-bottom-md-0">
                        <div class="container space-top-2 space-top-wd-3 px-3">
                            <div class="row">
                                <div class="col-lg-4 col-wd-3 d-flex">
                                    <img class="img-fluid mb-5 mb-lg-0 mt-auto" src="{{asset('assets/img/users/no-user-image.png')}}" alt="Image-Description">
                                </div>
{{--                                User Details--}}
                                <div class="col-lg-8 col-wd-9">
                                    <div class="mb-8">
                                        <h6 class="font-size-7 ont-weight-medium mt-2 mb-3 pb-1">
                                            {{$user->username}}  -  @switch($user->status)
                                                @case(0) {{__('inactive')}}
                                                @break
                                                @case(1) {{__('active')}}
                                                @break
                                                @default {{$user->status}}
                                            @endswitch
                                        </h6>
                                        <table class="table table-hover table-borderless">
                                            <tbody>
                                            <tr>
                                                <th class="px-4 px-xl-5">First Name: </th>
                                                <td>{{$user->first_name ?? 'No Value'}}</td>
                                            </tr>
                                            <tr>
                                                <th class="px-4 px-xl-5">Last Name: </th>
                                                <td>{{$user->last_name ?? 'No Value'}}</td>
                                            </tr>
                                            <tr>
                                                <th class="px-4 px-xl-5">Email: </th>
                                                <td>{{$user->email ?? 'No Value'}}</td>
                                            </tr>
                                            <tr>
                                                <th class="px-4 px-xl-5">Location: </th>
                                                <td>{{$user->location ?? 'No Value'}}</td>
                                            </tr>
                                                <tr>
                                                    <th class="px-4 px-xl-5">Number of Items: </th>
                                                    <td>{{$user->items_count ?? 'No Value'}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="px-4 px-xl-5">Number of Authors: </th>
                                                    <td>{{$user->authors_count ?? 'No Value'}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="px-4 px-xl-5">Number of Collections: </th>
                                                    <td>{{$user->collections_count ?? 'No Value'}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main>

@endsection
