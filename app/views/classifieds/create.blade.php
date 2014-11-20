@extends('layouts.template')

@section('title')
{{--{{ trans('classifieds.labels.name')}}--}}
{{	trans('classifieds.title') }}
@stop

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>{{	trans('classifieds.subtitle') }}</h5>
			</div>
			<div class="ibox-content">
				<div class="row">
					{{ Form::open(['url' => LaravelLocalization::transRoute('classifieds.store'),'class'=>'form-horizontal','method' => 'POST','id' => 'formCreateDiscount']) }}
					<div class="col-sm-6 b-r">
						<div class="form-group">
							{{ Form::label('language_id', trans('classifieds.labels.language'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::select('language_id',array(),null,array('class' => 'form-control','id'=>'language_id')) }}
							</div>
						</div>
						
						<div class="form-group">
							{{ Form::label('name', trans('classifieds.labels.name'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::text('name',null, ['class' => 'form-control']) }}
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('description', trans('classifieds.labels.description'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::textarea('description',null, ['class' => 'form-control', 'rows' => '3']) }}
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('price', trans('classifieds.labels.price'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::text('price',null, ['class' => 'form-control']) }}
							</div>
						</div>
					</div>

					<div class="col-sm-6">
						
						<div class="form-group">
							{{ Form::label('classified_type_id', trans('classifieds.labels.classified_type'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::select('discount_type_id',array(),null,array('class' => 'form-control')) }}
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('classified_condition_id', trans('classifieds.labels.classified_condition'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::select('classified_condition_id',array(),null,array('class' => 'form-control')) }}
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('active', trans('classifieds.labels.add_photos'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-10">
								<div class="radio i-checks">
									<label> 
										<!--<input type="radio" value="option1" name="a">-->
										{{ Form::radio('active', '1', 1)}}
										<i></i> {{ trans('classifieds.labels.Yes') }}
									</label>
								</div>
								<div class="radio i-checks">
									<label> 
										<!--<input type="radio" value="option1" name="a">--> 
										{{ Form::radio('active', '0', 0)}}
										<i></i> {{ trans('classifieds.labels.No') }}
									</label>
								</div>
							</div>
						</div>
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
@stop

@section('scripts')
<script>
	$(document).ready(function () 
	{
		$('.i-checks').iCheck({
			checkboxClass: 'icheckbox_square-green',
			radioClass: 'iradio_square-green',
		});

		$('#from').datepicker({
			showButtonPanel: true,
			changeMonth: true,
			changeYear: true,
			yearRange: '2014:2030',
			dateFormat: '{{ trans('classifieds.date') }}',
		});

		$('#to').datepicker({
			showButtonPanel: true,
			changeMonth: true,
			changeYear: true,
			dateFormat: '{{ trans('classifieds.date') }}',
		});

		$.validator.addMethod('onlyLettersNumbersAndSpaces', function(value, element) {
         	  return this.optional(element) || /^[a-zA-Z0-9ñÑ\s]+$/i.test(value);
       	}, '{{ trans('classifieds.validation.onlyLettersNumbersAndSpaces') }}');

		$.validator.addMethod('onlyLettersNumbersAndDash', function(value, element) {
         	  return this.optional(element) || /^[a-zA-Z0-9ñÑ\-]+$/i.test(value);
        }, '{{ trans('classifieds.validation.onlyLettersNumbersAndDash') }}');

		jQuery.validator.addMethod('customDateValidator', function(value, element) {
       	 	try{
       	 		jQuery.datepicker.parseDate( '{{ trans('classifieds.date') }}' , value);return true;}
        	catch(e){return false;}
    	},'{{ trans('classifieds.validation.date') }}');

		$('#formCreateDiscount').validate({

			rules:{
				name:{
					required:!0,
					rangelength: [2, 255],
					onlyLettersNumbersAndSpaces: true
				},
				description:{
					required:!0,
					rangelength: [10, 255]
				},
				value:{
					required:!0,
					number: true
				},
				percent:{
					required:!0,
					number: true
				},
				quantity:{
					required:!0,
					digits: true
				},
				quantity_per_user:{
					required:!0,
					digits: true
				},
				code:{
					required:!0,
					onlyLettersNumbersAndDash: true,
					 remote:
						{
							url:'{{ URL::to('/checkCode/') }}',
							type: 'POST',
							data: {
								code: function() {
									return $('#code').val();
								}
							},
							dataFilter: function (respuesta) {
								console.log('consulta:'+respuesta);
								return respuesta;
							}
						} 
				},
				active:{
					required:!0,
					digits: true
				},
				from:{
					required:!0,
					customDateValidator: true
				},
				to:{
					required:!0,
					customDateValidator: true
				},
				discount_type_id:{
					required:!0,
					digits: true
				}
			},
			messages:{
				name:{
					required: '{{ trans('classifieds.validation.required') }}',
					rangelength: '{{ trans('classifieds.validation.rangelength') }}'+'[2, 255]'+'{{ trans('classifieds.validation.characters') }}',
				},
				description:{
					required: '{{ trans('classifieds.validation.required') }}',
					rangelength: '{{ trans('classifieds.validation.rangelength') }}'+'[10, 255]'+'{{ trans('classifieds.validation.characters') }}',
				},
				value:{
					required: '{{ trans('classifieds.validation.required') }}',
					number: '{{ trans('classifieds.validation.number') }}'
				},
				percent:{
					required: '{{ trans('classifieds.validation.required') }}',
					number: '{{ trans('classifieds.validation.number') }}'
				},
				quantity:{
					required: '{{ trans('classifieds.validation.required') }}',
					digits: '{{ trans('classifieds.validation.digits') }}'
				},
				quantity_per_user:{
					required: '{{ trans('classifieds.validation.required') }}',
					digits: '{{ trans('classifieds.validation.digits') }}'
				},
				code:{
					required: '{{ trans('classifieds.validation.required') }}',
					remote: jQuery.validator.format('{{ trans('classifieds.alert') }}')
				},
				active:{
					required: '{{ trans('classifieds.validation.required') }}',
					digits: '{{ trans('classifieds.validation.digits') }}'
				},
				from:{
					required: '{{ trans('classifieds.validation.required') }}',
					//date: '{{ trans('classifieds.validation.date') }}'
				},
				to:{
					required: '{{ trans('classifieds.validation.required') }}',
					//date: '{{ trans('classifieds.validation.date') }}'
				},
				discount_type_id:{
					required: '{{ trans('classifieds.validation.required') }}',
					digits: '{{ trans('classifieds.validation.digits') }}'
				}
			},
			highlight:function(element){
				$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
			},
			unhighlight:function(element){
				$(element).closest('.form-group').removeClass('has-error');
			},
			success:function(element){
				element.addClass('valid').closest('.form-group').removeClass('has-error').addClass('has-success');
			}

		});

		var options = { 
				beforeSubmit:  showRequest,  // pre-submit callback 
				success:       showResponse,  // post-submit callback 
				url:  '{{URL::route('classifieds.store')}}',
        		type:'POST'
			};
		$('#formCreateDiscount').ajaxForm(options);
	});

	// pre-submit callback
		function showRequest(formData, jqForm, options) {
			setTimeout(jQuery.fancybox({
				'content': '<h1>Enviando datos</h1>',
				'autoScale' : true,
				'transitionIn' : 'none',
				'transitionOut' : 'none',
				'scrolling' : 'no',
				'type' : 'inline',
				'showCloseButton' : false,
				'hideOnOverlayClick' : false,
				'hideOnContentClick' : false
			}), 5000 );
			return $('#formCreateDiscount').valid();
		}

		// post-submit callback
		function showResponse(responseText, statusText, xhr, $form)  {
			jQuery.fancybox({
				'content' : '<h1>'+ responseText + '</h1>',
				'autoScale' : true
			});
		} 						

</script>
@stop