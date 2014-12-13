@extends('layouts.template')

@section('title')
{{--{{ Lang::get('modulo.variable') }}--}}
{{ trans('attributeType.list.title') }}
@stop

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>{{ trans('attributeType.list.subtitle') }}</h5>
			</div>
			@include('flash::message')
			<div class="ibox-content">
			<a class="btn btn-info " href="{{route('attributeType.create')}}"><i class="fa fa-paste"></i> {{ trans('attributeType.labels.new') }} </a>
				<?php
					$columns = [
						trans('attributeType.list.Name'),
						trans('attributeType.list.Actions')
				];
				$table = Datatable::table()
				->addColumn($columns)
				->setUrl(route('api.attributeType'))
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