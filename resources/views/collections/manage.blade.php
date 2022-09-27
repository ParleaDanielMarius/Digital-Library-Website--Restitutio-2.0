@extends('layouts.layout-index')

@section('CSS')
    <link rel="stylesheet" href="{{asset('/assets/vendor/cubeportfolio/css/cubeportfolio.min.css')}}">
@endsection

@section('content')

    <main id="content">
        <div class="space-bottom-2 space-bottom-lg-3">
            <div class="pb-lg-1">
                <div class="page-header border-bottom">
                    <div class="container">
                        <div class="d-md-flex justify-content-between align-items-center py-4">
                            <h1 class="page-title font-size-3 font-weight-medium m-0 text-lh-lg">Browse Inactive Collections</h1>
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
                            @forelse($collections as $collection)
                                <x-collections.collection-card :collection="$collection"></x-collections.collection-card>
                            @empty
                                <div class="cbp-item">
                                    <a class="cbp-caption">
                                        <div class="py-3 text-center">
                                            <h4 class="h6 text-dark">No Collections Found</h4>
                                        </div>
                                    </a>
                                </div>
                        @endforelse
                        <!-- End Item -->


                        </div>
                    {{ $collections->links('vendor.pagination.bootstrap-5') }}
                    <!-- End Content -->
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-wide border-dark text-dark rounded-0 transition-3d-hover">Load More</button>
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
