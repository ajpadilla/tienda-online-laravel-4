@extends('layouts.template')

@section('title')
{{--{{ Lang::get('modulo.variable') }}--}}
{{ trans('classifiedConditions.list.title') }}
@stop

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>{{ trans('classifiedConditions.list.title') }}</h5>
			</div>
			@include('flash::message')
			<div class="ibox-content">
				<?php
					$columns = [
						trans('classifiedConditions.list.Name'),
						trans('classifiedConditions.list.Actions')
				];
				$table = Datatable::table()
				->addColumn($columns)
				->setUrl(route('api.classifiedConditions'))
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