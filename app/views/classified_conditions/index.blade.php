@extends('layouts.template')

@section('title')
{{--{{ Lang::get('modulo.variable') }}--}}
{{ trans('classifiedTypes.list.title') }}
@stop

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>{{ trans('classifiedTypes.list.title') }}</h5>
			</div>
			@include('flash::message')
			<div class="ibox-content">
				<?php
					$columns = [
						trans('classifiedTypes.list.Name'),
						trans('classifiedTypes.list.Actions')
				];
				$table = Datatable::table()
				->addColumn($columns)
				->setUrl(route('api.classifiedTypes'))
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