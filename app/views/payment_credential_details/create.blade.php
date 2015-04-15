@extends('layouts.template')

@section('title')
	{{ trans('PaymentCredentialDetails.title') }}
@stop

@section('content')

<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>{{	trans('PaymentCredentialDetails.subtitle') }}</h5>
			</div>
			<div class="ibox-content">
				<div class="row">
					{{Form::open(['route' => 'PaymentCredentialDetails.store', 'class' => 'form-horizontal', 'id' => 'formCreateCredentials'])}}
						@include('payment_credential_details.partials._form')
					{{Form::close()}}
				</div>
			</div>
		</div>
	</div>
</div>
@stop

@section('scripts')
	<script type="text/javascript">
		$(document).ready(function () 
		{

			// Iniciar select chosen
			$('.chosen-select').chosen();

			$.validator.addMethod('onlyLettersNumbersAndSpaces', function(value, element) {
				return this.optional(element) || /^[a-zA-Z0-9ñÑ\s]+$/i.test(value);
			}, '{{ trans('products.validation.onlyLettersNumbersAndSpaces') }}');

			$.validator.addMethod('onlyLettersNumbersAndDash', function(value, element) {
				return this.optional(element) || /^[a-zA-Z0-9ñÑ\-]+$/i.test(value);
			}, '{{ trans('products.validation.onlyLettersNumbersAndDash') }}');

			jQuery.validator.addMethod("decimalNumbers", function(value, element) {
				return this.optional(element) || /^\d{0,20}(\.\d{0,6})?$/i.test(value);
			}, '{{trans('products.validation.maxlength')}}'+[20]+'{{trans('products.validation.length')}}' + '{{trans('products.validation.maxlengthDecimal')}}'+ [6] + '{{trans('products.validation.decimal')}}');

			$('#formCreateCredentials').validate({
				rules:{
					email:{
     					 email: true,
					},
					credit_cart_number:{
					},
				},
				messages:{
					
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
					url:  '{{ URL::route('PaymentCredentialDetails.store') }}',
					type:'POST'
				};
			$('#formCreateCredentials').ajaxForm(options);
		});

			// pre-submit callback
			function showRequest(formData, jqForm, options) {
				setTimeout(jQuery.fancybox({
					'content':'<h1>' + '{{ trans('PaymentCredentialDetails.sending') }}' + '</h1>',
					'autoScale' : true,
					'transitionIn' : 'none',
					'transitionOut' : 'none',
					'scrolling' : 'no',
					'type' : 'inline',
					'showCloseButton' : false,
					'hideOnOverlayClick' : false,
					'hideOnContentClick' : false
				}), 5000 );
				return $('#formCreateCredentials').valid();
			}

			// post-submit callback
			function showResponse(responseText, statusText, xhr, $form)  {

				console.log(responseText);

				jQuery.fancybox({
					'content' : '<h1>'+ responseText + '</h1>',
					'autoScale' : true
				});
			}
			
	</script>
@stop
