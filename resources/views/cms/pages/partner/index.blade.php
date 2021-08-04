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
                    <h3 class="card-title">@lang('partner.list_hotel')</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>@lang('partner.name')</th>
                            <th>@lang('partner.description')</th>
                            <th>@lang('partner.province')</th>
                            <th>@lang('partner.status')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($hotels as $hotel)
                            <tr>
                                <td>{{ $hotel->id }}</td>
                                <td>{{ $hotel->name }}</td>
                                <td>{{ $hotel->description }}</td>
                                <td>{{ $hotel->province->name }}</td>
                                <td>
                                    @if ($hotel->status == config('user.approved_number'))
                                        {{ config('user.approved') }}
                                    @elseif ($hotel->status == config('user.denied_number'))
                                        {{ config('user.denied') }}
                                    @else
                                        {{ config('user.pending') }}
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
