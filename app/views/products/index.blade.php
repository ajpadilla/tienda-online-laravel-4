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
				<div class="row"><br/></div>
				@include('partials._index-table')
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
							{{Form::open(['route' => 'products.api.update', 'class' => 'form-horizontal', 'id' => 'form-edit-product'])}}
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
	<section id="fancybox-edit-product-lang">
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>{{	trans('products.edit_language.title') }}</h5>
					</div>
					<div class="ibox-content">
						<div class="row">
							{{Form::open(['route' => 'products.routes.api.saveLang', 'class' => 'form-horizontal', 'id' => 'form-edit-product-language'])}}
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
	<script  type="text/javascript">
		$(document).ready(function () 
		{

			$('select[name="color"]').simplecolorpicker({theme: 'glyphicons'});
			
			$(".table").delegate(".edit-product", "click", function() {
             	action = getAttributeIdActionSelect($(this).attr('id'));
             	//console.log(action);
             	loadDataToEditProduct(action.number);
        	});
			
			$(".table").delegate(".edit-product-lang", "click", function() {
             	action = getAttributeIdActionSelect($(this).attr('id'));
             	//console.log(action);
             	loadDataForProductLang(action.number);
        	});
			
			$(".table").delegate(".delete-product", "click", function() {
             	action = getAttributeIdActionSelect($(this).attr('id'));
             	//console.log(action);
             	fancyConfirm('Are you sure you want to delete?', deleteProduct , action.number);
        	});

			var loadDataToEditProduct = function(productId) 
			{
				$.ajax({
					type: 'GET',
					url: '{{ URL::route('products.api.show') }}',	
					data: {'productId': productId},
					dataType: "JSON",
					success: function(response) 
					{
						//console.log(response);
						if (response.success == true) 
						{
							$('#product_id').val(response.product.attributes.id);
							$('#language_id').val(response.product.productLang.language_id);
							$('#name').val(response.product.productLang.name);
							$('#description').code(response.product.productLang.description);
							$('#quantity').val(response.product.attributes.quantity);
							$('#price').val(response.product.attributes.price);
							$('#point_price').val(response.product.attributes.point_price);
							$('#width').val(response.product.attributes.width.toFixed(2));
							$('#height').val(response.product.attributes.height.toFixed(2));
							$('#depth').val(response.product.attributes.depth.toFixed(2));
							$('#measure_id').val(response.product.attributes.measure_id);
							$('#weight').val(response.product.attributes.weight.toFixed(2));
							$('#weight_id').val(response.product.attributes.weight_id);
							if (response.product.attributes.color != '') {
								$('select[name="color"]').simplecolorpicker('selectColor', response.product.attributes.color);
							};
							$('input[name="on_sale"]').val([response.product.attributes.on_sale]);
							$('input[name="accept_barter"]').val([response.product.attributes.accept_barter]);
							$('input[name="active"]').val([response.product.attributes.active]);
							$('#categories').val(response.product.categories);
							$('#condition_id').val(response.product.attributes.condition_id);

							$('.chosen-select').trigger("chosen:updated");
							$('.i-checks').iCheck('update');

							showPopUpFancybox('#fancybox-edit-product');
						}
					}
				});
			}

			var loadDataForProductLang = function (productId) {
				$.ajax({
					type: 'GET',
					url: '{{ URL::route('products.api.show') }}',	
					data: {'productId': productId},
					dataType: "JSON",
					success: function(response) {
						//console.log(response.product);
						if (response.success == true) {
							$('#product_id_language').val(response.product.attributes.id);
							$('#lang_id').val(response.product.productLang.language_id);
							$('#name_language').val(response.product.productLang.name);
							$('#description_language').code(response.product.productLang.description);
							showPopUpFancybox('#fancybox-edit-product-lang');
						}
					}
				});
			}

			$('#lang_id').click(function () {
				//console.log($('#product_id_language').val() +" "+ $('#lang_id').val());
				$.ajax({
					type: 'GET',
					url: '{{ URL::route('products.api.show-lang') }}',	
					data: {'productId':$('#product_id_language').val(), 'languageId':$('#lang_id').val()},
					dataType: "JSON",
					success: function(response) {
						//console.log(response);
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

			var deleteProduct = function (productId) 
			{
				$.ajax({
					type: 'GET',
					url: '{{ URL::route('products.api.delete') }}',
					data: {'productId': productId},
					dataType: "JSON",
					success: function(response) {
						if (response.success == true) {
							$('#delet_product_'+productId).parent().parent().remove();
                    		reloadDataTable('#datatable');
						};
					}
				});
			}

			$('#form-edit-product').validate({
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

				$('#form-edit-product-language').validate({
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
						url:  '{{ URL::route('products.api.update') }}',
						type:'POST'
					};

				var optionsProductLang = {
					beforeSubmit:  showRequestLang,  // pre-submit callback
					success:       showResponseLang,  // post-submit callback
					url:  '{{ URL::route('products.routes.api.saveLang') }}',
					type:'POST'
				}

				$('#form-edit-product').ajaxForm(options);
				$('#form-edit-product-language').ajaxForm(optionsProductLang);
				
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
			return $('#form-edit-product').valid();
		}

		// post-submit callback
		function showResponse(responseText, statusText, xhr, $form)  {
			//console.log(responseText);
			if(responseText.success) 
			{
				jQuery.fancybox({
					'content' : '<h1>'+ responseText.message + '</h1>',
					'autoScale' : true
				});
				reloadDataTable('#datatable');
				if(responseText.add_photos == 1)
					document.location.href = responseText.url;
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
			return $('#form-edit-product-language').valid();
		}

		// post-submit callback
		function showResponseLang(responseText, statusText, xhr, $form)  {
			//console.log(responseText);
			if (responseText.success) 
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

@section('styles')
	<style type="text/css">
		.mini-photo {
			width: 70px;
			height: 100px;
		}
	</style>
@stop


