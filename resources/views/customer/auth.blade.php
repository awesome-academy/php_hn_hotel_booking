<!DOCTYPE html>
<html>

<!-- Mirrored from titanicthemes.com/travel/blue/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 08 Jul 2018 02:26:06 GMT -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Agency - HTML5 Booking template</title>
    <!-- Bootstrap -->
    <link href="{{ asset('bower_components/assets_travel/blue/dist/css/bootstrap.css') }}" rel="stylesheet" media="screen">

    <link href="{{ asset('bower_components/assets_travel/blue/assets/css/custom.css') }}" rel="stylesheet" media="screen">

    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <!-- Animo css-->
    <link href="{{ asset('bower_components/assets_travel/blue/plugins/animo/animate%2banimo.css') }}" rel="stylesheet" media="screen">

    <link href="{{ asset('bower_components/assets_travel/blue/examples/carousel/carousel.css') }}" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
    <script src="{{ asset('bower_components/assets_travel/blue/assets/js/html5shiv.js') }}"></script>

    <script src="{{ asset('bower_components/assets_travel/blue/assets/js/respond.min.js') }}"></script>
    <![endif]-->

    <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/assets_travel/blue/assets/css/font-awesome.css') }}" media="screen" />
<!--[if lt IE 7]><link rel="stylesheet" type="text/css" href="{{ asset('bower_components/assets_travel/blue/assets/css/font-awesome-ie7.css') }}" media="screen" /><![endif]-->
    <!-- Load jQuery -->
    <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
</head>
<body>
<!-- 100% Width & Height container  -->
<div class="login-fullwidith">
    <!-- Login Wrap  -->
@yield('content')
<!-- End of Login Wrap  -->
</div>
<!-- End of Container  -->
<!-- Javascript  -->
<script src="{{ asset('bower_components/assets_travel/blue/assets/js/initialize-loginpage.js') }}"></script>

<script src="{{ asset('bower_components/assets_travel/blue/assets/js/jquery.easing.js') }}"></script>
<!-- Load Animo -->
<script src="{{ asset('bower_components/assets_travel/blue/plugins/animo/animo.js') }}"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="{{ asset('bower_components/assets_travel/blue/dist/js/bootstrap.min.js') }}"></script>

</body>
</html>
