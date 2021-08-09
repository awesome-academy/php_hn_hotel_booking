@extends('cms.master')

@section('sidebar')
    @include('cms.layouts.admin.sidebar')
@endsection

@section('content')
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
                                <th>@lang('admin.hotel.name')</th>
                                <th>@lang('admin.hotel.description')</th>
                                <th>@lang('admin.hotel.province')</th>
                                <th>@lang('admin.hotel.status')</th>
                                <th>@lang('admin.hotel.action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($hotels as $hotel)
                                <tr>
                                    <td>#{{ ($hotels->currentPage()-1) * $hotels->perPage() + $loop->iteration }}</td>
                                    <td>{{ $hotel->name }}</td>
                                    <td>{{ $hotel->description }}</td>
                                    <td>{{ $hotel->province->name }}</td>
                                    <td>
                                        @if($hotel->status == config('user.approved_number'))
                                            {{ config('user.approved') }}
                                        @elseif($hotel->status == config('user.denied_number'))
                                            {{ config('user.denied') }}
                                        @else
                                            {{ config('user.pending') }}
                                        @endif
                                    </td>
                                    <td class="d-flex">
                                        <a href=""><button class="btn btn-warning btn-sm rounded-0" type="button" data-toggle="tooltip"
                                                           data-placement="top" title="@lang('admin.hotel.view')"><i class="fa fa-eye"></i></button>
                                        </a>
                                        @if ($hotel->status != config('user.approved_number'))
                                        <form action="{{ route('admin.hotel.upload') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $hotel->id }}">
                                            <input type="hidden" name="status" value="{{ config('user.approved_number') }}">
                                            <button class="btn btn-success btn-sm rounded-0" type="submit" data-toggle="tooltip"
                                                    data-placement="top" title="@lang('admin.hotel.approved')"><i class="fa fa-upload"></i></button>
                                        </form>
                                        @endif
                                        @if ($hotel->status != config('user.denied_number'))
                                        <form action="{{ route('admin.hotel.ban') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $hotel->id }}">
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
        {{ $hotels->appends(request()->query())->links("pagination::bootstrap-4") }}
    </div>
@endsection

@section('js')
    <script>
        @if (session('message'))
        Toast.fire({
            icon: 'success',
            title: '{{ session('message') }}'
        })
        @endif
    </script>
@endsection
