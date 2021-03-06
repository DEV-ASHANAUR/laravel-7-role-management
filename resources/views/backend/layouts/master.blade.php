<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title','laravel Role Admin')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('backend.layouts.partials.style')
    <script src="{{ asset('backend') }}/sweetalert/sweetalert.js"></script>
    <link rel="stylesheet" href="{{ asset('backend') }}/sweetalert/sweetalert.css">
    @yield('style')
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
        @include('backend.layouts.partials.sidebar')
        <!-- sidebar menu area end -->
        <!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
            @include('backend.layouts.partials.header')
            <!-- header area end -->
            @yield('main-content')
        </div>
        <!-- main content area end -->
        <!-- footer area start-->
        @include('backend.layouts.partials.footer')
        <!-- footer area end-->
    </div>
    <!-- page container area end -->
    <!-- offset area start -->
    
    @include('backend.layouts.partials.offset')
    <!-- offset area end -->
    <!-- jquery latest version -->
    @include('backend.layouts.partials.script')
    @yield('script')
</body>

</html>
