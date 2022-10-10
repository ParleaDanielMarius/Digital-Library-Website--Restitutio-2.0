@php
    use App\Models\Item;
@endphp
@extends('layouts.layout-index')
@section('title', __('librarian')['add item'])
@section('CSS')
    <link rel="stylesheet" href="{{asset('/assets/vendor/Virtual-select/css/virtual-select.min.css')}}">
@endsection

@section('content')

    <div class="page-header border-bottom">
        <div class="container">
            <div class="d-md-flex justify-content-between align-items-center py-4">
                <h1 class="page-title font-size-3 font-weight-medium m-0 text-lh-lg">{{__('librarian')['add item']}}</h1>
{{--                Breadcrumbs--}}
                <nav class="woocommerce-breadcrumb font-size-2">
                    <a href="#" class="h-primary">{{__('home')}}</a>
                    <span class="breadcrumb-separator mx-1"><i class="fas fa-angle-right"></i></span>{{__('librarian')['add item']}}
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
                            <h4 class="entry-title font-size-7 text-center">{{__('librarian')['add item']}}</h4>
                        </header>
                                <form method="POST" class="checkout woocommerce-checkout row mt-8" action="{{route('items.store')}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col2-set col-md-6 col-lg-7 col-xl-8 mb-6 mb-md-0" id="customer_details">
                                        <div class="px-4 pt-5 bg-white border">
                                            <div class="woocommerce-billing-fields">
                                                <h3 class="mb-4 font-size-3">{{__('items')['details']}}</h3>
                                                <div class="woocommerce-billing-fields__field-wrapper row">
{{--                                                    Title--}}
                                                    <p class="col-12 mb-4d75 form-row form-row-wide validate-required woocommerce-invalid woocommerce-invalid-required-field" id="title_field" data-priority="10">
                                                        <label for="title" class="form-label">{{__('items')['title']}} <abbr class="required" title="required">*</abbr></label>
                                                        <input type="text" class="input-text form-control" name="title" id="title" placeholder="Ex: Romeo and Juliet" value="{{old('title') ?? ''}}" autocomplete="title" autofocus="autofocus">
                                                    </p>
                                                    @error('title')
                                                    <p class="text-danger mt-1 col-12 mb-4d75 form-row form-row-wide">{{$message}}</p>
                                                    @enderror
{{--                                                    Long Title--}}
                                                    <p class="col-12 mb-4d75 form-row form-row-wide" id="title_long_field" data-priority="20">
                                                        <label for="title_long" class="form-label">{{__('items')['title_long']}}</label>
                                                        <input type="text" class="input-text form-control" name="title_long" id="title_long" placeholder="Use this for titles longer than 76 characters" value="{{old('title_long') ?? ''}}" autocomplete="title-long">
                                                    </p>
                                                    @error('title_long')
                                                    <p class="text-danger mt-1 col-12 mb-4d75 form-row form-row-wide">{{$message}}</p>
                                                    @enderror
{{--                                                    Collections--}}
                                                    <div class="col-12 mb-4d75 form-row form-row-wide">
                                                        <label for="collectionsSelect" class="col-12 mb-4d75">{{__('collections')['collections']}} <abbr class="required" title="required">*</abbr></label>
                                                        <div id="collectionsSelect" class="col-12 mb-4d75" multiple name="collections_id" placeholder="{{__('collections')['collections']}}" data-search="true" data-silent-initial-value-set="true">
                                                        </div>
                                                    </div>
                                                    @error('collections_id')
                                                    <p class="text-danger mt-1 col-12 mb-4d75 form-row form-row-wide">{{$message}}</p>
                                                    @enderror
{{--                                                    Authors--}}
                                                    <div class="col-12 mb-4d75 form-row form-row-wide">
                                                        <label for="authorsSelect" class="col-12 mb-4d75">{{__('authors')['authors']}} <abbr class="required" title="required">*</abbr></label>
                                                        <div id="authorsSelect" class="col-12 mb-4d75" multiple name="authors_id" placeholder="{{__('authors')['authors']}}" data-search="true" data-silent-initial-value-set="true">
                                                        </div>
                                                    </div>
                                                    @error('authors_id')
                                                    <p class="text-danger mt-1 col-12 mb-4d75 form-row form-row-wide">{{$message}}</p>
                                                    @enderror
{{--                                                    Subjects--}}
                                                    <div class="col-12 mb-4d75 form-row form-row-wide">
                                                        <label for="subjectsSelect" class="col-12 mb-4d75">{{__('subjects')['subjects']}} <abbr class="required" title="required">*</abbr></label>
                                                        <div id="subjectsSelect" class="col-12 mb-4d75" multiple name="subjects_id" placeholder="{{__('subjects')['subjects']}}" data-search="true" data-silent-initial-value-set="true">
                                                        </div>
                                                    </div>
                                                    @error('subjects_id')
                                                    <p class="text-danger mt-1 col-12 mb-4d75 form-row form-row-wide">{{$message}}</p>
                                                    @enderror
{{--                                                    Publisher--}}
                                                    <p class="col-12 mb-4d75 form-row form-row-wide address-field" id="publisher_field" data-priority="50">
                                                        <label for="publisher" class="form-label">{{__('items')['publisher']}}</label>
                                                        <input type="text" class="input-text form-control" name="publisher" id="publisher" placeholder="Ex: Editura Litera" value="{{old('publisher') ?? ''}}" autocomplete="publisher">
                                                    </p>
                                                    @error('publisher_id')
                                                    <p class="text-danger mt-1 col-12 mb-4d75 form-row form-row-wide">{{$message}}</p>
                                                    @enderror
{{--                                                    Publishing Day--}}
                                                    <p class="col-12 mb-4d75 form-row form-row-wide address-field validate-required" id="publisher_day_field" data-priority="60" data-o_class="form-row form-row-wide address-field validate-required">
                                                        <label for="publisher_day" class="form-label">{{__('items')['publisher_day']}} <abbr class="required" title="required">*</abbr></label>
                                                        <input type="number" class="input-text form-control" name="publisher_day" id="publisher_day" min="1" max="31" placeholder="Ex: 26" value="{{old('publisher_day') ?? ''}}" autocomplete="publisher_day">
                                                    </p>
                                                    @error('publisher_day')
                                                    <p class="text-danger mt-1 col-12 mb-4d75 form-row form-row-wide">{{$message}}</p>
                                                    @enderror
{{--                                                    Publishing Month--}}
                                                    <p class="col-12 mb-4d75 form-row form-row-wide address-field validate-required" id="publisher_month_field" data-priority="60" data-o_class="form-row form-row-wide address-field validate-required">
                                                        <label for="publisher_month" class="form-label">{{__('items')['publisher_month']}} <abbr class="required" title="required">*</abbr></label>
                                                        <input type="number" class="input-text form-control" name="publisher_month" id="publisher_month" min="1" max="12" placeholder="Ex: 06" value="{{old('publisher_month') ?? ''}}" autocomplete="publisher_month">
                                                    </p>
                                                    @error('publisher_month')
                                                    <p class="text-danger mt-1 col-12 mb-4d75 form-row form-row-wide">{{$message}}</p>
                                                    @enderror
{{--                                                    Publishing Year--}}
                                                    <p class="col-12 mb-4d75 form-row form-row-wide address-field validate-required" id="publisher_year_field" data-priority="60" data-o_class="form-row form-row-wide address-field validate-required">
                                                        <label for="publisher_year" class="form-label">{{__('items')['publisher_year']}} <abbr class="required" title="required">*</abbr></label>
                                                        <input type="number" class="input-text form-control" name="publisher_year" id="publisher_year" min="1000" placeholder="Ex: 2000" value="{{old('publisher_year') ?? ''}}" autocomplete="publisher_year">
                                                    </p>
                                                    @error('publisher_year')
                                                    <p class="text-danger mt-1 col-12 mb-4d75 form-row form-row-wide">{{$message}}</p>
                                                    @enderror
{{--                                                    Publishing Location--}}
                                                    <p class="col-12 mb-4d75 form-row form-row-wide" id="publisher_where_field" data-priority="70" data-o_class="form-row form-row-wide">
                                                        <label for="publisher_where" class="form-label">{{__('items')['publisher_where']}}</label>
                                                        <input type="text" class="input-text form-control" value="{{old('publisher_where') ?? ''}}" placeholder="Ex: Bucharest" name="publisher_where" id="publisher_where" autocomplete="publisher_Where">
                                                    </p>
                                                    @error('publisher_where')
                                                    <p class="text-danger mt-1 col-12 mb-4d75 form-row form-row-wide">{{$message}}</p>
                                                    @enderror
{{--                                                    Cover Path--}}
                                                    <p class="col-12 mb-4d75 form-row form-row-wide" id="cover_path_field" data-priority="100">
                                                        <label for="cover_path" class="form-label">{{__('items')['cover_path']}} <abbr class="required" title="required">*</abbr></label>
                                                        <input type="file" class="border border-gray-200 rounded p-2 w-full" name="cover_path" id="cover_path" value="{{old('cover_path')}}">
                                                    </p>
                                                    @error('cover_path')
                                                    <p class="text-danger mt-1 col-12 mb-4d75 form-row form-row-wide">{{$message}}</p>
                                                    @enderror
{{--                                                    PDF Path--}}
                                                    <p class="col-12 mb-4d75 form-row form-row-wide" id="pdf_path_field" data-priority="110">
                                                        <label for="pdf_path" class="form-label">{{__('items')['pdf_path']}} <abbr class="required" title="required">*</abbr></label>
                                                        <input type="file" class="border border-gray-200 rounded p-2 w-full" name="pdf_path" id="pdf_path" value="{{old('pdf_path')}}">
                                                    </p>
                                                    @error('pdf_path')
                                                    <p class="text-danger mt-1 col-12 mb-4d75 form-row form-row-wide">{{$message}}</p>
                                                    @enderror
{{--                                                    Description--}}
                                                    <p class="col-12 mb-4d75 form-row notes" id="description_field" data-priority="120">
                                                        <label for="description" class="form-label">{{__('items')['description']}}</label>
                                                        <textarea name="description" class="input-text form-control" id="description" placeholder="Ex: Quia beatae tempore rerum dicta et voluptas ullam. Velit ea quis et. Est harum quas quas reprehenderit autem maiores voluptatem beatae. Eum quam mollitia repudiandae dolorem dolores eveniet quia. Aut aliquid quo quia est repudiandae voluptas cum sunt. Vitae sunt nulla perferendis sed." rows="8" cols="5">{{old('description') ?? ''}}</textarea>
                                                    </p>
                                                    @error('description')
                                                    <p class="text-danger mt-1 col-12 mb-4d75 form-row form-row-wide">{{$message}}</p>
                                                    @enderror
{{--                                                    Language--}}
                                                    <p class="col-12 mb-4d75 form-row form-row-wide" id="language_field" data-priority="130" data-o_class="form-row form-row-wide">
                                                        <label for="language" class="form-label">{{__('items')['language']}}</label>
                                                        <input type="text" class="input-text form-control" value="{{old('language') ?? ''}}" placeholder="Ex: Romanian" name="language" id="language" autocomplete="language">
                                                    </p>
                                                    @error('language')
                                                    <p class="text-danger mt-1 col-12 mb-4d75 form-row form-row-wide">{{$message}}</p>
                                                    @enderror
{{--                                                    Provider--}}
                                                    <p class="col-12 mb-4d75 form-row form-row-wide" id="provider_field" data-priority="140" data-o_class="form-row form-row-wide">
                                                        <label for="provider" class="form-label">{{__('items')['provider']}}</label>
                                                        <input type="text" class="input-text form-control" value="{{old('provider') ?? "BCU 'Carol I' Bucuresti"}}" placeholder="Ex: BCU 'Carol I' Bucuresti" name="provider" id="provider" autocomplete="provider">
                                                    </p>
                                                    @error('provider')
                                                    <p class="text-danger mt-1 col-12 mb-4d75 form-row form-row-wide">{{$message}}</p>
                                                    @enderror
{{--                                                    Rights--}}
                                                    <p class="col-12 mb-4d75 form-row form-row-wide" id="rights_field" data-priority="150" data-o_class="form-row form-row-wide">
                                                        <label for="rights" class="form-label">{{__('items')['rights']}}</label>
                                                        <input type="text" class="input-text form-control" value="{{old('rights') ?? "https://creativecommons.org/publicdomain/mark/1.0"}}" placeholder="Ex: https://creativecommons.org/publicdomain/mark/1.0" name="rights" id="rights" autocomplete="rights">
                                                    </p>
                                                    @error('rights')
                                                    <p class="text-danger mt-1 col-12 mb-4d75 form-row form-row-wide">{{$message}}</p>
                                                    @enderror
{{--                                                    ISBN--}}
                                                    <p class="col-12 mb-4d75 form-row form-row-wide" id="ISBN_field" data-priority="160" data-o_class="form-row form-row-wide">
                                                        <label for="ISBN" class="form-label">ISBN</label>
                                                        <input type="text" class="input-text form-control" value="{{old('ISBN') ?? ''}}" placeholder="Ex: 9321977476123" name="ISBN" id="ISBN" autocomplete="ISBN">
                                                    </p>
                                                    @error('ISBN')
                                                    <p class="text-danger mt-1 col-12 mb-4d75 form-row form-row-wide">{{$message}}</p>
                                                    @enderror
{{--                                                    ISSN--}}
                                                    <p class="col-12 mb-4d75 form-row form-row-wide" id="ISSN_field" data-priority="160" data-o_class="form-row form-row-wide">
                                                        <label for="ISSN" class="form-label">ISSN</label>
                                                        <input type="text" class="input-text form-control" value="{{old('ISSN') ?? ''}}" placeholder="Ex: 2049-3630" name="ISSN" id="ISSN" autocomplete="ISSN">
                                                    </p>
                                                    @error('ISSN')
                                                    <p class="text-danger mt-1 col-12 mb-4d75 form-row form-row-wide">{{$message}}</p>
                                                    @enderror
{{--                                                    Vubis ID--}}
                                                    <p class="col-12 mb-4d75 form-row form-row-wide" id="vubis_id_field" data-priority="170" data-o_class="form-row form-row-wide">
                                                        <label for="vubis_id" class="form-label">Vubis ID (optional)</label>
                                                        <input type="text" class="input-text form-control" value="{{old('vubis_id') ?? ''}}" placeholder="Ex: 800100" name="vubis_id" id="vubis_id" autocomplete="vubis_id">
                                                    </p>
                                                    @error('vubis_id')
                                                    <p class="text-danger mt-1 col-12 mb-4d75 form-row form-row-wide">{{$message}}</p>
                                                    @enderror
{{--                                                    Type--}}
                                                    <p class="col-12 mb-4d75 form-row form-row-wide" id="type_field" data-priority="180">
                                                        <label for="type" class="form-label">{{__('items')['type']}} <abbr class="required" title="required">*</abbr></label>
                                                        <select name="type" id="type" class="form-control select2-hidden-accessible"
                                                                autocomplete="type" tabindex="-1" aria-hidden="true">
                                                            <option value="{{Item::type_Book}}" @if(old('type') == Item::type_Book) selected @endif>{{Item::type_Book}}</option>
                                                            <option value="{{Item::type_OldBook}}" @if(old('type') == Item::type_OldBook) selected @endif>{{Item::type_OldBook}}</option>
                                                            <option value="{{Item::type_Map}}" @if(old('type') == Item::type_Map) selected @endif>{{Item::type_Map}}</option>
                                                            <option value="{{Item::type_Manuscript}}" @if(old('type') == Item::type_Manuscript) selected @endif>{{Item::type_Manuscript}}</option>
                                                            <option value="{{Item::type_Periodic}}" @if(old('type') == Item::type_Periodic) selected @endif>{{Item::type_Periodic}}</option>
                                                        </select>
                                                    </p>
                                                    @error('type')
                                                    <p class="text-danger mt-1 col-12 mb-4d75 form-row form-row-wide">{{$message}}</p>
                                                    @enderror
{{--                                                    Status--}}
                                                    <p class="col-12 mb-4d75 form-row form-row-wide" id="status_field" data-priority="190">
                                                        <label for="status" class="form-label">{{__('items')['status']}} <abbr class="required" title="required">*</abbr></label>
                                                        <select name="status" id="status" class="form-control select2-hidden-accessible">
                                                            <option value="{{Item::STATUS_ACTIVE}}" @if(old('status') == Item::STATUS_ACTIVE) selected @endif>{{Item::STATUS_ACTIVE}}</option>
                                                            <option value="{{Item::STATUS_INACTIVE}}" @if(old('status') == Item::STATUS_INACTIVE) selected @endif>{{Item::STATUS_INACTIVE}}</option>w
                                                        </select>
                                                    </p>
                                                    @error('status')
                                                    <p class="text-danger mt-1 col-12 mb-4d75 form-row form-row-wide">{{$message}}</p>
                                                    @enderror
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

