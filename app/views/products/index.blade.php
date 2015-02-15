@extends('layouts.template')

@section('title')
	{{ trans('products.list.title') }}
@stop

@section('content')
@include('layouts.partials._error')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>{{trans('products.list.subtitle')}}</h5>
			</div>
			@include('flash::message')
			<div class="ibox-content">
				<a class="btn btn-info " href="{{route('products.create')}}"><i class="fa fa-paste"></i> {{ trans('products.labels.new') }} </a>
				<?php
					$columns = [
						trans('products.list.photo'),
						trans('products.list.name'),
						trans('products.list.price'),
						trans('products.list.quantity'),
						trans('products.list.active'),
						trans('products.list.accept'),
						trans('products.list.category'),
						trans('products.list.ratings'),
						trans('products.list.actions')
				];
				$table = Datatable::table()
				->addColumn($columns)
				->setUrl(route('api.products'))
				->noScript();
				?>
				<div class="row"><br/></div>
				{{ $table->render() }}
			</div>
		</div>
	</div>
</div>
	
<div class="row" style="display: none">
	<section id="fancybox-edit-product">
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>{{	trans('products.subtitle') }}</h5>
					</div>
					<div class="ibox-content">
						<div class="row">
							{{Form::open(['route' => 'products.update', 'class' => 'form-horizontal', 'id' => 'formEditProduct'])}}
								@include('products.partials._form')
							{{Form::close()}}
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<div class="row" style="display: none">
	<section id="fancybox-edit-language-product">
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>{{	trans('products.edit_language.title') }}</h5>
					</div>
					<div class="ibox-content">
						<div class="row">
							{{Form::open(['route' => 'products.saveLang', 'class' => 'form-horizontal', 'id' => 'formEditProductLanguage'])}}
								@include('products.partials._form_language')
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
	<script  type="text/javascript">
		$(document).ready(function () 
		{

			$('.i-checks').iCheck({
				checkboxClass: 'icheckbox_square-green',
				radioClass: 'iradio_square-green',
			});

				// Iniciar select chosen
			$('.chosen-select').chosen({width: "95%"});

			$('#description').summernote();

			$('#description_language').summernote();

			$('select[name="color"]').simplecolorpicker({theme: 'glyphicons'});
			

			loadData();

			/*$('.btn.btn-success.btn-outline.dim.col-sm-6.show').fancybox({
				openEffect	: 'elastic',
	    		closeEffect	: 'elastic',
				centerOnScroll: true,
				hideOnOverlayClick: true,
			});*/


			$('.btn.btn-warning.btn-outline.dim.col-sm-6.edit').fancybox({
				openEffect	: 'elastic',
	    		closeEffect	: 'elastic',
				centerOnScroll: true,
				hideOnOverlayClick: true,
				beforeLoad: loadData()
			});

			$('.btn.btn-success.btn-outline.dim.col-sm-6.language').fancybox({
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
									deleteProduct(numberId);
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
					url: '{{ URL::to('/returnDataProduct/') }}',	
					data: {'productId': id},
					dataType: "JSON",
					success: function(response) {
						if (response.success == true) {
							$('#product_id').val(response.product.product.id);
							$('#language_id').val(response.product.language_id);
							$('#name').val(response.product.name);
							$('#description').code(response.product.description);
							$('#quantity').val(response.product.product.quantity);
							$('#price').val(response.product.product.price);
							$('#point_price').val(response.product.product.point_price);
							$('#width').val(response.product.product.width.toFixed(2));
							$('#height').val(response.product.product.height.toFixed(2));
							$('#depth').val(response.product.product.depth.toFixed(2));
							$('#measure_id').val(response.product.product.measure_id);
							$('#weight').val(response.product.product.weight.toFixed(2));
							$('#weight_id').val(response.product.product.weight_id);
							if (response.product.product.color != '') {
								$('select[name="color"]').simplecolorpicker('selectColor', response.product.product.color);
							};
							$('input[name="on_sale"]').val([response.product.product.on_sale]);
							$('input[name="accept_barter"]').val([response.product.product.accept_barter]);
							$('input[name="active"]').val([response.product.product.active]);
							$('#categories').val(response.categories);
							$('#condition_id').val(response.product.product.condition_id);

							$('.chosen-select').trigger("chosen:updated");
							$('.i-checks').iCheck('update');
						}
					}
				});
			}

			function loadDataForLanguage(id) {
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

			}) ;


			function deleteProduct(id) {
				$.ajax({
					type: 'GET',
					url: '{{ URL::route('products.delete-ajax') }}',
					data: {'productId': id},
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

			$('#formEditProduct').validate({
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
						quantity:{
							required:true,
							digits: true
						},
						price:{
							required:true,
							number: true
						},
						width:{
							required:true,
							number: true
						},
						height:{
							required:true,
							number: true
						},
						depth:{
							required:true,
							number:true
						},
						weight:{
							required:true,
							number:true
						},
						on_sale:{
							required:true,
							digits: true
						},
						active:{
							required:true,
							digits: true
						},
						available_for_order:{
							required:true,
							digits: true
						},
						show_price:{
							required:true,
							digits: true
						},
						accept_barter:{
							required:true,
							digits: true
						},
						product_for_barter:{
							required:true,
							digits: true
						},
						'categories[]':{
							required:true
						},
						condition_id:{
							required:true
						},
						color:{
							required: '{{ trans('products.validation.required') }}',
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

				$('#formEditProductLanguage').validate({
					rules:{
						name_language:{
							required:true,
							rangelength: [2, 64],
							onlyLettersNumbersAndSpaces: true
						},
						description_language:{
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
						url:  '{{ URL::route('products.update') }}',
						type:'POST'
					};

				var optionsProductLang = {
					beforeSubmit:  showRequestLang,  // pre-submit callback
					success:       showResponseLang,  // post-submit callback
					url:  '{{ URL::route('products.saveLang') }}',
					type:'POST'
				}

				$('#formEditProduct').ajaxForm(options);
				$('#formEditProductLanguage').ajaxForm(optionsProductLang);
				
		});

		// pre-submit callback
		function showRequest(formData, jqForm, options) {
			setTimeout(jQuery.fancybox({
				'content':'<h1>' + '{{ trans('products.sending') }}' + '</h1>',
				'autoScale' : true,
				'transitionIn' : 'none',
				'transitionOut' : 'none',
				'scrolling' : 'no',
				'type' : 'inline',
				'showCloseButton' : false,
				'hideOnOverlayClick' : false,
				'hideOnContentClick' : false
			}), 5000 );
			return $('#formEditProduct').valid();
		}

		// post-submit callback
		function showResponse(responseText, statusText, xhr, $form)  {
			console.log(responseText);

			jQuery.fancybox({
				'content' : '<h1>'+ responseText.message + '</h1>',
				'autoScale' : true
			});

			if(responseText.add_photos == 1)
				document.location.href = responseText.url;
		}

		// pre-submit callback
		function showRequestLang(formData, jqForm, options) {
			setTimeout(jQuery.fancybox({
				'content':'<h1>' + '{{ trans('products.sending') }}' + '</h1>',
				'autoScale' : true,
				'transitionIn' : 'none',
				'transitionOut' : 'none',
				'scrolling' : 'no',
				'type' : 'inline',
				'showCloseButton' : false,
				'hideOnOverlayClick' : false,
				'hideOnContentClick' : false
			}), 5000 );
			return $('#formEditProductLanguage').valid();
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

@section('styles')
	<style type="text/css">
		.mini-photo {
			width: 70px;
			height: 100px;
		}
	</style>
@stop


