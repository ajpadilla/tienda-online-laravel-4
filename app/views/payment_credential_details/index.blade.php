@extends('layouts.template')

@section('title')
	{{ trans('PaymentCredentialDetails.list.title') }}
@stop

@section('content')
@include('layouts.partials._error')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>{{trans('PaymentCredentialDetails.list.subtitle')}}</h5>
			</div>
			@include('flash::message')
			<div class="ibox-content">
				<a class="btn btn-info " href="{{route('PaymentCredentialDetails.create')}}"><i class="fa fa-paste"></i> {{ trans('PaymentCredentialDetails.labels.new') }} </a>
				<?php
					$columns = [
						trans('PaymentCredentialDetails.list.email'),
						trans('PaymentCredentialDetails.list.credit_cart_number'),
						trans('PaymentCredentialDetails.list.credit_cart_expire_date'),
						trans('PaymentCredentialDetails.list.payments_types'),
						trans('PaymentCredentialDetails.list.users'),
						trans('PaymentCredentialDetails.list.card_brands'),
						trans('PaymentCredentialDetails.list.actions'),
				];
				$table = Datatable::table()
				->addColumn($columns)
				->setUrl(route('api.paymentCredentialDetails'))
				->noScript();
				?>
				<div class="row"><br/></div>
				{{ $table->render() }}
			</div>
		</div>
	</div>
</div>
@stop


<div class="row" style="display: none">
	<section id="fancybox-show-credential">
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>{{	trans('products.subtitle') }}</h5>
					</div>
					<div class="ibox-content">
						<div class="row">
							{{Form::open(['route' => 'PaymentCredentialDetails.show', 'class' => 'form-horizontal', 'id' => 'formShowCredential'])}}
								@include('payment_credential_details.partials._form_show')
							{{Form::close()}}
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<div class="row" style="display: none">
	<section id="fancybox-edit-credential">
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>{{	trans('products.subtitle') }}</h5>
					</div>
					<div class="ibox-content">
						<div class="row">
							{{Form::open(['route' => 'PaymentCredentialDetails.update', 'class' => 'form-horizontal', 'id' => 'formEditCredential'])}}
								@include('payment_credential_details.partials._form')
							{{Form::close()}}
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>


@section('scripts')
	{{ $table->script() }}
	<script type="text/javascript">
		$(document).ready(function () 
		{
			// Iniciar select chosen
			$('.chosen-select').chosen({width: "95%"});

			$('#credit_cart_expire_date').datepicker({
				showButtonPanel: true,
				changeMonth: true,
				changeYear: true,
				dateFormat: '{{ trans('PaymentCredentialDetails.date') }}',
			});

			$('.show').fancybox({
				openEffect	: 'elastic',
				closeEffect	: 'elastic',
				centerOnScroll: true,
				hideOnOverlayClick: true,
				beforeLoad: loadData()
			});

			$('.edit').fancybox({
				openEffect	: 'elastic',
				closeEffect	: 'elastic',
				centerOnScroll: true,
				hideOnOverlayClick: true,
				beforeLoad: loadData()
			});

			function loadData() 
			{
				$('.table').click(function(event)
				{
					var target = $( event.target );
					if (target.is('button')) 
					{
						console.log($(target).attr('id'));

						var id = $(target).attr('id');
						var type = id ? id.split('_')[0] : '';
						var numberId = id ? id.split('_')[1] : '';

						if (type == "edit") {
							loadDataToEdit(numberId);
						}else if(type == "show"){
							loadDataToShow(numberId);
						}else{
							deleteData(numberId);
						}
					}			
				});
			}

			function loadDataToShow(credentialId) {
				$.ajax({
					type: 'GET',
					url: '{{ URL::route('PaymentCredentialDetails.getData') }}',	
					data: {'credentialId': credentialId},
					dataType: "JSON",
					success: function(response) {
						if (response.success == true) {
							//console.log(response.credential)
							$('#credential_id_show').val(response.credential.id);
							$('#email_show').val(response.credential.email);
							$('#credit_cart_number_show').val(response.credential.credit_cart_number);
							$('#credit_cart_security_number_show').val(response.credential.credit_cart_security_number);
							$('#credit_cart_expire_date_show').val(response.credential.credit_cart_expire_date);
							$('#payments_types_id_show').val(response.paymentTypes);
							$('#card_brands_id_show').val(response.cardBrand);
							$('.chosen-select').trigger("chosen:updated");
						}
					}
				});
			}

			function loadDataToEdit(credentialId) 
			{
				$.ajax({
					type: 'GET',
					url: '{{ URL::route('PaymentCredentialDetails.getData') }}',	
					data: {'credentialId': credentialId},
					dataType: "JSON",
					success: function(response) {
						if (response.success == true) {
							//console.log(response.credential)
							$('#credential_id').val(response.credential.id);
							$('#email').val(response.credential.email);
							$('#credit_cart_number').val(response.credential.credit_cart_number);
							$('#credit_cart_security_number').val(response.credential.credit_cart_security_number);
							$('#credit_cart_expire_date').val(response.credential.credit_cart_expire_date);
							$('#payments_types_id').val(response.credential.payments_types_id);
							$('#card_brands_id').val(response.credential.card_brands_id);
							$('.chosen-select').trigger("chosen:updated");
						}
					}
				});
			}

			function deleteData(credentialId) {
				$.ajax({
					type: 'GET',
					url: '{{ URL::route('PaymentCredentialDetails.delete-ajax') }}',
					data: {'credentialId': credentialId},
					dataType: "JSON",
					success: function(response) {
						if (response.success == true) {
							$('#delet_'+credentialId).parent().parent().remove();
						};
					}
				});
			}


			$.validator.addMethod('onlyLettersNumbersAndSpaces', function(value, element) {
				return this.optional(element) || /^[a-zA-Z0-9ñÑ\s]+$/i.test(value);
			}, '{{ trans('products.validation.onlyLettersNumbersAndSpaces') }}');

			$.validator.addMethod('onlyLettersNumbersAndDash', function(value, element) {
				return this.optional(element) || /^[a-zA-Z0-9ñÑ\-]+$/i.test(value);
			}, '{{ trans('products.validation.onlyLettersNumbersAndDash') }}');

			jQuery.validator.addMethod("decimalNumbers", function(value, element) {
				return this.optional(element) || /^\d{0,20}(\.\d{0,6})?$/i.test(value);
			}, '{{trans('products.validation.maxlength')}}'+[20]+'{{trans('products.validation.length')}}' + '{{trans('products.validation.maxlengthDecimal')}}'+ [6] + '{{trans('products.validation.decimal')}}');

			$('#formEditCredential').validate({
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
					url:  '{{ URL::route('PaymentCredentialDetails.update') }}',
					type:'POST'
				};
			$('#formEditCredential').ajaxForm(options);
		});

		// pre-submit callback
		function showRequest(formData, jqForm, options) {
			setTimeout($.fancybox({
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
			return $('#formEditCredential').valid();
		}

		// post-submit callback
		function showResponse(responseText, statusText, xhr, $form)  {
			console.log(responseText);
			$.fancybox({
				'content' : '<h1>'+ responseText + '</h1>',
				'autoScale' : true
			});
		}
	</script>
@stop


