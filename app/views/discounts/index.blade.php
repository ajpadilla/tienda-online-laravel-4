@extends('layouts.template')

@section('title')
{{--{{ Lang::get('modulo.variable') }}--}}
{{ trans('discounts.list.title') }}
@stop

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>{{ trans('discounts.list.title') }}</h5>
			</div>
			@include('flash::message')
			<div class="ibox-content">
				<?php
					$columns = [
						trans('discounts.list.Code'),
						trans('discounts.list.Discount_type'),
						trans('discounts.list.Name'),
						trans('discounts.list.Value'),
						trans('discounts.list.Percent'),
						trans('discounts.list.Active'),
						trans('discounts.list.From'),
						trans('discounts.list.To'),
						trans('discounts.list.Actions')
				];
				$table = Datatable::table()
				->addColumn($columns)
				->setUrl(route('api.discounts'))
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