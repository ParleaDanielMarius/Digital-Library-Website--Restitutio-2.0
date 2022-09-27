<div class="woocommerce-tabs wc-tabs-wrapper mb-10 row">
    <!-- Nav Classic -->
    <ul class="col-lg-4 col-xl-3 pt-9 border-top d-lg-block tabs wc-tabs nav justify-content-lg-center flex-nowrap flex-lg-wrap overflow-auto overflow-lg-visble" id="pills-tab" role="tablist">
        <li class="flex-shrink-0 flex-lg-shrink-1 nav-item mb-3">
            <a class="py-1 d-inline-block nav-link font-weight-medium active" id="pills-one-example1-tab" data-toggle="pill" href="#pills-one-example1" role="tab" aria-controls="pills-one-example1" aria-selected="true">
                Description
            </a>
        </li>
        <li class="flex-shrink-0 flex-lg-shrink-1 nav-item mb-3">
            <a class="py-1 d-inline-block nav-link font-weight-medium" id="pills-two-example1-tab" data-toggle="pill" href="#pills-two-example1" role="tab" aria-controls="pills-two-example1" aria-selected="false">
                Item Details
            </a>
        </li>
        <li class="flex-shrink-0 flex-lg-shrink-1 nav-item mb-3">
            <a class="py-1 d-inline-block nav-link font-weight-medium" id="pills-three-example1-tab" data-toggle="pill" href="#pills-three-example1" role="tab" aria-controls="pills-three-example1" aria-selected="false">
                PDF
            </a>
        </li>
        @auth
            <li class="flex-shrink-0 flex-lg-shrink-1 nav-item mb-3">
                <a class="py-1 d-inline-block nav-link font-weight-medium" id="pills-four-example1-tab" data-toggle="pill" href="#pills-four-example1" role="tab" aria-controls="pills-four-example1" aria-selected="false">
                    <b class="text-info">Staff</b>
                </a>
            </li>
        @endauth
    </ul>
    <!-- End Nav Classic -->

    <!-- Tab Content -->
    <div class="tab-content col-lg-8 col-xl-9 border-top" id="pills-tabContent">
        <div class="woocommerce-Tabs-panel panel entry-content wc-tab tab-pane fade border-left pl-4 pt-4 pl-lg-6 pt-lg-6 pl-xl-9 pt-xl-9 show active" id="pills-one-example1" role="tabpanel" aria-labelledby="pills-one-example1-tab">
            <p class="mb-0">{{$deletion->description}}</p>
        </div>
        <div class="woocommerce-Tabs-panel panel entry-content wc-tab tab-pane fade border-left pl-4 pt-4 pl-lg-6 pt-lg-6 pl-xl-9 pt-xl-9" id="pills-two-example1" role="tabpanel" aria-labelledby="pills-two-example1-tab">
            <!-- Mockup Block -->
            <div class="table-responsive mb-4">
                <table class="table table-hover table-borderless">
                    <tbody>
                    <tr>
                        <th class="px-4 px-xl-5">Publication date: </th>
                        <td>{{$deletion->publisher_when ?? 'Unknown'}}</td>
                    </tr>
                    <tr>
                        <th class="px-4 px-xl-5">Publisher:</th>
                        <td>{{$deletion->publisher ?? 'Unknown'}}</td>
                    </tr>
                    <tr>
                        <th class="px-4 px-xl-5">Publication City/Country:</th>
                        <td>{{$deletion->publisher_where ?? 'Unknown'}}</td>
                    </tr>
                    <tr>
                        <th class="px-4 px-xl-5">Language:</th>
                        <td>{{$deletion->language ?? 'Unknown'}}</td>
                    </tr>
                    <tr>
                        <th class="px-4 px-xl-5">Provider: </th>
                        <td>{{$deletion->provider ?? 'Unknown'}}</td>
                    </tr>
                    <tr>
                        <th class="px-4 px-xl-5">Rights:</th>
                        <td><a href="{{$deletion->rights ?? ''}}">{{$deletion->rights ?? 'Unknown'}}</a></td>
                    </tr>

                    </tbody>
                </table>
            </div>
            <!-- End Mockup Block -->
        </div>
        <div class="woocommerce-Tabs-panel panel entry-content wc-tab tab-pane fade border-left pl-4 pt-4 pl-lg-6 pt-lg-6 pl-xl-9 pt-xl-9" id="pills-three-example1" role="tabpanel" aria-labelledby="pills-three-example1-tab">

            <!-- Mockup Block -->
            @if($deletion->pdf_path && file_exists('storage' . '/' . $deletion->pdf_path))

                <iframe id="pdf-js-viewer" src="/assets/PDF.js/web/viewer.html?file=/storage/{{$deletion->pdf_path}}" title="PDF Viewer"  width="700" height="800"></iframe>

                <div class="text-xl font-bold mb-4"><a href="/storage/{{$deletion->pdf_path}}" target="_blank" class="hover:text-red">Click here to open PDF in a separate tab</a></div>

                <div class="border border-gray-200 w-full mb-6"></div>
            @else <h3 class="text-xl font-bold">No PDF Attached</h3>
        @endif
        <!-- End Mockup Block -->
        </div>
            <div class="woocommerce-Tabs-panel panel entry-content wc-tab tab-pane fade border-left pl-4 pt-4 pl-lg-6 pt-lg-6 pl-xl-9 pt-xl-9" id="pills-four-example1" role="tabpanel" aria-labelledby="pills-four-example1-tab">
                <!-- Mockup Block -->
                <div class="table-responsive mb-4">
                    <table class="table table-hover table-borderless">
                        <tbody>
                        <tr>
                            <th class="px-4 px-xl-5">Vubis ID: </th>
                            <td>{{$deletion->vubis_id ?? 'Unknown'}}</td>
                        </tr>
                        <tr>
                            <th class="px-4 px-xl-5">Item Status: </th>
                            <td>{{$deletion->status ?? 'No Value'}}</td>
                        </tr>
                            <tr>
                                <th class="px-4 px-xl-5">Created by: </th>
                                <td>{{$deletion->user->username ?? 'No Value'}}</td>
                            </tr>
                            <tr>
                                <th class="px-4 px-xl-5">Created at: </th>
                                <td>{{$deletion->created_at ?? 'No Value'}}</td>
                            </tr>
                            <tr>
                                <th class="px-4 px-xl-5">Updated by: </th>
                                <td>{{$deletion->userUpdate->username ?? 'No Value'}}</td>
                            </tr>
                            <tr>
                                <th class="px-4 px-xl-5">Updated at: </th>
                                <td>{{$deletion->updated_at ?? 'No Value'}}</td>
                            </tr>
                            <tr>
                                <th class="px-4 px-xl-5">Deleted by: </th>
                                <td>{{$deletion->userDelete->username ?? 'No Value'}}</td>
                            </tr>
                            <tr>
                                <th class="px-4 px-xl-5">Deleted at: </th>
                                <td>{{$deletion->deleted_at ?? 'No Value'}}</td>
                            </tr>
                            <tr>
                                <th class="px-4 px-xl-5">Last restored at: </th>
                                <td>{{$deletion->restored_at ?? 'No Value'}}</td>
                            </tr>
                        <tr>
                            <th class="px-4 px-xl-5">Actions: </th>
                            <td>
                                <a href="#" type="button" data-toggle="modal" data-target="#restoreModal"><i class="fa-solid fa-trash-restore"></i>
                                    Restore
                                </a>
                            </td>
                            <td>
                                <a href="#" type="button" data-toggle="modal" data-target="#deleteModal"><i class="fa-solid fa-trash"></i>
                                    Delete
                                </a>
                            </td>
                            <td>
                                <a href="#" type="button" data-toggle="modal" data-target="#fullDeleteModal"><i class="fa-solid fa-trash-alt"></i>
                                    Full Delete
                                </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <!-- End Mockup Block -->
            </div>
            @include('partials.deletions._restoreModal')
            @include('partials.deletions._deleteModal')
            @include('partials.deletions._fullDeleteModal')


    </div>
    <!-- End Tab Content -->
</div>
