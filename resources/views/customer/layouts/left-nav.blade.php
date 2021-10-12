<div class="col-md-3 filters offset-0">
    <div class="bookfilters hpadding20">
        <div class="w50percent">
            <div class="radio">
                <label>
                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                    <span class="hotel-ico"></span> @lang('customer.hotels')
                </label>
            </div>
        </div>
        <div class="clearfix"></div><br/>
        <!-- HOTELS TAB -->
        <form action="{{ route('booking.hotels.search') }}" method="get">
            <div class="hotelstab2 none">
                <span class="opensans size13">@lang('customer.where_do_u_want_to_go')</span>
                <select name="province" class="form-control">
                    @foreach($provinces as $province)
                        <option value="{{ $province->id }}" {{ $province->id == old('province', $request->province ?? null) ? "selected" : null }}>{{ $province->name }}</option>
                    @endforeach
                </select>
                <div class="clearfix pbottom15"></div>
                <div class="w50percent">
                    <div class="">
                        <span class="opensans size13">@lang('customer.check_in_date')</span>
                        <input type="date" name="checkIn" value="{{ old('checkIn', $request->checkIn ?? null) }}" class="form-control"/>
                    </div>
                </div>
                <div class="w50percentlast">
                    <div class="wh90percent right">
                        <span class="opensans size13">@lang('customer.check_out_date')</span>
                        <input type="date" name="checkOut" value="{{ old('checkOut', $request->checkOut ?? null) }}" class="form-control"/>
                    </div>
                </div>
                <div class="d-flex w-100 pt-5">
                    <div class="w-50">
                        <span>@lang('customer.room')</span>
                        <input type="number" name="room" value="{{old('room', $request->room ?? 1) }}" class="form-control"/>
                    </div>
                    <div class="w-50">
                        <span>@lang('customer.adult')</span>
                        <input type="number" name="adult" value="{{old('adult', $request->adult ?? 1) }}" class="form-control"/>
                    </div>
                    <div class="w-50">
                        <span>@lang('customer.child')</span>
                        <input type="number" name="child" value="{{old('child', $request->child ?? 1) }}" class="form-control"/>
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn-search3">
                        @lang('customer.search')
                    </button>
                </div>
            </div>

        </form>
        <!-- END OF HOTELS TAB -->
    </div>
    <!-- END OF BOOK FILTERS -->
    <div class="line2"></div>
    <div class="padding20title"><h3 class="opensans dark">@lang('customer.filter_by')</h3></div>
    <div class="line2"></div>
    <!-- Star ratings -->
    <button type="button" class="collapsebtn" data-toggle="collapse" data-target="#collapse1">
        @lang('customer.star_rating') <span class="collapsearrow"></span>
    </button>

    <div id="collapse1" class="collapse in">
        <div class="hpadding20">
            <div class="checkbox">
                <label>
                    <input type="checkbox"><img src="{{ asset('bower_components/assets_travel/blue/images/filter-rating-5.png') }}" class="imgpos1" alt=""/> 5 @lang('customer.stars')
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox"><img src="{{ asset('bower_components/assets_travel/blue/images/filter-rating-4.png') }}" class="imgpos1" alt=""/> 4 @lang('customer.stars')
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox"><img src="{{ asset('bower_components/assets_travel/blue/images/filter-rating-3.png') }}" class="imgpos1" alt=""/> 3 @lang('customer.stars')
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox"><img src="{{ asset('bower_components/assets_travel/blue/images/filter-rating-2.png') }}" class="imgpos1" alt=""/> 2 @lang('customer.stars')
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox"><img src="{{ asset('bower_components/assets_travel/blue/images/filter-rating-1.png') }}" class="imgpos1" alt=""/> 1 @lang('customer.stars')
                </label>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <!-- End of Star ratings -->

    <div class="line2"></div>

    <!-- Price range -->
    <button type="button" class="collapsebtn" data-toggle="collapse" data-target="#collapse2">
        Price range <span class="collapsearrow"></span>
    </button>

    <div id="collapse2" class="collapse in">
        <div class="padding20">
            <div class="layout-slider wh100percent">
                <span class="cstyle09"><input id="Slider1" type="slider" name="price" value="400;700" /></span>
            </div>
            <script type="text/javascript">
                jQuery("#Slider1").slider({ from: 100, to: 1000, step: 5, smooth: true, round: 0, dimension: "&nbsp;$", skin: "round" });
            </script>
        </div>
    </div>
    <!-- End of Price range -->
</div>
