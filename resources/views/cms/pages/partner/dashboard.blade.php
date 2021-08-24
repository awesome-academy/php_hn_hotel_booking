@extends('cms.master')

@section('sidebar')
    @include('cms.layouts.partner.sidebar')
@endsection

@section('content')
    <div class="container-fluild">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-lg-4 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $numberOfOrders }}</h3>

                                <p>@lang('partner.orders')</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="{{ route('partners.order') }}" class="small-box-footer">
                                @lang('partner.more_info')
                                <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-4 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $numberOfHotel }}</h3>

                                <p>@lang('partner.hotel')</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="{{ route('partners.hotels.index') }}" class="small-box-footer">
                                @lang('partner.more_info')
                                <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-4 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>${{ $totalRevenue }}</h3>
                                <p>@lang('partner.Revenues')</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="{{ route('partners.order') }}" class="small-box-footer">
                                @lang('partner.more_info')
                                <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <input id="chart_data" type="hidden" value="{{ $data }}">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">@lang('partner.orders')</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                </div>
                            </div>
                            <canvas id="order_chart" class="chartjs-render-monitor"></canvas>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-12">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">@lang('partner.Revenues')</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                </div>
                            </div>
                            <canvas id="revenue_chart" class="chartjs-render-monitor"></canvas>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
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
