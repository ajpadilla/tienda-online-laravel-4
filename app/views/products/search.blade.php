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
				@if (!$productsSearch->isEmpty())
				<table class="row-border dataTable no-footer" cellspacing="0" width="100%">
					<thead>
						<tr role="row">
							<th>Foto</th>

							<th>Puntos</th>

							<th>Nombre</th>

							<th>Categorias</th>

							<th>Precio</th>

						</tr>
					</thead>

					<tbody>
						@foreach ($productsSearch as $productSearch)
							<tr role="row">
								<td>{{ $productSearch->product->getFirstPhoto() }}</td>
								<td>{{ $productSearch->product->point_price }}</td>
								<td>{{ $productSearch->name }}</td>
								<td>
									@foreach ($productSearch->product->getCategories($language_id)  as $categoryName)
										{{ $categoryName }}								
									@endforeach
								</td>
								<td>{{ $productSearch->product->price }}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
				@else
				No hay productos registrados
				@endif
			</div>
		</div>
	</div>
</div>
@stop


