@extends('layouts.layout-index')

@section('content')

    <main id="content">
        <div class="space-bottom-2 space-bottom-lg-3">
            <div class="pb-lg-1">
                <div class="page-header border-bottom">
                    <div class="container">
                        <div class="d-md-flex justify-content-between align-items-center py-4">
                            <h1 class="page-title font-size-3 font-weight-medium m-0 text-lh-lg">Authors</h1>
                            <nav class="woocommerce-breadcrumb font-size-2">
                                <a href="../home/index.html" class="h-primary">Home</a>
                                <span class="breadcrumb-separator mx-1"><i class="fas fa-angle-right"></i></span>
                                <span>Authors Single</span>
                            </nav>
                        </div>
                    </div>
                </div>

                @auth()
                    <table class="table table-hover table-borderless">
                        <tbody>
                        @if(auth()->user()->isAdmin())
                            <tr>
                                <th class="px-4 px-xl-5">Created by: </th>
                                <td>{{$author->user->username ?? 'No Value'}}</td>
                            </tr>
                            <tr>
                                <th class="px-4 px-xl-5">Created at: </th>
                                <td>{{$author->created_at ?? 'No Value'}}</td>
                            </tr>
                            <tr>
                                <th class="px-4 px-xl-5">Updated by: </th>
                                <td>{{$author->user->username ?? 'No Value'}}</td>
                            </tr>
                            <tr>
                                <th class="px-4 px-xl-5">Updated at: </th>
                                <td>{{$author->updated_at ?? 'No Value'}}</td>
                            </tr>
                        @endif
                        <tr>
                            <th class="px-4 px-xl-5">Actions: </th>
                            <td>
                                <a href="{{route('authors.edit', $author)}}"><i class="fa-solid fa-pencil"></i>
                                    Edit Author</a>
                            </td>
                            <td>
                                <a href="#" type="button" data-toggle="modal" data-target="#deleteModal"><i class="fa-solid fa-trash"></i>
                                    Delete Author</a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    @include('partials.authors._deleteModal')
                @endauth
                <section class="space-bottom-2 space-bottom-lg-3">
                    <div class="bg-gray-200 space-bottom-2 space-bottom-md-0">
                        <div class="container space-top-2 space-top-wd-3 px-3">
                            <div class="row">
                                <div class="col-lg-4 col-wd-3 d-flex">
                                    <img class="img-fluid mb-5 mb-lg-0 mt-auto" src="{{asset('assets/img/authors/edit.png')}}" alt="Image-Description">
                                </div>
                                <div class="col-lg-8 col-wd-9">
                                    <div class="mb-8">
                                        <span class="text-gray-400 font-size-2">Number of items: {{$author->items_count}}</span>
                                        <h6 class="font-size-7 ont-weight-medium mt-2 mb-3 pb-1">
                                            {{$author->fullname}}
                                        </h6>
                                        <p class="mb-0">Description will go here if needed. </p>
                                    </div>
                                    <ul class="products list-unstyled row no-gutters row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-wd-4 my-0 mb-md-8 mb-wd-12">
                                        @foreach($items->sortBy('created_at', SORT_DESC)->take(4) as $item)
                                            <x-authors.item-author-card :item="$item"></x-authors.item-author-card>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <div class="container">
                    <header class="mb-5">
                        <h2 class="font-size-7 mb-0">Author's Books</h2>
                    </header>
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
                        {{ $items->links('vendor.pagination.bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
