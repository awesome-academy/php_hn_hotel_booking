@extends('cms.master')

@section('sidebar')
    @include('cms.layouts.partner.sidebar')
@endsection

@section('content')
    @include('cms.layouts.partner.modal')
    <div class="container-fluild">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">@lang('admin.list_hotel')</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('partner.hotel')</th>
                                <th>@lang('partner.customer')</th>
                                <th>@lang('partner.phone')</th>
                                <th>@lang('partner.total')</th>
                                <th>@lang('partner.status')</th>
                                <th>@lang('admin.hotel.action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>#{{ ($orders->currentPage()-1) * $orders->perPage() + $loop->iteration }}</td>
                                    <td>{{ $order->hotel->name }}</td>
                                    <td>{{ $order->user->name }}</td>
                                    <td>{{ $order->user->phone_number }}</td>
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
                                        <button data-id="{{ $order->id }}" class="detail-order btn btn-warning btn-sm rounded-0"  type="button" data-toggle="modal" data-target="#detailOrder" data-placement="top" title="@lang('admin.hotel.view')">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                        @if ($order->status == config('user.approved_number'))
                                            <form action="{{ route('partners.order.paid', $order->id) }}" method="post">
                                                @csrf
                                                <input type="hidden" name="status" value="{{ config('user.paid_number') }}">
                                                <button class="btn btn-info btn-sm rounded-0" type="submit" data-toggle="tooltip"
                                                        data-placement="top" title="@lang('admin.hotel.paid')"><i class="fa fa-credit-card"></i></button>
                                            </form>
                                        @elseif ($order->status == config('user.pending_number'))
                                            <form action="{{ route('partners.order.upload', $order->id) }}" method="post">
                                                @csrf
                                                <input type="hidden" name="status" value="{{ config('user.approved_number') }}">
                                                <button class="btn btn-success btn-sm rounded-0" type="submit" data-toggle="tooltip"
                                                        data-placement="top" title="@lang('admin.hotel.approved')"><i class="fa fa-upload"></i></button>
                                            </form>
                                            <form action="{{ route('partners.order.ban', $order->id) }}" method="post">
                                                @csrf
                                                <input type="hidden" name="status" value="{{ config('user.denied_number') }}">
                                                <button class="btn btn-danger btn-sm rounded-0" type="submit" data-toggle="tooltip"
                                                        data-placement="top" title="@lang('admin.hotel.denied')"><i class="fa fa-ban"></i></button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
    <div class="card-footer">
        {{ $orders->appends(request()->query())->links("pagination::bootstrap-4") }}
    </div>
@endsection

@section('js')
    <script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.js') }}"></script>

    <script>
        @if (session('message'))
        Toast.fire({
            icon: 'success',
            title: '{{ session('message') }}'
        })
        @endif
    </script>
@endsection
