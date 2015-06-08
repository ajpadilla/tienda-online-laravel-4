@extends('layouts.template')

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
				        <h2>{{ Lang::get('products.labels.NewProducts') }}</h2>
				        @include('products.partials._new-products')
				    </div>
				    <div class="row">
				        <h2>{{ Lang::get('products.labels.TopProducts') }}</h2>
				        @include('products.partials._top-products')
			        </div>
			    </div>

			    <div id="trueques" class="tab-pane">
			    </div>

			    <div id="clasificados" class="tab-pane">
			    	{{--<div class="row">
				        <h2>{{ Lang::get('classifieds.labels.NewClassifieds') }}</h2>
					    @include('classifieds.partials._new-classifieds')
				    </div>--}}
				    {{-- <div class="row">
				        <h2>{{ Lang::get('classifieds.labels.TopClassifieds') }}</h2>
				        @include('products.partials._top-products')
			        </div> --}}
			    </div>
		    </div>
	    </div>
    </div>
@stop

@if($newProducts)
	@foreach($newProducts as $product)
		@include('products.partials._pop-up-products')
	@endforeach		    
@endif

@if($newClassifieds)
	@foreach($newClassifieds as $classified)
		@include('classifieds.partials._pop-up-classifieds')
	@endforeach		    
@endif