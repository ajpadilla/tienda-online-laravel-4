@extends('layouts.template')

@section('title')
{{--{{ trans('classifieds.labels.name')}}--}}
{{	trans('classifieds.title') }}
@stop

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>{{	trans('classifieds.subtitle') }}</h5>
			</div>
			<div class="ibox-content">
				<div class="row">
					{{ Form::open(['url' => LaravelLocalization::transRoute('classifieds.store'),'class'=>'form-horizontal','method' => 'POST','id' => 'formCreateClassified']) }}
					<div class="col-sm-6 b-r">
						<div class="form-group">
							{{ Form::label('language_id', trans('classifieds.labels.language'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::select('language_id',$languages,null,array('class' => 'form-control','id'=>'language_id')) }}
							</div>
						</div>
						
						<div class="form-group">
							{{ Form::label('name', trans('classifieds.labels.name'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::text('name',null, ['class' => 'form-control']) }}
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('description', trans('classifieds.labels.description'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::textarea('description',null, ['class' => 'form-control', 'rows' => '3']) }}
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('address', trans('classifieds.labels.address'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::textarea('address',null, ['class' => 'form-control', 'rows' => '3']) }}
							</div>
						</div>
					</div>

					<div class="col-sm-6">
						<div class="form-group">
							{{ Form::label('price', trans('classifieds.labels.price'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::text('price',null, ['class' => 'form-control']) }}
							</div>
						</div>

						<div class="form-group">
							{{ Form::label('classified_type_id', trans('classifieds.labels.classified_type'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::select('classified_type_id',$classified_types,null,array('class' => 'form-control')) }}
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('classified_condition_id', trans('classifieds.labels.classified_condition'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::select('classified_condition_id',$classified_conditions,null,array('class' => 'form-control')) }}
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('add_photos', trans('classifieds.labels.add_photos'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-10">
								<div class="radio i-checks">
									<label> 
										<!--<input type="radio" value="option1" name="a">-->
										{{ Form::radio('add_photos', '1', 1)}}
										<i></i> {{ trans('classifieds.labels.Yes') }}
									</label>
								</div>
								<div class="radio i-checks">
									<label> 
										<!--<input type="radio" value="option1" name="a">--> 
										{{ Form::radio('add_photos', '0', 0)}}
										<i></i> {{ trans('classifieds.labels.No') }}
									</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-4 col-sm-offset-2">
								{{ Form::submit(trans('classifieds.labels.save'), ['class' => 'btn btn-primary']) }}
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
       	}, '{{ trans('classifieds.validation.onlyLettersNumbersAndSpaces') }}');

		$.validator.addMethod('onlyLettersNumbersAndDash', function(value, element) {
         	  return this.optional(element) || /^[a-zA-Z0-9ñÑ\-]+$/i.test(value);
        }, '{{ trans('classifieds.validation.onlyLettersNumbersAndDash') }}');

		jQuery.validator.addMethod('customDateValidator', function(value, element) {
       	 	try{
       	 		jQuery.datepicker.parseDate( '{{ trans('classifieds.date') }}' , value);return true;}
        	catch(e){return false;}
    	},'{{ trans('classifieds.validation.date') }}');

		$('#formCreateClassified').validate({

			rules:{
				name:{
					required:!0,
					rangelength: [2, 255],
					onlyLettersNumbersAndSpaces: true,
					remote:
					{
						url:'{{ URL::to('/checkNameClassified/') }}',
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
				description:{
					required:!0,
					rangelength: [10, 255]
				},
				addres:{
					required:!0,
					rangelength: [10, 255]
				},
				price:{
					required:!0,
					number: true
				},
			},
			messages:{
				name:{
					required: '{{ trans('classifieds.validation.required') }}',
					rangelength: '{{ trans('classifieds.validation.rangelength') }}'+'[2, 255]'+'{{ trans('classifieds.validation.characters') }}',
					remote: jQuery.validator.format('{{ trans('classifieds.alert') }}')
				},
				description:{
					required: '{{ trans('classifieds.validation.required') }}',
					rangelength: '{{ trans('classifieds.validation.rangelength') }}'+'[10, 255]'+'{{ trans('classifieds.validation.characters') }}',
				},
				addres:{
					required: '{{ trans('classifieds.validation.required') }}',
					rangelength: '{{ trans('classifieds.validation.rangelength') }}'+'[10, 255]'+'{{ trans('classifieds.validation.characters') }}',
				},
				price:{
					required: '{{ trans('classifieds.validation.required') }}',
					number: '{{ trans('classifieds.validation.number') }}'
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
				url:  '{{URL::route('classifieds.store')}}',
        		type:'POST'
			};
		$('#formCreateClassified').ajaxForm(options);
	});

	// pre-submit callback
		function showRequest(formData, jqForm, options) {
			setTimeout(jQuery.fancybox({
				'content': '<h1>' + '{{ trans('classifieds.sending') }}' + '</h1>',
				'autoScale' : true,
				'transitionIn' : 'none',
				'transitionOut' : 'none',
				'scrolling' : 'no',
				'type' : 'inline',
				'showCloseButton' : false,
				'hideOnOverlayClick' : false,
				'hideOnContentClick' : false
			}), 5000 );
			return $('#formCreateClassified').valid();
		}

		// post-submit callback
		function showResponse(responseText, statusText, xhr, $form)  {
			jQuery.fancybox({
				'content' : '<h1>'+ responseText.message + '</h1>',
				'autoScale' : true
			});

			if (responseText.add_photos == 1) {
				document.location.href = '{{ URL::route('photosClassifieds.create') }}';
			};

			
		} 			
</script>
@stop