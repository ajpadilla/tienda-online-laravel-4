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

@section('scripts')
	{{ $table->script() }}
@stop


