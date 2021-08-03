<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sun* | {{ __('booking') }}</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="{{ asset('bower_components/tempusdominus-bootstrap-4/build/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('bower_components/icheck-bootstrap/icheck-bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('bower_components/adminlte3/assets_adminlte3/dist/css/adminlte.min.css') }}">

    <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/all.css') }}">

    <link rel="stylesheet" href="{{ asset('bower_components/summernote/dist/summernote-bs4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('bower_components/select2/dist/css/select2.min.css') }}">

    @yield('css')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <!-- Navbar -->
    @include('cms.layouts.main-header')
    <!-- Main Sidebar Container -->
    @yield('sidebar')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="content">
            @yield('content')
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    @include('cms.layouts.footer')
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<!-- jQuery -->
<script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>

<script src="{{ asset('bower_components/chart.js/dist/Chart.min.js') }}"></script>

<script src="{{ asset('bower_components/summernote/dist/summernote-bs4.min.js') }}"></script>

<script src="{{ asset('bower_components/adminlte3/assets_adminlte3/dist/js/adminlte.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('bower_components/adminlte3/assets_adminlte3/dist/js/demo.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->

<script src="{{ asset('bower_components/select2/dist/js/select2.min.js') }}"></script>

<script src="{{ asset('assets/js/js.js')  }}"></script>

<script src=" {{ asset('assets/lfm/lfm.js') }}"></script>

@include('cms.sweetAlert2')

<script>
    $('.lfm-multi').filemanager('image', {
        multiple: true,
        name: 'images',
        element: '#slider_container',
        limit: 3,
        message: '{{ __('limit_image') }}'
    });
</script>

    @yield('js')

</body>
</html>
