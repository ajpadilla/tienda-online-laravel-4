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
				{{ Form::open(['url' => LaravelLocalization::transRoute('discounts.store'),'class'=>'form-horizontal','method' => 'POST','id' => 'formCreateDiscount']) }}
				<div class="form-group">
					{{ Form::label('code', trans('discounts.labels.code'),['class'=>'col-sm-2 control-label']) }}
					<div class="col-sm-8">
						{{ Form::text('code',null, ['class' => 'form-control']) }}
					</div>
				</div>
				<div class="hr-line-dashed"></div>
				<div class="form-group">
					{{ Form::label('name', trans('discounts.labels.name'),['class'=>'col-sm-2 control-label']) }}
					<div class="col-sm-8">
						{{ Form::text('name',null, ['class' => 'form-control']) }}
					</div>
				</div>
				<div class="hr-line-dashed"></div>
				<div class="form-group">
					{{ Form::label('description', trans('discounts.labels.description'),['class'=>'col-sm-2 control-label']) }}
					<div class="col-sm-8">
						{{ Form::textarea('description',null, ['class' => 'form-control', 'rows' => '3']) }}
					</div>
				</div>
				<div class="hr-line-dashed"></div>
				<div class="form-group">
					{{ Form::label('value',  trans('discounts.labels.value'),['class'=>'col-sm-2 control-label']) }}
					<div class="col-sm-8">
						{{ Form::text('value',null, ['class' => 'form-control']) }}
					</div>
				</div>
				<div class="hr-line-dashed"></div>
				<div class="form-group">
					{{ Form::label('percent', trans('discounts.labels.percent'),['class'=>'col-sm-2 control-label']) }}
					<div class="col-sm-8">
						{{ Form::text('percent',null, ['class' => 'form-control']) }}
					</div>
				</div>
				<div class="form-group">
					{{ Form::label('quantity', trans('discounts.labels.quantity'),['class'=>'col-sm-2 control-label']) }}
					<div class="col-sm-8">
						{{ Form::text('quantity',null, ['class' => 'form-control']) }}
					</div>
				</div>
				<div class="hr-line-dashed"></div>
				<div class="form-group">
					{{ Form::label('quantity_per_user', trans('discounts.labels.quantity_per_user'),['class'=>'col-sm-2 control-label']) }}
					<div class="col-sm-8">
						{{ Form::text('quantity_per_user',null, ['class' => 'form-control']) }}
					</div>
				</div>
				<div class="hr-line-dashed"></div>
				<div class="form-group">
					{{ Form::label('active', trans('discounts.labels.active'),['class'=>'col-sm-2 control-label']) }}
					<div class="col-sm-10">
						<div class="radio i-checks">
							<label> 
								<!--<input type="radio" value="option1" name="a">-->
								{{ Form::radio('active', '1', 1)}}
								<i></i> Yes
							</label>
						</div>
						<div class="radio i-checks">
							<label> 
								<!--<input type="radio" value="option1" name="a">--> 
								{{ Form::radio('active', '0', 0)}}
								<i></i> No
							</label>
						</div>
					</div>
				</div>
				<div class="hr-line-dashed"></div>
				<div class="form-group">
					{{ Form::label('from', trans('discounts.labels.from'),['class'=>'col-sm-2 control-label']) }}
					<div class="col-sm-8">
						{{ Form::text('from',null, ['class' => 'form-control','id'=>'from']) }}
					</div>
				</div>
				<div class="hr-line-dashed"></div>
				<div class="form-group">
					{{ Form::label('to', trans('discounts.labels.to'),['class'=>'col-sm-2 control-label']) }}
					<div class="col-sm-8">
						{{ Form::text('to',null, ['class' => 'form-control','id'=>'to']) }}
					</div>
				</div>
				<div class="form-group">
					{{ Form::label('discount_type_id', trans('discounts.labels.discount_type'),['class'=>'col-sm-2 control-label']) }}
					<div class="col-sm-8">
						{{ Form::select('discount_type_id',$discountTypes,null,array('class' => 'form-control')) }}
					</div>
				</div>
				<div class="hr-line-dashed"></div>
				<div class="form-group">
					<div class="col-sm-4 col-sm-offset-2">
						{{ Form::submit(trans('discounts.labels.save'), ['class' => 'btn btn-primary']) }}
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
	$(document).ready(function () {
		$('.i-checks').iCheck({
			checkboxClass: 'icheckbox_square-green',
			radioClass: 'iradio_square-green',
		});

		$('#from').datepicker({
			showButtonPanel: true,
			changeMonth: true,
			changeYear: true,
			yearRange: '2014:2030',
			dateFormat: 'yy-mm-dd'
		});

		$('#to').datepicker({
			showButtonPanel: true,
			changeMonth: true,
			changeYear: true,
			yearRange: '2014:2030', 
			dateFormat: 'yy-mm-dd'
		});

		$.validator.addMethod('onlyLettersNumbersAndSpaces', function(value, element) {
         	  return this.optional(element) || /^[a-zA-Z0-9ñÑ\s]+$/i.test(value);
            }, '{{ trans('discounts.validation.onlyLettersNumbersAndSpaces') }}');

		$.validator.addMethod('onlyLettersNumbersAndDash', function(value, element) {
         	  return this.optional(element) || /^[a-zA-Z0-9ñÑ\-]+$/i.test(value);
            }, '{{ trans('discounts.validation.onlyLettersNumbersAndDash') }}');

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
					onlyLettersNumbersAndDash: true
				},
				active:{
					required:!0,
					digits: true
				},
				from:{
					required:!0,
					date: true
				},
				to:{
					required:!0,
					date: true
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
				},
				active:{
					required: '{{ trans('discounts.validation.required') }}',
					digits: '{{ trans('discounts.validation.digits') }}'
				},
				from:{
					required: '{{ trans('discounts.validation.required') }}',
					date: '{{ trans('discounts.validation.date') }}'
				},
				to:{
					required: '{{ trans('discounts.validation.required') }}',
					date: '{{ trans('discounts.validation.date') }}'
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
				url:  '{{URL::to(LaravelLocalization::transRoute('discounts.store'))}}',
        		type:'POST'
			};
		$('#formCreateDiscount').ajaxForm(options);
	});

	// pre-submit callback 
		function showRequest(formData, jqForm, options) {          
			setTimeout(jQuery.fancybox({
				'content': '<h1>Enviando datos</h1>',
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