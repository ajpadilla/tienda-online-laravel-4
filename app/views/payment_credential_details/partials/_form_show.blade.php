<div class="col-lg-7">

	<div class="form-group" style="display: none">
		{{ Form::label('credential_id','id', ['class' => 'col-sm-2 control-label']) }}
		<div class="col-sm-10">
			{{ Form::text('credential_id', null, ['class' => 'form-control', 'placeholder' =>'','id'=> 'credential_id_show']) }}
		</div>
	</div>


	<div class="form-group">
		{{ Form::label('email',  trans('PaymentCredentialDetails.labels.email') , ['class' => 'col-sm-2 control-label']) }}
		<div class="col-sm-10">
			{{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email', 'id' => 'email_show']) }}
		</div>
	</div>
	
	<div class="form-group">
		{{ Form::label('credit_cart_number',  trans('PaymentCredentialDetails.labels.credit_cart_number') , ['class' => 'col-sm-2 control-label']) }}
		<div class="col-sm-10">
			{{ Form::text('credit_cart_number', null, ['class' => 'form-control', 'placeholder' => 'Credit cart number', 'id' => 'credit_cart_number_show']) }}
		</div>
	</div>

	<div class="form-group">
		{{ Form::label('credit_cart_security_number',  trans('PaymentCredentialDetails.labels.credit_cart_security_number') , ['class' => 'col-sm-2 control-label']) }}
		<div class="col-sm-10">
			{{ Form::text('credit_cart_security_number', null, ['class' => 'form-control', 'placeholder' => 'Credit cart security number', 'id' => 'credit_cart_security_number_show']) }}
		</div>
	</div>

	<div class="form-group">
		{{ Form::label('credit_cart_expire_date',  trans('PaymentCredentialDetails.labels.credit_cart_expire_date') , ['class' => 'col-sm-2 control-label']) }}
		<div class="col-sm-10">
			{{ Form::text('credit_cart_expire_date', null, ['class' => 'form-control', 'placeholder' => 'Credit cart expire date', 'id' => 'credit_cart_expire_date_show']) }}
		</div>
	</div>

</div>

<div class="col-lg-7">
	<div class="form-group">
		{{ Form::label('payments_types_id',  trans('PaymentCredentialDetails.labels.payments_types') , ['class' => 'col-sm-2 control-label']) }}
		<div class="col-sm-10">
			{{ Form::text('payments_types_id', null, ['class' => 'form-control', 'placeholder' => 'Credit cart expire date', 'id' => 'payments_types_id_show']) }}
		</div>
	</div>

	<div class="form-group">
		{{ Form::label('card_brands_id',  trans('PaymentCredentialDetails.labels.card_brands') , ['class' => 'col-sm-2 control-label']) }}
		<div class="col-sm-10">
			{{ Form::text('card_brands_id', null, ['class' => 'form-control', 'placeholder' => 'Credit cart expire date', 'id' => 'card_brands_id_show']) }}
		</div>
	</div>
</div>

<div class="clearfix"></div>
