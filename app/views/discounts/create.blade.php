@extends('layouts.template')

@section('title')
{{--{{ trans('discounts.labels.name')}}--}}
{{	trans('discounts.title') }}
@stop

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>{{	trans('discounts.subtitle') }}</h5>
			</div>
			<div class="ibox-content">
				<div class="row">
					{{ Form::open(['route' =>'discounts.store','class'=>'form-horizontal','method' => 'POST','id' => 'form-create-discount']) }}
						@include('discounts.partials._form')
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
		$('#form-create-discount').validate({
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
								//console.log('consulta:'+respuesta);
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
					required: '{{ trans('discounts.validation.required') }}',
					rangelength: '{{ trans('discounts.validation.rangelength') }}'+'[2, 255]'+'{{ trans('discounts.validation.characters') }}',
				},
				description:{
					required: '{{ trans('discounts.validation.required') }}',
					rangelength: '{{ trans('discounts.validation.rangelength') }}'+'[10, 255]'+'{{ trans('discounts.validation.characters') }}',
				},
				value:{
					required: '{{ trans('discounts.validation.required') }}',
					number: '{{ trans('discounts.validation.number') }}'
				},
				percent:{
					required: '{{ trans('discounts.validation.required') }}',
					number: '{{ trans('discounts.validation.number') }}'
				},
				quantity:{
					required: '{{ trans('discounts.validation.required') }}',
					digits: '{{ trans('discounts.validation.digits') }}'
				},
				quantity_per_user:{
					required: '{{ trans('discounts.validation.required') }}',
					digits: '{{ trans('discounts.validation.digits') }}'
				},
				code:{
					required: '{{ trans('discounts.validation.required') }}',
					remote: jQuery.validator.format('{{ trans('discounts.alert') }}')
				},
				active:{
					required: '{{ trans('discounts.validation.required') }}',
					digits: '{{ trans('discounts.validation.digits') }}'
				},
				from:{
					required: '{{ trans('discounts.validation.required') }}',
					//date: '{{ trans('discounts.validation.date') }}'
				},
				to:{
					required: '{{ trans('discounts.validation.required') }}',
					//date: '{{ trans('discounts.validation.date') }}'
				},
				discount_type_id:{
					required: '{{ trans('discounts.validation.required') }}',
					digits: '{{ trans('discounts.validation.digits') }}'
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
				url:  '{{URL::route('discounts.store')}}',
        		type:'POST'
			};
		$('#form-create-discount').ajaxForm(options);
	});

	// pre-submit callback
		function showRequest(formData, jqForm, options) {
			setTimeout(jQuery.fancybox({
				'content':'<h1>' + '{{ trans('discounts.sending') }}' + '</h1>',
				'autoScale' : true,
				'transitionIn' : 'none',
				'transitionOut' : 'none',
				'scrolling' : 'no',
				'type' : 'inline',
				'showCloseButton' : false,
				'hideOnOverlayClick' : false,
				'hideOnContentClick' : false
			}), 5000 );
			return $('#form-create-discount').valid();
		}

		// post-submit callback
		function showResponse(responseText, statusText, xhr, $form)  {
			if(responseText.success) 
			{
				jQuery.fancybox({
					'content' : '<h1>'+ responseText.message + '</h1>',
					'autoScale' : true
				});
			}else{
				jQuery.fancybox({
					'content' : '<h1>'+ responseText.errors + '</h1>',
					'autoScale' : true
				});
			}
		} 						

</script>
@stop