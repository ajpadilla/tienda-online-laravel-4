@extends('layouts.template')

@section('title')
{{--{{ trans('discounts.labels.name')}}--}}
{{	trans('discounts.title') }}
@stop

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>{{	trans('discounts.subtitle') }}</h5>
			</div>
			<div class="ibox-content">
				<div class="row">
					{{ Form::open(['url' => LaravelLocalization::transRoute('discounts.storeCode'),'class'=>'form-horizontal','method' => 'POST','id' => 'formCreateDiscount']) }}
					<div class="col-sm-6 b-r">
						<div class="form-group">
							{{ Form::label('code', trans('discounts.labels.code'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::text('code',null, ['class' => 'form-control','id' =>'code']) }}
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<div class="col-sm-4 col-sm-offset-2">
								{{ Form::submit(trans('discounts.labels.save'), ['class' => 'btn btn-primary']) }}
							</div>
						</div>
					</div>
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
		$('.i-checks').iCheck({
			checkboxClass: 'icheckbox_square-green',
			radioClass: 'iradio_square-green',
		});

		$.validator.addMethod('onlyLettersNumbersAndDash', function(value, element) {
         	  return this.optional(element) || /^[a-zA-Z0-9ñÑ\-]+$/i.test(value);
        }, '{{ trans('discounts.validation.onlyLettersNumbersAndDash') }}');


		$('#formCreateDiscount').validate({

			rules:{
				code:{
					required:!0,
					onlyLettersNumbersAndDash: true,
				},
			},
			messages:{
				code:{
					required: '{{ trans('discounts.validation.required') }}',
				},
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

	});
</script>
@stop