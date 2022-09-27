@extends('layouts.layout-index')

@section('CSS')
    <link rel="stylesheet" href="{{asset('/assets/vendor/cubeportfolio/css/cubeportfolio.min.css')}}">
@endsection

@section('searchbar')
    <div class="site-search ml-xl-0 ml-md-auto w-r-100 my-2 my-xl-0">
        <form action="" class="form-inline" method="get">
            <div class="input-group">
                <div class="input-group-prepend">
                    <i class="glph-icon flaticon-loupe input-group-text py-2d75 bg-white-100 border-white-100"></i>
                </div>
                <input id="search" name="search" value="{{request('search') ?? ''}}" class="form-control bg-white-100 min-width-380 py-2d75 height-4 border-white-100" type="search" placeholder="Search for authors ..." aria-label="Search">
            </div>
            <button class="btn btn-outline-success my-2 my-sm-0 sr-only" type="submit">Search</button>
        </form>
    </div>
@endsection

@section('content')

    <main id="content">
        <div class="space-bottom-2 space-bottom-lg-3">
            <div class="pb-lg-1">
                <div class="page-header border-bottom">
                    <div class="container">
                        <div class="d-md-flex justify-content-between align-items-center py-4">
                            <h1 class="page-title font-size-3 font-weight-medium m-0 text-lh-lg">Browse Authors</h1>
                            <nav class="woocommerce-breadcrumb font-size-2">
                                <a href="../home/index.html" class="h-primary">Home</a>
                                <span class="breadcrumb-separator mx-1"><i class="fas fa-angle-right"></i></span>
                                <span>Authors</span>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="u-cubeportfolio mb-5 mb-lg-7">
                        <!-- Content -->
                        <div class="cbp"
                             data-layout="grid"
                             data-animation="quicksand"
                             data-x-gap="20"
                             data-y-gap="100"
                             data-media-queries='[
                            {"width": 1100, "cols": 5},
                            {"width": 800, "cols": 3},
                            {"width": 480, "cols": 1}
                          ]'>

                            <!-- Item -->
                            @forelse($authors as $author)
                                <x-authors.author-card :author="$author"></x-authors.author-card>
                            @empty
                                <div class="cbp-item">
                                    <a class="cbp-caption">
                                        <div class="py-3 text-center">
                                            <h4 class="h6 text-dark">No Authors Found</h4>
                                        </div>
                                    </a>
                                </div>
                        @endforelse
                        <!-- End Item -->


                        </div>
                    {{ $authors->links('vendor.pagination.bootstrap-5') }}
                    <!-- End Content -->
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection

@section('JS')
    <script src="{{asset('/assets/vendor/cubeportfolio/js/jquery.cubeportfolio.min.js')}}"></script>
@endsection

@section('JS HS')
    <script src="{{asset('/assets/js/components/hs.cubeportfolio.js')}}"></script>
@endsection

@section('scripts')
    // initialization of cubeportfolio
    $.HSCore.components.HSCubeportfolio.init('.cbp');
@endsection
