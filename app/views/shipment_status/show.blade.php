@extends('layouts.template')

@section('title')
{{--{{ trans('shipmentStatus.labels.name')}}--}}
{{	trans('shipmentStatus.show_data.title') }}
@stop

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>{{	trans('shipmentStatus.show_data.subtitle') }}</h5>
			</div>
			<div class="ibox-content">
				<div class="row">
					{{ Form::open(['url' => LaravelLocalization::transRoute('shipmentStatus.store'),'class'=>'form-horizontal','method' => 'POST','id' => 'formCrateShipmentStatus']) }}
					<div class="col-sm-6 b-r">
						<div class="form-group">
							{{ Form::label('language_id', trans('shipmentStatus.labels.language'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::text('language_id',$shipmentStatusLanguage->name, ['class' => 'form-control', 'id' => 'name','readonly']) }}
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('name', trans('shipmentStatus.labels.name'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::text('name',$shipmentStatusLanguage->pivot->name, ['class' => 'form-control', 'id' => 'name','readonly']) }}
							</div>
						</div>
					</div>
					
					<div class="col-sm-6">
						<div class="form-group">
							{{ Form::label('description', trans('shipmentStatus.labels.description'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::textarea('description',$shipmentStatusLanguage->pivot->description, ['class' => 'form-control', 'rows' => '3','readonly']) }}
							</div>
						</div>
						
						<div class="form-group">
							{{ Form::label('color', trans('shipmentStatus.labels.color'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::select('color',array(
											'#7bd148' => 'Green',
											'#5484ed' =>'Bold blue',
											'#a4bdfc' => 'Blue',
											'#46d6db' => 'Turquoise',
											'#7ae7bf' => 'Light green',
											'#51b749' => 'Bold green',
											'#fbd75b' => 'Yellow',
											'#ffb878' => 'Orange',
											'#ff887c' => 'Red',
											'#dc2127' => 'Bold red',
											'#dbadff' => 'Purple',
											'#e1e1e1' => 'Gray',
										)
								,$shipmentStatus->color,['class' => 'form-control','id' => 'color']) }}
							</div>
						</div>
					</div>
					{{ Form::close() }}
				</div>
			</div>
		</div>
	</div>
@stop

@section('scripts')
<script>
	$(document).ready(function () 
	{
		$('select[name="color"]').simplecolorpicker({picker: true, theme: 'glyphicons'});
	});
</script>
@stop