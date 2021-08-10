<div class="col-md-8">
    <div id="c-carousel" class="details-slider">
        <div id="wrapper">
            <div id="inner">
                <div id="caroufredsel_wrapper2">
                    <div id="carousel">
                        @foreach ($images as $img)
                            <img src="{{ $img->image }}" alt="">
                        @endforeach
                    </div>
                </div>
                <div id="pager-wrapper">
                    <div id="pager">
                        @foreach ($images as $img)
                            <img src="{{ $img->image }}" alt=""/>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <button id="prev_btn2" class="prev2">
                <img src="{{ asset('bower_components/assets_travel/blue/images/spacer.png') }}" alt=""/>
            </button>
            <button id="next_btn2" class="next2">
                <img src="{{ asset('bower_components/assets_travel/blue/images/spacer.png') }}" alt=""/>
            </button>
        </div>
    </div> <!-- /c-carousel -->
    <br>
    <br>
    <div>
        <div class="cstyle10"></div>
        <ul class="nav nav-tabs" id="myTab">
            <li onclick="mySelectUpdate()" class="active">
                <a data-toggle="tab" href="#roomrates">
                    <span class="rates"></span>
                    <span class="hidetext">@lang('customer.types_room')</span>&nbsp;
                </a>
            </li>
        </ul>
        <div class="tab-content4" >
            <div id="roomrates" class="tab-pane fade active in">
                <div class="line2"></div>
                @foreach ($rooms as $room)
                    <div class="padding20">
                        <div class="col-md-4 offset-0">
                            <a href="{{ route('booking.detail-room', $room->id) }}">
                                <img src="{{ asset($image) }}" alt="" class="fwimg"/>
                            </a>
                        </div>
                        <div class="col-md-8 offset-0">
                            <div class="col-md-8 mediafix1">
                                <h4 class="opensans dark bold margtop1 lh1">{{ $room->type->name }}</h4>
                                @lang('customer.max_occupancy'): {{ $room->type->number_of_guest }} @lang('customer.adult')
                                <br>
                                @lang('customer.description'): {{ $room->type->description }}
                                <ul class="hotelpreferences margtop10">
                                    <li class="icohp-internet"></li>
                                    <li class="icohp-air"></li>
                                    <li class="icohp-pool"></li>
                                    <li class="icohp-childcare"></li>
                                    <li class="icohp-fitness"></li>
                                    <li class="icohp-breakfast"></li>
                                    <li class="icohp-parking"></li>
                                </ul>
                                <div class="clearfix"></div>
                                <ul class="checklist2 margtop10">
                                    <li>@lang('customer.free_cancellation')</li>
                                    <li>@lang('customer.pay_at_hotel')</li>
                                </ul>
                            </div>
                            <div class="col-md-4 center bordertype4">
                                <span class="opensans green size24">${{ $room->price }}</span><br/>
                                <span class="opensans lightgrey size12">/@lang('customer.night')</span><br/><br/>
                                <span class="lred bold">{{ $room->remaining }} @lang('customer.left')</span><br/><br/>
                                <a href="{{ route('booking.add_to_cart') }}">
                                    <button class="bookbtn mt1">@lang('customer.book')</button>
                                </a>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="line2"></div>
                @endforeach
            </div>
        </div>
    </div>
</div>
