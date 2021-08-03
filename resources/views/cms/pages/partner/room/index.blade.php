@extends('cms.master')

@section('sidebar')
    @include('cms.layouts.partner.sidebar')
@endsection

@section('content')
    <div class="container-fluild">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">@lang('partner.list_room')</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>@lang('partner.hotel')</th>
                                <th>@lang('partner.type_room')</th>
                                <th>@lang('partner.price')</th>
                                <th>@lang('partner.qty')</th>
                                <th>@lang('partner.remaining')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($rooms as $room)
                                <tr>
                                    <td>{{ $room->id }}</td>
                                    <td>{{ $room->hotel->name }}</td>
                                    <td>{{ $room->type->name }}</td>
                                    <td>{{ $room->price }}</td>
                                    <td>{{ $room->qty }}</td>
                                    <td>{{ $room->remaining }}</td>
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
