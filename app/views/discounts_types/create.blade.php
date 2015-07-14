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
				{{ Form::open(['url' => LaravelLocalization::transRoute('discountType.routes.store'),'class'=>'form-horizontal','method' => 'POST','id' => 'form-create-discountType']) }}
					@include('discounts_types.partials._form')
				{{ Form::close() }}
			</div>
		</div>
	</div>
</div>
@stop

@section('scripts')
<script>
	$(document).ready(function () {

		$('#form-create-discountType').validate({
			rules:{
				name:{
					required:!0,
					onlyLettersNumbersAndSpaces: true,
					remote:
						{
							url:'{{ URL::to('/checkName/') }}',
							type: 'POST',
							data: {
								name: function() {
									return $('#name').val();
								},
								language_id: function () {
									return $('#language_id').val();
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
				url:  '{{URL::to(LaravelLocalization::transRoute('discountType.routes.store'))}}',
        		type:'POST'
			};
		$('#form-create-discountType').ajaxForm(options);

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
			return $('#form-create-discountType').valid(); 
		} 
														     
		// post-submit callback 
		function showResponse(responseText, statusText, xhr, $form)  {    
			if(responseText.success) 
			{
				jQuery.fancybox({
					'content' : '<h1>'+ responseText.message + '</h1>',
					'autoScale' : true
				});
			}else{
				jQuery.fancybox({
					'content' : '<h1>'+ responseText.errors + '</h1>',
					'autoScale' : true
				});
			}
			$('#form-create-discountType').resetForm();
		} 						
</script>
@stop