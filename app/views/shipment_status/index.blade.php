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


@stop

@section('scripts')
	{{ $table->script() }}
	<script type="text/javascript">
		$(document).ready(function () 
		{
			$('.summernote').summernote();

			$('select[name="color"]').simplecolorpicker({theme: 'glyphicons'});

			$('.edit').fancybox({
				openEffect	: 'elastic',
	    		closeEffect	: 'elastic',
				centerOnScroll: true,
				hideOnOverlayClick: true,
			});

			loadData();

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
						/*else
						{
							if (type == "language" ) 
							{
								loadDataForLanguage(numberId);
							}
							else
							{
								if (type == "delet")
								{
									deleteProduct(numberId);
								}
							}
						}*/

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

			/*function loadDataForLanguage(id) {
				$.ajax({
					type: 'GET',
					url: '{{ URL::to('/returnDataProduct/') }}',	
					data: {'productId': id},
					dataType: "JSON",
					success: function(response) {
						console.log(response.product);
						if (response.success == true) {
							$('#product_id_language').val(response.product.product.id);
							$('#lang_id').val(response.product.language_id);
							$('#name_language').val(response.product.name);
							$('#description_language').code(response.product.description);
						}
					}
				});
			}

			$('#lang_id').click(function () {
				console.log($('#product_id_language').val() +" "+ $('#lang_id').val());

				$.ajax({
					type: 'GET',
					url: '{{ URL::to('/returnDataProductLang/') }}',	
					data: {'productId':$('#product_id_language').val(), 'languageId':$('#lang_id').val()},
					dataType: "JSON",
					success: function(response) {
						console.log(response);
						if (response.success == true) {
							$('#name_language').val(response.productLang.name);
							$('#description_language').code(response.productLang.description);
						}else{
							$('#name_language').val('');
							$('#description_language').code('');
						}
					}
				});

			}) ;*/

			$('#formEditProductLanguage').validate({
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

					/*var optionsProductLang = {
					beforeSubmit:  showRequestLang,  // pre-submit callback
					success:       showResponseLang,  // post-submit callback
					url:  '{{ URL::route('products.saveLang') }}',
					type:'POST'
				}*/

			$('#formEditShipmentStatus').ajaxForm(options);
			//$('#formEditProductLanguage').ajaxForm(optionsProductLang);

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
	</script>
@stop