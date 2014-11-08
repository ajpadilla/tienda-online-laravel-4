@extends('layouts.template')

@section('title')
{{--{{ Lang::get('modulo.variable') }}--}}
{{ trans('languages.title') }}
@stop

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>{{ trans('languages.subtitle') }}</h5>
			</div>
			<div class="ibox-content">
				<div class="row">
					{{ Form::open(['url' => LaravelLocalization::transRoute('languages.store'),'class'=>'form-horizontal','method' => 'POST','id' => 'formCreateLanguage']) }}
					<div class="col-sm-6 b-r">
						<div class="form-group">
							{{ Form::label('name',trans('languages.labels.name'),['class'=>'col-sm-4 control-label']) }}
							<div class="col-sm-6">
								{{ Form::text('name',null, ['class' => 'form-control','id'=>'name']) }}
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('native_name',trans('languages.labels.native_name'),['class'=>'col-sm-4 control-label']) }}
							<div class="col-sm-6">
								{{ Form::text('native_name',null, ['class' => 'form-control','id'=>'native_name']) }}
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('iso_code',trans('languages.labels.iso_code'),['class'=>'col-sm-4 control-label']) }}
							<div class="col-sm-6">
								{{ Form::text('iso_code',null, ['class' => 'form-control','id'=>'iso_code']) }}
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							{{ Form::label('language_code',trans('languages.labels.language_code'),['class'=>'col-sm-4 control-label']) }}
							<div class="col-sm-6">
								{{ Form::text('language_code',null, ['class' => 'form-control','id'=>'language_code']) }}
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('date_format',trans('languages.labels.date_format'),['class'=>'col-sm-4 control-label']) }}
							<div class="col-sm-6">
								{{ Form::text('date_format',null, ['class' => 'form-control','id'=>'date_format']) }}
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-4 col-sm-offset-2">
								{{ Form::submit(trans('languages.labels.save'), ['class' => 'btn btn-primary']) }}
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
            }, '{{ trans('languages.validation.onlyLettersNumbersAndSpaces') }}');

		$.validator.addMethod('onlyLetters', function(value, element) {
         	  return this.optional(element) || /^[a-zA-Z]+$/i.test(value);
            }, '{{ trans('languages.validation.onlyLetters') }}');

		$('#formCreateLanguage').validate({
			rules:{
				name:{
					required:true,
					onlyLettersNumbersAndSpaces: true,
				},
				native_name:{
					required: true,
					onlyLettersNumbersAndSpaces: true,
				},
				iso_code:{
					required: true,
					onlyLetters: true,
					remote:
						{
							url:'{{ URL::to('/checkIsoCodeLang/') }}',
							type: 'POST',
							data: {
								iso_code: function() {
									return $('#iso_code').val();
								}
							},
							dataFilter: function (respuesta) {
								console.log('consulta:'+respuesta);
								return respuesta;
							}
						}
				},
				language_code:{
					required: true,
					onlyLettersNumbersAndSpaces: true,
				},
				date_format:{
					required: true,
					rangelength: [2,45],
					onlyLettersNumbersAndSpaces: true,
				},
			},
			messages:{
				name:{
					required: '{{ trans('languages.validation.required') }}',
					rangelength: '{{ trans('languages.validation.rangelength') }}'+'[2, 255]'+'{{ trans('discounts.validation.characters') }}',
				},
				native_name:{
					required: '{{ trans('languages.validation.required') }}',
					rangelength: '{{ trans('languages.validation.rangelength') }}'+'[2, 255]'+'{{ trans('discounts.validation.characters') }}',
				},
				iso_code:{
					required: '{{ trans('languages.validation.required') }}',
					remote: jQuery.validator.format('{{ trans('languages.alert') }}')
				},
				language_code:{
					required: '{{ trans('languages.validation.required') }}',
				},
				date_format:{
					required: '{{ trans('languages.validation.required') }}',
					rangelength: '{{ trans('languages.validation.rangelength') }}'+'[2, 45]'+'{{ trans('discounts.validation.characters') }}',
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
				url:  '{{URL::to(LaravelLocalization::transRoute('languages.store'))}}',
        		type:'POST'
			};
		$('#formCreateLanguage').ajaxForm(options);

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
			return $('#formCreateLanguage').valid(); 
		} 
														     
		// post-submit callback 
		function showResponse(responseText, statusText, xhr, $form)  {    
			jQuery.fancybox({
				'content' : '<h1>'+ responseText + '</h1>',
				'autoScale' : true
			});
			$('#formCreateLanguage').resetForm();
		} 						
</script>
@stop