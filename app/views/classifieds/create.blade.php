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
					{{ Form::open(['route' => 'classifieds.store','class'=>'form-horizontal','id' => 'form-create-classified']) }}
						@include('classifieds.partials._form')
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

		$('.chosen-select').chosen({width: "95%"});

		$('.summernote').summernote();

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

		$('#form-create-classified').validate({

			rules:{
				name:{
					required:!0,
					rangelength: [2, 255],
					onlyLettersNumbersAndSpaces: true,
					remote:
					{
						url:'{{ URL::to('/checkNameClassified/') }}',
						type: 'POST',
						data: {
							language_id: function() {
								return $('#language_id').val();
							},
							name: function() {
								return $('#name').val();
							}
						},
						dataFilter: function (respuesta) {
							//console.log('consulta:'+respuesta);
							return respuesta;
						}
					}
				},
				description:{
					required:!0,
					rangelength: [10, 255]
				},
				addres:{
					required:!0,
					rangelength: [10, 255]
				},
				price:{
					required:!0,
					number: true
				},
			},
			messages:{
				name:{
					required: '{{ trans('classifieds.validation.required') }}',
					rangelength: '{{ trans('classifieds.validation.rangelength') }}'+'[2, 255]'+'{{ trans('classifieds.validation.characters') }}',
					remote: jQuery.validator.format('{{ trans('classifieds.alert') }}')
				},
				description:{
					required: '{{ trans('classifieds.validation.required') }}',
					rangelength: '{{ trans('classifieds.validation.rangelength') }}'+'[10, 255]'+'{{ trans('classifieds.validation.characters') }}',
				},
				addres:{
					required: '{{ trans('classifieds.validation.required') }}',
					rangelength: '{{ trans('classifieds.validation.rangelength') }}'+'[10, 255]'+'{{ trans('classifieds.validation.characters') }}',
				},
				price:{
					required: '{{ trans('classifieds.validation.required') }}',
					number: '{{ trans('classifieds.validation.number') }}'
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
			 	dataType:  'json', 
				beforeSubmit:  showRequest,  // pre-submit callback 
				success:       processJson,  // post-submit callback 
				url:  '{{URL::route('classifieds.store')}}',
        		type:'POST'
			};
		$('#form-create-classified').ajaxForm(options);
	});

	// pre-submit callback
		function showRequest(formData, jqForm, options) {
			setTimeout(jQuery.fancybox({
				'content': '<h1>' + '{{ trans('classifieds.sending') }}' + '</h1>',
				'autoScale' : true,
				'transitionIn' : 'none',
				'transitionOut' : 'none',
				'scrolling' : 'no',
				'type' : 'inline',
				'showCloseButton' : false,
				'hideOnOverlayClick' : false,
				'hideOnContentClick' : false
			}), 5000 );
			return $('#form-create-classified').valid();
		}

		function processJson(response) { 
    		jQuery.fancybox({
				'content' : '<h1>'+ response.message + '</h1>',
				'autoScale' : true
			});

    		if(response.add_photos == 1)
					document.location.href = response.url;

		}	
</script>
@stop