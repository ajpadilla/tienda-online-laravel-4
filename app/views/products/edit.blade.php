@extends('layouts.template')

@section('title')
	{{	trans('products.show_data.title') }}
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
					{{Form::open(['route' => 'products.update', 'class' => 'form-horizontal', 'id' => 'formUpdateProduct'])}}
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

			 $('select[name="color"]').simplecolorpicker({picker: true, theme: 'glyphicons'});

			$.validator.addMethod('onlyLettersNumbersAndSpaces', function(value, element) {
				return this.optional(element) || /^[a-zA-Z0-9ñÑ\s]+$/i.test(value);
			}, 'only letters, numbers and spaces.');

			$('#formUpdateProduct').validate({
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
					available_for_order:{
						required:true,
						digits: true
					},
					show_price:{
						required:true,
						digits: true
					},
					accept_barter:{
						required:true,
						digits: true
					},
					product_for_barter:{
						required:true,
						digits: true
					},
					'categories[]':{
						required:true
					},
					condition_id:{
						required:true
					},
					color:{
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
					url:  '{{URL::route('products.update')}}',
					type:'POST'
				};
			$('#formUpdateProduct').ajaxForm(options);

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
				return $('#formUpdateProduct').valid();
			}

			// post-submit callback
			function showResponse(responseText, statusText, xhr, $form)  {
				console.log(responseText);

				jQuery.fancybox({
					'content' : '<h1>'+ responseText.message + '</h1>',
					'autoScale' : true
				});

				if(responseText.add_photos == 1)
					document.location.href = responseText.url;			}
		});
	</script>
@stop
