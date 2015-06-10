@extends('layouts.template')

@section('title')
{{--{{ Lang::get('modulo.variable') }}--}}
{{ trans('shipmentStatus.list.title') }}
@stop

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>{{ trans('shipmentStatus.list.subtitle') }}</h5>
			</div>
			@include('flash::message')
			<div class="ibox-content">
			<a class="btn btn-info " href="{{route('shipmentStatus.create')}}"><i class="fa fa-paste"></i> {{ trans('shipmentStatus.labels.new') }} </a>
				<?php
					$columns = [
						trans('shipmentStatus.list.Color'),
						trans('shipmentStatus.list.Name'),
						trans('shipmentStatus.list.Description'),
						trans('shipmentStatus.list.Actions')
				];
				$table = Datatable::table()
				->addColumn($columns)
				->setUrl(route('api.shipmentStatus'))
				->noScript();
				?>
				<div class="row"><br/></div>
				{{ $table->render() }}
			</div>
		</div>
	</div>
</div>

<div class="row" style="display: none">
	<section id="fancybox-edit-shipment-status">
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>{{	trans('products.subtitle') }}</h5>
					</div>
					<div class="ibox-content">
						<div class="row">
							{{Form::open(['route' => 'shipmentStatus.update', 'class' => 'form-horizontal', 'id' => 'formEditShipmentStatus'])}}
								@include('shipment_status.partials._form')
							{{Form::close()}}
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>


<div class="row" style="display: none">
	<section id="fancybox-edit-language-shipment-status">
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>{{	trans('products.edit_language.title') }}</h5>
					</div>
					<div class="ibox-content">
						<div class="row">
							{{Form::open(['route' => 'shipmentStatus.saveLang', 'class' => 'form-horizontal', 'id' => 'formEditShipmentStatusLanguage'])}}
								@include('shipment_status.partials._form_language')
							{{Form::close()}}
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>



@stop

