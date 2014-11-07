@extends('layouts.template')

@section('title')
{{--{{ Lang::get('modulo.variable') }}--}}
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
						'Code',
						'Discount type',
						'Name',
						'Value',
						'Percent',
						'Active',
						'From',
						'To',
						'Actions'
				];
				$table = Datatable::table()
				->addColumn($columns)
				->setUrl(route('api.discounts'))
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