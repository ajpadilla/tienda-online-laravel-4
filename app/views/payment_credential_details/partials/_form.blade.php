<div class="col-lg-7">

	<div class="form-group" style="display: none">
		{{ Form::label('credential_id','id', ['class' => 'col-sm-2 control-label']) }}
		<div class="col-sm-10">
			{{ Form::text('credential_id', null, ['class' => 'form-control', 'placeholder' =>'','id'=> 'credential_id']) }}
		</div>
	</div>


	<div class="form-group">
		{{ Form::label('email',  trans('PaymentCredentialDetails.labels.email') , ['class' => 'col-sm-2 control-label']) }}
		<div class="col-sm-10">
			{{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email', 'id' => 'email']) }}
		</div>
	</div>
	
	<div class="form-group">
		{{ Form::label('credit_cart_number',  trans('PaymentCredentialDetails.labels.credit_cart_number') , ['class' => 'col-sm-2 control-label']) }}
		<div class="col-sm-10">
			{{ Form::text('credit_cart_number', null, ['class' => 'form-control', 'placeholder' => 'Credit cart number', 'id' => 'credit_cart_number']) }}
		</div>
	</div>

	<div class="form-group">
		{{ Form::label('credit_cart_security_number',  trans('PaymentCredentialDetails.labels.credit_cart_security_number') , ['class' => 'col-sm-2 control-label']) }}
		<div class="col-sm-10">
			{{ Form::text('credit_cart_security_number', null, ['class' => 'form-control', 'placeholder' => 'Credit cart security number', 'id' => 'credit_cart_security_number']) }}
		</div>
	</div>

	<div class="form-group">
		{{ Form::label('credit_cart_expire_date',  trans('PaymentCredentialDetails.labels.credit_cart_expire_date') , ['class' => 'col-sm-2 control-label']) }}
		<div class="col-sm-10">
			{{ Form::text('credit_cart_expire_date', null, ['class' => 'form-control', 'placeholder' => 'Credit cart expire date', 'id' => 'credit_cart_expire_date']) }}
		</div>
	</div>

</div>

<div class="col-lg-7">
	<div class="form-group">
		{{ Form::label('payments_types_id', trans('PaymentCredentialDetails.labels.payments_types'), ['class' => 'col-sm-2 control-label']) }}
		<div class="col-sm-10">
			{{
				Form::select('payments_types_id', $paymentsTypes, null,
				['class' => 'chosen-select form-control','data-placeholder' => 'Payments Types', 'id' =>'payments_types_id'])
			}}
		</div>
	</div>

	<div class="form-group">
		{{ Form::label('card_brands_id', trans('PaymentCredentialDetails.labels.card_brands'), ['class' => 'col-sm-2 control-label']) }}
		<div class="col-sm-10">
			{{
				Form::select('card_brands_id', $cardBrands, null,
				['class' => 'chosen-select form-control', 'data-placeholder' => 'Card brands...', 'id' => 'card_brands_id'])
			}}
		</div>
	</div>
</div>

<div class="col-lg-6 col-lg-offset-2">
	<div class="form-group">
		<div class="col-sm-3">
			<button type="submit" class="pull-right btn btn-primary" name="save" value="0">{{ trans('PaymentCredentialDetails.labels.save') }}</button>
		</div>
	</div>
</div>

<div class="clearfix"></div>