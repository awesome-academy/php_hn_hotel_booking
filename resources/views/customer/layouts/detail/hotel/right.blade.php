<div id="mycart" class="col-md-4 detailsright offset-0">
    <div class="pagecontainer2 grey">
        @if (!empty(session('carts')[$hotel->id]))
        <div class="padding20">
            <span class="opensans size18 dark bold caps">{{ $hotel->name }}</span>
        </div>
        <div class="line3"></div>
        <div class="hpadding30 margtop30">
            <span class="dark size16 bold avg_night">{{ $cart['checkOut']->diffInDays($cart['checkIn']) }} @lang('customer.days')</span><br>
            <span class="grey size13 bold checkIn">@lang('customer.check_in_date'): {{ $cart['checkIn']->format('d/m/Y') }} </span><br>
            <span class="grey size13 bold checkOut">@lang('customer.check_out_date'): {{ $cart['checkOut']->format('d/m/Y') }} </span><br>
            <div class="fdash mt10"></div>
            <br>
            <span class="grey size13">@lang('customer.price'):</span>
            <span class="size16 bold lred2 right total">${{ session('total') }}</span>
            <div class="clearfix"></div>
            <div class="fdash mt10"></div>
            <br>
            <span class="dark size16 bold">@lang('customer.guests')</span><br>
            <span class="size12 grey2 bold">
            <div class="clearfix"></div>
                # @lang('customer.staterooms'): <span class="right room_in_cart">{{ count(session('carts')[$hotel->id]) }} @lang('customer.room')</span>
            <div class="clearfix"></div>
            </span>
            <br>
        </div>
        <div class="line3"></div>
        @foreach (session('carts')[$hotel->id] as $key => $cart)
            <div id="cart{{ $key }}" class="hpadding30 margtop30">
                <div class="d-flex">
                    <div class="dark size16 bold w-50">@lang('customer.stateroom') {{ $loop->iteration }}:</div>
                    <div class="edit-cart w-50">
                        <button class="add-cart" data-hotelid="{{ $hotel->id }}" data-roomid="{{ $key }}" ><i class="fa fa-plus" aria-hidden="true"></i></button>
                        <button class="sub-cart" data-hotelid="{{ $hotel->id }}" data-roomid="{{ $key }}"><i class="fa fa-minus-circle" aria-hidden="true"></i></button>
                        <button class="remove-cart" data-hotelid="{{ $hotel->id }}" data-roomid="{{ $key }}"><i class="fa fa-times-circle" aria-hidden="true"></i></button>
                    </div>
                </div>
                <div class="fdash mt10"></div>
                <br>
                <table class="wh100percent size13">
                    <tbody>
                        <tr>
                            <td valign="top">@lang('customer.stateroom'):</td>
                            <td class="textright">{{ $cart['name'] }}</td>
                        </tr>
                        <tr>
                            <td valign="top">@lang('customer.qty'):</td>
                            <td class="textright qty">{{ $cart['qty'] }}</td>
                        </tr>
                        <tr>
                            <td valign="top">@lang('customer.price'):</td>
                            <td class="textright">{{ $cart['price'] }}$</td>
                        </tr>
                        <tr>
                            <td valign="top">@lang('customer.night'):</td>
                            <td class="textright">{{ $cart['checkOut']->diffInDays($cart['checkIn']) }}</td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="fdash mt10"></div>
                                <br>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" class="dark bold">@lang('customer.subtotal')*</td>
                            <td class="textright dark bold">${{ $cart['qty'] * $cart['price'] }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @endforeach
            <div class="hpadding20">
                <a href="{{ route('booking.info', $hotel->id) }}" class="booknow margtop20 btnmarg">{{ __('checkout') }}</a>
            </div>
        @endif
    </div>
</div>
