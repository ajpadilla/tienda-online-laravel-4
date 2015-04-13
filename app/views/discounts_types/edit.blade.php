@extends('layouts.template')

@section('title')
{{--{{ Lang::get('modulo.variable') }}--}}
{{ trans('discountType.edit_view.title') }}
@stop

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>{{ trans('discountType.edit_view.subtitle') }}</h5>
			</div>
			<div class="ibox-content">
				<div class="row">
					{{ Form::model($discount_type, array('route' => array('discountType.update', $discount_type->id),'id'=>'formEditDiscountType','class'=>'form-horizontal')) }}
					<div class="col-sm-6 b-r">
						<div class="form-group">
							{{ Form::label('language_id', trans('discountType.labels.language'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-8">
								{{ Form::select('language_id',$languages,$discount_type_language->id,array('class' => 'form-control','id'=>'language_id')) }}
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('name',trans('discountType.labels.name'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-8">
								{{ Form::text('name',$discount_type_language->pivot->name, ['class' => 'form-control','id'=>'name']) }}
							</div>
						</div>

						<div class="form-group">
						{{ Form::text('discount_type_id',$discount_type->id, ['class' => 'form-control','id'=>'discount_type_id','style'=>'display: none;']) }}
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

		$('#formEditDiscountType').validate({
			rules:{
				name:{
					required:!0,
					onlyLettersNumbersAndSpaces: true,
					remote:
						{
							url:'{{ URL::to('/checkNameForEditDiscountType/') }}',
							type: 'POST',
							data: {
								name: function() {
									return $('#name').val();
								},
								
								language_id: function () {
									return $('#language_id').val();
								},

								discount_type_id: function () {
									return $('#discount_type_id').val();
								}
							},
							dataFilter: function (respuesta) {
								console.log('consulta:'+respuesta);
								return respuesta;
							}
						}
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
				url:  '{{ URL::route('discountType.update',$discount_type->id) }}',
        		type:'POST'
			};
		$('#formEditDiscountType').ajaxForm(options);

	});

	// pre-submit callback 
		function showRequest(formData, jqForm, options) {          
			setTimeout(jQuery.fancybox({
				'content':'<h1>' + '{{ trans('discountType.sending') }}' + '</h1>',
				'autoScale' : true,
				'transitionIn' : 'none',
				'transitionOut' : 'none',
				'scrolling' : 'no',         
				'type' : 'inline',
				'showCloseButton' : false,
				'hideOnOverlayClick' : false,
				'hideOnContentClick' : false    
			}), 5000 );  
			return $('#formEditDiscountType').valid(); 
		} 
														     
		// post-submit callback 
		function showResponse(responseText, statusText, xhr, $form)  {    
			jQuery.fancybox({
				'content' : '<h1>'+ responseText + '</h1>',
				'autoScale' : true
			});
			//$('#formEditDiscountType').resetForm();
		} 						
</script>
@stop