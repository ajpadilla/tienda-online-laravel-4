@extends('layouts.template')

@section('title')
{{--{{ Lang::get('modulo.variable') }}--}}
{{ trans('categories.list.title') }}
@stop

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>{{ trans('categories.list.subtitle') }}</h5>
			</div>
			@include('flash::message')
			<div class="ibox-content">
			<a class="btn btn-info " href="{{route('categories.create')}}"><i class="fa fa-paste"></i> {{ trans('categories.labels.new') }} </a>
				<div class="row"><br/></div>
				@include('partials._index-table')
			</div>
		</div>
	</div>
</div>
@stop

@section('scripts')
@stop