@extends('layouts.template')

@section('title')
{{--{{ Lang::get('modulo.variable') }}--}}
{{ trans('classifiedConditions.title') }}
@stop

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>{{ trans('classifiedConditions.subtitle') }}</h5>
			</div>
			<div class="ibox-content">
				<div class="row">
					{{ Form::model($classified_condition, array('route' => array('classifiedConditions.update', $classified_condition->id),'id'=>'formEditclassifiedConditions','class'=>'form-horizontal')) }}
					<div class="col-sm-6 b-r">
						<div class="form-group">
							{{ Form::label('language_id', trans('classifiedConditions.labels.language'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-8">
								{{ Form::select('language_id',$languages,$classified_condition_language->id,array('class' => 'form-control','id'=>'language_id')) }}
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('name',trans('classifiedConditions.labels.name'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-8">
								{{ Form::text('name',$classified_condition_language->pivot->name, ['class' => 'form-control','id'=>'name']) }}
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<div class="col-sm-4 col-sm-offset-2">
								{{ Form::submit(trans('classifiedConditions.labels.save'), ['class' => 'btn btn-primary']) }}
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
	$(document).ready(function () {

		$.validator.addMethod('onlyLettersNumbersAndSpaces', function(value, element) {
         	  return this.optional(element) || /^[a-zA-Z0-9ñÑ\s]+$/i.test(value);
            }, '{{ trans('classifiedConditions.validation.onlyLettersNumbersAndSpaces') }}');

		$('#formEditclassifiedConditions').validate({
			rules:{
				name:{
					required:!0,
					onlyLettersNumbersAndSpaces: true,
					/*remote:
						{
							url:'{{ URL::to('/checkName/') }}',
							type: 'POST',
							data: {
								name: function() {
									return $('#name').val();
								},
								language_id: function () {
									return $('#language_id').val();
								}

							},
							dataFilter: function (respuesta) {
								console.log('consulta:'+respuesta);
								return respuesta;
							}
						}*/
				},
			},
			messages:{
				name:{
					required: '{{ trans('classifiedConditions.validation.required') }}',
					rangelength: '{{ trans('classifiedConditions.validation.rangelength') }}'+'[2, 45]'+'{{ trans('discounts.validation.characters') }}',
					remote: jQuery.validator.format('{{ trans('classifiedConditions.alert') }}')
				},
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
				url:  '{{ URL::route('classifiedConditions.update',$classified_condition->id) }}',
        		type:'POST'
			};
		$('#formEditclassifiedConditions').ajaxForm(options);

	});

	// pre-submit callback 
		function showRequest(formData, jqForm, options) {          
			setTimeout(jQuery.fancybox({
				'content': "<h1>"+'{{ trans('classifiedConditions.sending') }}'+"</h1>",
				'autoScale' : true,
				'transitionIn' : 'none',
				'transitionOut' : 'none',
				'scrolling' : 'no',         
				'type' : 'inline',
				'showCloseButton' : false,
				'hideOnOverlayClick' : false,
				'hideOnContentClick' : false    
			}), 5000 );  
			return $('#formEditclassifiedConditions').valid(); 
		} 
														     
		// post-submit callback 
		function showResponse(responseText, statusText, xhr, $form)  {    
			jQuery.fancybox({
				'content' : '<h1>'+ responseText + '</h1>',
				'autoScale' : true
			});
			//$('#formEditclassifiedConditions').resetForm();
		} 						
</script>
@stop