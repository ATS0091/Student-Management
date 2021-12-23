<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon"> <!-- Favicon-->
        <title>Student Management System</title>
        <meta name="description" content="@yield('meta_description', config('app.name'))">
        <meta name="author" content="@yield('meta_author', config('app.name'))">
        @yield('meta')
        @stack('before-styles')
        <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendor/font-awesome/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendor/pnotify/PNotifyBrightTheme.min.css') }}"/>
        <link rel="stylesheet" href="{{ asset('assets/vendor/sweetalert/sweetalert.css') }}"/>
        <link rel="stylesheet" href="{{ asset('assets/vendor/select2/select2.min.css') }}"/>
        <!-- Custom Css -->
        <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/color_skins.css') }}">
        <script src='https://www.google.com/recaptcha/api.js'></script>
        @stack('after-styles')

    </head>


    <body class="theme-cyan">

        <!-- Page Loader -->
        {{-- <div class="page-loader-wrapper">
            <div class="loader">
                <div class="m-t-30"><img src="{{ asset('assets/img/logo.png') }}" width="auto" height="auto" alt="Student Management"></div>
                <p>Please wait...</p>
            </div>
        </div> --}}

        <div id="wrapper">

            @yield('content')

        </div>
    </body>
     <!-- Scripts -->
     @stack('before-scripts')
     <script src="{{ asset('assets/vendor/jquery/jquery-3.3.1.min.js') }}"></script>
     <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
     <script src="{{ asset('assets/bundles/vendorscripts.bundle.js') }}"></script>
     <script src="{{ asset('assets/bundles/mainscripts.bundle.js') }}"></script>
     <script src="{{ asset('assets/vendor/pnotify/pnotify.min.js') }}"></script>
     <script src="{{ asset('assets/vendor/pnotify/PNotifyButtons.min.js') }}"></script>
     <script src="{{ asset('assets/vendor/pnotify/PNotifyAnimate.min.js') }}"></script>
     <script src="{{ asset('assets/vendor/sweetalert/sweetalert.min.js') }}"></script>
     <script src="{{ asset('assets/vendor/parsleyjs/js/parsley.min.js') }}"></script>
     <script src="{{ asset('assets/vendor/select2/select2.min.js') }}"></script>
     @stack('after-scripts')
    @if (trim($__env->yieldContent('page-script')))
    @yield('page-script')
   @endif
</html>
