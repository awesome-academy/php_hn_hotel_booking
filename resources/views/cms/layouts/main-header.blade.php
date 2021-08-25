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
        <li class="nav-item dropdown order-notification">
            <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="true">
                <i class="far fa-bell"></i>
                <span data-count="{{ Auth::user()->unreadNotifications->count() }}" class="badge badge-warning navbar-badge dropdown-notifications notify-count-number">{{ Auth::user()->unreadNotifications->count() }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span data-count="{{ Auth::user()->unreadNotifications->count() }}" class="dropdown-item dropdown-header notify-count">{{ Auth::user()->unreadNotifications->count() }} messages</span>
                    <div class="notification">
                        @foreach (Auth::user()->notifications  as $notification)
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('partners.order', $notification->order_id) }}" class="dropdown-item {{ (empty($notification->read_at)) ? 'active' : '' }}">
                            <i class="fas fa-envelope mr-2"></i>
                            <b>{{ $notification->data['title'] }}</b>
                            <p>{{ $notification->data['content'] }}
                                <span class="float-right text-muted text-sm">{{ $notification->created_at->format('d-m-y') }}</span>
                            </p>
                        </a>
                        @endforeach
                    </div>
                <a href="{{ route('partners.notify.markAsRead') }}" class="dropdown-item dropdown-footer">@lang('partner.mark_all_as_read')</a>
            </div>
        </li>
    </ul>
</nav>
