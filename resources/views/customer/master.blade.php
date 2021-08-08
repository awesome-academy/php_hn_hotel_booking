<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@lang('customer.travel_agency')</title>
    <!-- Bootstrap -->
    <link href="{{ asset('bower_components/assets_travel/blue/dist/css/bootstrap.css') }}" rel="stylesheet" media="screen">
    <link href="{{ asset('bower_components/assets_travel/blue/assets/css/custom.css') }}" rel="stylesheet" media="screen">
    <link href="{{ asset('bower_components/assets_travel/blue/examples/carousel/carousel.css') }}" rel="stylesheet">
    <!-- Fonts -->
    <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/assets_travel/blue/assets/css/font-awesome.css') }}" media="screen" />
    <!--[if lt IE 7]><link rel="stylesheet" type="text/css" href="{{ asset('bower_components/assets_travel/blue/assets/css/font-awesome-ie7.css') }}" media="screen" /><![endif]-->
    <!-- REVOLUTION BANNER CSS SETTINGS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/assets_travel/blue/css/fullscreen.css') }}" media="screen" />
    <link rel="stylesheet" type="text/css" href=" {{ asset('bower_components/assets_travel/blue/rs-plugin/css/settings.css') }}" media="screen" />
    <!-- Picker -->
    <link rel="stylesheet" href=" {{ asset('bower_components/assets_travel/blue/assets/css/jquery-ui.css') }}"/>
    <!-- bin/jquery.slider.min.css -->
    <link rel="stylesheet" href="{{ asset('bower_components/assets_travel/blue/plugins/jslider/css/jslider.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('bower_components/assets_travel/blue/plugins/jslider/css/jslider.round.css') }}" type="text/css">

    <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/all.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">

    <!-- jQuery -->
    <script src="{{ asset('bower_components/assets_travel/blue/assets/js/jquery.v2.0.3.js') }}"></script>
    <script src="{{ asset('bower_components/assets_travel/blue/assets/js/jquery-ui.js') }}"></script>

    <!-- bin/jquery.slider.min.js -->
    <script type="text/javascript" src="{{ asset('bower_components/assets_travel/blue/plugins/jslider/js/jshashtable-2.1_src.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bower_components/assets_travel/blue/plugins/jslider/js/jquery.numberformatter-1.2.3.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bower_components/assets_travel/blue/plugins/jslider/js/tmpl.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bower_components/assets_travel/blue/plugins/jslider/js/jquery.dependClass-0.1.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bower_components/assets_travel/blue/plugins/jslider/js/draggable-0.1.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bower_components/assets_travel/blue/plugins/jslider/js/jquery.slider.js') }}"></script>
</head>
<body id="top" class="thebg" >

<!-- Top wrapper -->
    @include('customer.layouts.navbar')
<!-- / Top wrapper -->
    @include('customer.layouts.breadcrub')
<!-- CONTENT -->
<div class="container">
    <div class="container pagecontainer offset-0">
        @yield('left-nav')
        @yield('detail_content')
        <div class="rightcontent col-md-9 offset-0">
            @yield('content')
        </div>
    </div>

</div>
    @include('customer.layouts.footer')
<!-- END OF CONTENT -->
<!-- Javascript -->
<!-- Custom Select -->
<script src="{{ asset('bower_components/assets_travel/blue/assets/js/js-list.js') }}"></script>

<script type='text/javascript' src='{{ asset('bower_components/assets_travel/blue/assets/js/jquery.customSelect.js') }}'></script>

<script src="{{ asset('bower_components/assets_travel/blue/assets/js/initialize-google-map.js') }}"></script>

<script src="{{ asset('bower_components/assets_travel/blue/assets/js/functions.js') }}"></script>

<script src="{{ asset('bower_components/assets_travel/blue/assets/js/jquery.nicescroll.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('bower_components/assets_travel/blue/rs-plugin/js/jquery.themepunch.revolution.min.js') }}"></script>

<script src="{{ asset('bower_components/assets_travel/blue/assets/js/jquery.carouFredSel-6.2.1-packed.js') }}"></script>

<!-- JS Ease -->
<script src="{{ asset('bower_components/assets_travel/blue/assets/js/jquery.easing.js') }}"></script>

<!-- Custom functions -->

<!-- jQuery KenBurn Slider  -->
<script type="text/javascript" src="{{ asset('bower_components/assets_travel/blue/rs-plugin/js/jquery.themepunch.revolution.min.js') }}"></script>

<!-- Counter -->
<script src="{{ asset('bower_components/assets_travel/blue/assets/js/counter.js') }}"></script>

<!-- Nicescroll  -->
<script src="{{ asset('bower_components/assets_travel/blue/assets/js/jquery.nicescroll.min.js') }}"></script>

<script src="{{ asset('bower_components/assets_travel/blue/assets/js/js-details.js') }}"></script>

<!-- Picker -->
<script src="{{ asset('bower_components/assets_travel/blue/assets/js/jquery-ui.js') }}"></script>

<!-- Bootstrap -->
<script src="{{ asset('bower_components/assets_travel/blue/dist/js/bootstrap.min.js') }}"></script>

<script src="{{ asset('bower_components/assets_travel/blue/assets/js/initialize-carousel-detailspage.js') }}"></script>

<script src="{{ asset('assets/js/rating.js') }}"></script>

<script src="{{ asset('assets/js/custom.js') }}"></script>
    @yield('script')
</body>
</html>
