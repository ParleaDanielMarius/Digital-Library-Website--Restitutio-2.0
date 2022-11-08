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
                    <a href="{{route('home')}}" class="h-primary">{{__('home')}}</a>
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
                                                <input required type="text" class="input-text form-control" name="title" id="title" placeholder="Ex: Romeo and Juliet" value="{{old('title') ?? ''}}" autocomplete="title" autofocus="autofocus">
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
                                                <select multiple required
                                                        id="collectionsSelect"
                                                        name="collections_id" placeholder="{{__('collections')['collections']}}"
                                                        data-search="true" data-silent-initial-value-set="true"
                                                >
                                                    @foreach($collections as $collection)
                                                        <option value="{{$collection->id}}" @if(old('collections_id' === $collection->title)) selected @endif>{{$collection->title}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('collections_id')
                                            <p class="text-danger mt-1 col-12 mb-4d75 form-row form-row-wide">{{$message}}</p>
                                            @enderror
{{--                                                    Authors--}}
                                            <div class="col-12 mb-4d75 form-row form-row-wide">
                                                <label for="authors_container" class="col-12 mb-4d75 form-label">{{__('items')['contributors']}} <abbr class="required" title="required">*</abbr></label>
                                                <div id="authors_container" class="authors_container">
                                                    <button class="add_author_field rounded">{{__('librarian')['add author']}} &nbsp;
                                                        <span style="font-size:16px; font-weight:bold;">+ </span>
                                                    </button>
                                                    <div class="author_wrapper"><input required class="authors" placeholder="Person" value="{{old('authors_id')[0] ?? ''}}" type="text" name="authors_id[]"><input value="{{old('contribution')[0] ?? ''}}" required placeholder="Contribution" type="text" name="contribution[]"/><a href="#" class="checkData mx-5">Check</a></div>
                                                    @if(old('authors_id'))
                                                        @foreach(old('authors_id') as $key => $value)
                                                            @if($key != 0)
                                                                <div class="author_wrapper"><input required class="authors" placeholder="Person" type="text" name="authors_id[]" value="{{$value}}"><input required value="{{old('contribution')[$key] ?? ''}}" placeholder="Contribution" type="text" name="contribution[]"/><a href="#" class="checkData mx-5">Check</a><a href="#" class="delete">Delete</a></div>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                            @error('authors_id')
                                            <p class="text-danger mt-1 col-12 mb-4d75 form-row form-row-wide">{{$message}}</p>
                                            @enderror
{{--                                                    Subjects--}}
                                            <div class="col-12 mb-4d75 form-row form-row-wide">
                                                <label for="subjects_container" class="col-12 mb-4d75 form-label">{{__('subjects')['subjects']}}</label>
                                                <div id="subjects_container" class="subjects_container">
                                                    <button class="add_subject_field rounded">{{__('librarian')['add subject']}} &nbsp;
                                                        <span style="font-size:16px; font-weight:bold;">+ </span>
                                                    </button>
                                                    <div class="subject_wrapper"><input class="subjects" placeholder="{{__('subjects')['subject']}}" value="{{old('subjects_id')[0] ?? ''}}" type="text" name="subjects_id[]"><a href="#" class="checkData mx-5">Check</a></div>
                                                    @if(old('subjects_id'))
                                                        @foreach(old('subjects_id') as $key => $value)
                                                            @if($key != 0)
                                                                <div class="subject_wrapper"><input required class="subjects" placeholder="{{__('subjects')['subject']}}" type="text" name="subjects_id[]" value="{{$value}}"><a href="#" class="checkData mx-5">Check</a><a href="#" class="delete">Delete</a></div>
                                                            @endif
                                                        @endforeach
                                                    @endif
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
                                                <label for="publisher_day" class="form-label">{{__('items')['publisher_day']}}<abbr class="required" title="Required if month was entered">*</abbr></label>
                                                <input type="number" class="input-text form-control" name="publisher_day" id="publisher_day" min="1" max="31" placeholder="Ex: 26" value="{{old('publisher_day') ?? ''}}" autocomplete="publisher_day">
                                            </p>
                                            @error('publisher_day')
                                            <p class="text-danger mt-1 col-12 mb-4d75 form-row form-row-wide">{{$message}}</p>
                                            @enderror
{{--                                                    Publishing Month--}}
                                            <p class="col-12 mb-4d75 form-row form-row-wide address-field validate-required" id="publisher_month_field" data-priority="60" data-o_class="form-row form-row-wide address-field validate-required">
                                                <label for="publisher_month" class="form-label">{{__('items')['publisher_month']}} <abbr class="required" title="Required if day was entered">*</abbr></label>
                                                <input type="number" class="input-text form-control" name="publisher_month" id="publisher_month" min="1" max="12" placeholder="Ex: 06" value="{{old('publisher_month') ?? ''}}" autocomplete="publisher_month">
                                            </p>
                                            @error('publisher_month')
                                            <p class="text-danger mt-1 col-12 mb-4d75 form-row form-row-wide">{{$message}}</p>
                                            @enderror
{{--                                                    Publishing Year--}}
                                            <p class="col-12 mb-4d75 form-row form-row-wide address-field validate-required" id="publisher_year_field" data-priority="60" data-o_class="form-row form-row-wide address-field validate-required">
                                                <label for="publisher_year" class="form-label">{{__('items')['publisher_year']}}</label>
                                                <input type="number" class="input-text form-control" name="publisher_year" id="publisher_year" min="1000" max="2500" placeholder="Ex: 2000" value="{{old('publisher_year') ?? ''}}" autocomplete="publisher_year">
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
{{--                                                    Type--}}
                                            <p class="col-12 mb-4d75 form-row form-row-wide type-form-p" id="type_field" data-priority="180">
                                                <label for="type" class="form-label">{{__('items')['type']}} <abbr class="required" title="required">*</abbr></label>
                                                <select name="type" id="type" class="form-control select2-hidden-accessible type-format"
                                                        autocomplete="type" tabindex="-1" aria-hidden="true">
                                                    <option value="Carte" @if(old('type') == 'Carte') selected @endif>{{__('items')['book']}}</option>
                                                    <option value="Carte Veche" @if(old('type') == 'Carte Veche') selected @endif>{{__('items')['old book']}}</option>
                                                    <option value="Manuscris" @if(old('type') == 'Manuscris') selected @endif>{{__('items')['manuscript']}}</option>
                                                    <option value="Hartă" @if(old('type') == 'Hartă') selected @endif>{{__('items')['map']}}</option>
                                                    <option value="Serial" @if(old('type') == 'Serial') selected @endif>{{__('items')['serial']}}</option>
                                                    <option value="Ex Libris" @if(old('type') == 'Ex Libris') selected @endif>{{__('items')['ex libris']}}</option>
                                                    <option value="Fotografie" @if(old('type') == 'Fotografie') selected @endif>{{__('items')['photograph']}}</option>
                                                    <option value="Document" @if(old('type') == 'Document') selected @endif>{{__('items')['document']}}</option>
                                                    <option value="Carte Poștală" @if(old('type') == 'Carte Poștală') selected @endif>{{__('items')['postcard']}}</option>
                                                    <option value="Other" @if(!in_array(old('type'), ['Carte', 'Carte Veche', 'Manuscris', 'Hartă', 'Serial', 'Ex Libris', 'Fotografie', 'Document', 'Carte Poștală'])) selected @endif>{{__('items')['other']}}</option>
                                                </select>
                                                @if(old('additionalType'))
                                                    <input required class="additionalType my-2 form-control" value="{{old('additionalType')}}" placeholder="Type" type="text" name="additionalType"/>
                                                @endif
                                            </p>
                                            @error('type')
                                            <p class="text-danger mt-1 col-12 mb-4d75 form-row form-row-wide">{{$message}}</p>
                                            @enderror
                                            @error('additionalType')
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

    <div class="modal fade" id="checkModal" tabindex="-1" role="dialog" aria-labelledby="checkModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="checkModalLabel">DataBase Check</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong><span id="checkResult"></span></strong></p>
                    <p><span id="checkData"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('JS')
    <script src="{{asset('/assets/vendor/Virtual-select/js/virtual-select.min.js')}}"></script>
@endsection

@section('separate scripts')
{{--    Collection Multi-select --}}
    <script type="text/javascript">
        VirtualSelect.init({
            ele: '#collectionsSelect',
            setValueAsArray: false,
            emptyValue: null,
            showValueAsTags: true,
            disableSelectAll: true
        });

    </script>

<script>
    let addField = false;
    const typeSelect = $(".type-format");
    const typeP = $(".type-form-p");

    $(typeSelect).change(function() {
        if($(this).val() === "Other" && $(".additionalType").length < 1) {
            AddField();
        } else {
            RemoveField();
        }
    })

    function AddField() {
        $(typeP).append('<input required class="additionalType my-2 form-control" placeholder="Type" type="text" name="additionalType"/>')
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
        const max_fields = 10;

        // Author Variables
        const wrapper_authors = $(".authors_container");
        const add_button_authors = $(".add_author_field");

        // Subject Variables
        const wrapper_subjects = $(".subjects_container");
        const add_button_subjects = $(".add_subject_field");

        // Add author fields
        $(add_button_authors).click(function(e) {
            e.preventDefault();
            if ($('div.author_wrapper').length < max_fields) {
                $(wrapper_authors).append('<div class="author_wrapper"><input required class="authors" placeholder="Person" type="text" name="authors_id[]"/><input required placeholder="Contribution" type="text" name="contribution[]"/><a href="#" class="checkData mx-5">Check</a><a href="#" class="delete">Delete</a></div>');
            } else {
                alert('You reached the limits')
            }
        });

        // Delete author fields
        $(wrapper_authors).on("click", ".delete", function(e) {
            e.preventDefault();
            $(this).parent('div').remove();
        })

        // Ajax request to check if author exists
        $(wrapper_authors).on("click", ".checkData", function(e) {
            e.preventDefault();
            var search = '/author-check/' + $(this).parent('div').find('.authors').val()
            return $.ajax({
                url: search,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#checkModal').modal('show')
                    $('#checkResult').text('Found!')
                    $('#checkData').text(data.fullname)
                },
                error: function(jqXHR, exception) {
                    var msg = '';
                    if (jqXHR.status === 0) {
                        msg = 'Not connect.\n Verify Network.';
                    } else if (jqXHR.status == 404) {
                        msg = 'Not Found. [404]';
                    } else if (jqXHR.status == 500) {
                        msg = 'Internal Server Error [500].';
                    } else if (exception === 'parsererror') {
                        msg = 'Requested JSON parse failed.';
                    } else if (exception === 'timeout') {
                        msg = 'Time out error.';
                    } else if (exception === 'abort') {
                        msg = 'Ajax request aborted.';
                    } else {
                        msg = 'Uncaught Error.\n' + jqXHR.responseText;
                    }
                    $('#checkModal').modal('show')
                    $('#checkResult').text('Not Found!')
                    $('#checkData').text(msg)
                }
            });
        })

        // Add subject fields
        $(add_button_subjects).click(function(e) {
            e.preventDefault();
            if ($('div.subject_wrapper').length < max_fields) {
                $(wrapper_subjects).append('<div class="subject_wrapper"><input required class="subjects" placeholder="Subject" type="text" name="subjects_id[]"/><a href="#" class="checkData mx-5">Check</a><a href="#" class="delete">Delete</a></div>'); //add input box
            } else {
                alert('You reached the limits')
            }
        });


        // Delete subject fields
        $(wrapper_subjects).on("click", ".delete", function(e) {
            e.preventDefault();
            $(this).parent('div').remove();
        })


        // Ajax request to check subject
        $(wrapper_subjects).on("click", ".checkData", function(e) {
            e.preventDefault();
            var search = '/subject-check/' + $(this).parent('div').find('.subjects').val()
            return $.ajax({
                url: search,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#checkModal').modal('show')
                    $('#checkResult').text('Found!')
                    $('#checkData').text(data.title)
                },
                error: function(jqXHR, exception) {
                    var msg = '';
                    if (jqXHR.status === 0) {
                        msg = 'Not connect.\n Verify Network.';
                    } else if (jqXHR.status == 404) {
                        msg = 'Not Found. [404]';
                    } else if (jqXHR.status == 500) {
                        msg = 'Internal Server Error [500].';
                    } else if (exception === 'parsererror') {
                        msg = 'Requested JSON parse failed.';
                    } else if (exception === 'timeout') {
                        msg = 'Time out error.';
                    } else if (exception === 'abort') {
                        msg = 'Ajax request aborted.';
                    } else {
                        msg = 'Uncaught Error.\n' + jqXHR.responseText;
                    }
                    $('#checkModal').modal('show')
                    $('#checkResult').text('Not Found!')
                    $('#checkData').text(msg)
                }
            });
        })
    });
</script>
@endsection
