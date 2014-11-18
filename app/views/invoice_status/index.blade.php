@extends('layouts.template')

@section('title')
{{--{{ Lang::get('modulo.variable') }}--}}
{{ trans('invoiceStatus.list.title') }}
@stop

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>{{ trans('invoiceStatus.list.title') }}</h5>
			</div>
			@include('flash::message')
			<div class="ibox-content">
				<?php
					$columns = [
						trans('invoiceStatus.list.Color'),
						trans('invoiceStatus.list.Name'),
						trans('invoiceStatus.list.Description'),
						trans('invoiceStatus.list.Actions')
				];
				$table = Datatable::table()
				->addColumn($columns)
				->setUrl(route('api.invoiceStatus'))
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