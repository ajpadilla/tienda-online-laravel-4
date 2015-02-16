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
			<div class="ibox-content">
				@if (!empty($classifiedsResult))
				@foreach ($classifiedsResult as $classified)
				<table class="table table-bordered" cellspacing="0" width="100%">
					<thead>
						<tr class="row">
							<th class="col-md-4">Foto</th>
							<th class="col-md-4">Nombre</th>
							<th class="col-md-4">Categorias</th>
							<th class="col-md-4">Precio</th>
						</tr>
					</thead>
					<tbody>
						<tr class="row">
							<td class="col-md-4">
								@if ($classified->getFirstPhoto())
									<a href="{{ URL::route('classifieds.show',$classified->id) }}"><img class="mini-photo" src="{{ asset($classified->getFirstPhoto()->complete_path) }}" alt="$classified->getFirstPhoto()->filename"></a>
								@else 
									{{ Lang::get('classifieds.labels.image') }}
								@endif 
							</td>
							<td class="col-md-4">{{ $classified->getInCurrentLangAttribute()->name }}</td>	
							<td class="col-md-4">
								@foreach ($classified->getCategories() as $value)
									{{ $value }}
								@endforeach
							</td>
							<td class="col-md-4">{{ $classified->price }}</td>	
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

@section('styles')
	<style type="text/css">
		.mini-photo {
			width: 70px;
			height: 100px;
		}
	</style>
@stop