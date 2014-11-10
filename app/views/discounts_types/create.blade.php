@extends('layouts.template')

@section('title')
{{--{{ Lang::get('modulo.variable') }}--}}
{{ trans('discountType.title') }}
@stop

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>{{ trans('discountType.subtitle') }}</h5>
			</div>
			<div class="ibox-content">
			<div class="row">
				{{ Form::open(['url' => LaravelLocalization::transRoute('discountType.store'),'class'=>'form-horizontal','method' => 'POST','id' => 'formCreateDiscountType']) }}
				<div class="col-sm-6 b-r">
					<div class="form-group">
						{{ Form::label('name',trans('discountType.labels.name'),['class'=>'col-sm-2 control-label']) }}
						<div class="col-sm-8">
							{{ Form::text('name',null, ['class' => 'form-control','id'=>'name']) }}
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<div class="col-sm-4 col-sm-offset-2">
							{{ Form::submit(trans('discountType.labels.save'), ['class' => 'btn btn-primary']) }}
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
	$(document).ready(function () {

		$.validator.addMethod('onlyLettersNumbersAndSpaces', function(value, element) {
         	  return this.optional(element) || /^[a-zA-Z0-9ñÑ\s]+$/i.test(value);
            }, '{{ trans('discountType.validation.onlyLettersNumbersAndSpaces') }}');

		$('#formCreateDiscountType').validate({
			rules:{
				name:{
					required:!0,
					onlyLettersNumbersAndSpaces: true,
					/*remote:
						{
							url:'{{ URL::to('/checkName/') }}',
							type: 'POST',
							data: {
								name: function() {
									return $('#name').val();
								}
							},
							dataFilter: function (respuesta) {
								console.log('consulta:'+respuesta);
								return respuesta;
							}
						} */
				},
			},
			messages:{
				name:{
					required: '{{ trans('discountType.validation.required') }}',
					rangelength: '{{ trans('discountType.validation.rangelength') }}'+'[2, 45]'+'{{ trans('discounts.validation.characters') }}',
					remote: jQuery.validator.format('{{ trans('discountType.alert') }}')
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
				url:  '{{URL::to(LaravelLocalization::transRoute('discountType.store'))}}',
        		type:'POST'
			};
		$('#formCreateDiscountType').ajaxForm(options);

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
			return $('#formCreateDiscountType').valid(); 
		} 
														     
		// post-submit callback 
		function showResponse(responseText, statusText, xhr, $form)  {    
			jQuery.fancybox({
				'content' : '<h1>'+ responseText + '</h1>',
				'autoScale' : true
			});
			$('#formCreateDiscountType').resetForm();
		} 						
</script>
@stop