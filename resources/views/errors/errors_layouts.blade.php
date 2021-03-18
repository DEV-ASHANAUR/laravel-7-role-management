<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('error','Unauthorized Access!')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">
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
    <!-- error area start -->
    <div class="error-area ptb--100 text-center">
        <div class="container">
            <div class="error-content">
                @yield('error-content')
            </div>
        </div>
    </div>
    <!-- error area end -->

    <!-- jquery latest version -->
    @include('backend.layouts.partials.script')
    @yield('script')
</body>

</html>