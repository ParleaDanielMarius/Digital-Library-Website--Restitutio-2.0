
@extends('layouts.layout-index')
@section('title', __('librarian')['edit author'])
@section('content')

    <div class="page-header border-bottom">
        <div class="container">
            <div class="d-md-flex justify-content-between align-items-center py-4">
                <h1 class="page-title font-size-3 font-weight-medium m-0 text-lh-lg">{{__('librarian')['edit author']}}</h1>
{{--                Breadcrumbs--}}
                <nav class="woocommerce-breadcrumb font-size-2">
                    <a href="{{route('home')}}" class="h-primary">{{__('home')}}</a>
                    <span class="breadcrumb-separator mx-1"><i class="fas fa-angle-right"></i></span>
                    <a href="{{route('authors.index')}}" class="h-primary">{{__('browse')['browse authors']}}</a>
                    <span class="breadcrumb-separator mx-1"><i class="fas fa-angle-right"></i></span>
                    <a href="{{route('authors.show', $author->slug)}}" class="h-primary">{{$author->fullname}}</a>
                    <span class="breadcrumb-separator mx-1"><i class="fas fa-angle-right"></i></span>
                    <span>{{__('librarian')['edit author']}}</span>

                </nav>
            </div>
        </div>
    </div>
    <div id="content" class="site-content bg-punch-light space-bottom-3">
        <div class="container">
            <div id="primary content-centered" class="content-area">
                <main id="main" class="site-main">
                    <article id="post-6" class="post-6 page type-page status-publish hentry">
                        <header class="entry-header space-top-2 space-bottom-1 mb-2">
                            <h4 class="entry-title font-size-7 text-center">{{__('librarian')['edit author']}}</h4>
                        </header>
                        <form method="POST" class="checkout woocommerce-checkout row mt-8" action="{{route('authors.update', $author)}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="col2-set col-md-6 col-lg-7 col-xl-8 mb-6 mb-md-0" id="customer_details">
                                <div class="px-4 pt-5 bg-white border">
                                    <div class="woocommerce-billing-fields">
                                        <h3 class="mb-4 font-size-3">{{__('authors')['details']}}</h3>
{{--                                        First Name Input--}}
                                        <div class="woocommerce-billing-fields__field-wrapper row">
                                            <p class="col-12 mb-4d75 form-row form-row-wide validate-required woocommerce-invalid woocommerce-invalid-required-field" id="title_field" data-priority="10">
                                                <label for="first_name" class="form-label">{{__('authors')['first_name']}}<abbr class="required" title="required">*</abbr></label>
                                                <input type="text" class="input-text form-control" name="first_name" id="first_name" placeholder="Ex: Mihai" value="{{$author->first_name ?? ''}}" autocomplete="first_name" autofocus="autofocus">
                                            </p>
{{--                                        Last Name Input--}}
                                            <p class="col-12 mb-4d75 form-row form-row-wide" id="title_long_field" data-priority="20">
                                                <label for="last_name" class="form-label">{{__('authors')['last_name']}}</label>
                                                <input type="text" class="input-text form-control" name="last_name" id="last_name" placeholder="Ex: Eminescu" value="{{$author->last_name ?? ''}}" autocomplete="last_name">
                                            </p>
                                        </div>
                                    </div>
                                    <input type="submit" class="button alt btn btn-primary rounded-0 py-4" name="submit" id="submit" value="{{__('submit')}}" data-value="submit">
                                </div>


                            </div>


                        </form>


                        <!-- .entry-content -->
                    </article>
                    <!-- #post-## -->
                </main>
                <!-- #main -->
            </div>
            <!-- #primary -->
        </div>
        <!-- .col-full -->
    </div>

@endsection


