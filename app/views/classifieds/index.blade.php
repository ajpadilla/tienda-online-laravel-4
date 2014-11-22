@extends('layouts.template')

@section('title')
{{--{{ Lang::get('modulo.variable') }}--}}
{{ trans('classifieds.list.title') }}
@stop

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>{{ trans('classifieds.list.title') }}</h5>
			</div>
			@include('flash::message')
			<div class="ibox-content">
				<?php
					$columns = [
						trans('classifieds.list.Name'),
						trans('classifieds.list.Description'),
						trans('classifieds.list.Address'),
						trans('classifieds.list.User'),
						trans('classifieds.list.Classifieds_types'),
						trans('classifieds.list.Classified_condition'),
						trans('classifieds.list.Actions')
				];
				$table = Datatable::table()
				->addColumn($columns)
				->setUrl(route('api.classifieds'))
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