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
					{{ Form::open(['route' => 'classifieds.filterClassified','class'=>'form-horizontal','id' => 'formSearchClassified']) }}
						<div class="col-lg-12">
							<div class="row">
								<div class="form-group">
									<div class="col-md-2">
										<!--{{ Form::label('countryId', trans('classifieds.searchs.Country'),['class'=>'col-sm-2 control-label']) }}>-->

										 {{ Form::select('countryId',$country,null,array('class' => 'form-control','id'=>'countryId')) }}
									</div class="col-md-2">
											
									<div class="col-md-2">
										<!--{{ Form::label('stateId', trans('classifieds.searchs.State'),['class'=>'col-sm-1 control-label'])
											}}-->
										{{ Form::select('stateId',array(''),null,array('class' => 'form-control','id'=>'stateId')) }}
									</div>

									<div class="col-md-2">
										<!--{{ Form::label('cityId', trans('classifieds.searchs.City'),['class'=>'col-sm-1 control-label']) }}-->
										  		{{ Form::select('cityId',array(''),null,array('class' => 'form-control','id'=>'cityId')) }}
									</div>
												
									<div class="col-md-2">
										<!--{{ Form::label('price', trans('classifieds.labels.price'),['class'=>'col-sm-2 control-label']) }}-->
										{{ Form::text('price',null, ['class' => 'form-control']) }}
											
									</div>

									<div class="col-md-2">
										<!--{{ Form::label('operator', trans('classifieds.labels.precio'),['class'=>'col-md-2 control-label']) }}-->
											{{ Form::select('operator',
												array('>' => '>', 
													'<' => '<',
													'>=' => '>=',
													'<=' => '<=',
													'==' => '=='
													,),
													null,array('class' => 'form-control','id'=>'operator')) }}
									</div>
											
									<div class="col-md-2">
										<!--{{ Form::label('classifiedTypeId', trans('classifieds.labels.classified_type'),['class'=>'col-sm-2 control-label']) }}-->

										{{ Form::select('classifiedTypeId',$classifiedTypes,null,array('class' => 'form-control','id'=>'classifiedTypeId')) }}
									</div>
								</div>
								<div class="row">
									
									<div class="col-md-2">
										<!--{{ Form::label('classifiedConditionId', trans('classifieds.labels.classified_condition'),['class'=>'col-sm-2 control-label']) }}-->
									
										{{ Form::select('classifiedConditionId',$classifiedConditions,null,array('class' => 'form-control','id'=>'classifiedConditionId')) }}
									</div>
									
									<div class="col-md-4 col-lg-offset-1">
										{{ Form::submit(trans('classifieds.searchs.subtitle'), ['class' => 'btn btn-primary']) }}
									</div>
								</div>
							</div>
					{{ Form::close() }}
					</div>
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
			$('#countryId').click(function() {
				$.ajax({
					type: 'GET',
					url: '{{ URL::to('/statesForCountry/') }}',	
					data: {'countryId': $('#countryId').val()},
					dataType: "JSON",
					success: function(response) {
						console.log(response.success);
						console.log(response.states);
						if (response.success == true) {
							$('#stateId').html('');
							$('#stateId').append('<option value=\"\"> </option>');
							$.each(response.states,function (k,v){
								$('#stateId').append('<option value=\"'+k+'\">'+v+'</option>');
							});
						}else{
							$('#stateId').html('');
							$('#stateId').append('<option value=\"\"> {{ trans('classifieds.searchs.State') }} </option>');
						}
					}
				});
			});

			$('#stateId').click(function() {
				$.ajax({
					type: 'GET',
					url: '{{ URL::to('/citiesForState/') }}',	
					data: {'stateId': $('#stateId').val()},
					dataType: "JSON",
					success: function(response) {
						console.log(response.success);
						console.log(response.cities);
						if (response.success == true) {
							$('#cityId').html('');
							$('#cityId').append('<option value=\"\"> </option>');
							$.each(response.cities,function (k,v){
								$('#cityId').append('<option value=\"'+k+'\">'+v+'</option>');
							});
						}else{
							$('#cityId').html('');
							$('#cityId').append('<option value=\"\"> {{ trans('classifieds.searchs.City') }} </option>');
						}
					}
				});
			});
		});
	</script>
@stop