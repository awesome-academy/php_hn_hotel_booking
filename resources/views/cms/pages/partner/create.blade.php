@extends('cms.master')

@section('sidebar')
    @include('cms.layouts.partner.sidebar')
@endsection

@section('content')
    <div class="container-fluild">
        <div class="row">
            <div class="col-md-12">
                <div class="card-header">
                    <h3 class="card-title">@lang('partner.register_hotel')</h3>
                </div>
                <form action="{{ route('partners.hotels.store') }}" method="post" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                @error('name')
                                <small class="text-danger rule">{{ $message }}</small>
                                @enderror
                                <div class="form-group">
                                    <label for="title">@lang('partner.name_hotel')</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name', $request->name ?? null) }}"
                                           placeholder="@lang('partner.name_placeholder')">
                                </div>
                                @error('description')
                                <small class="text-danger rule">{{ $message }}</small>
                                @enderror
                                <div class="form-group">
                                    <label for="title">@lang('partner.description')</label>
                                    <input type="text" name="description" class="form-control" value="{{ old('name', $request->description ?? null) }}"
                                           placeholder="@lang('partner.description_placeholder')">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>@lang('partner.province')</label>
                                    <select class="select2 w-100" name="province_id" data-placeholder="@lang('partner.province_select')">
                                        @foreach ($provinces as $province)
                                        <option value="{{ $province->id }}" {{ ($province->id == old('province_id')) ?'selected' : '' }}>{{ $province->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
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
