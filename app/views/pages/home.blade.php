@extends('layouts.template')

@section('title')
    {{--{{ Lang::get('modulo.variable') }}--}}
@stop

@section('content')

    <div class="panel-heading">
        {{--<div class="panel-title m-b-md"><h4>Productos</h4></div>--}}
        <div class="panel-options">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#ventas">Tienda - Canjea tus Puntos</a></li>
                <li class=""><a data-toggle="tab" href="#trueques">Venta de Garaje y Trueque</a></li>
                <li class=""><a data-toggle="tab" href="#clasificados">Anuncios Clasificados</a></li>
            </ul>
        </div>
    </div>

	<div class="panel-body">
		<div class="panel blank-panel">
			<div class="tab-content">
				<div id="ventas" class="tab-pane active">
				    <div class="row">
				        <h2>Nuevos Productos</h2>
				        @include('products.partials._new-products')
				    </div>
				    <div class="row">
				        <h2>Top de Productos</h2>
				        @include('products.partials._top-products')
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

@include('products.partials._pop-up-products')

@include('products.partials._product-show-js')