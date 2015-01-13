@extends('layouts.template')

@section('title')
{{--{{ Lang::get('modulo.variable') }}--}}
{{ trans('classifieds.searchs.title') }}
@stop

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>{{ trans('classifieds.searchs.subtitle') }}</h5>
			</div>
			<div class="ibox-content">
				<div class="row">
					{{ Form::open(['route' => 'classifieds.filteClassified','class'=>'form-horizontal','id' => 'formSearchClassified']) }}
					<div class="col-sm-6 b-r">
						<div class="form-group">
							{{ Form::label('country_id', trans('classifieds.searchs.Country'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::select('country_id',$country,null,array('class' => 'form-control','id'=>'country_id')) }}
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('state_id', trans('classifieds.searchs.State'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::select('state_id',array(''),null,array('class' => 'form-control','id'=>'state_id')) }}
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('city_id', trans('classifieds.searchs.City'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::select('city_id',array(''),null,array('class' => 'form-control','id'=>'city_id')) }}
							</div>
						</div>
						
						<div class="form-group">
							{{ Form::label('price', trans('classifieds.labels.price'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::text('price',null, ['class' => 'form-control']) }}
							</div>
						</div>

						<div class="form-group">
							{{ Form::label('classified_type_id', trans('classifieds.labels.classified_type'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::select('classified_type_id',$classifiedTypes,null,array('class' => 'form-control','id'=>'classified_type_id')) }}
							</div>
						</div>

						<div class="form-group">
							{{ Form::label('classified_condition_id', trans('classifieds.labels.classified_condition'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::select('classified_condition_id',$classifiedConditions,null,array('class' => 'form-control','id'=>'classified_condition_id')) }}
							</div>
						</div>

					</div>

					<div class="col-sm-6">
						<div class="form-group">
							<div class="col-sm-4 col-sm-offset-2">
								{{ Form::submit(trans('classifieds.labels.save'), ['class' => 'btn btn-primary']) }}
							</div>
						</div>
					</div>
					{{ Form::close() }}
				</div>
			</div>
		</div>
	</div>
</div>
@stop

@section('scripts')
	<script>
		$(document).ready(function () 
		{
			$('#country_id').click(function() {
				
				$.ajax({
					type: 'GET',
					url: '{{ URL::to('/statesForCountry/') }}',	
					data: {'conutry_id': $('#country_id').val()},
					dataType: "JSON",
					success: function(response) {
						console.log(response.success);
						console.log(response.states);
						if (response.success == true) {
							$('#state_id').html('');
							$('#state_id').append('<option value=\"\"> {{ trans('classifieds.searchs.State') }} </option>');
							$.each(response.states,function (k,v){
								$('#state_id').append('<option value=\"'+k+'\">'+v+'</option>');
							});
						}else{
							$('#state_id').html('');
							$('#state_id').append('<option value=\"\"> {{ trans('classifieds.searchs.State') }} </option>');
						}
					}
				});

			});
		});
	</script>
@stop