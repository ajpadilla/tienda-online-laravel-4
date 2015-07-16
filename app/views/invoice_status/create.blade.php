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
					{{ Form::open(['url' => LaravelLocalization::transRoute('invoiceStatus.store'),'class'=>'form-horizontal','method' => 'POST','id' => 'form-crate-invoice-status']) }}
						@include('invoice_status.partials._form')
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

		$('#form-crate-invoice-status').validate({
			rules:{
				name:{
					required:!0,
					rangelength: [2, 255],
					onlyLettersNumbersAndSpaces: true,
					remote:
					{
						url:'{{ URL::to('/checkNameInvoiceStatus/') }}',
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
				color:{
					required:!0,
					 /*remote:
						{
							url:'{{ URL::to('/checkColorinvoiceStatus/') }}',
							type: 'POST',
							data: {
								color: function() {
									return $('#color').val();
								}
							},
							dataFilter: function (respuesta) {
								console.log('consulta:'+respuesta);
								return respuesta;
							}
						} */
				}
			},
			messages:{
				name:{
					required: '{{ trans('invoiceStatus.validation.required') }}',
					rangelength: '{{ trans('invoiceStatus.validation.rangelength') }}'+'[2, 255]'+'{{ trans('invoiceStatus.validation.characters') }}',
					remote: jQuery.validator.format('{{ trans('invoiceStatus.alert') }}')
				},
				description:{
					required: '{{ trans('invoiceStatus.validation.required') }}',
					rangelength: '{{ trans('invoiceStatus.validation.rangelength') }}'+'[10, 255]'+'{{ trans('invoiceStatus.validation.characters') }}',
				},
				color:{
					required: '{{ trans('invoiceStatus.validation.required') }}',
					remote: jQuery.validator.format('{{ trans('invoiceStatus.alertColor') }}')
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
				url:  '{{ URL::route('invoiceStatus.store') }}',
        		type:'POST'
			};
		$('#form-crate-invoice-status').ajaxForm(options);
	});

	// pre-submit callback
		function showRequest(formData, jqForm, options) {
			setTimeout(jQuery.fancybox({
				'content': '<h1>'+'"{{ trans('invoiceStatus.sending') }}"'+'</h1>',
				'autoScale' : true,
				'transitionIn' : 'none',
				'transitionOut' : 'none',
				'scrolling' : 'no',
				'type' : 'inline',
				'showCloseButton' : false,
				'hideOnOverlayClick' : false,
				'hideOnContentClick' : false
			}), 5000 );
			return $('#form-crate-invoice-status').valid();
		}

		// post-submit callback
		function showResponse(responseText, statusText, xhr, $form)  {
			if(responseText.success) 
			{
				jQuery.fancybox({
					'content' : '<h1>'+ responseText.message + '</h1>',
					'autoScale' : true
				});
				$('#form-crate-invoice-status').resetForm();
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