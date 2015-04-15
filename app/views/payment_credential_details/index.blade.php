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
							{{Form::open(['route' => 'PaymentCredentialDetails.edit', 'class' => 'form-horizontal', 'id' => 'formEditCredential'])}}
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
							console.log(response.credential)
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


		});
	</script>
@stop


