@extends('layouts.template')

@section('title')
	{{ trans('products.title') }}
@stop

@section('content')

<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>{{	trans('products.subtitle') }}</h5>
			</div>
			<div class="ibox-content">
				<div class="row">
					{{Form::open(['route' => 'products.store', 'class' => 'form-horizontal', 'id' => 'formCreateProduct'])}}
						@include('products.partials._form')
					{{Form::close()}}
				</div>
			</div>
		</div>
	</div>
</div>
@stop

@section('scripts')
	<script type="text/javascript">
		$(document).ready(function () {
			// Iniciar checks
			$('.i-checks').iCheck({
				checkboxClass: 'icheckbox_square-green',
				radioClass: 'iradio_square-green',
			});

			// Iniciar select chosen
			$('.chosen-select').chosen();

			 $('#description').summernote();

			$.validator.addMethod('onlyLettersNumbersAndSpaces', function(value, element) {
				return this.optional(element) || /^[a-zA-Z0-9ñÑ\s]+$/i.test(value);
			}, '{{ trans('products.validation.onlyLettersNumbersAndSpaces') }}');

			$.validator.addMethod('onlyLettersNumbersAndDash', function(value, element) {
				return this.optional(element) || /^[a-zA-Z0-9ñÑ\-]+$/i.test(value);
			}, '{{ trans('products.validation.onlyLettersNumbersAndDash') }}');

			$('#formCreateProduct').validate({
				rules:{
					name:{
						required:true,
						rangelength: [2, 64],
						onlyLettersNumbersAndSpaces: true
					},
					description:{
						required:true,
						rangelength: [10, 255]
					},
					quantity:{
						required:true,
						digits: true
					},
					price:{
						required:true,
						number: true
					},
					width:{
						required:true,
						number: true
					},
					height:{
						required:true,
						number: true
					},
					depth:{
						required:true,
						number:true
					},
					weight:{
						required:true,
						number:true
					},
					on_sale:{
						required:true,
						digits: true
					},
					active:{
						required:true,
						digits: true
					},
					point_price:{
						required:true,
						digits: true
					},
					accept_barter:{
						required:true,
						digits: true
					},
					'categories[]':{
						required:true
					},
					condition_id:{
						required:true
					}
				},
				messages:{
					name:{
						required: '{{ trans('products.validation.required') }}',
						rangelength: '{{ trans('products.validation.rangelength') }}'+'[2, 64]'+'{{ trans('products.validation.characters') }}'
					},
					description:{
						required: '{{ trans('products.validation.required') }}',
							rangelength: '{{ trans('products.validation.rangelength') }}'+'[10, 255]'+'{{ trans('products.validation.characters') }}'
					},
					quantity:{
						required: '{{ trans('products.validation.required') }}',
						digits: '{{ trans('products.validation.digits') }}'
					},
					price:{
						required: '{{ trans('products.validation.required') }}',
						number: '{{ trans('products.validation.number') }}'
					},
					width:{
						required: '{{ trans('products.validation.required') }}',
						number: '{{ trans('products.validation.number') }}'
					},
					height:{
						required: '{{ trans('products.validation.required') }}',
						number: '{{ trans('products.validation.number') }}'
					},
					depth:{
						required: '{{ trans('products.validation.required') }}',
						number: '{{ trans('products.validation.number') }}'
					},
					weight:{
						required: '{{ trans('products.validation.required') }}',
						number: '{{ trans('products.validation.number') }}'
					},
					on_sale:{
						required: '{{ trans('products.validation.required') }}',
						digits: '{{ trans('products.validation.digits') }}'
					},
					active:{
						required: '{{ trans('products.validation.required') }}',
						digits: '{{ trans('products.validation.digits') }}'
					},
					point_price:{
						required: '{{ trans('products.validation.required') }}',
						digits: '{{ trans('products.validation.digits') }}'
					},
					accept_barter:{
						required: '{{ trans('products.validation.required') }}',
						digits: '{{ trans('products.validation.digits') }}'
					},
					'categories[]':{
						required: '{{ trans('products.validation.required') }}',
					},
					condition_id:{
						required: '{{ trans('products.validation.required') }}',
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
					url:  '{{ URL::route('products.store') }}',
					type:'POST'
				};
			$('#formCreateProduct').ajaxForm(options);

			// pre-submit callback
			function showRequest(formData, jqForm, options) {
				setTimeout(jQuery.fancybox({
					'content':'<h1>' + '{{ trans('products.sending') }}' + '</h1>',
					'autoScale' : true,
					'transitionIn' : 'none',
					'transitionOut' : 'none',
					'scrolling' : 'no',
					'type' : 'inline',
					'showCloseButton' : false,
					'hideOnOverlayClick' : false,
					'hideOnContentClick' : false
				}), 5000 );
				return $('#formCreateProduct').valid();
			}

			// post-submit callback
			function showResponse(responseText, statusText, xhr, $form)  {
				jQuery.fancybox({
					'content' : '<h1>'+ responseText.message + '</h1>',
					'autoScale' : true
				});

				if(responseText.add_photos == 1)
					document.location.href = '{{ URL::route('photoProduct.create') }}';
			}
		});
	</script>
@stop
