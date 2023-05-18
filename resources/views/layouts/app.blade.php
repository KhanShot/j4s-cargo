<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="CryptoDash admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities with bitcoin dashboard.">
    <meta name="keywords" content="admin template, CryptoDash Cryptocurrency Dashboard Template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
    <meta name="author" content="ThemeSelection">
    <title>J4S - Cargo</title>
    <link rel="apple-touch-icon" href="log.png">
    <link rel="shortcut icon" type="image/x-icon" href="log.png">
    <link href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i|Comfortaa:300,400,500,700" rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="/css/vendors.css">
    <link rel="stylesheet" type="text/css" href="/vendors/css/charts/chartist.css">
    <link rel="stylesheet" type="text/css" href="/vendors/css/charts/chartist-plugin-tooltip.css">
    <!-- END VENDOR CSS-->
    <!-- BEGIN MODERN CSS-->
    <link rel="stylesheet" type="text/css" href="/css/app.css">
    <!-- END MODERN CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="/css/core/menu/menu-types/vertical-compact-menu.css">
    <link rel="stylesheet" type="text/css" href="/vendors/css/cryptocoins/cryptocoins.css">
    <link rel="stylesheet" type="text/css" href="/css/pages/timeline.css">
    <link rel="stylesheet" type="text/css" href="/css/pages/dashboard-ico.css">
    <script src="https://unpkg.com/imask"></script>
    <script src="https://api-maps.yandex.ru/2.1/?apikey=83b1cd06-7039-47c5-989b-b7eba9943738&lang=ru_RU" type="text/javascript"></script>
    <script
        src="https://code.jquery.com/jquery-3.7.0.js"
        integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />

    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
{{--    <link rel="stylesheet" type="text/css" href="/assets/css/style.css">--}}
    <!-- END Custom CSS-->
    @vite('resources/js/app.js')
</head>
<body class="vertical-layout vertical-compact-menu 2-columns menu-expanded fixed-navbar @if(!auth()->check()) bg-full-screen-image @endif " data-open="click" data-menu="vertical-compact-menu" data-col="2-columns">

@if(auth()->check())
    @include('layouts.navbar')
@endif
<!-- ////////////////////////////////////////////////////////////////////////////-->

@if(auth()->check() && auth()->user()->type != 'user')
@include('layouts.sidebar')
@endif

@yield('content')
<!-- ////////////////////////////////////////////////////////////////////////////-->

@if(auth()->check())
    @include('layouts.footer')
@endif

<!-- BEGIN VENDOR JS-->
<script src="/vendors/js/vendors.min.js" type="text/javascript"></script>

<!-- BEGIN VENDOR JS-->
<!-- BEGIN PAGE VENDOR JS-->

<script src="/vendors/js/timeline/horizontal-timeline.js" type="text/javascript"></script>
<script src="/vendors/js/forms/icheck/icheck.min.js" type="text/javascript"></script>

<!-- END PAGE VENDOR JS-->
<!-- BEGIN MODERN JS-->
<script src="/js/core/app-menu.js" type="text/javascript"></script>
<script src="/js/core/app.js" type="text/javascript"></script>
<!-- END MODERN JS-->
<!-- BEGIN PAGE LEVEL JS-->
@if(request()->routeIs('admin.dashboard'))
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endif


<script src="/js/scripts/forms/form-login-register.js" type="text/javascript"></script>
<!-- END PAGE LEVEL JS-->
<script>
    @if(request()->route() == 'register')
    let phoneMask = IMask(
        document.getElementById('phone'), {
            mask: '+{7}(000)000-00-00'
        });
    @endif

    let table = new DataTable('#dataTable', {
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/ru.json',
        },
    });
</script>

@yield('js')
</body>
</html>
