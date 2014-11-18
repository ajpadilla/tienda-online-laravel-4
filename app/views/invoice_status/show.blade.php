@extends('layouts.template')

@section('title')
{{--{{ trans('invoiceStatus.labels.name')}}--}}
{{	trans('invoiceStatus.title') }}
@stop

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>{{	trans('invoiceStatus.subtitle') }}</h5>
			</div>
			<div class="ibox-content">
				<div class="row">
					{{ Form::open(['url' => LaravelLocalization::transRoute('invoiceStatus.store'),'class'=>'form-horizontal','method' => 'POST','id' => 'formCrateinvoiceStatus']) }}
					<div class="col-sm-6 b-r">
						<div class="form-group">
							{{ Form::label('language_id', trans('invoiceStatus.labels.language'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::text('language_id',$invoiceStatusLanguage->name, ['class' => 'form-control', 'id' => 'name','readonly']) }}
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('name', trans('invoiceStatus.labels.name'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::text('name',$invoiceStatusLanguage->pivot->name, ['class' => 'form-control', 'id' => 'name','readonly']) }}
							</div>
						</div>
					</div>
					
					<div class="col-sm-6">
						<div class="form-group">
							{{ Form::label('description', trans('invoiceStatus.labels.description'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::textarea('description',$invoiceStatusLanguage->pivot->description, ['class' => 'form-control', 'rows' => '3','readonly']) }}
							</div>
						</div>
						
						<div class="form-group">
							{{ Form::label('color', trans('invoiceStatus.labels.color'),['class'=>'col-sm-2 control-label']) }}
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
								,$invoiceStatus->color,['class' => 'form-control','id' => 'color']) }}
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