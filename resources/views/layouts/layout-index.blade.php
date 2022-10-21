<!DOCTYPE html>
<html lang="en">
<head>
{{--    Title--}}
    <title>Restitutio | @yield('title')</title>
{{--    Required Meta Tags Always Come First--}}
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

{{--    Favicon--}}
    <link rel="shortcut icon" href="../../assets/img/favicon.png">

{{--    FONT AWESOME--}}
    <script src="https://kit.fontawesome.com/f377810201.js" crossorigin="anonymous"></script>

{{--    FONT--}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">

{{--    CSS IMPLEMENTING PLUGINS--}}
    <link rel="stylesheet" href="{{asset('/assets/vendor/font-awesome/css/fontawesome-all.min.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/vendor/flaticon/font/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/vendor/animate.css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/vendor/slick-carousel/slick/slick.css')}}"/>
    <link rel="stylesheet" href="{{asset('/assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css')}}">
    @yield('CSS')

{{--    THEME--}}
    <link rel="stylesheet" href="{{asset('/assets/css/theme.css')}}">
</head>
{{--MESSAGES AND WARNINGS--}}
<x-flash-message />
<x-flash-warning />
<body class="left-sidebar">
<script>0</script>
{{--HEADER CONTENT--}}
<header id="site-header" class="site-header__v1">
    <div class="topbar border-bottom d-none d-md-block">
        <div class="container-fluid px-2 px-md-5 px-xl-8d75">
            <div class="topbar__nav d-md-flex justify-content-between align-items-center">
                <ul class="topbar__nav--left nav ml-md-n3">
                    <li class="nav-item"><a href="mailto:{{__('contact email')}}" class="nav-link link-black-100"><i class="glph-icon flaticon-question mr-2"></i>{{__('contact email display')}}</a></li>
                    <li class="nav-item"><a href="tel:{{__('contact phone')}}" class="nav-link link-black-100"><i class="glph-icon flaticon-phone mr-2"></i>{{__('contact phone display')}}</a></li>
                </ul>

                <ul class="topbar__nav--right nav mr-md-n3">
                    <li class="nav-item"><a href="https://www.instagram.com/bcu_bucuresti/" class="nav-link link-black-100"><i class="fab fa-instagram"></i></a></li>
                    <li class="nav-item"><a href="https://www.facebook.com/BCUCaroII/" class="nav-link link-black-100"><i class="fab fa-facebook-f"></i></a></li>
                    <li class="nav-item"><a href="https://www.youtube.com/user/BibliotecaCentrala/videos" class="nav-link link-black-100"><i class="fab fa-youtube"></i></a></li>
                    <li class="nav-item">
{{--                        Account sidebar toggle--}}
                        <a id="sidebarNavToggler" href="javascript:" role="button" class="nav-link link-black-100"
                           aria-controls="sidebarContent"
                           aria-haspopup="true"
                           aria-expanded="false"
                           data-unfold-event="click"
                           data-unfold-hide-on-scroll="false"
                           data-unfold-target="#sidebarContent"
                           data-unfold-type="css-animation"
                           data-unfold-animation-in="fadeInRight"
                           data-unfold-animation-out="fadeOutRight"
                           data-unfold-duration="500">
                            <i class="glph-icon flaticon-user"></i>
                        </a>
                    </li>
{{--                    Languages--}}
                    <li class="nav-item">
                        <select class="changeLang js-select selectpicker dropdown-select mb-3 mb-lg-0"
                                data-style="border px-4 py-2 rounded-0 height-5 outline-none shadow-none form-control font-size-2"
                                data-dropdown-align-right="true">
                            <option value="ro" {{ session()->get('locale') == 'ro' ? 'selected' : '' }}>@lang('romanian')</option>
                            <option value="en" {{ session()->get('locale') == 'en' ? 'selected' : '' }}>@lang('english')</option>
                        </select>
                    </li>
                </ul>
            </div>
        </div>
    </div>
{{--    NAVBAR--}}
    <div class="masthead border-bottom position-relative" style="margin-bottom: -1px;">
        <div class="container-fluid px-3 px-md-5 px-xl-8d75 py-2 py-md-0">
            <div class="d-flex align-items-center position-relative flex-wrap">
                <div class="offcanvas-toggler mr-4 mr-lg-8">
                    <a id="sidebarNavToggler2" href="javascript:" role="button" class="cat-menu"
                       aria-controls="sidebarContent2"
                       aria-haspopup="true"
                       aria-expanded="false"
                       data-unfold-event="click"
                       data-unfold-hide-on-scroll="false"
                       data-unfold-target="#sidebarContent2"
                       data-unfold-type="css-animation"
                       data-unfold-animation-in="fadeInLeft"
                       data-unfold-animation-out="fadeOutLeft"
                       data-unfold-duration="100">
                        <svg width="20px" height="18px">
                            <path fill-rule="evenodd"  fill="rgb(25, 17, 11)" d="M-0.000,-0.000 L20.000,-0.000 L20.000,2.000 L-0.000,2.000 L-0.000,-0.000 Z"/>
                            <path fill-rule="evenodd"  fill="rgb(25, 17, 11)" d="M-0.000,8.000 L15.000,8.000 L15.000,10.000 L-0.000,10.000 L-0.000,8.000 Z"/>
                            <path fill-rule="evenodd"  fill="rgb(25, 17, 11)" d="M-0.000,16.000 L20.000,16.000 L20.000,18.000 L-0.000,18.000 L-0.000,16.000 Z"/>
                        </svg>
                    </a>
                </div>
{{--                NAVBAR LOGO--}}
                <div class="site-branding pr-md-4">
                    <a href="{{route('home')}}" class="d-block mb-1">
                        <img src="{{asset('/assets/img/LOGO-REST-PH.png')}}" alt="LOGO RESTITUTIO" />
                    </a>
                </div>
                <div class="site-navigation mr-auto d-none d-xl-block">
                    <ul class="nav">
{{--                        Home Nav--}}
                        <li class="nav-item"><a href="{{route('home')}}" class="nav-link link-black-100 mx-4 px-0 py-5 font-weight-medium">@lang('home')</a></li>
{{--                        Browse Nav--}}
                        <li class="nav-item dropdown">
                            <a id="browseDropdownInvoker" href="{{route('items.index')}}" class="dropdown-toggle nav-link link-black-100 mx-4 px-0 py-5 font-weight-medium d-flex align-items-center"
                               aria-haspopup="true"
                               aria-expanded="false"
                               data-unfold-event="hover"
                               data-unfold-target="#browseDropdownMenu"
                               data-unfold-type="css-animation"
                               data-unfold-duration="200"
                               data-unfold-delay="50"
                               data-unfold-hide-on-scroll="true"
                               data-unfold-animation-in="slideInUp"
                               data-unfold-animation-out="fadeOut">
                                {{__('browse')['browse']}}
                            </a>
                            <ul id="browseDropdownMenu" class="dropdown-unfold dropdown-menu font-size-2 rounded-0 border-gray-900" aria-labelledby="blogDropdownInvoker">
                                <li><a href="{{route('authors.index')}}" class="dropdown-item link-black-100">{{__('browse')['browse authors']}}</a></li>
                                <li><a href="{{route('collections.index')}}" class="dropdown-item link-black-100">{{__('browse')['browse collections']}}</a></li>
                                <li><a href="{{route('items.index')}}" class="dropdown-item link-black-100">{{__('browse')['browse items']}}</a></li>
                            </ul>
                        </li>

{{--                        Staff Nav--}}
                        @auth
                        <li class="nav-item dropdown">
                            <a id="blogDropdownInvoker" href="{{route('items.create')}}" class="dropdown-toggle nav-link link-black-100 mx-4 px-0 py-5 font-weight-medium d-flex align-items-center"
                               aria-haspopup="true"
                               aria-expanded="false"
                               data-unfold-event="hover"
                               data-unfold-target="#blogDropdownMenu"
                               data-unfold-type="css-animation"
                               data-unfold-duration="200"
                               data-unfold-delay="50"
                               data-unfold-hide-on-scroll="true"
                               data-unfold-animation-in="slideInUp"
                               data-unfold-animation-out="fadeOut">
                                <b class="text-info">{{__('librarian')['librarian']}}</b>
                            </a>
                            <ul id="blogDropdownMenu" class="dropdown-unfold dropdown-menu font-size-2 rounded-0 border-gray-900" aria-labelledby="blogDropdownInvoker">
                                <li class="position-relative">
                                    <a id="shopDropdownsubmenutwoInvoker" href="{{route('authors.create')}}" class="dropdown-toggle dropdown-item dropdown-item__sub-menu link-black-100 d-flex align-items-center justify-content-between"
                                       aria-haspopup="true"
                                       aria-expanded="false"
                                       data-unfold-event="hover"
                                       data-unfold-target="#shopDropdownsubMenutwo"
                                       data-unfold-type="css-animation"
                                       data-unfold-duration="200"
                                       data-unfold-delay="100"
                                       data-unfold-hide-on-scroll="true"
                                       data-unfold-animation-in="slideInUp"
                                       data-unfold-animation-out="fadeOut">{{__('authors')['authors']}}
                                    </a>
                                    <ul id="shopDropdownsubMenutwo" class="dropdown-unfold dropdown-menu dropdown-sub-menu font-size-2 rounded-0 border-gray-900" aria-labelledby="shopDropdownsubmenutwoInvoker">
                                        <li><a href="{{route('authors.create')}}" class="dropdown-item link-black-100">{{__('librarian')['add author']}}</a></li>
                                    </ul>
                                </li>
                                <li class="position-relative">
                                    <a id="shopDropdownsubmenuthreeInvoker" href="{{route('collections.create')}}" class="dropdown-toggle dropdown-item dropdown-item__sub-menu link-black-100 d-flex align-items-center justify-content-between"
                                       aria-haspopup="true"
                                       aria-expanded="false"
                                       data-unfold-event="hover"
                                       data-unfold-target="#shopDropdownsubMenuthree"
                                       data-unfold-type="css-animation"
                                       data-unfold-duration="200"
                                       data-unfold-delay="100"
                                       data-unfold-hide-on-scroll="true"
                                       data-unfold-animation-in="slideInUp"
                                       data-unfold-animation-out="fadeOut">{{__('collections')['collections']}}
                                    </a>
                                    <ul id="shopDropdownsubMenuthree" class="dropdown-unfold dropdown-menu dropdown-sub-menu font-size-2 rounded-0 border-gray-900" aria-labelledby="shopDropdownsubmenuthreeInvoker">
                                        <li><a href="{{route('collections.create')}}" class="dropdown-item link-black-100">{{__('librarian')['add collection']}}</a></li>
                                        <li><a href="{{route('collections.manage')}}" class="dropdown-item link-black-100">{{__('librarian')['manage inactive collections']}}</a></li>
                                    </ul>
                                </li>
                                <li class="position-relative">
                                    <a id="shopDropdownsubmenuoneInvoker" href="{{route('items.create')}}" class="dropdown-toggle dropdown-item dropdown-item__sub-menu link-black-100 d-flex align-items-center justify-content-between"
                                       aria-haspopup="true"
                                       aria-expanded="false"
                                       data-unfold-event="hover"
                                       data-unfold-target="#shopDropdownsubMenuone"
                                       data-unfold-type="css-animation"
                                       data-unfold-duration="200"
                                       data-unfold-delay="100"
                                       data-unfold-hide-on-scroll="true"
                                       data-unfold-animation-in="slideInUp"
                                       data-unfold-animation-out="fadeOut">{{__('items')['items']}}
                                    </a>
                                    <ul id="shopDropdownsubMenuone" class="dropdown-unfold dropdown-menu dropdown-sub-menu font-size-2 rounded-0 border-gray-900" aria-labelledby="shopDropdownsubmenuoneInvoker">
                                        <li><a href="{{route('items.create')}}" class="dropdown-item link-black-100">{{__('librarian')['add item']}}</a></li>
                                        <li><a href="{{route('items.manage')}}" class="dropdown-item link-black-100">{{__('librarian')['manage inactive items']}}</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
{{--                        Admin Only Nav--}}
                        @if(auth()->user()->isAdmin())
                        <li class="nav-item dropdown">
                            <a id="pagesDropdownInvoker" href="{{route('users.create')}}" class="dropdown-toggle nav-link link-black-100 mx-4 px-0 py-5 font-weight-medium d-flex align-items-center"
                               aria-haspopup="true"
                               aria-expanded="false"
                               data-unfold-event="hover"
                               data-unfold-target="#pagesDropdownMenu"
                               data-unfold-type="css-animation"
                               data-unfold-duration="200"
                               data-unfold-delay="50"
                               data-unfold-hide-on-scroll="true"
                               data-unfold-animation-in="slideInUp"
                               data-unfold-animation-out="fadeOut">
                                <b class="text-info">{{__('admin')['admin']}}</b>
                            </a>
                            <ul id="pagesDropdownMenu" class="dropdown-unfold dropdown-menu font-size-2 rounded-0 border-gray-900" aria-labelledby="pagesDropdownInvoker">
                                <li class="position-relative">
                                    <a id="pagesDropdownsubmenuoneInvoker" href="{{route('users.create')}}" class="dropdown-toggle dropdown-item dropdown-item__sub-menu link-black-100 d-flex align-items-center justify-content-between"
                                       aria-haspopup="true"
                                       aria-expanded="false"
                                       data-unfold-event="hover"
                                       data-unfold-target="#pagesDropdownsubMenuone"
                                       data-unfold-type="css-animation"
                                       data-unfold-duration="200"
                                       data-unfold-delay="100"
                                       data-unfold-hide-on-scroll="true"
                                       data-unfold-animation-in="slideInUp"
                                       data-unfold-animation-out="fadeOut">{{__('users')['users']}}
                                    </a>
                                    <ul id="pagesDropdownsubMenuone" class="dropdown-unfold dropdown-menu dropdown-sub-menu font-size-2 rounded-0 border-gray-900" aria-labelledby="pagesDropdownsubmenuoneInvoker">
                                        <li><a href="{{route('users.create')}}" class="dropdown-item link-black-100">{{__('admin')['add user']}}</a></li>
                                        <li><a href="{{route('users.manage')}}" class="dropdown-item link-black-100">{{__('admin')['manage users']}}</a></li>
                                    </ul>
                                </li>
                                <li><a href="{{route('deletions.manage')}}" class="dropdown-item link-black-100">{{__('admin')['manage deleted items']}}</a></li>
                            </ul>
                        </li>
                        @endif
                        @endauth
                    </ul>
                </div>
                <ul class="d-md-none nav mr-md-n3 ml-auto">
                </ul>
{{--                Yields Searchbar if used (Not used curently)--}}
                @yield('searchbar')
            </div>
        </div>
    </div>
</header>

{{--Account sidebar navigation DESKTOP--}}
<aside id="sidebarContent" class="u-sidebar u-sidebar__lg" aria-labelledby="sidebarNavToggler">
    <div class="u-sidebar__scroller">
        <div class="u-sidebar__container">
            <div class="u-header-sidebar__footer-offset">
                <!-- Toggle Button -->
                <div class="d-flex align-items-center position-absolute top-0 right-0 z-index-2 mt-5 mr-md-6 mr-4">
                    <button type="button" class="close ml-auto"
                            aria-controls="sidebarContent"
                            aria-haspopup="true"
                            aria-expanded="false"
                            data-unfold-event="click"
                            data-unfold-hide-on-scroll="false"
                            data-unfold-target="#sidebarContent"
                            data-unfold-type="css-animation"
                            data-unfold-animation-in="fadeInRight"
                            data-unfold-animation-out="fadeOutRight"
                            data-unfold-duration="500">
                        <span aria-hidden="true">Close <i class="fas fa-times ml-2"></i></span>
                    </button>
                </div>

{{--                STAFF LOGOUT--}}
                @auth()
                <div class="js-scrollbar u-sidebar__body">
                    <div class="u-sidebar__content u-header-sidebar__content">
                        <form method="POST" action="{{route('users.logout')}}">
                            @csrf
{{--                            LOGOUT--}}
                            <div id="logout" data-target-group="idForm">
{{--                                Title--}}
                                <header class="border-bottom px-4 px-md-6 py-4">
                                    <h2 class="font-size-3 mb-0 d-flex align-items-center"><i class="flaticon-user mr-3 font-size-5"></i>Account</h2>
                                </header>
                                <div class="p-4 p-md-6">
{{--                                    Form Groups--}}
                                    <div class="form-group mb-4">
                                        <div class="js-form-message js-focus-state">
                                            <b>Logged in as:</b>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <div class="js-form-message js-focus-state">
                                            {{auth()->user()->first_name . ' ' . auth()->user()->last_name}}
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <div class="js-form-message js-focus-state">
                                            <span><b>Role: </b>
                                            {{auth()->user()->role}}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="mb-4d75">
                                        <button type="submit" class="btn btn-block py-3 rounded-0 btn-dark">Logout</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @else
{{--                Staff Login--}}
                <div class="js-scrollbar u-sidebar__body">
                    <div class="u-sidebar__content u-header-sidebar__content">
                        <form method="POST" action="{{route('users.login')}}">
                        @csrf
{{--                        Login--}}
                            <div id="login" data-target-group="idForm">
{{--                                Title--}}
                                <header class="border-bottom px-4 px-md-6 py-4">
                                    <h2 class="font-size-3 mb-0 d-flex align-items-center"><i class="flaticon-user mr-3 font-size-5"></i>Account</h2>
                                </header>
                                <div class="p-4 p-md-6">
{{--                                    Form Groups--}}
                                    <div class="form-group mb-4">
                                        <div class="js-form-message js-focus-state">
                                            <label id="login" class="form-label" for="login">Username *</label>
                                            <input type="text" class="form-control rounded-0 height-4 px-4" name="username" id="username" placeholder="" aria-label="">
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <div class="js-form-message js-focus-state">
                                            <label id="signinPasswordLabel" class="form-label" for="signinPassword">Password *</label>
                                            <input type="password" class="form-control rounded-0 height-4 px-4" name="password" id="password" placeholder="" aria-label="" aria-describedby="signinPasswordLabel" required>
                                        </div>
                                    </div>
                                    <div class="mb-4d75">
                                        <button type="submit" class="btn btn-block py-3 rounded-0 btn-dark">Sign In</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @endauth
            </div>
        </div>
    </div>
</aside>

{{--Categories sidebar navigation--}}
<aside id="sidebarContent2" class="u-sidebar u-sidebar__md u-sidebar--left" aria-labelledby="sidebarNavToggler2">
<div class="u-sidebar__scroller js-scrollbar">
    <div class="u-sidebar__container">
        <div class="u-header-sidebar__footer-offset">
            <div class="u-sidebar__body">
                <div class="u-sidebar__content u-header-sidebar__content">
{{--                    Title--}}
                    <header class="border-bottom px-4 px-md-5 py-4 d-flex align-items-center justify-content-between">
                        <h2 class="font-size-3 mb-0">Restitutio</h2>
{{--                        Toggle Button--}}
                        <div class="d-flex align-items-center">
                            <button type="button" class="close ml-auto"
                                    aria-controls="sidebarContent2"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                    data-unfold-event="click"
                                    data-unfold-hide-on-scroll="false"
                                    data-unfold-target="#sidebarContent2"
                                    data-unfold-type="css-animation"
                                    data-unfold-animation-in="fadeInLeft"
                                    data-unfold-animation-out="fadeOutLeft"
                                    data-unfold-duration="500">
                                <span aria-hidden="true"><i class="fas fa-times ml-2"></i></span>
                            </button>
                        </div>
                    </header>
{{--                    Content--}}
                    <div class="border-bottom">
                        <div class="zeynep pt-4">
                            <ul>
                                <li>
                                    <a href="{{route('home')}}">{{__('home')}}</a>
                                </li>

                                <li>
                                    <a href="{{route('authors.index')}}">{{__('browse')['browse authors']}}</a>
                                </li>

                                <li>
                                    <a href="{{route('collections.index')}}">{{__('browse')['browse collections']}}</a>
                                </li>

                                <li>
                                    <a href="{{route('items.index')}}">{{__('browse')['browse items']}}</a>
                                </li>

                            </ul>
                        </div>
                    </div>
                    <div class="px-4 px-md-5 py-5">
                        <label for="languageSelectSide">Language</label>
                        <select id="languageSelectSide" class="changeLang custom-select mb-4 rounded-0 pl-4 height-4 shadow-none text-dark">
                            <option value="ro" {{ session()->get('locale') == 'ro' ? 'selected' : '' }}>@lang('romanian')</option>
                            <option value="en" {{ session()->get('locale') == 'en' ? 'selected' : '' }}>@lang('english')</option>
                        </select>
{{--                        Social Networks--}}
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item">
                                <a class="h-primary pr-2 font-size-2" href="https://www.instagram.com/bcu_bucuresti/">
                                    <span class="fab fa-instagram btn-icon__inner"></span>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a class="h-primary pr-2 font-size-2" href="https://www.facebook.com/BCUCaroII/">
                                    <span class="fab fa-facebook-f btn-icon__inner"></span>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a class="h-primary pr-2 font-size-2" href="https://www.youtube.com/user/BibliotecaCentrala/videos">
                                    <span class="fab fa-youtube btn-icon__inner"></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</aside>

{{--Yield Page Content--}}
@yield('content')


<footer>
    <div class="border-top space-top-3">
        <div class="border-bottom pb-5 space-bottom-lg-3">
            <div class="container">

                <div class="row">
                    <div class="col-lg-2 mb-6 mb-lg-0">
                        <div class="pb-6">
                            <a href="{{route('home')}}" class="d-block mb-1">
                                <img src="{{asset('/assets/img/LOGO-REST-PH.png')}}" alt="LOGO RESTITUTIO" />
                            </a>
                            <address class="font-size-2 mb-5">
                                    <span class="mb-2 font-weight-normal text-dark">
                                        Strada Boteanu 1, <br> București 010292
                                    </span>
                            </address>
                            <div class="mb-4">
                                <a href="mailto:{{__('contact email')}}" class="font-size-2 d-block link-black-100 mb-1">{{__('contact email display')}}</a>
                                <a href="tel:{{__('contact phone')}}" class="font-size-2 d-block link-black-100">{{__('contact phone display')}}</a>
                            </div>
                            <ul class="list-unstyled mb-0 d-flex">
                                <li class="btn pl-0">
                                    <a class="link-black-100" href="https://www.instagram.com/bcu_bucuresti/">
                                        <span class="fab fa-instagram"></span>
                                    </a>
                                </li>
                                <li class="btn">
                                    <a class="link-black-100" href="https://www.facebook.com/BCUCaroII/">
                                        <span class="fab fa-facebook-f"></span>
                                    </a>
                                </li>
                                <li class="btn">
                                    <a class="link-black-100" href="https://www.youtube.com/user/BibliotecaCentrala/videos">
                                        <span class="fab fa-youtube"></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="space-1">
            <div class="container">
                <div class="d-lg-flex text-center text-lg-left justify-content-between align-items-center">
{{--                    Copyright--}}
                    <p class="mb-3 mb-lg-0 font-size-2">© 2022 • BCU „Carol I” - All rights reserved.</p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- ========== END FOOTER ========== -->

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="{{asset('/assets/vendor/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('/assets/vendor/jquery-migrate/dist/jquery-migrate.min.js')}}"></script>
<script src="{{asset('/assets/vendor/popper.js/dist/umd/popper.min.js')}}"></script>
<script src="{{asset('/assets/vendor/bootstrap/bootstrap.min.js')}}"></script>
<script src="{{asset('/assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
<script src="{{asset('/assets/vendor/slick-carousel/slick/slick.min.js')}}"></script>
<script src="{{asset('/assets/vendor/multilevel-sliding-mobile-menu/dist/jquery.zeynep.js')}}"></script>
<script src="{{asset('/assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js')}}"></script>
@yield('JS')

<!-- JS HS Components -->
<script src="{{asset('/assets/js/hs.core.js')}}"></script>
<script src="{{asset('/assets/js/components/hs.unfold.js')}}"></script>
<script src="{{asset('/assets/js/components/hs.malihu-scrollbar.js')}}"></script>
<script src="{{asset('/assets/js/components/hs.header.js')}}"></script>
<script src="{{asset('/assets/js/components/hs.slick-carousel.js')}}"></script>
<script src="{{asset('/assets/js/components/hs.selectpicker.js')}}"></script>
<script src="{{asset('/assets/js/components/hs.show-animation.js')}}"></script>
@yield('JS HS')
<!-- JS Bookworm -->
<!-- <script src="../../assets/js/bookworm.js"></script> -->
<script>
    $(document).on('ready', function () {
        // initialization of unfold component
        $.HSCore.components.HSUnfold.init($('[data-unfold-target]'));

        // initialization of slick carousel
        $.HSCore.components.HSSlickCarousel.init('.js-slick-carousel');


        // initialization of header
        $.HSCore.components.HSHeader.init($('#header'));

        // initialization of malihu scrollbar
        $.HSCore.components.HSMalihuScrollBar.init($('.js-scrollbar'));


        // initialization of show animations
        $.HSCore.components.HSShowAnimation.init('.js-animation-link');

        @yield('scripts')

        // init zeynepjs
        var zeynep = $('.zeynep').zeynep({
            onClosed: function () {
                // enable main wrapper element clicks on any its children element
                $("body main").attr("style", "");

                console.log('the side menu is closed.');
            },
            onOpened: function () {
                // disable main wrapper element clicks on any its children element
                $("body main").attr("style", "pointer-events: none;");

                console.log('the side menu is opened.');
            }
        });

        // handle zeynep overlay click
        $(".zeynep-overlay").click(function () {
            zeynep.close();
        });

        // open side menu if the button is clicked
        $(".cat-menu").click(function () {
            if ($("html").hasClass("zeynep-opened")) {
                zeynep.close();
            } else {
                zeynep.open();
            }
        });
    });
</script>

@yield('separate scripts')

<script type="text/javascript">

    var url = "{{ route('changeLang') }}";

    $(".changeLang").change(function(){
        window.location.href = url + "?lang="+ $(this).val();
    });

</script>
</body>
</html>
