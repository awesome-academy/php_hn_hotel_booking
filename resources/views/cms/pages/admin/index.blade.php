@extends('cms.master')

@section('sidebar')
    @include('cms.layouts.admin.sidebar')
@endsection

@section('content')
    <h1>admin</h1>
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
