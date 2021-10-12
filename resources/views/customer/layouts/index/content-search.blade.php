<div class="clearfix"></div>
<div class="itemscontainer offset-1">
    @if (!empty($hotels->count()))
        @foreach ($hotels as $hotel)
            <div class="col-md-4">
                <div class="listitem">
                    <a href="{{ route('booking.detail-hotel', $hotel->id) }}">
                        <img src="{{ \App\Models\Hotel::find($hotel->hotel_id)->first()->images->first()->image }}" alt=""/>
                    </a>
                    <div class="liover"></div>
                    <a class="fav-icon" href="#"></a>
                    <a class="book-icon" href="#"></a>
                </div>
                <div class="itemlabel">
                    <a href="{{ route('booking.detail-hotel', $hotel->id) }}">
                        <button class="bookbtn right mt1">@lang('customer.book')</button>
                    </a>
                    <b><a href="{{ route('booking.detail-hotel', $hotel->id) }}">{{ $hotel->name }}</a></b><br/>
                    <p class="lightgrey"><span class="green size14"><b>${{ $hotel->avg_price }}</b></span> /@lang('customer.night')</p>
                </div>
            </div>
        @endforeach
    @else
        <h2>Không tồn tại khách sạn</h2>
    @endif
    <div class="clearfix"></div>
    <div class="offset-2"><hr class="featurette-divider3"></div>
</div>
