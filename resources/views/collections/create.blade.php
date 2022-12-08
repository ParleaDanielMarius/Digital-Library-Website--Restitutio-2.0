@php
    use App\Models\Collection;
@endphp


@extends('layouts.layout-index')

@section('title', __('librarian')['add collection'])

@section('content')

    <div class="page-header border-bottom">
        <div class="container">
            <div class="d-md-flex justify-content-between align-items-center py-4">
                <h1 class="page-title font-size-3 font-weight-medium m-0 text-lh-lg">{{__('librarian')['add collection']}}</h1>
{{--                Breadcrumbs--}}
                <nav class="woocommerce-breadcrumb font-size-2">
                    <a href="{{route('home')}}" class="h-primary">{{__('home')}}</a>
                    <span class="breadcrumb-separator mx-1"><i class="fas fa-angle-right"></i></span>
                    <span>{{__('librarian')['add collection']}}</span>
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
                            <h4 class="entry-title font-size-7 text-center">{{__('librarian')['add collection']}}</h4>
                        </header>
                        <form method="POST" class="checkout woocommerce-checkout row mt-8" action="{{route('collections.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="col2-set col-md-6 col-lg-7 col-xl-8 mb-6 mb-md-0" id="customer_details">
                                <div class="px-4 pt-5 bg-white border">
                                    <div class="woocommerce-billing-fields">
                                        <h3 class="mb-4 font-size-3">{{__('collections')['details']}}</h3>
                                        <div class="woocommerce-billing-fields__field-wrapper row">
{{--                                        Title--}}
                                            <p class="col-12 mb-4d75 form-row form-row-wide validate-required woocommerce-invalid woocommerce-invalid-required-field" id="title_field" data-priority="10">
                                                <label for="title" class="form-label">{{__('collections')['title']}}<abbr class="required" title="required">*</abbr></label>
                                                <input type="text" class="input-text form-control" name="title" id="title" placeholder="Ex: Old Books and Manuscripts" value="{{old('title') ?? ''}}" autocomplete="title" autofocus="autofocus">
                                            </p>
{{--                                            Description--}}
                                            <p class="col-12 mb-4d75 form-row notes" id="description_field" data-priority="120">
                                                <label for="description" class="form-label">{{__('collections')['description']}}</label>
                                                <textarea name="description" class="input-text form-control" id="description" placeholder="Ex: Quia beatae tempore rerum dicta et voluptas ullam. Velit ea quis et. Est harum quas quas reprehenderit autem maiores voluptatem beatae. Eum quam mollitia repudiandae dolorem dolores eveniet quia. Aut aliquid quo quia est repudiandae voluptas cum sunt. Vitae sunt nulla perferendis sed." rows="8" cols="5">{{old('description') ?? ''}}</textarea>
                                            </p>
{{--                                            Cover Path--}}
                                            <p class="col-12 mb-4d75 form-row form-row-wide" id="cover_path_field" data-priority="100">
                                                <label for="cover_path" class="form-label">{{__('collections')['cover_path']}} <abbr class="required" title="required">*</abbr></label>
                                                <input type="file" class="border border-gray-200 rounded p-2 w-full" name="cover_path" id="cover_path" value="{{old('cover_path')}}">
                                            </p>
{{--                                            Status--}}
                                            <p class="col-12 mb-4d75 form-row form-row-wide" id="status_field" data-priority="190">
                                                <label for="status" class="form-label">{{__('collections')['status']}}<abbr class="required" title="required">*</abbr></label>
                                                <select name="status" id="status" class="form-control select2-hidden-accessible"
                                                        autocomplete="status" tabindex="-1" aria-hidden="true">
                                                    <option value="{{Collection::STATUS_ACTIVE}}" @if(old('status') == Collection::STATUS_ACTIVE) selected @endif>{{__('active')}}</option>
                                                    <option value="{{Collection::STATUS_INACTIVE}}" @if(old('status') == Collection::STATUS_INACTIVE) selected @endif>{{__('inactive')}}</option>
                                                </select>
                                            </p>
                                        </div>
                                    </div>
                                    <input type="submit" class="button alt btn btn-primary rounded-0 py-4" name="submit" id="submit" value="{{__('submit')}}" data-value="submit">
                                </div>
                            </div>
                        </form>
                    </article>
                </main>
            </div>
        </div>
    </div>

@endsection


