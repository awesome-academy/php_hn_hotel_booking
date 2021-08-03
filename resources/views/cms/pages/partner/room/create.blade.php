@extends('cms.master')

@section('sidebar')
    @include('cms.layouts.partner.sidebar')
@endsection

@section('content')
    <div class="container-fluild">
        <div class="row">
            <div class="col-md-12">
                <div class="card-header">
                    <h3 class="card-title">@lang('partner.register_room')</h3>
                </div>
                <form action="{{ route('partners.rooms.store') }}" method="post" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>@lang('partner.hotel')</label>
                                    <select class="select2 w-100" name="hotel_id">
                                        @foreach ($hotels as $hotel)
                                        <option value="{{ $hotel->id }}" {{ ($hotel->id == old('hotel_id')) ?'selected' : '' }}>{{ $hotel->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>@lang('partner.type_room')</label>
                                    <select class="select2 w-100" name="type_id">
                                        @foreach ($types as $type)
                                            <option value="{{ $type->id }}" {{ ($type->id == old('type_id')) ?'selected' : '' }}>{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group" id="slide-container">
                                    @error('images')
                                    <div>
                                        <small class="text-danger rule">{{ $message }}</small>
                                    </div>
                                    @enderror
                                    <label for="image">@lang('partner.image')</label>
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <a data-input="slide" data-preview="holder"
                                               class="lfm-multi btn btn-primary">
                                                <i class="fas fa-plus"></i>
                                            </a>
                                        </span>
                                        <input id="image" class="form-control" type="text" hidden>
                                    </div>
                                </div>
                                <div id="slider_container" class="row"></div>
                            </div>
                            <div class="col-6">
                                @error('price')
                                <small class="text-danger rule">{{ $message }}</small>
                                @enderror
                                <div class="form-group">
                                    <label for="title">@lang('partner.price')</label>
                                    <input type="text" name="price" class="form-control" value="{{ old('price', $request->price ?? null) }}"
                                           placeholder="@lang('partner.price_placeholder')">
                                </div>
                                @error('qty')
                                <small class="text-danger rule">{{ $message }}</small>
                                @enderror
                                <div class="form-group">
                                    <label for="title">@lang('partner.qty')</label>
                                    <input type="number" name="qty" class="form-control" value="{{ old('qty', $request->description ?? null) }}"
                                           placeholder="@lang('partner.qty_placeholder')">
                                </div>
                                @error('remaining')
                                <small class="text-danger rule">{{ $message }}</small>
                                @enderror
                                <div class="form-group">
                                    <label for="title">@lang('partner.remaining')</label>
                                    <input type="number" name="remaining" class="form-control" value="{{ old('remaining', $request->remaining ?? null) }}"
                                           placeholder="@lang('partner.remaining_placeholder')">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-submit">@lang('partner.create')</button>
                    </div>
                </form>
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
