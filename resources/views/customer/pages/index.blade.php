@extends('customer.master')

@section('content')
    @include('customer.layouts.index.filter')
    @include('customer.layouts.index.content')
@endsection

@section('left-nav')
    @include('customer.layouts.left-nav')
@endsection
