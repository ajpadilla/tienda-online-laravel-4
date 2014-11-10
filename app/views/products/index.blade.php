@extends('layouts.template')

@section('title')

@stop

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>List discounts</h5>
			</div>
			<div class="ibox-content">
				<?php
					$columns = [
						'Photo',
						'Name',
						'Price',
						'Quantity',
						'Active',
						'Accept',
						'Category',
						'Ratings',
						'Actions'
				];
				$table = Datatable::table()
				->addColumn($columns)
				->setUrl(route('api.products'))
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

@section('styles')
	<style type="text/css">
		.mini-photo {
			width: 70px;
			height: 100px;
		}
	</style>
@stop
