@extends('layouts.template')

@section('title')
{{--{{ trans('shipmentStatus.labels.name')}}--}}
{{	trans('shipmentStatus.title') }}
@stop

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>{{	trans('shipmentStatus.subtitle') }}</h5>
			</div>
			<div class="ibox-content">
				<div class="row">
					{{ Form::open(['url' => LaravelLocalization::transRoute('shipmentStatus.routes.store'),'class'=>'form-horizontal','method' => 'POST','id' => 'form-create-shipment-status']) }}
						@include('shipment_status.partials._form')
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

		$('#form-create-shipment-status').validate({
			rules:{
				name:{
					required:!0,
					rangelength: [2, 255],
					onlyLettersNumbersAndSpaces: true,
					remote:
					{
						url:'{{ URL::to('/checkNameShipmentStatus/') }}',
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
							console.log('consulta:'+respuesta);
							return respuesta;
						}
					}
				},
				description:{
					required:!0,
					rangelength: [10, 255]
				},
				color:{
					required:!0,
				}
			},
			messages:{
				name:{
					required: '{{ trans('shipmentStatus.validation.required') }}',
					rangelength: '{{ trans('shipmentStatus.validation.rangelength') }}'+'[2, 255]'+'{{ trans('shipmentStatus.validation.characters') }}',
					remote: jQuery.validator.format('{{ trans('shipmentStatus.alert') }}')
				},
				description:{
					required: '{{ trans('shipmentStatus.validation.required') }}',
					rangelength: '{{ trans('shipmentStatus.validation.rangelength') }}'+'[10, 255]'+'{{ trans('shipmentStatus.validation.characters') }}',
				},
				color:{
					required: '{{ trans('shipmentStatus.validation.required') }}',
					remote: jQuery.validator.format('{{ trans('shipmentStatus.alertColor') }}')
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
				url:  '{{ URL::route('shipmentStatus.store') }}',
        		type:'POST'
			};
		$('#form-create-shipment-status').ajaxForm(options);
	});

	// pre-submit callback
		function showRequest(formData, jqForm, options) {
			setTimeout(jQuery.fancybox({
				'content': '<h1>' + '{{ trans('shipmentStatus.sending') }}' + '</h1>',
				'autoScale' : true,
				'transitionIn' : 'none',
				'transitionOut' : 'none',
				'scrolling' : 'no',
				'type' : 'inline',
				'showCloseButton' : false,
				'hideOnOverlayClick' : false,
				'hideOnContentClick' : false
			}), 5000 );
			return $('#form-create-shipment-status').valid();
		}

		// post-submit callback 
		function showResponse(responseText, statusText, xhr, $form)  {    
			if(responseText.success) 
			{
				jQuery.fancybox({
					'content' : '<h1>'+ responseText.message + '</h1>',
					'autoScale' : true
				});
				$('#form-create-shipment-status').resetForm();
				$('.summernote').code('');
			}else{
				jQuery.fancybox({
					'content' : '<h1>'+ responseText.errors + '</h1>',
					'autoScale' : true
				});
			}
		} 					
</script>
@stop