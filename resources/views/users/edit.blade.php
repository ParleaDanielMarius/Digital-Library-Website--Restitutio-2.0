@php
    use App\Models\User
@endphp


@extends('layouts.layout-index')

@section('content')

    <div class="page-header border-bottom">
        <div class="container">
            <div class="d-md-flex justify-content-between align-items-center py-4">
                <h1 class="page-title font-size-3 font-weight-medium m-0 text-lh-lg">Edit User</h1>
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
                            <h4 class="entry-title font-size-7 text-center">Edit {{$user->username}}</h4>
                        </header>

                        <form method="POST" class="checkout woocommerce-checkout row mt-8" action="{{route('users.update', $user)}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="col2-set col-md-6 col-lg-7 col-xl-8 mb-6 mb-md-0" id="customer_details">
                                <div class="px-4 pt-5 bg-white border">
                                    <div class="woocommerce-billing-fields">

                                        <h3 class="mb-4 font-size-3">User details</h3>

                                        <div class="woocommerce-billing-fields__field-wrapper row">
                                            <p class="col-12 mb-4d75 form-row form-row-wide validate-required woocommerce-invalid woocommerce-invalid-required-field" id="first_name_field" data-priority="10">
                                                <label for="first_name" class="form-label">First Name <abbr class="required" title="required">*</abbr></label>
                                                <input type="text" class="input-text form-control" name="first_name" id="first_name" placeholder="Ex: John" value="{{$user->first_name ?? ''}}" autocomplete="first_name" autofocus="autofocus">
                                            </p>

                                            <p class="col-12 mb-4d75 form-row form-row-wide" id="last_name_field" data-priority="20">
                                                <label for="last_name" class="form-label">Last Name</label>
                                                <input type="text" class="input-text form-control" name="last_name" id="last_name" placeholder="Ex: Doe" value="{{$user->last_name ?? ''}}" autocomplete="last_name">
                                            </p>

                                            <p class="col-12 mb-4d75 form-row form-row-wide" id="username_field" data-priority="30">
                                                <label for="username" class="form-label">Username</label>
                                                <input type="text" class="input-text form-control" name="username" id="username" placeholder="Ex: johndoe21" value="{{$user->username ?? ''}}" autocomplete="username">
                                            </p>


                                            <p class="col-12 mb-4d75 form-row form-row-last validate-required validate-email" id="email_field" data-priority="40">
                                                <label for="email" class="form-label">Email address <abbr class="required" title="required">*</abbr></label>
                                                <input type="email" class="input-text form-control" name="email" id="email" placeholder="john.doe@bcub.ro" value="{{$user->email ?? ''}}" autocomplete="email">
                                            </p>

                                            <p class="col-12 mb-4d75 form-row form-row-wide" id="password_field" data-priority="50">
                                                <label for="password" class="form-label">Password</label>
                                                <input type="password" class="input-text form-control" name="password" id="password">
                                            </p>

                                            <p class="col-12 mb-4d75 form-row form-row-wide" id="password_confirmation_field" data-priority="60">
                                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                                <input type="password" class="input-text form-control" name="password_confirmation" id="password_confirmation">
                                            </p>

                                            <p class="col-12 mb-4d75 form-row form-row-wide" id="location_field" data-priority="70">
                                                <label for="location" class="form-label">Location</label>
                                                <input type="text" class="input-text form-control" name="location" id="location" placeholder="Ex: BCU Carol I" value="{{$user->location ?? ''}}" autocomplete="location">
                                            </p>

                                            <p class="col-12 mb-4d75 form-row form-row-wide" id="role_field" data-priority="90">
                                                <label for="role" class="form-label">Role <abbr class="required" title="required">*</abbr></label>
                                                <select name="role" id="role" class="form-control select2-hidden-accessible"
                                                        autocomplete="role" tabindex="-1" aria-hidden="true">
                                                    <option value="{{User::role_Librarian}}" @if($user->role == User::role_Librarian) selected @endif>{{User::role_Librarian}}</option>
                                                    <option value="{{User::role_Admin}}" @if($user->role == User::role_Admin) selected @endif>{{User::role_Admin}}</option>
                                                </select>
                                            </p>

                                            <p class="col-12 mb-4d75 form-row form-row-wide" id="status_field" data-priority="100">
                                                <label for="status" class="form-label">Status <abbr class="required" title="required">*</abbr></label>
                                                <select name="status" id="status" class="form-control select2-hidden-accessible"
                                                        autocomplete="status" tabindex="-1" aria-hidden="true">
                                                    <option value="{{User::STATUS_ACTIVE}}" @if($user->status == User::STATUS_ACTIVE) selected @endif>{{User::STATUS_ACTIVE}}</option>
                                                    <option value="{{User::STATUS_INACTIVE}}" @if($user->status == User::STATUS_INACTIVE) selected @endif>{{User::STATUS_INACTIVE}}</option>
                                                </select>
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


