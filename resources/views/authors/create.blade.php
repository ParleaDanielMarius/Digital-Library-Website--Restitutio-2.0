
@extends('layouts.layout-index')

@section('content')

    <div class="page-header border-bottom">
        <div class="container">
            <div class="d-md-flex justify-content-between align-items-center py-4">
                <h1 class="page-title font-size-3 font-weight-medium m-0 text-lh-lg">Create Author</h1>
                <nav class="woocommerce-breadcrumb font-size-2">
                    <a href="#" class="h-primary">Home</a>
                    <span class="breadcrumb-separator mx-1"><i class="fas fa-angle-right"></i></span>
                    <a href="#" class="h-primary">Shop</a>
                    <span class="breadcrumb-separator mx-1"><i class="fas fa-angle-right"></i></span>Shop Single
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
                            <h4 class="entry-title font-size-7 text-center">Create Author</h4>
                        </header>

                        <form method="POST" class="checkout woocommerce-checkout row mt-8" action="{{route('authors.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="col2-set col-md-6 col-lg-7 col-xl-8 mb-6 mb-md-0" id="customer_details">
                                <div class="px-4 pt-5 bg-white border">
                                    <div class="woocommerce-billing-fields">

                                        <h3 class="mb-4 font-size-3">Author details</h3>

                                        <div class="woocommerce-billing-fields__field-wrapper row">
                                            <p class="col-12 mb-4d75 form-row form-row-wide validate-required woocommerce-invalid woocommerce-invalid-required-field" id="title_field" data-priority="10">
                                                <label for="first_name" class="form-label">First Name <abbr class="required" title="required">*</abbr></label>
                                                <input type="text" class="input-text form-control" name="first_name" id="first_name" placeholder="Ex: Mihai / Fundatia Culturala / Uniunea Ziaristilor din" value="{{old('first_name') ?? ''}}" autocomplete="first_name" autofocus="autofocus">
                                            </p>

                                            <p class="col-12 mb-4d75 form-row form-row-wide" id="title_long_field" data-priority="20">
                                                <label for="last_name" class="form-label">Last Name</label>
                                                <input type="text" class="input-text form-control" name="last_name" id="last_name" placeholder="Ex: Eminescu / Augustin Buzura / R.P.Română" value="{{old('last_name') ?? ''}}" autocomplete="last_name">
                                            </p>

                                            <p class="col-12 mb-4d75 form-row notes" id="description_field" data-priority="120">
                                                <label for="description" class="form-label">Description</label>
                                                <textarea name="description" class="input-text form-control" id="description" placeholder="Ex: Quia beatae tempore rerum dicta et voluptas ullam. Velit ea quis et. Est harum quas quas reprehenderit autem maiores voluptatem beatae. Eum quam mollitia repudiandae dolorem dolores eveniet quia. Aut aliquid quo quia est repudiandae voluptas cum sunt. Vitae sunt nulla perferendis sed." rows="8" cols="5">{{old('description') ?? ''}}</textarea>
                                            </p>





                                        </div>

                                    </div>
                                    <input type="submit" class="button alt btn btn-primary rounded-0 py-4" name="submit" id="submit" value="Submit" data-value="submit">
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


