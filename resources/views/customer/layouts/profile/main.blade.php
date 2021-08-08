<div class="col-md-11 offset-0">
    <!-- Tab panes from left menu -->
    <div class="tab-content5">
        <!-- TAB 5 -->
        <div class="tab-pane active" id="history">
            <div class="padding40">
                <span class="dark size18">@lang('customer.history')</span>
                <div class="line4"></div>
                <br>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('customer.hotels')</th>
                            <th>@lang('customer.total')</th>
                            <th>@lang('customer.status')</th>
                            <th>@lang('customer.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($orders as  $order)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $order->hotel->name }}</td>
                                <td>${{ $order->total }}</td>
                                <td>
                                    @if ($order->status == config('user.approved_number'))
                                        {{ __('approved') }}
                                    @elseif ($order->status == config('user.denied_number'))
                                        {{ __('denied') }}
                                    @elseif ($order->status == config('user.pending_number'))
                                        {{ __('pending') }}
                                    @elseif ($order->status == config('user.paid_number'))
                                        {{ __('paid') }}
                                    @else
                                        {{ __('unpaid') }}
                                    @endif
                                </td>
                                <td class="d-flex">
                                    <a href="">
                                        <button class="btn btn-warning btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="@lang('admin.hotel.view')">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                    </a>
                                    @if ($order->status == config('user.paid_number'))
                                        <a href="{{ route('customer.reviewForm', $order->id) }}">
                                            <button class="btn btn-success btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="@lang('admin.hotel.view')">
                                                <i class="fa fa-comment" aria-hidden="true"></i>
                                            </button>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- END OF TAB 5 -->
    </div>
    <!-- End of Tab panes from left menu -->
</div>
