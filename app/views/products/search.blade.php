@extends('layouts.template')

@section('title')
{{ trans('products.list.title') }}
@stop

@section('content')
@include('layouts.partials._error')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>{{trans('products.list.subtitle')}}</h5>
			</div>
			@include('flash::message')
			<div class="ibox-content">
				@if (count($productResults) > 0)
					@foreach ($productResults as $category => $products)
					{{$category}}
					<table class="row-border dataTable no-footer" cellspacing="0" width="100%">
						<thead>
							<tr role="row">
								<th>Puntos</th>
								<th>Nombre</th>
								<th>Categorias</th>
								<th>Precio</th>
							</tr>
						</thead>
						<tbody>
							@foreach($products as $key => $productSearch)
							<tr role="row">
								<!--<td>{{ $key }}</td>-->
								<td>{{ $productSearch->product->point_price }}</td>	
								<td>{{ $productSearch->name }}</td>	
								<td>
									@foreach ($productSearch->product->getCategories($language_id) as $value)
									{{ $value }}
									@endforeach
								</td>	
								<td>{{ $productSearch->product->price }}</td>	
							</tr>
							@endforeach
						</tbody>
					</table>
					@endforeach
				@endif
				@if (count($categoryResults) > 0)
					@foreach ($categoryResults as $category => $classifieds)
					{{$category}}
					<table class="row-border dataTable no-footer" cellspacing="0" width="100%">
						<thead>
							<tr role="row">
								<!--<th>Puntos</th>-->
								<th>Nombre</th>
								<th>Categorias</th>
								<th>Precio</th>
							</tr>
						</thead>
						<tbody>
							@foreach($classifieds as $key => $classifiedSearch)
							<tr role="row">
								<!--<td>{{ $key }}</td>-->
								<!--<td>{{ $classifiedSearch->classified->price }}</td>-->
								<td>{{ $classifiedSearch->name }}</td>	
								<td>
									@foreach ($classifiedSearch->product->getCategories($language_id) as $value)
									{{ $value }}
									@endforeach
								</td>	
								<td>{{ $classifiedSearch->classified->price }}</td>	
							</tr>
							@endforeach
						</tbody>
					</table>
					@endforeach
				@endif
			</div>
		</div>
	</div>
</div>
@stop


