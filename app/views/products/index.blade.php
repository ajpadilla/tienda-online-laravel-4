@extends('layouts.template')

@section('title')
	
@stop

@section('content')
@include('layouts.partials._error')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>{{trans('products.list.title')}}</h5>
			</div>
			@include('flash::message')
			<div class="ibox-content">
				<a class="btn btn-info " href="{{route('products.create')}}"><i class="fa fa-paste"></i> New</a>
				<?php
					$columns = [
						trans('products.list.photo'),
						trans('products.list.name'),
						trans('products.list.price'),
						trans('products.list.quantity'),
						trans('products.list.active'),
						trans('products.list.accept'),
						trans('products.list.category'),
						trans('products.list.ratings'),
						trans('products.list.actions')
				];
				$table = Datatable::table()
				->addColumn($columns)
				->setUrl(route('api.products'))
				->noScript();
				?>
				<div class="row"><br/></div>
				{{ $table->render() }}
			</div>
		</div>
	</div>
</div>
@stop

@section('scripts')
	{{ $table->script() }}
@stop

@section('styles')
	<style type="text/css">
		.mini-photo {
			width: 70px;
			height: 100px;
		}
	</style>
@stop
