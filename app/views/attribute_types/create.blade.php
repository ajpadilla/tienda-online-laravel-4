@extends('layouts.template')

@section('title')
{{--{{ trans('attributeType.labels.name')}}--}}
{{	trans('attributeType.title') }}
@stop

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>{{	trans('attributeType.subtitle') }}</h5>
			</div>
			<div class="ibox-content">
				<div class="row">
					{{ Form::open(['url' => LaravelLocalization::transRoute('attributeType.store'),'class'=>'form-horizontal','method' => 'POST','id' => 'formAttributeType']) }}
					<div class="col-sm-6 b-r">
						<div class="form-group">
							{{ Form::label('language_id', trans('attributeType.labels.language'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::select('language_id',$languages,null,array('class' => 'form-control','id'=>'language_id')) }}
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('name', trans('attributeType.labels.name'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::text('name',null, ['class' => 'form-control', 'id' => 'name']) }}
							</div>
						</div>
					</div>
					
					<div class="col-sm-6">
						<div class="form-group">
							<div class="col-sm-4 col-sm-offset-2">
								{{ Form::submit(trans('attributeType.labels.save'), ['class' => 'btn btn-primary']) }}
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
       	}, '{{ trans('attributeType.validation.onlyLettersNumbersAndSpaces') }}');

		$('#formAttributeType').validate({

			rules:{
				name:{
					required:!0,
					rangelength: [2, 255],
					onlyLettersNumbersAndSpaces: true,
					/*remote:
					{
						url:'{{ URL::to('/checkNameClassifiedType/') }}',
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
					}*/
				},
			},
			messages:{
				name:{
					required: '{{ trans('attributeType.validation.required') }}',
					rangelength: '{{ trans('attributeType.validation.rangelength') }}'+'[2, 255]'+'{{ trans('attributeType.validation.characters') }}',
					remote: jQuery.validator.format('{{ trans('attributeType.alert') }}')
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
				url:  '{{ URL::route('attributeType.store') }}',
        		type:'POST'
			};
		$('#formAttributeType').ajaxForm(options);
	});

	// pre-submit callback
		function showRequest(formData, jqForm, options) {
			setTimeout(jQuery.fancybox({
				'content': "<h1>"+'{{ trans('attributeType.sending') }}'+"</h1>",
				'autoScale' : true,
				'transitionIn' : 'none',
				'transitionOut' : 'none',
				'scrolling' : 'no',
				'type' : 'inline',
				'showCloseButton' : false,
				'hideOnOverlayClick' : false,
				'hideOnContentClick' : false
			}), 5000 );
			return $('#formAttributeType').valid();
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