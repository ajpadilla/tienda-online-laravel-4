@extends('layouts.template')

@section('title')
    {{--{{ Lang::get('modulo.variable') }}--}}
@stop

@section('content')

    <div class="panel-heading">
        <div class="panel-title m-b-md"><h4>Carro de Compras</h4></div>
    </div>

	<div class="panel-body">
		<div class="panel blank-panel">
			<pre>
				{{ dd($cart) }}
			</pre>
	    </div>
    </div>
@stop

@include('products.partials._pop-up-products')

@include('products.partials._product-show-js')