@section('scripts')
	{{ $table->script() }}
	<script type="text/javascript">
		$(document).ready(function () 
		{
			console.log('product');
			$('.summernote').summernote();

			$('select[name="color"]').simplecolorpicker({theme: 'glyphicons'});

			loadData();

			$('.edit').fancybox({
				openEffect	: 'elastic',
	    		closeEffect	: 'elastic',
				centerOnScroll: true,
				hideOnOverlayClick: true,
				beforeLoad: loadData()
			});


			$('.language').fancybox({
				openEffect	: 'elastic',
	    		closeEffect	: 'elastic',
				centerOnScroll: true,
				hideOnOverlayClick: true,
				beforeLoad: loadData()
			});

			function loadData() 
			{
				$('.table').click(function(event)
				{
					var target = $( event.target );
					if (target.is('button')) 
					{
						console.log($(target).attr('id'));

						var id = $(target).attr('id');
						var type = id ? id.split('_')[0] : '';
						var numberId = id ? id.split('_')[1] : '';

						if (type == "edit") 
						{
							loadDataToEdit(numberId);
						}
						else
						{
							if (type == "language" ) 
							{
								loadDataForLanguage(numberId);
							}
							else
							{
								if (type == "delet")
								{
									deleteShipmentStatus(numberId);
								}
							}
						}

					}			
				});
			}

			function loadDataToEdit(id) 
			{
				$.ajax({
					type: 'GET',
					url: '{{ URL::to('/returnDatashipmentStatus/') }}',	
					data: {'shipmentStatusId': id},
					dataType: "JSON",
					success: function(response) {
						//console.log(response.shipment_status.shipmentStatus);
						if (response.success == true) {
							$('#shipment_status_id').val(response.shipment_status_lang.shipment_status_id);
							$('#language_id').val(response.shipment_status_lang.language_id);
							$('#name').val(response.shipment_status_lang.name);
							$('#description').code(response.shipment_status_lang.description);
							if (response.shipment_status.color != '') {
								$('select[name="color"]').simplecolorpicker('selectColor', response.shipment_status.color);
							};
						}
					}
				});
			}

			function loadDataForLanguage(id) {
				$.ajax({
					type: 'GET',
					url: '{{ URL::to('/returnDatashipmentStatus/') }}',	
					data: {'shipmentStatusId': id},
					dataType: "JSON",
					success: function(response) {
						//console.log(response.shipment_status_lang);
						if (response.success == true) {
							$('#shipment_status_id_language').val(response.shipment_status_lang.shipment_status_id);
							$('#lang_id').val(response.shipment_status_lang.language_id);
							$('#name_language').val(response.shipment_status_lang.name);
							$('#description_language').code(response.shipment_status_lang.description);
						}
					}
				});
			}

			$('#lang_id').click(function () {
				console.log($('#shipment_status_id_language').val() +" "+ $('#lang_id').val());

				$.ajax({
					type: 'GET',
					url: '{{ URL::to('/returnDataShipmentStatusLang/') }}',	
					data: {'shipmentStatusId':$('#shipment_status_id_language').val(), 'languageId':$('#lang_id').val()},
					dataType: "JSON",
					success: function(response) {
						console.log(response);
						if (response.success == true) {
							$('#name_language').val(response.shipmentStatusLang.name);
							$('#description_language').code(response.shipmentStatusLang.description);
						}else{
							$('#name_language').val('');
							$('#description_language').code('');
						}
					}
				});

			});

			
			function deleteShipmentStatus(id) {
				$.ajax({
					type: 'GET',
					url: '{{ URL::route('shipmentStatus.delete-ajax') }}',
					data: {'shipmentStatusId': id},
					dataType: "JSON",
					success: function(response) {
						if (response.success == true) {
							$('#delet_'+id).parent().parent().remove();
						};
					}
				});
			}

			$.validator.addMethod('onlyLettersNumbersAndSpaces', function(value, element) {
					return this.optional(element) || /^[a-zA-Z0-9ñÑ\s]+$/i.test(value);
			}, 'only letters, numbers and spaces.');



			$('#formEditShipmentStatus').validate({
				rules:{
					name:{
						required:true,
						rangelength: [2, 64],
						onlyLettersNumbersAndSpaces: true
					},
					description:{
						required:true,
						rangelength: [10, 255]
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

			$('#formEditShipmentStatusLanguage').validate({
				rules:{
					name:{
						required:true,
						rangelength: [2, 64],
						onlyLettersNumbersAndSpaces: true
					},
					description:{
						required:true,
						rangelength: [10, 255]
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
						url:  '{{ URL::route('shipmentStatus.update') }}',
						type:'POST'
					};

			var optionsLang = {
				beforeSubmit:  showRequestLang,  // pre-submit callback
				success:       showResponseLang,  // post-submit callback
				url:  '{{ URL::route('shipmentStatus.saveLang') }}',
				type:'POST'
			}

			$('#formEditShipmentStatus').ajaxForm(options);
			$('#formEditShipmentStatusLanguage').ajaxForm(optionsLang);

		});

		// pre-submit callback
		function showRequest(formData, jqForm, options) {
			setTimeout(jQuery.fancybox({
				'content':'<h1>' + '{{ trans('shipmentStatus.sending') }}' + '</h1>',
				'autoScale' : true,
				'transitionIn' : 'none',
				'transitionOut' : 'none',
				'scrolling' : 'no',
				'type' : 'inline',
				'showCloseButton' : false,
				'hideOnOverlayClick' : false,
				'hideOnContentClick' : false
			}), 5000 );
			return $('#formEditShipmentStatus').valid();
		}

		// post-submit callback
		function showResponse(responseText, statusText, xhr, $form)  {
			jQuery.fancybox({
				'content' : '<h1>'+ responseText + '</h1>',
				'autoScale' : true
			});
		}

		// pre-submit callback
		function showRequestLang(formData, jqForm, options) {
			setTimeout(jQuery.fancybox({
				'content':'<h1>' + '{{ trans('shipmentStatus.sending') }}' + '</h1>',
				'autoScale' : true,
				'transitionIn' : 'none',
				'transitionOut' : 'none',
				'scrolling' : 'no',
				'type' : 'inline',
				'showCloseButton' : false,
				'hideOnOverlayClick' : false,
				'hideOnContentClick' : false
			}), 5000 );
			return $('#formEditShipmentStatusLanguage').valid();
		}

		// post-submit callback
		function showResponseLang(responseText, statusText, xhr, $form)  {
			console.log(responseText);

			jQuery.fancybox({
				'content' : '<h1>'+ responseText + '</h1>',
				'autoScale' : true
			});
		}
	</script>
@stop