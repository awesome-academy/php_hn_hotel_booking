@component('mail::message')
# @lang('partner.hello') {{ $data['name'] }},
@lang('partner.foreword')
@component('mail::table')
|                                                |                            |    |
| -----------------------------------------------|:-------------------------: |--: |
|<b>@lang('partner.general_information')</b>     |                            |    |
|@lang('partner.Revenues')                       |${{ $data['revenues'] }}    |    |
|@lang('partner.Orders')                         |{{ $data['orders'] }}       |    |
|<b>@lang('partner.detail_information')</b>      |                            |    |
@foreach($data['orderDetail'] as $key => $detail)
|<b>@lang('partner.order') #{{ $key }}</b>       |                            |    |
|@lang('partner.name')                           | {{ $detail['customer'] }}  |    |
|@lang('partner.email')                          | {{ $detail['email'] }}     |    |
|@lang('partner.phone')                          | {{ $detail['phone'] }}     |    |
|@lang('partner.hotel')                          | {{ $detail['hotel_id'] }}  |    |
|@lang('partner.status')                         | {{ $detail['status'] }}    |    |
|@lang('partner.created_at')                     | {{ $detail['created_at'] }}|    |
|@lang('partner.total')                          |${{ $detail['total'] }}     |    |
@endforeach
@endcomponent

@lang('partner.thanks') <br>
@endcomponent

