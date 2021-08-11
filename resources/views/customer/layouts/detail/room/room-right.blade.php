<div class="col-md-4 detailsright offset-0">
    <div class="pagecontainer2 grey">
        <div class="padding20">
            <span class="opensans size18 dark bold caps">@lang('customer.details')</span>
        </div>
        <div class="line3"></div>
        <div class="hpadding30 margtop30">
            <span class="dark size16 bold">@lang('customer.hotel'):</span>
            <span>{{ $room->hotel->name }}</span><br>
            <span class="dark size16 bold">@lang('customer.room_type'):</span>
            <span>{{ $room->type->name }} </span><br>
            <span class="dark size16 bold">@lang('customer.description'):</span>
            <span>{{ $room->type->description }} </span><br>
            <div class="fdash mt10"></div>
            <br>
            <span class="dark size16 bold">@lang('customer.price'):</span>
            <span class="size16 bold lred2">${{ $room->price }}</span>
            <div class="clearfix"></div>
            <div class="fdash mt10"></div>
            <br>
            <span class="dark size16 bold">@lang('customer.left'): {{ $room->remaining }}</span><br>
        </div>
        <div class="hpadding20">
            <a href="{{ route('booking.add_to_cart') }}" class="booknow margtop20 btnmarg">@lang('customer.book')</a>
        </div>
    </div>
</div>
