<div class="navbar-wrapper2 navbar-fixed-top">
    <div class="container">
        <div class="navbar mtnav">
            <div class="container offset-3">
                <!-- Navigation-->
                <div class="navbar-header">
                    <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="{{ route('booking.index') }}" class="navbar-brand">
                        <img src="{{ asset('bower_components/assets_travel/blue/images/logo.png') }}" class="logo"/>
                    </a>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">@lang('customer.profile')<b class="lightcaret mt-2"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ route('customer.profile') }}">@lang('customer.order')</a></li>
                                <li><a href="{{ route('auth.customer.logout') }}">{{__('logout')}}</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
