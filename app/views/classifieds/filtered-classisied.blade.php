@extends('layouts.template')

@section('title')
{{ trans('classifieds.filtered.title') }}
@stop

@section('content')
@include('layouts.partials._error')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>{{trans('classifieds.filtered.subtitle')}}</h5>
			</div>
			@include('flash::message')
			<div class="ibox-content">
				@if (!empty($classifiedsResult))
				@foreach ($classifiedsResult as $classified)
				<table class="row-border dataTable no-footer" cellspacing="0" width="100%">
					<thead>
						<tr role="row">
							<th>Nombre</th>
							<th>Precio</th>
						</tr>
					</thead>
					<tbody>
						<tr role="row">
							<td>{{ $classified->getDataForLanguage($languageId)->pivot->name }}</td>	
							<td>{{ $classified->price }}</td>	
						</tr>
					</tbody>
				</table>
				@endforeach
				@endif
			</div>
		</div>
	</div>
</div>
@stop
