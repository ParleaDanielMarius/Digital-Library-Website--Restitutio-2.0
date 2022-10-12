    @php
        use App\Models\Item;
    @endphp

@extends('layouts.layout-index')
    @section('title', __('librarian')['edit item'])
    @section('CSS')
        <link rel="stylesheet" href="{{asset('/assets/vendor/Virtual-select/css/virtual-select.min.css')}}">
    @endsection
@section('content')

    <div class="page-header border-bottom">
        <div class="container">
            <div class="d-md-flex justify-content-between align-items-center py-4">
                <h1 class="page-title font-size-3 font-weight-medium m-0 text-lh-lg">{{__('librarian')['edit item']}}</h1>
{{--                Breadcrumbs--}}
                <nav class="woocommerce-breadcrumb font-size-2">
                    <a href="#" class="h-primary">{{__('home')}}</a>
                    <span class="breadcrumb-separator mx-1"><i class="fas fa-angle-right"></i></span>
                    <a href="{{route('items.index')}}" class="h-primary">{{__('browse')['browse items']}}</a>
                    <span class="breadcrumb-separator mx-1"><i class="fas fa-angle-right"></i></span>
                    <a href="{{route('items.show', $item->slug)}}" class="h-primary">{{$item->title}}</a>
                    <span class="breadcrumb-separator mx-1"><i class="fas fa-angle-right"></i></span>{{__('librarian')['edit item']}}
                </nav>
            </div>
        </div>
    </div>
    <div id="content" class="site-content bg-punch-light space-bottom-3">
        <div class="col-full container">
            <div id="primary" class="content-area">
                <main id="main" class="site-main">
                    <article id="post-6" class="post-6 page type-page status-publish hentry">
                        <header class="entry-header space-top-2 space-bottom-1 mb-2">
                            <h4 class="entry-title font-size-7 text-center">{{__('librarian')['edit item']}}</h4>
                        </header>
                        <form name="checkout" method="POST" class="checkout woocommerce-checkout row mt-8" action="{{route('items.update', $item)}}" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="col2-set col-md-6 col-lg-7 col-xl-8 mb-6 mb-md-0" id="customer_details">
                                <div class="px-4 pt-5 bg-white border">
                                    <div class="woocommerce-billing-fields">
                                        <h3 class="mb-4 font-size-3">{{__('items')['details']}}</h3>
                                        <div class="woocommerce-billing-fields__field-wrapper row">
{{--                                            Title--}}
                                            <p class="col-12 mb-4d75 form-row form-row-wide validate-required woocommerce-invalid woocommerce-invalid-required-field" id="title_field" data-priority="10">
                                                <label for="title" class="form-label">{{__('items')['title']}} <abbr class="required" title="required">*</abbr></label>
                                                <input type="text" class="input-text form-control" name="title" id="title" placeholder="Ex: Romeo and Juliet" value="{{$item->title ?? ''}}" autocomplete="title" autofocus="autofocus">
                                            </p>
                                            @error('title')
                                            <p class="text-danger mt-1 col-12 mb-4d75 form-row form-row-wide">{{$message}}</p>
                                            @enderror
{{--                                            Long Title--}}
                                            <p class="col-12 mb-4d75 form-row form-row-wide" id="title_long_field" data-priority="20">
                                                <label for="title_long" class="form-label">{{__('items')['title_long']}}</label>
                                                <input type="text" class="input-text form-control" name="title_long" id="title_long" placeholder="Use this for titles longer than 76 characters" value="{{$item->title_long ?? ''}}" autocomplete="title-long">
                                            </p>
                                            @error('title_long')
                                            <p class="text-danger mt-1 col-12 mb-4d75 form-row form-row-wide">{{$message}}</p>
                                            @enderror
{{--                                            Collections--}}
                                            <p class="col-12 mb-4d75 form-row form-row-wide" id="collections_id_field" data-priority="30">
                                                <label for="multipleSelect" class="form-label">{{__('items')['part of']}} <abbr class="required" title="required">*</abbr></label>
                                                <select id="multipleSelect" multiple name="collections_id" placeholder="Collections" data-search="true" data-silent-initial-value-set="true">
                                                    @foreach($collections as $collection)
                                                        <option value="{{$collection->id}}"
                                                                @foreach($item->collections as $itemCollection)
                                                                @if($collection->id == $itemCollection->id) selected @endif
                                                            @endforeach
                                                        >{{$collection->title}}</option>
                                                    @endforeach
                                                </select>
                                            </p>
                                            @error('collections_id')
                                            <p class="text-danger mt-1 col-12 mb-4d75 form-row form-row-wide">{{$message}}</p>
                                            @enderror
{{--                                            Authors--}}
                                            <p class="col-12 mb-4d75 form-row form-row-wide" id="authors_id_field" data-priority="40">
                                                <label for="multipleSelect" class="form-label">{{__('authors')['authors']}} <abbr class="required" title="required">*</abbr></label>
                                                <select id="multipleSelect" multiple name="authors_id" placeholder="Authors" data-search="true" data-silent-initial-value-set="true">
                                                    @foreach($authors as $author)
                                                        <option value="{{$author->id}}"
                                                                @foreach($item->authors as $itemAuthor)
                                                                @if($author->id == $itemAuthor->id) selected @endif
                                                            @endforeach
                                                        >{{$author->fullname}}</option>
                                                    @endforeach
                                                </select>
                                            </p>
                                            @error('authors_id')
                                            <p class="text-danger mt-1 col-12 mb-4d75 form-row form-row-wide">{{$message}}</p>
                                            @enderror
{{--                                            Publisher--}}
                                            <p class="col-12 mb-4d75 form-row form-row-wide address-field" id="publisher_field" data-priority="50">
                                                <label for="publisher" class="form-label">{{__('items')['publisher']}}</label>
                                                <input type="text" class="input-text form-control" name="publisher" id="publisher" placeholder="Ex: Editura Litera" value="{{$item->publisher ?? ''}}" autocomplete="publisher">
                                            </p>
                                            @error('publisher_id')
                                            <p class="text-danger mt-1 col-12 mb-4d75 form-row form-row-wide">{{$message}}</p>
                                            @enderror
{{--                                            Publishing Day--}}
                                            <p class="col-12 mb-4d75 form-row form-row-wide address-field validate-required" id="publisher_day_field" data-priority="60" data-o_class="form-row form-row-wide address-field validate-required">
                                                <label for="publisher_day" class="form-label">{{__('items')['publisher_day']}} <abbr class="required" title="required">*</abbr></label>
                                                <input type="number" class="input-text form-control" name="publisher_day" id="publisher_day" min="1" max="31" placeholder="Ex: 26" value="{{$item->publisher_day ?? ''}}" autocomplete="publisher_day">
                                            </p>
                                            @error('publisher_day')
                                            <p class="text-danger mt-1 col-12 mb-4d75 form-row form-row-wide">{{$message}}</p>
                                            @enderror
{{--                                            Publishing Month--}}
                                            <p class="col-12 mb-4d75 form-row form-row-wide address-field validate-required" id="publisher_month_field" data-priority="60" data-o_class="form-row form-row-wide address-field validate-required">
                                                <label for="publisher_month" class="form-label">{{__('items')['publisher_month']}} <abbr class="required" title="required">*</abbr></label>
                                                <input type="number" class="input-text form-control" name="publisher_month" id="publisher_month" min="1" max="12" placeholder="Ex: 06" value="{{$item->publisher_month ?? ''}}" autocomplete="publisher_month">
                                            </p>
                                            @error('publisher_month')
                                            <p class="text-danger mt-1 col-12 mb-4d75 form-row form-row-wide">{{$message}}</p>
                                            @enderror
{{--                                            Publishing Year--}}
                                            <p class="col-12 mb-4d75 form-row form-row-wide address-field validate-required" id="publisher_year_field" data-priority="60" data-o_class="form-row form-row-wide address-field validate-required">
                                                <label for="publisher_year" class="form-label">{{__('items')['publisher_year']}} <abbr class="required" title="required">*</abbr></label>
                                                <input type="number" class="input-text form-control" name="publisher_year" id="publisher_year" min="1000" placeholder="Ex: 2000" value="{{$item->publisher_year ?? ''}}" autocomplete="publisher_year">
                                            </p>
                                            @error('publisher_year')
                                            <p class="text-danger mt-1 col-12 mb-4d75 form-row form-row-wide">{{$message}}</p>
                                            @enderror
{{--                                            Publishing Location--}}
                                            <p class="col-12 mb-4d75 form-row form-row-wide" id="publisher_where_field" data-priority="70" data-o_class="form-row form-row-wide">
                                                <label for="publisher_where" class="form-label">{{__('items')['publisher_where']}}</label>
                                                <input type="text" class="input-text form-control" value="{{$item->publisher_where ?? ''}}" placeholder="Ex: Bucharest" name="publisher_where" id="publisher_where" autocomplete="publisher_Where">
                                            </p>
                                            @error('publisher_where')
                                            <p class="text-danger mt-1 col-12 mb-4d75 form-row form-row-wide">{{$message}}</p>
                                            @enderror
{{--                                            Subjects--}}
                                            <p class="col-12 mb-4d75 form-row form-row-wide" id="subjects_field" data-priority="80" data-o_class="form-row form-row-wide">
                                                <label for="multipleSelect" class="form-label">{{__('subjects')['subjects']}} <abbr class="required" title="required">*</abbr></label>
                                                <select id="multipleSelect" multiple name="subjects_id" placeholder="Subjects" data-search="true" data-silent-initial-value-set="true">
                                                    @foreach($subjects as $subject)
                                                        <option value="{{$subject->id}}"
                                                                @foreach($item->subjects as $itemSubject)
                                                                @if($itemSubject->id == $subject->id) selected @endif
                                                            @endforeach
                                                        >{{$subject->title}}</option>
                                                    @endforeach
                                                </select>
                                            </p>
                                            @error('subjects_id')
                                            <p class="text-danger mt-1 col-12 mb-4d75 form-row form-row-wide">{{$message}}</p>
                                            @enderror
{{--                                            Cover Path--}}
                                            <p class="col-12 mb-4d75 form-row form-row-wide" id="cover_path_field" data-priority="100">
                                                <label for="cover_path" class="form-label">{{__('items')['cover_path']}} <abbr class="required" title="required">*</abbr></label>
                                                <input type="file" class="border border-gray-200 rounded p-2 w-full" name="cover_path" id="cover_path" value="{{old('cover_path')}}">
                                            </p>
                                            @error('cover_path')
                                            <p class="text-danger mt-1 col-12 mb-4d75 form-row form-row-wide">{{$message}}</p>
                                            @enderror
{{--                                            PDF Path--}}
                                            <p class="col-12 mb-4d75 form-row form-row-wide" id="pdf_path_field" data-priority="110">
                                                <label for="pdf_path" class="form-label">{{__('items')['pdf_path']}} <abbr class="required" title="required">*</abbr></label>
                                                <input type="file" class="border border-gray-200 rounded p-2 w-full" name="pdf_path" id="pdf_path" value="{{old('pdf_path')}}">
                                            </p>
                                            @error('pdf_path')
                                            <p class="text-danger mt-1 col-12 mb-4d75 form-row form-row-wide">{{$message}}</p>
                                            @enderror
{{--                                            Description--}}
                                            <p class="col-12 mb-4d75 form-row notes" id="description_field" data-priority="120">
                                                <label for="description" class="form-label">{{__('items')['description']}}</label>
                                                <textarea name="description" class="input-text form-control" id="description" placeholder="Ex: Quia beatae tempore rerum dicta et voluptas ullam. Velit ea quis et. Est harum quas quas reprehenderit autem maiores voluptatem beatae. Eum quam mollitia repudiandae dolorem dolores eveniet quia. Aut aliquid quo quia est repudiandae voluptas cum sunt. Vitae sunt nulla perferendis sed." rows="8" cols="5">{{$item->description ?? ''}}</textarea>
                                            </p>
                                            @error('description')
                                            <p class="text-danger mt-1 col-12 mb-4d75 form-row form-row-wide">{{$message}}</p>
                                            @enderror
{{--                                            Language--}}
                                            <p class="col-12 mb-4d75 form-row form-row-wide" id="language_field" data-priority="130" data-o_class="form-row form-row-wide">
                                                <label for="language" class="form-label">{{__('items')['language']}}</label>
                                                <input type="text" class="input-text form-control" value="{{$item->language ?? ''}}" placeholder="Ex: Romanian" name="language" id="language" autocomplete="language">
                                            </p>
                                            @error('language')
                                            <p class="text-danger mt-1 col-12 mb-4d75 form-row form-row-wide">{{$message}}</p>
                                            @enderror
{{--                                            Provider--}}
                                            <p class="col-12 mb-4d75 form-row form-row-wide" id="provider_field" data-priority="140" data-o_class="form-row form-row-wide">
                                                <label for="provider" class="form-label">{{__('items')['provider']}}</label>
                                                <input type="text" class="input-text form-control" value="{{$item->provider ?? "BCU 'Carol I' Bucuresti"}}" placeholder="Ex: BCU 'Carol I' Bucuresti" name="provider" id="provider" autocomplete="provider">
                                            </p>
                                            @error('provider')
                                            <p class="text-danger mt-1 col-12 mb-4d75 form-row form-row-wide">{{$message}}</p>
                                            @enderror
{{--                                            Rights--}}
                                            <p class="col-12 mb-4d75 form-row form-row-wide" id="rights_field" data-priority="150" data-o_class="form-row form-row-wide">
                                                <label for="rights" class="form-label">{{__('items')['rights']}}</label>
                                                <input type="text" class="input-text form-control" value="{{$item->rights ?? "https://creativecommons.org/publicdomain/mark/1.0"}}" placeholder="Ex: https://creativecommons.org/publicdomain/mark/1.0" name="rights" id="rights" autocomplete="rights">
                                            </p>
                                            @error('rights')
                                            <p class="text-danger mt-1 col-12 mb-4d75 form-row form-row-wide">{{$message}}</p>
                                            @enderror
{{--                                            ISBN--}}
                                            <p class="col-12 mb-4d75 form-row form-row-wide" id="ISBN_field" data-priority="160" data-o_class="form-row form-row-wide">
                                                <label for="ISBN" class="form-label">ISBN</label>
                                                <input type="text" class="input-text form-control" value="{{$item->ISBN ?? ''}}" placeholder="Ex: 9780977476077" name="ISBN" id="ISBN" autocomplete="ISBN">
                                            </p>
                                            @error('ISBN')
                                            <p class="text-danger mt-1 col-12 mb-4d75 form-row form-row-wide">{{$message}}</p>
                                            @enderror
{{--                                            ISSN--}}
                                            <p class="col-12 mb-4d75 form-row form-row-wide" id="vubis_id_field" data-priority="170" data-o_class="form-row form-row-wide">
                                                <label for="vubis_id" class="form-label">Vubis ID (optional)</label>
                                                <input type="text" class="input-text form-control" value="{{$item->vubis_id ?? ''}}" placeholder="Ex: 800100" name="vubis_id" id="vubis_id" autocomplete="vubis_id">
                                            </p>
                                            @error('ISSN')
                                            <p class="text-danger mt-1 col-12 mb-4d75 form-row form-row-wide">{{$message}}</p>
                                            @enderror
{{--                                            Vubis ID--}}
                                            <p class="col-12 mb-4d75 form-row form-row-wide" id="vubis_id_field" data-priority="170" data-o_class="form-row form-row-wide">
                                                <label for="vubis_id" class="form-label">Vubis ID (optional)</label>
                                                <input type="text" class="input-text form-control" value="{{$item->vubis_id ?? ''}}" placeholder="Ex: 800100" name="vubis_id" id="vubis_id" autocomplete="vubis_id">
                                            </p>
                                            @error('vubis_id')
                                            <p class="text-danger mt-1 col-12 mb-4d75 form-row form-row-wide">{{$message}}</p>
                                            @enderror
{{--                                            Type--}}
                                            <p class="col-12 mb-4d75 form-row form-row-wide" id="type_field" data-priority="180">
                                                <label for="type" class="form-label">{{__('items')['type']}} <abbr class="required" title="required">*</abbr></label>
                                                <select name="type" id="type" class="form-control select2-hidden-accessible"
                                                        autocomplete="type" tabindex="-1" aria-hidden="true">
                                                    <option value="{{Item::type_Book}}" @if($item->type == Item::type_Book) selected @endif>{{Item::type_Book}}</option>
                                                    <option value="{{Item::type_OldBook}}" @if($item->type == Item::type_OldBook) selected @endif>{{Item::type_OldBook}}</option>
                                                    <option value="{{Item::type_Map}}" @if($item->type == Item::type_Map) selected @endif>{{Item::type_Map}}</option>
                                                    <option value="{{Item::type_Manuscript}}" @if($item->type == Item::type_Manuscript) selected @endif>{{Item::type_Manuscript}}</option>
                                                    <option value="{{Item::type_Periodic}}" @if($item->type == Item::type_Periodic) selected @endif>{{Item::type_Periodic}}</option>
                                                </select>
                                            </p>
                                            @error('type')
                                            <p class="text-danger mt-1 col-12 mb-4d75 form-row form-row-wide">{{$message}}</p>
                                            @enderror
{{--                                            Status--}}
                                            <p class="col-12 mb-4d75 form-row form-row-wide" id="status_field" data-priority="190">
                                                <label for="status" class="form-label">{{__('items')['status']}} <abbr class="required" title="required">*</abbr></label>
                                                <select name="status" id="status" class="form-control select2-hidden-accessible"
                                                        autocomplete="status" tabindex="-1" aria-hidden="true">
                                                    <option value="{{Item::STATUS_ACTIVE}}" @if($item->status == Item::STATUS_ACTIVE) selected @endif>{{Item::STATUS_ACTIVE}}</option>
                                                    <option value="{{Item::STATUS_INACTIVE}}" @if($item->status == Item::STATUS_INACTIVE) selected @endif>{{Item::STATUS_INACTIVE}}</option>w
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
        <script type="text/javascript">
            VirtualSelect.init({
                ele: '#multipleSelect',
                setValueAsArray: false,
                emptyValue: null,
                showValueAsTags: true
            });
        </script>
    @endsection
