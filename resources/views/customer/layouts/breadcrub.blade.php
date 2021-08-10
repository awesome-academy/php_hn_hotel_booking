<div class="container breadcrub">
    <div>
        <a class="homebtn left" href="{{ route('booking.index') }}"></a>
        <div class="left">
            <ul class="bcrumbs">
                <li>/</li>
                <li><a href="{{ route('booking.index') }}">@lang('customer.hotels')</a></li>
            </ul>
        </div>
        <a class="backbtn right" href="{{ url()->previous() }}"></a>
    </div>
    <div class="clearfix"></div>
    <div class="brlines"></div>
</div>
