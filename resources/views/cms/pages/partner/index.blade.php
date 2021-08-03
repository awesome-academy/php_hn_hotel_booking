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
                                <td>{{ \App\Models\Province::find($hotel->province_id)->name }}</td>
                                <td>{{ ($hotel->status == config('user.pending')) ? __('partner_pending'): __('partner_approved') }}</td>
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
