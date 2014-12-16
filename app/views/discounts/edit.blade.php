@extends('layouts.template')

@section('title')
{{--{{ trans('discounts.labels.name')}}--}}
{{	trans('discounts.edit_view.title') }}
@stop

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>{{	trans('discounts.edit_view.subtitle') }}</h5>
			</div>
			<div class="ibox-content">
				<div class="row">
					{{ Form::model($discount, array('route' => array('discounts.update', $discount->id),'id'=>'formCreateDiscount','class'=>'form-horizontal')) }}
					<div class="col-sm-6 b-r">
						<div class="form-group">
							{{ Form::label('language_id', trans('discounts.labels.language'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::select('language_id',$languages,$discount_language->id,array('class' => 'form-control','id'=>'language_id')) }}
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('code', trans('discounts.labels.code'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::text('code',$discount->code, ['class' => 'form-control','id' =>'code',
								'']) }}
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('name', trans('discounts.labels.name'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::text('name',$discount_language->pivot->name, ['class' => 'form-control','']) }}
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('description', trans('discounts.labels.description'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::textarea('description',$discount_language->pivot->description, ['class' => 'form-control', 'rows' => '3','']) }}
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('value',  trans('discounts.labels.value'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::text('value',$discount->value, ['class' => 'form-control','']) }}
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('percent', trans('discounts.labels.percent'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::text('percent',$discount->percent, ['class' => 'form-control','']) }}
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('quantity', trans('discounts.labels.quantity'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::text('quantity',$discount->quantity, ['class' => 'form-control','']) }}
							</div>
						</div>
					</div>

					<div class="col-sm-6">
						<div class="form-group">
							{{ Form::label('quantity_per_user', trans('discounts.labels.quantity_per_user'),['class'=>'col-sm-4 control-label']) }}
							<div class="col-sm-6 ">
								{{ Form::text('quantity_per_user',$discount->quantity_per_user, ['class' => 'form-control','']) }}
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('active', trans('discounts.labels.active'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::select('active',array('1'=>'Si','2'=>'No'),$discount->active,array('class' => 'form-control','')) }}
							</div>
						</div>

						<div class="form-group">
							{{ Form::label('from', trans('discounts.labels.from'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::text('from',date($language->date_format ,strtotime($discount->from)), ['class' => 'form-control','']) }}
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('to', trans('discounts.labels.to'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::text('to',date($language->date_format ,strtotime($discount->to)), ['class' => 'form-control','']) }}
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('discount_type_id', trans('discounts.labels.discount_type'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::select('discount_type_id',$discountTypes,$discount->discountType->id,array('class' => 'form-control')) }}
							</div>
						</div>
						<div class="form-group">
								{{ Form::text('discount_id',$discount->id,['class' => 'form-control','id'=>'discount_id','style'=>'display: none;']) }}
							</div>
						</div>
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

		$('#from').datepicker({
			showButtonPanel: true,
			changeMonth: true,
			changeYear: true,
			yearRange: '2014:2030',
			dateFormat: '{{ trans('discounts.date') }}',
		});

		$('#to').datepicker({
			showButtonPanel: true,
			changeMonth: true,
			changeYear: true,
			dateFormat: '{{ trans('discounts.date') }}',
		});

		$.validator.addMethod('onlyLettersNumbersAndSpaces', function(value, element) {
         	  return this.optional(element) || /^[a-zA-Z0-9ñÑ\s]+$/i.test(value);
       	}, '{{ trans('discounts.validation.onlyLettersNumbersAndSpaces') }}');

		$.validator.addMethod('onlyLettersNumbersAndDash', function(value, element) {
         	  return this.optional(element) || /^[a-zA-Z0-9ñÑ\-]+$/i.test(value);
        }, '{{ trans('discounts.validation.onlyLettersNumbersAndDash') }}');

		jQuery.validator.addMethod('customDateValidator', function(value, element) {
        	// parseDate throws exception if the value is invalid
       	 	try{
       	 		jQuery.datepicker.parseDate( '{{ trans('discounts.date') }}' , value);return true;}
        	catch(e){return false;}
    	},'{{ trans('discounts.validation.date') }}');

		$('#formCreateDiscount').validate({

			rules:{
				name:{
					required:!0,
					rangelength: [2, 255],
					onlyLettersNumbersAndSpaces: true
				},
				description:{
					required:!0,
					rangelength: [10, 255]
				},
				value:{
					required:!0,
					number: true
				},
				percent:{
					required:!0,
					number: true
				},
				quantity:{
					required:!0,
					digits: true
				},
				quantity_per_user:{
					required:!0,
					digits: true
				},
				code:{
					required:!0,
					onlyLettersNumbersAndDash: true,
						remote:
						{
							url:'{{ URL::to('/checkCodeForEdit/') }}',
							type: 'POST',
							data: {
								code: function() {
									return $('#code').val();
								},
								discount_id: function() {
									return $('#discount_id').val();
								}
							},
							dataFilter: function (respuesta) {
								console.log('consulta:'+respuesta);
								return respuesta;
							}
						} 
				},
				active:{
					required:!0,
					digits: true
				},
				from:{
					required:!0,
					customDateValidator: true
				},
				to:{
					required:!0,
					customDateValidator: true
				},
				discount_type_id:{
					required:!0,
					digits: true
				}
			},
			messages:{
				name:{
					required: '{{ trans('discounts.validation.required') }}',
					rangelength: '{{ trans('discounts.validation.rangelength') }}'+'[2, 255]'+'{{ trans('discounts.validation.characters') }}',
				},
				description:{
					required: '{{ trans('discounts.validation.required') }}',
					rangelength: '{{ trans('discounts.validation.rangelength') }}'+'[10, 255]'+'{{ trans('discounts.validation.characters') }}',
				},
				value:{
					required: '{{ trans('discounts.validation.required') }}',
					number: '{{ trans('discounts.validation.number') }}'
				},
				percent:{
					required: '{{ trans('discounts.validation.required') }}',
					number: '{{ trans('discounts.validation.number') }}'
				},
				quantity:{
					required: '{{ trans('discounts.validation.required') }}',
					digits: '{{ trans('discounts.validation.digits') }}'
				},
				quantity_per_user:{
					required: '{{ trans('discounts.validation.required') }}',
					digits: '{{ trans('discounts.validation.digits') }}'
				},
				code:{
					required: '{{ trans('discounts.validation.required') }}',
					remote: jQuery.validator.format('{{ trans('discounts.alert') }}')
				},
				active:{
					required: '{{ trans('discounts.validation.required') }}',
					digits: '{{ trans('discounts.validation.digits') }}'
				},
				from:{
					required: '{{ trans('discounts.validation.required') }}',
					//date: '{{ trans('discounts.validation.date') }}'
				},
				to:{
					required: '{{ trans('discounts.validation.required') }}',
					//date: '{{ trans('discounts.validation.date') }}'
				},
				discount_type_id:{
					required: '{{ trans('discounts.validation.required') }}',
					digits: '{{ trans('discounts.validation.digits') }}'
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
				url:  '{{ URL::route('discounts.update',$discount->id) }}',
        		type:'POST'
			};
		$('#formCreateDiscount').ajaxForm(options);
	});

	// pre-submit callback
		function showRequest(formData, jqForm, options) {
			setTimeout(jQuery.fancybox({
				'content':'<h1>' + '{{ trans('discounts.sending') }}' + '</h1>',
				'autoScale' : true,
				'transitionIn' : 'none',
				'transitionOut' : 'none',
				'scrolling' : 'no',
				'type' : 'inline',
				'showCloseButton' : false,
				'hideOnOverlayClick' : false,
				'hideOnContentClick' : false
			}), 5000 );
			return $('#formCreateDiscount').valid();
		}

		// post-submit callback
		function showResponse(responseText, statusText, xhr, $form)  {
			jQuery.fancybox({
				'content' : '<h1>'+ responseText + '</h1>',
				'autoScale' : true
			});
		} 						

</script>
@stop