<div class="woocommerce-tabs wc-tabs-wrapper mb-10 row">
    <!-- Nav Classic -->
    <ul class="col-lg-4 col-xl-3 pt-9 border-top d-lg-block tabs wc-tabs nav justify-content-lg-center flex-nowrap flex-lg-wrap overflow-auto overflow-lg-visible" id="pills-tab" role="tablist">
        <li class="flex-shrink-0 flex-lg-shrink-1 nav-item mb-3">
            <a class="py-1 d-inline-block nav-link font-weight-medium active" id="pills-one-tab" data-toggle="pill" href="#pills-one" role="tab" aria-controls="pills-one" aria-selected="true">
                {{__('items')['description']}}
            </a>
        </li>
        <li class="flex-shrink-0 flex-lg-shrink-1 nav-item mb-3">
            <a class="py-1 d-inline-block nav-link font-weight-medium" id="pills-two-tab" data-toggle="pill" href="#pills-two" role="tab" aria-controls="pills-two" aria-selected="false">
                {{__('items')['details']}}
            </a>
        </li>
        <li class="flex-shrink-0 flex-lg-shrink-1 nav-item mb-3">
            <a class="py-1 d-inline-block nav-link font-weight-medium" id="pills-three-tab" data-toggle="pill" href="#pills-three" role="tab" aria-controls="pills-three" aria-selected="false">
                PDF
            </a>
        </li>
        @auth
            <li class="flex-shrink-0 flex-lg-shrink-1 nav-item mb-3">
                <a class="py-1 d-inline-block nav-link font-weight-medium" id="pills-four-tab" data-toggle="pill" href="#pills-four" role="tab" aria-controls="pills-four" aria-selected="false">
                    <b class="text-info">Staff</b>
                </a>
            </li>
        @endauth
    </ul>
    <!-- End Nav Classic -->

    <!-- Tab Content -->
    <div class="tab-content col-lg-8 col-xl-9 border-top" id="pills-tabContent">
        <div class="woocommerce-Tabs-panel panel entry-content wc-tab tab-pane fade border-left pl-4 pt-4 pl-lg-6 pt-lg-6 pl-xl-9 pt-xl-9 show active" id="pills-one" role="tabpanel" aria-labelledby="pills-one-tab">
            <p class="mb-0">{{$item->description}}</p>
        </div>
        <div class="woocommerce-Tabs-panel panel entry-content wc-tab tab-pane fade border-left pl-4 pt-4 pl-lg-6 pt-lg-6 pl-xl-9 pt-xl-9" id="pills-two" role="tabpanel" aria-labelledby="pills-two-tab">
            <!-- Mockup Block -->
            <div class="table-responsive mb-4">
                <table class="table table-hover table-borderless">
                    <tbody>
                    <tr>
                        <th class="px-4 px-xl-5">{{__('items')['publisher_when']}}: </th>
                        <td>{{$item->publisher_when ?? 'Unknown'}}</td>
                    </tr>
                    <tr>
                        <th class="px-4 px-xl-5">{{__('items')['publisher']}}:</th>
                        <td>{{$item->publisher ?? 'Unknown'}}</td>
                    </tr>
                    <tr>
                        <th class="px-4 px-xl-5">{{__('items')['publisher_where']}}:</th>
                        <td>{{$item->publisher_where ?? 'Unknown'}}</td>
                    </tr>
                    <tr>
                        <th class="px-4 px-xl-5">{{__('items')['language']}}:</th>
                        <td>{{$item->language ?? 'Unknown'}}</td>
                    </tr>
                    <tr>
                        <th class="px-4 px-xl-5">{{__('items')['provider']}}: </th>
                        <td>{{$item->provider ?? 'Unknown'}}</td>
                    </tr>
                    <tr>
                        <th class="px-4 px-xl-5">{{__('items')['rights']}}:</th>
                        <td><a href="{{$item->rights ?? ''}}">{{$item->rights ?? 'Unknown'}}</a></td>
                    </tr>

                    </tbody>
                </table>
            </div>
            <!-- End Mockup Block -->
        </div>
        <div class="woocommerce-Tabs-panel panel entry-content wc-tab tab-pane fade border-left pl-4 pt-4 pl-lg-6 pt-lg-6 pl-xl-9 pt-xl-9" id="pills-three" role="tabpanel" aria-labelledby="pills-three-tab">

            <!-- Mockup Block -->
            @if($item->pdf_path && file_exists('storage' . '/' . $item->pdf_path))

                <iframe id="pdf-js-viewer" src="{{asset('/assets/PDF.js/web/viewer.html?file=/storage/' . $item->pdf_path)}}" title="PDF Viewer"  width="100%" height="600"></iframe>

                <div class="text-xl font-bold mb-4"><a href="/storage/{{$item->pdf_path}}" target="_blank" class="hover:text-red">{{__('click here to open pdf')}}</a></div>

                <div class="border border-gray-200 w-full mb-6"></div>
            @else <h3 class="text-xl font-bold">{{__('no pdf attached')}}</h3>
        @endif
        <!-- End Mockup Block -->
        </div>
        @auth
            <div class="woocommerce-Tabs-panel panel entry-content wc-tab tab-pane fade border-left pl-4 pt-4 pl-lg-6 pt-lg-6 pl-xl-9 pt-xl-9" id="pills-four" role="tabpanel" aria-labelledby="pills-four-tab">
                <!-- Mockup Block -->
                <div class="table-responsive mb-4">
                    <table class="table table-hover table-borderless">
                        <tbody>
                        <tr>
                            <th class="px-4 px-xl-5">{{__('items')['status']}}: </th>
                            <td>{{$item->status ?? 'No Value'}}</td>
                        </tr>
                        @if(auth()->user()->isAdmin())
                            <tr>
                                <th class="px-4 px-xl-5">{{__('items')['created_by']}}: </th>
                                <td>{{$item->user->username ?? 'No Value'}}</td>
                            </tr>
                            <tr>
                                <th class="px-4 px-xl-5">{{__('items')['created_at']}}: </th>
                                <td>{{$item->created_at ?? 'No Value'}}</td>
                            </tr>
                            <tr>
                                <th class="px-4 px-xl-5">{{__('items')['updated_by']}}: </th>
                                <td>{{$item->user->username ?? 'No Value'}}</td>
                            </tr>
                            <tr>
                                <th class="px-4 px-xl-5">{{__('items')['updated_at']}}: </th>
                                <td>{{$item->updated_at ?? 'No Value'}}</td>
                            </tr>
                        @endif
                        <tr>
                            <th class="px-4 px-xl-5">{{__('actions')}}: </th>
                            <td>
                                <a href="{{route('items.edit', $item->slug)}}" type="button"><i class="fa-solid fa-pencil"></i>
                                    {{__('librarian')['edit item']}}
                                </a>
                            </td>
                            <td>
                                <a href="#" type="button" data-toggle="modal" data-target="#deleteModal"><i class="fa-solid fa-trash"></i>
                                    {{__('librarian')['delete item']}}
                                </a>
                            </td>
                            <td>
                                <a href="#" type="button" data-toggle="modal" data-target="#statusModal"><i class="fa-solid fa-power-off"></i>
                                    {{__('librarian')['change status']}}
                                </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <!-- End Mockup Block -->
            </div>
            @include('partials.items._deleteModal')
            @include('partials.items._statusModal')
        @endauth

    </div>
    <!-- End Tab Content -->
</div>
