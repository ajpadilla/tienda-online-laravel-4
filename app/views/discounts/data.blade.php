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
					@include('flash::message')
				</div>
				<div class="row">
					{{ Form::open(['url' => LaravelLocalization::transRoute('discounts.saveData'),'class'=>'form-horizontal','method' => 'POST','id' => 'formCreateDiscount']) }}
					<div class="col-sm-6 b-r">
						
						<div class="form-group">
							{{ Form::label('code', trans('discounts.labels.code'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::text('code',Session::get('discount_code'), ['class' => 'form-control','id' =>'code','readonly']) }}
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('name', trans('discounts.labels.name'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::text('name',null, ['class' => 'form-control','id'=>'name']) }}
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('description', trans('discounts.labels.description'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::textarea('description',null, ['class' => 'form-control', 'rows' => '3','id'=>'description']) }}
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
		
		$.validator.addMethod('onlyLettersNumbersAndSpaces', function(value, element) {
         	  return this.optional(element) || /^[a-zA-Z0-9ñÑ\s]+$/i.test(value);
       	}, '{{ trans('discounts.validation.onlyLettersNumbersAndSpaces') }}');


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
				url:  '{{URL::to(LaravelLocalization::transRoute('discounts.saveData'))}}',
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
			window.location.href = 	'{{URL::to(LaravelLocalization::transRoute('discounts.createCode'))}}'	
		} 						

</script>
@stop