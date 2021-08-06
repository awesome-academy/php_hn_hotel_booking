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
        <div class="hotelstab2 none">
            <span class="opensans size13">@lang('customer.where_do_u_want_to_go')</span>
            <input type="text" class="form-control" placeholder="@lang('customer.ha_noi')">
            <div class="clearfix pbottom15"></div>
            <div class="w50percent">
                <div class="wh90percent textleft">
                    <span class="opensans size13">@lang('customer.check_in_date')</span>
                    <input type="text" class="form-control mySelectCalendar" id="datepicker" placeholder="mm/dd/yyyy"/>
                </div>
            </div>
            <div class="w50percentlast">
                <div class="wh90percent textleft right">
                    <span class="opensans size13">@lang('customer.check_out_date')</span>
                    <input type="text" class="form-control mySelectCalendar" id="datepicker2" placeholder="mm/dd/yyyy"/>
                </div>
            </div>
            <div class="clearfix pbottom15"></div>
            <div class="room1" >
                <div class="w50percent">
                    <div class="wh90percent textleft">
                        <span class="opensans size13"><b>@lang('customer.room') 1</b></span><br/>

                        <div class="addroom1 block"><a onclick="addroom2()" class="grey cpointer">+ @lang('customer.add_room')</a></div>
                    </div>
                </div>
                <div class="w50percentlast">
                    <div class="wh90percent textleft right ohidden">
                        <div class="w50percent">
                            <div class="wh90percent textleft left">
                                <span class="opensans size13">@lang('customer.adult')</span>
                                <select class="form-control">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                        </div>
                        <div class="w50percentlast">
                            <div class="wh90percent textleft right ohidden">
                                <span class="opensans size13">@lang('customer.child')</span>
                                <select class="form-control">
                                    <option>0</option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="room2 none">
                <div class="clearfix"></div><div class="line1"></div>
                <div class="w50percent">
                    <div class="wh90percent textleft">
                        <span class="opensans size13"><b>@lang('customer.room') 2</b></span><br/>
                        <div class="addroom2 block grey"><a onclick="addroom3()" class="grey cpointer">+ @lang('customer.add_room')</a> | <a onclick="removeroom2()" class="orange cpointer"><img src="{{ asset('bower_components/assets_travel/blue/images/delete.png') }}" alt="delete"/></a></div>
                    </div>
                </div>
                <div class="w50percentlast">
                    <div class="wh90percent textleft right">
                        <div class="w50percent">
                            <div class="wh90percent textleft left">
                                <span class="opensans size13">@lang('customer.adult')</span>
                                <select class="form-control">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                        </div>
                        <div class="w50percentlast">
                            <div class="wh90percent textleft right">
                                <span class="opensans size13">@lang('customer.child')</span>
                                <select class="form-control">
                                    <option>0</option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="room3 none">
                <div class="clearfix"></div><div class="line1"></div>
                <div class="w50percent">
                    <div class="wh90percent textleft">
                        <span class="opensans size13"><b>@lang('customer.room') 3</b></span><br/>
                        <div class="addroom3 block grey"><a onclick="addroom3()" class="grey cpointer">+ @lang('customer.add_room')</a> |
                            <a onclick="removeroom3()" class="orange cpointer">
                                <img src="{{ asset('bower_components/assets_travel/blue/images/delete.png') }}" alt="delete"/>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="w50percentlast">
                    <div class="wh90percent textleft right">
                        <div class="w50percent">
                            <div class="wh90percent textleft left">
                                <span class="opensans size13">@lang('customer.adult')</span>
                                <select class="form-control">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                        </div>
                        <div class="w50percentlast">
                            <div class="wh90percent textleft right">
                                <span class="opensans size13">@lang('customer.child')</span>
                                <select class="form-control">
                                    <option>0</option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div><div class="clearfix"></div>
            <button type="submit" class="btn-search3">@lang('customer.search')</button>
        </div>
        <!-- END OF HOTELS TAB -->
    </div>
    <!-- END OF BOOK FILTERS -->
    <div class="line2"></div>
    <div class="padding20title"><h3 class="opensans dark">@lang('customer.filter_by')</h3></div>
    <div class="line2"></div>
    <!-- Star ratings -->
    <button type="button" class="collapsebtn" data-toggle="collapse" data-target="#collapse1">
        @lang('star_rating') <span class="collapsearrow"></span>
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
