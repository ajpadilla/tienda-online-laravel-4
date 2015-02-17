@extends('layouts.template')

@section('content')
@include('layouts.partials._error')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>{{trans('products.result_search.title')}}</h5>
			</div>
			@include('flash::message')
			<div class="ibox-content">
				<div class="row ol-md-12 text-left">
					{{ trans('products.Products') }}
				</div>
				@if (!empty($productResults))
					@foreach ($productResults as $category => $products)
						<div class="row col-md-12 text-center">
							{{$category}}
						</div>
						<table class="table table-bordered" cellspacing="0" width="100%">
							<thead>
								<tr class="row">
									<th class="col-md-4">Foto</th>
									<th class="col-md-4">Nombre</th>
									<th class="col-md-4">Categorias</th>
									<th class="col-md-4">Puntos</th>
									<th class="col-md-4">Precio</th>
								</tr>
							</thead>
							<tbody>
								@foreach($products as $key => $productSearch)
									<tr class="row">
										<td class="col-md-4">
											@if ($productSearch->product->getFirstPhoto())
												<a href="{{ URL::route('products.show',$productSearch->product->id) }}"><img class="mini-photo" src="{{ asset($productSearch->product->getFirstPhoto()->complete_path) }}" alt="$productSearch->product->getFirstPhoto()->filename"></a>
											@else
												{{ Lang::get('products.labels.image') }}
											@endif
										</td>
										<td class="col-md-4">{{ $productSearch->name }}</td>
										<td class="col-md-4">
											@foreach ($productSearch->product->getCategories() as $value)
												{{ $value }}
											@endforeach
										</td>
										<td class="col-md-4">{{ $productSearch->product->point_price }}</td>
										<td class="col-md-4">{{ $productSearch->product->price }}</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					@endforeach
				@endif

				@if (!empty($categoryResults))
					<div class="row ol-md-12 text-left">
						{{ trans('classifieds.Classifieds') }}
					</div>
					@foreach ($categoryResults as $category => $classifieds)
						<div class="row col-md-12 text-center">
							{{$category}}
						</div>
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
								@foreach($classifieds as $key => $classifiedSearch)
									<tr class="row">
										<td class="col-md-4">
											@if ($classifiedSearch->classified->getFirstPhoto())
												<a href="{{ URL::route('classifieds.show',$classifiedSearch->classified->id) }}"><img class="mini-photo" src="{{ asset($classifiedSearch->classified->getFirstPhoto()->complete_path) }}" alt="$classifiedSearch->classified->getFirstPhoto()->filename"></a>
											@else
												{{ Lang::get('classifieds.labels.image') }}
											@endif
										</td>
										<td class="col-md-4">{{ $classifiedSearch->name }}</td>
										<td class="col-md-4">
											@foreach ($classifiedSearch->classified->getCategories() as $value)
												{{ $value }}
											@endforeach
										</td>
										<td class="col-md-4">{{ $classifiedSearch->classified->price }}</td>
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

@section('styles')
	<style type="text/css">
		.mini-photo {
			width: 70px;
			height: 100px;
		}
	</style>
@stop
