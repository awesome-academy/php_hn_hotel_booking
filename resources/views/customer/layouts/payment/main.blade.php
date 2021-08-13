<div class="col-md-8 pagecontainer2 offset-0">
    <div class="padding30 grey">
        <span class="size16px bold dark left">@lang('customer.who_traveling')</span>
        <div class="roundstep active right">1</div>
        <div class="clearfix"></div>
        <div class="line4"></div>
        @lang('customer.18_or_order') <br/><br/>
        <form action="{{ route('booking.checkout', $hotel->id) }}" method="post">
            @csrf
            <div class="col-md-4 textright">
                <div class="margtop15"><span class="dark">@lang('customer.contact_name'):</span><span class="red">*</span></div>
            </div>
            <div class="col-md-4">
                <span class="size12">@lang('customer.first_and_last_name')*</span>
                <input type="text" name="name" class="form-control " placeholder="@lang('customer.name_placeholder')">
            </div>
            <div class="col-md-4 textleft margtop15">
            </div>
            <div class="clearfix"></div>
            <br/>
            <div class="col-md-4 textright">
                <div class="margtop15"><span class="dark">@lang('customer.phone_number'):</span><span class="red">*</span></div>
            </div>
            <div class="col-md-4 textleft">
                <span class="size12">@lang('customer.phone_number')*</span>
                <input type="text" name="phone_number" class="form-control" placeholder="@lang('customer.phone_placeholder')">
            </div>
            <div class="clearfix"></div>
            <br/>
            <div class="col-md-4">
            </div>
            <div class="clearfix"></div>
            <div class="alert alert-info">
                @lang('customer.booking_note'):<br/>
                <p class="size12">• @lang('customer.booking_note_content')</p>
            </div>
            @lang('customer.agree_policy').<br/>
            <button type="submit" class="bluebtn margtop20">@lang('customer.complete_booking')</button>
        </form>
    </div>

</div>
