@extends('layouts.template')

@section('title')
{{--{{ trans('invoiceStatus.labels.name')}}--}}
{{	trans('invoiceStatus.edit_view.title') }}
@stop

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>{{	trans('invoiceStatus.edit_view.subtitle') }}</h5>
			</div>
			<div class="ibox-content">
				<div class="row">
					{{ Form::model($invoiceStatus, array('route' => array('invoiceStatus.update', $invoiceStatus->id),'id'=>'formEditInvoiceStatus','class'=>'form-horizontal')) }}
					<div class="col-sm-6 b-r">
						<div class="form-group">
							{{ Form::label('language_id', trans('invoiceStatus.labels.language'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::select('language_id',$languages,$invoiceStatusLanguage->id,array('class' => 'form-control','id'=>'language_id')) }}
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('name', trans('invoiceStatus.labels.name'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::text('name',$invoiceStatusLanguage->pivot->name, ['class' => 'form-control', 'id' => 'name']) }}
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('description', trans('invoiceStatus.labels.description'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::textarea('description',$invoiceStatusLanguage->pivot->description, ['class' => 'form-control', 'rows' => '3', 'id' => 'description']) }}
							</div>
						</div>
					</div>
					
					<div class="col-sm-6">
						<div class="form-group">
							{{ Form::label('color', trans('invoiceStatus.labels.color'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::select('color',array(
											'#7bd148' => 'Green',
											'#5484ed' =>'Bold blue',
											'#a4bdfc' => 'Blue',
											'#46d6db' => 'Turquoise',
											'#7ae7bf' => 'Light green',
											'#51b749' => 'Bold green',
											'#fbd75b' => 'Yellow',
											'#ffb878' => 'Orange',
											'#ff887c' => 'Red',
											'#dc2127' => 'Bold red',
											'#dbadff' => 'Purple',
											'#e1e1e1' => 'Gray',
										)
								,$invoiceStatus->color,['class' => 'form-control','id' => 'color']) }}
							</div>
						</div>

						<div class="form-group">
						{{ Form::text('invoice_status_id',$invoiceStatus->id, ['class' => 'form-control','id'=>'invoice_status_id','style'=>'display: none;']) }}
						</div>

						<div class="form-group">
							<div class="col-sm-4 col-sm-offset-2">
								{{ Form::submit(trans('invoiceStatus.labels.save'), ['class' => 'btn btn-primary']) }}
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
		$('#description').summernote();

		$('select[name="color"]').simplecolorpicker({picker: true, theme: 'glyphicons'});

		$.validator.addMethod('onlyLettersNumbersAndSpaces', function(value, element) {
         	  return this.optional(element) || /^[a-zA-Z0-9ñÑ\s]+$/i.test(value);
       	}, '{{ trans('invoiceStatus.validation.onlyLettersNumbersAndSpaces') }}');

		$.validator.addMethod('onlyLettersNumbersAndDash', function(value, element) {
         	  return this.optional(element) || /^[a-zA-Z0-9ñÑ\-]+$/i.test(value);
        }, '{{ trans('invoiceStatus.validation.onlyLettersNumbersAndDash') }}');


		$('#formEditInvoiceStatus').validate({

			rules:{
				name:{
					required:!0,
					rangelength: [2, 255],
					onlyLettersNumbersAndSpaces: true,
					remote:
					{
						url:'{{ URL::to('/checkNameInvoiceStatusEdit/') }}',
						type: 'POST',
						data: {
							language_id: function() {
								return $('#language_id').val();
							},
							
							name: function() {
								return $('#name').val();
							},

							invoice_status_id: function() {
								return $('#invoice_status_id').val();
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
				color:{
					required:!0,
				}
			},
			messages:{
				name:{
					required: '{{ trans('invoiceStatus.validation.required') }}',
					rangelength: '{{ trans('invoiceStatus.validation.rangelength') }}'+'[2, 255]'+'{{ trans('invoiceStatus.validation.characters') }}',
					remote: jQuery.validator.format('{{ trans('invoiceStatus.alert') }}')
				},
				description:{
					required: '{{ trans('invoiceStatus.validation.required') }}',
					rangelength: '{{ trans('invoiceStatus.validation.rangelength') }}'+'[10, 255]'+'{{ trans('invoiceStatus.validation.characters') }}',
				},
				color:{
					required: '{{ trans('invoiceStatus.validation.required') }}',
					remote: jQuery.validator.format('{{ trans('invoiceStatus.alertColor') }}')
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
				url:  '{{ URL::route('invoiceStatus.update',$invoiceStatus->id) }}',
        		type:'POST'
			};
		$('#formEditInvoiceStatus').ajaxForm(options);
	});

	// pre-submit callback
		function showRequest(formData, jqForm, options) {
			setTimeout(jQuery.fancybox({
				'content': '<h1>'+'"{{ trans('invoiceStatus.sending') }}"'+'</h1>',
				'autoScale' : true,
				'transitionIn' : 'none',
				'transitionOut' : 'none',
				'scrolling' : 'no',
				'type' : 'inline',
				'showCloseButton' : false,
				'hideOnOverlayClick' : false,
				'hideOnContentClick' : false
			}), 5000 );
			return $('#formEditInvoiceStatus').valid();
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