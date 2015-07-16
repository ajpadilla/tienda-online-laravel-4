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
				<div class="row"><br/></div>
				@include('partials._index-table')
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
							{{Form::open(['route' => 'shipmentStatus.api.update', 'class' => 'form-horizontal', 'id' => 'form-edit-shipment-status'])}}
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
							{{Form::open(['route' => 'shipmentStatus.api.saveLang', 'class' => 'form-horizontal', 'id' => 'form-edit-shipment-status-language'])}}
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
	<script type="text/javascript">
		$(document).ready(function () 
		{
			$('select[name="color"]').simplecolorpicker({theme: 'glyphicons'});
				
			$(".table").delegate(".edit-shipment-status", "click", function() {
				action = getAttributeIdActionSelect($(this).attr('id'));
	      		//console.log(action);
	        	loadDataToEditShipmentStatus(action.number);
	    	});

	    	$(".table").delegate(".edit-shipment-status-lang", "click", function() {
             	action = getAttributeIdActionSelect($(this).attr('id'));
             	//console.log(action);
             	loadDataForShipmentStatusLang(action.number);
        	});

			$(".table").delegate(".delete-shipment-status", "click", function() {
        		action = getAttributeIdActionSelect($(this).attr('id'));
        		//console.log(action);
        		fancyConfirm('Are you sure you want to delete?', deleteShipmentStatus , action.number);
        	});

			var loadDataToEditShipmentStatus = function(shipmentStatusId) 
			{
				$.ajax({
					type: 'GET',
					url: '{{ URL::route('shipmentStatus.api.show') }}',	
					data: {'shipmentStatusId': shipmentStatusId},
					dataType: "JSON",
					success: function(response) 
					{
						//console.log(response);
						if (response.success == true) 
						{
							$('#language_id').val(response.shipmentStatus.shipmentStatusLang.language_id);
							$('#shipment_status_id').val(response.shipmentStatus.attributes.id);
							$('#name_shipment_status').val(response.shipmentStatus.shipmentStatusLang.name);
							if (response.shipmentStatus.attributes.color != '') {
								$('select[name="color"]').simplecolorpicker('selectColor', response.shipmentStatus.attributes.color);
							};
							$('#description_shipment_status').code(response.shipmentStatus.shipmentStatusLang.description);
							showPopUpFancybox('#fancybox-edit-shipment-status');
						}
					}
				});
			};


			var loadDataForShipmentStatusLang = function (shipmentStatusId) 
			{
				$.ajax({
					type: 'GET',
					url: '{{ URL::route('shipmentStatus.api.show') }}',	
					data: {'shipmentStatusId': shipmentStatusId},
					dataType: "JSON",
					success: function(response) {
						//console.log(response.product);
						if (response.success == true) 
						{
							$('#shipment_status_id_language').val(response.shipmentStatus.attributes.id);
							$('#lang_id').val(response.shipmentStatus.shipmentStatusLang.language_id);
							$('#name_shipment_status_language').val(response.shipmentStatus.shipmentStatusLang.name);
							$('#description_shipment_status_language').code(response.shipmentStatus.shipmentStatusLang.description);
							showPopUpFancybox('#fancybox-edit-language-shipment-status');
						}
					}
				});
			};

			$('#lang_id').click(function () {
				console.log($('#shipment_status_id_language').val() +" "+ $('#lang_id').val());
				$.ajax({
					type: 'GET',
					url: '{{ URL::route('shipmentStatus.api.show-lang') }}',	
					data: {'shipmentStatusId':$('#shipment_status_id_language').val(), 'languageId':$('#lang_id').val()},
					dataType: "JSON",
					success: function(response) {
						//console.log(response);
						if (response.success == true) {
							$('#name_shipment_status_language').val(response.shipmentStatusLang.name);
							$('#description_shipment_status_language').code(response.shipmentStatusLang.description);
						}else{
							$('#name_shipment_status_language').val('');
							$('#description_shipment_status_language').code('');
						}
					}
				});
			});

			
			function deleteShipmentStatus(shipmentStatusId) {
				$.ajax({
					type: 'GET',
					url: '{{ URL::route('shipmentStatus.api.delete') }}',
					data: {'shipmentStatusId': shipmentStatusId},
					dataType: "JSON",
					success: function(response) {
						if (response.success == true) {
							$('#delet_shipment-status_'+shipmentStatusId).parent().parent().remove();
							reloadDataTable('#datatable');
						};
					}
				});
			}

			$('#form-edit-shipment-status').validate({
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

			$('#form-edit-shipment-status-language').validate({
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
						url:  '{{ URL::route('shipmentStatus.api.update') }}',
						type:'POST'
					};

			var optionsLang = {
				beforeSubmit:  showRequestLang,  // pre-submit callback
				success:       showResponseLang,  // post-submit callback
				url:  '{{ URL::route('shipmentStatus.api.saveLang') }}',
				type:'POST'
			}

			$('#form-edit-shipment-status').ajaxForm(options);
			$('#form-edit-shipment-status-language').ajaxForm(optionsLang);

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
			return $('#form-edit-shipment-status').valid();
		}

		// post-submit callback
		function showResponse(responseText, statusText, xhr, $form)  {
			if(responseText.success) 
			{
				jQuery.fancybox({
					'content' : '<h1>'+ responseText.message + '</h1>',
					'autoScale' : true
				});
				reloadDataTable('#datatable');
			}else{
				jQuery.fancybox({
					'content' : '<h1>'+ responseText.errors + '</h1>',
					'autoScale' : true
				});
			}
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
			return $('#form-edit-shipment-status-language').valid();
		}

		// post-submit callback
		function showResponseLang(responseText, statusText, xhr, $form)  {
			if(responseText.success) 
			{
				jQuery.fancybox({
					'content' : '<h1>'+ responseText.message + '</h1>',
					'autoScale' : true
				});
				reloadDataTable('#datatable');
			}else{
				jQuery.fancybox({
					'content' : '<h1>'+ responseText.errors + '</h1>',
					'autoScale' : true
				});
			}
		}
	</script>
@stop