@extends('layouts.template')

@section('title')
    {{--{{ Lang::get('modulo.variable') }}--}}
@stop

@section('content')
	    <div class="row">
	        <h2>New Products</h2>
	        @include('products.partials._new-products')
	    </div>
	    <div class="row">
	        <h2>Top Products</h2>
	        {{--<div class="sidebar col col-md-3">
	            @include('products.partials._category-sidebar')
	        </div>--}}
	        @include('products.partials._top-products')
        </div>
        <div class="row">
            <h2>New Classifieds</h2>
            {{-- Aquí va es top classifieds --}}
            @include('products.partials._new-products')
        </div>
@stop

@section('in-situ-css')
	<link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}"/>
@stop

@include('products.partials._pop-up-products')

@include('products.partials._product-show-js')