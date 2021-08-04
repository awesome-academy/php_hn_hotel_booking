<div class="clearfix"></div>
<div class="itemscontainer offset-1">
    @if (!empty($hotels))
        @foreach ($hotels as $hotel)
    <div class="col-md-4">
        <div class="listitem">
            @foreach ($hotel->images as $image)
                @if ($loop->first)
                    <img src="{{ $image->image }}" alt=""/>
                @endif
            @endforeach
            <div class="liover"></div>
            <a class="fav-icon" href="#"></a>
            <a class="book-icon" href="#"></a>
        </div>
        <div class="itemlabel">
            <button class="bookbtn right mt1">@lang('customer.book')</button>
            <b>{{ $hotel->name }}</b><br/>
            <p class="lightgrey"><span class="green size14"><b>${{ $hotel->avg_price }}</b></span> /@lang('customer.night')</p>
        </div>
    </div>
    @endforeach
    @endif
    <div class="clearfix"></div>
    <div class="offset-2"><hr class="featurette-divider3"></div>
</div>
