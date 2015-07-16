@extends('layouts.template')

@section('title')
{{--{{ Lang::get('modulo.variable') }}--}}
{{ trans('invoiceStatus.list.title') }}
@stop

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>{{ trans('invoiceStatus.list.subtitle') }}</h5>
			</div>
			@include('flash::message')
			<div class="ibox-content">
			<a class="btn btn-info " href="{{ route('invoiceStatus.create') }}"><i class="fa fa-paste"></i> {{ trans('invoiceStatus.labels.new') }} </a>
				<div class="row"><br/></div>
				@include('partials._index-table')
			</div>
		</div>
	</div>
</div>

<div class="row" style="display: none">
	<section id="fancybox-edit-invoice-status">
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>{{	trans('products.subtitle') }}</h5>
					</div>
					<div class="ibox-content">
						<div class="row">
							{{Form::open(['route' => 'invoiceStatus.api.update', 'class' => 'form-horizontal', 'id' => 'form-edit-invoice-status'])}}
								@include('invoice_status.partials._form')
							{{Form::close()}}
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<div class="row" style="display: none">
	<section id="fancybox-edit-language-invoice-status">
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>{{	trans('products.edit_language.title') }}</h5>
					</div>
					<div class="ibox-content">
						<div class="row">
							{{Form::open(['route' => 'invoiceStatus.api.saveLang', 'class' => 'form-horizontal', 'id' => 'form-edit-invoice-status-language'])}}
								@include('invoice_status.partials._form_language')
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
			$('select[name="color"]').simplecolorpicker({theme: 'glyphicons'});
				
			$(".table").delegate(".edit-invoice-status", "click", function() {
				action = getAttributeIdActionSelect($(this).attr('id'));
	      		//console.log(action);
	        	loadDataToEditInvoiceStatus(action.number);
	    	});

	    	$(".table").delegate(".edit-invoice-status-lang", "click", function() {
             	action = getAttributeIdActionSelect($(this).attr('id'));
             	//console.log(action);
             	loadDataForInvocieStatusLang(action.number);
        	});

			$(".table").delegate(".delete-invoice-status", "click", function() {
        		action = getAttributeIdActionSelect($(this).attr('id'));
        		//console.log(action);
        		fancyConfirm('Are you sure you want to delete?', deleteInvoiceStatus , action.number);
        	});

			var loadDataToEditInvoiceStatus = function(invoiceStatusId) 
			{
				$.ajax({
					type: 'GET',
					url: '{{ URL::route('invoiceStatus.api.show') }}',	
					data: {'invoiceStatusId': invoiceStatusId},
					dataType: "JSON",
					success: function(response) 
					{
						//console.log(response);
						if (response.success == true) 
						{
							$('#language_id').val(response.invoiceStatus.invoiceStatusLang.language_id);
							$('#invoice_status_id').val(response.invoiceStatus.attributes.id);
							$('#name_invoice_status').val(response.invoiceStatus.invoiceStatusLang.name);
							if (response.invoiceStatus.attributes.color != '') {
								$('select[name="color"]').simplecolorpicker('selectColor', response.invoiceStatus.attributes.color);
							};
							$('#description_invoice_status').code(response.invoiceStatus.invoiceStatusLang.description);
							showPopUpFancybox('#fancybox-edit-invoice-status');
						}
					}
				});
			};


			var loadDataForInvocieStatusLang = function (invoiceStatusId) 
			{
				$.ajax({
					type: 'GET',
					url: '{{ URL::route('invoiceStatus.api.show') }}',	
					data: {'invoiceStatusId': invoiceStatusId},
					dataType: "JSON",
					success: function(response) {
						//console.log(response.product);
						if (response.success == true) 
						{
							$('#invoice_status_id_lang').val(response.invoiceStatus.attributes.id);
							$('#lang_id').val(response.invoiceStatus.invoiceStatusLang.language_id);
							$('#name_language').val(response.invoiceStatus.invoiceStatusLang.name);
							$('#description_language').code(response.invoiceStatus.invoiceStatusLang.description);
							showPopUpFancybox('#form-edit-invoice-status-language');
						}
					}
				});
			};

			$('#lang_id').click(function () {
				//console.log($('#shipment_status_id_language').val() +" "+ $('#lang_id').val());
				$.ajax({
					type: 'GET',
					url: '{{ URL::route('invoiceStatus.api.show-lang') }}',	
					data: {'invoiceStatusId':$('#invoice_status_id_lang').val(), 'languageId':$('#lang_id').val()},
					dataType: "JSON",
					success: function(response) {
						//console.log(response);
						if (response.success == true) {
							$('#name_language').val(response.invoiceStatusLang.name);
							$('#description_language').code(response.invoiceStatusLang.description);
						}else{
							$('#name_language').val('');
							$('#description_language').code('');
						}
					}
				});
			});

			function deleteInvoiceStatus(invoiceStatusId) {
				$.ajax({
					type: 'GET',
					url: '{{ URL::route('invoiceStatus.api.delete') }}',
					data: {'invoiceStatusId': invoiceStatusId},
					dataType: "JSON",
					success: function(response) {
						if (response.success == true) {
							$('#delet_invoice-status_'+invoiceStatusId).parent().parent().remove();
							reloadDataTable('#datatable');
						};
					}
				});
			}
			
			$('#form-edit-invoice-status').validate({
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

			$('#form-edit-invoice-status-language').validate({
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
						url:  '{{ URL::route('invoiceStatus.api.update') }}',
						type:'POST'
					};

			var optionsLang = {
				beforeSubmit:  showRequestLang,  // pre-submit callback
				success:       showResponseLang,  // post-submit callback
				url:  '{{ URL::route('invoiceStatus.api.saveLang') }}',
				type:'POST'
			}

			$('#form-edit-invoice-status').ajaxForm(options);
			$('#form-edit-invoice-status-language').ajaxForm(optionsLang);

		});

		// pre-submit callback
		function showRequest(formData, jqForm, options) {
			setTimeout(jQuery.fancybox({
				'content':'<h1>' + '{{ trans('invoiceStatus.sending') }}' + '</h1>',
				'autoScale' : true,
				'transitionIn' : 'none',
				'transitionOut' : 'none',
				'scrolling' : 'no',
				'type' : 'inline',
				'showCloseButton' : false,
				'hideOnOverlayClick' : false,
				'hideOnContentClick' : false
			}), 5000 );
			return $('#form-edit-invoice-status').valid();
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
				'content':'<h1>' + '{{ trans('invoiceStatus.sending') }}' + '</h1>',
				'autoScale' : true,
				'transitionIn' : 'none',
				'transitionOut' : 'none',
				'scrolling' : 'no',
				'type' : 'inline',
				'showCloseButton' : false,
				'hideOnOverlayClick' : false,
				'hideOnContentClick' : false
			}), 5000 );
			return $('#form-edit-invoice-status-language').valid();
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