@section('JS')
    <script src="{{asset('/assets/vendor/Virtual-select/js/virtual-select.min.js')}}"></script>
@endsection

@section('separate scripts')
{{--    Author Multi-select     --}}
    <script type="text/javascript">
        VirtualSelect.init({
            ele: '#authorsSelect',
            labelKey:'fullname',
            valueKey:'id',
            setValueAsArray: false,
            emptyValue: null,
            showValueAsTags: true,
            onServerSearch: pointToAuthors,
        });
        const searchAuthor = debounce(function(searchValue, virtualSelect) {
            authorsSearch(searchValue, virtualSelect)
            }, 1000)

        function pointToAuthors(searchValue, virtualSelect) {
                searchAuthor(searchValue, virtualSelect)
        }

        function authorsSearch(searchValue, virtualSelect) {
            getAuthorsFromServer(searchValue).then(function(newOptions) {
                virtualSelect.setServerOptions(newOptions)

            });
        }

        function getAuthorsFromServer(searchValue) {
            if(searchValue === '') {
                searchValue = 'a'
            }
            var authorsRoute = '/authors-select/'
            authorsRoute = authorsRoute.concat(searchValue)
            return $.ajax({
                url: authorsRoute,
                type: 'GET',
                dataType: 'json',
            })

        }

        function debounce(cb, delay = 250) {
            let timeout

            return (...args) => {
                clearTimeout(timeout)
                timeout = setTimeout(() => {
                    cb(...args)
                }, delay)
            }
        }
    </script>
{{--    Collection Multi-select --}}
    <script type="text/javascript">
        VirtualSelect.init({
            ele: '#collectionsSelect',
            labelKey:'title',
            valueKey:'id',
            setValueAsArray: false,
            emptyValue: null,
            showValueAsTags: true,
            onServerSearch: pointToCollections,
        });
        const searchCollection = debounce(function(searchValue, virtualSelect) {
            collectionSearch(searchValue, virtualSelect)
        }, 1000)

        function pointToCollections(searchValue, virtualSelect) {
            searchCollection(searchValue, virtualSelect);
        }

        function collectionSearch(searchValue, virtualSelect) {
            getCollectionsFromServer(searchValue).then(function(newOptions) {
                virtualSelect.setServerOptions(newOptions);

            });
        }

        function getCollectionsFromServer(searchValue) {
            var collectionsRoute = '/collections-select/';
            collectionsRoute = collectionsRoute.concat(searchValue);
            return $.ajax({
                url: collectionsRoute,
                type: 'GET',
                dataType: 'json',
            });
        }

        function debounce(cb, delay = 250) {
            let timeout

            return (...args) => {
                clearTimeout(timeout)
                timeout = setTimeout(() => {
                    cb(...args)
                }, delay)
            }
        }
    </script>
{{--    Subject Multi-select    --}}
    <script type="text/javascript">
        VirtualSelect.init({
            ele: '#subjectsSelect',
            labelKey:'title',
            valueKey:'id',
            setValueAsArray: false,
            emptyValue: null,
            showValueAsTags: true,
            onServerSearch: pointToSubjects,
        });
        const searchSubject = debounce(function(searchValue, virtualSelect) {
            subjectSearch(searchValue, virtualSelect)
        }, 1000)

        function pointToSubjects(searchValue, virtualSelect) {
            searchSubject(searchValue, virtualSelect);
        }

        function subjectSearch(searchValue, virtualSelect) {
            getSubjectsFromServer(searchValue).then(function(newOptions) {
                virtualSelect.setServerOptions(newOptions);

            });
        }

        function getSubjectsFromServer(searchValue) {
            var subjectsRoute = '/subjects-select/';
            subjectsRoute = subjectsRoute.concat(searchValue);
            return $.ajax({
                url: subjectsRoute,
                type: 'GET',
                dataType: 'json',
            });
        }

        function debounce(cb, delay = 250) {
            let timeout

            return (...args) => {
                clearTimeout(timeout)
                timeout = setTimeout(() => {
                    cb(...args)
                }, delay)
            }
        }
    </script>
@endsection
