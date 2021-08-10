<div class="col-md-8 details-slider">
    <div id="c-carousel">
        <div id="wrapper">
            <div id="inner">
                <div id="caroufredsel_wrapper2">
                    <div id="carousel">
                        @foreach ($room->images as $image)
                            <img src="{{ $image->image }}" alt="">
                        @endforeach
                    </div>
                </div>
                <div id="pager-wrapper">
                    <div id="pager">
                        @foreach ($room->images as $image)
                            <img src="{{ $image->image }}" alt=""/>
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
</div>
