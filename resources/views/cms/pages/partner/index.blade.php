@extends('cms.master')

@section('sidebar')
    @include('cms.layouts.partner.sidebar')
@endsection

@section('content')
    <h1>Partner</h1>
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
