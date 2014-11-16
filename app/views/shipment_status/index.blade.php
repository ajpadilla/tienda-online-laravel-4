@extends('layouts.template')

@section('title')
{{--{{ Lang::get('modulo.variable') }}--}}
{{ trans('shipmentStatus.list.title') }}
@stop

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>{{ trans('shipmentStatus.list.title') }}</h5>
			</div>
			<div class="ibox-content">
				<?php
					$columns = [
						trans('shipmentStatus.list.Color'),
						trans('shipmentStatus.list.Name'),
						trans('shipmentStatus.list.Description'),
						trans('shipmentStatus.list.Actions')
				];
				$table = Datatable::table()
				->addColumn($columns)
				->setUrl(route('api.shipmentStatus'))
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