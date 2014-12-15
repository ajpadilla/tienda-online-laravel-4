@extends('layouts.template')

@section('title')
    {{--{{ Lang::get('modulo.variable') }}--}}
@stop

@section('content')

    <div class="panel-heading">
        {{--<div class="panel-title m-b-md"><h4>Productos</h4></div>--}}
        <div class="panel-options">

            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#ventas">Productos para venta</a></li>
                <li class=""><a data-toggle="tab" href="#trueques">Productos para trueque</a></li>
                <li class=""><a data-toggle="tab" href="#clasificados">Clasificados</a></li>
            </ul>
        </div>
    </div>

	<div class="panel-body">
		<div class="panel blank-panel">
			<div class="tab-content">
				<div id="ventas" class="tab-pane active">
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
			    </div>

			    <div id="trueques" class="active">
			    </div>

			    <div id="clasificados" class="active">
			    </div>
		    </div>
	    </div>
    </div>
@stop

@section('in-situ-css')
	<link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}"/>
@stop

@include('products.partials._pop-up-products')

@include('products.partials._product-show-js')


