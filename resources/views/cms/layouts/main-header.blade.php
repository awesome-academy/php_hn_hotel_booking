<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('change-language', config('user.vn')) }}">
                <img src="{{ asset('assets/images/vn.png') }}" alt="">
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('change-language', config('user.en')) }}">
                <img src="{{ asset('assets/images/us.png') }}" alt="">
            </a>
        </li>
    </ul>
</nav>
