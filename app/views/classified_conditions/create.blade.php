@extends('layouts.template')

@section('title')
{{--{{ trans('classifiedConditions.labels.name')}}--}}
{{	trans('classifiedConditions.title') }}
@stop

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>{{	trans('classifiedConditions.subtitle') }}</h5>
			</div>
			<div class="ibox-content">
				<div class="row">
					{{ Form::open(['url' => LaravelLocalization::transRoute('classifiedConditions.store'),'class'=>'form-horizontal','method' => 'POST','id' => 'form-crate-classified-conditions']) }}
						@include('classified_conditions.partials._form')
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
		$('#form-crate-classified-conditions').validate({
			rules:{
				name:{
					required:!0,
					rangelength: [2, 255],
					onlyLettersNumbersAndSpaces: true,
					remote:
					{
						url:'{{ URL::to('/verificateNameClassifiedCondition/') }}',
						type: 'POST',
						data: {
							language_id: function() {
								return $('#language_id').val();
							},
							name: function() {
								return $('#name').val();
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
					required: '{{ trans('classifiedConditions.validation.required') }}',
					rangelength: '{{ trans('classifiedConditions.validation.rangelength') }}'+'[2, 255]'+'{{ trans('classifiedConditions.validation.characters') }}',
					remote: jQuery.validator.format('{{ trans('classifiedConditions.alert') }}')
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
				url:  '{{ URL::route('classifiedConditions.store') }}',
        		type:'POST'
			};
		$('#form-crate-classified-conditions').ajaxForm(options);
	});

	// pre-submit callback
	function showRequest(formData, jqForm, options) {
		setTimeout(jQuery.fancybox({
			'content': '<h1>'+'{{ trans('classifiedConditions.sending') }}'+'</h1>',
			'autoScale' : true,
			'transitionIn' : 'none',
			'transitionOut' : 'none',
			'scrolling' : 'no',
			'type' : 'inline',
			'showCloseButton' : false,
			'hideOnOverlayClick' : false,
			'hideOnContentClick' : false
		}), 5000 );
		return $('#form-crate-classified-conditions').valid();
	}

	// post-submit callback
	function showResponse(responseText, statusText, xhr, $form)  {
		if(responseText.success) 
		{
			jQuery.fancybox({
				'content' : '<h1>'+ responseText.message + '</h1>',
				'autoScale' : true
			});
			$('#form-crate-classified-types').resetForm();
			$('.summernote').code('');
		}else{
			jQuery.fancybox({
				'content' : '<h1>'+ responseText.errors + '</h1>',
				'autoScale' : true
			});
		}
	} 						
</script>
@stop