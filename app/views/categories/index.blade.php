@extends('layouts.template')

@section('title')
{{--{{ Lang::get('modulo.variable') }}--}}
{{ trans('categories.list.title') }}
@stop

@section('content')

<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>{{ trans('categories.list.subtitle') }}</h5>
			</div>
			@include('flash::message')
			<div class="ibox-content">
			<a class="btn btn-info " href="{{route('categories.create')}}"><i class="fa fa-paste"></i> {{ trans('categories.labels.new') }} </a>
				<div class="row"><br/></div>
				@include('partials._index-table')
			</div>
		</div>
	</div>
</div>

<div class="row" style="display: none">
	<section id="fancybox-edit-category">
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>{{	trans('categories.edit_language.title') }}</h5>
					</div>
					<div class="ibox-content">
						<div class="row">
							{{Form::open(['route' => 'categories.api.update', 'class' => 'form-horizontal', 'id' => 'form-edit-category'])}}
								@include('categories.partials._form')
							{{Form::close()}}
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
	
<div class="row" style="display: none">
	<section id="fancybox-edit-category-lang">
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>{{	trans('categories.edit_language.title') }}</h5>
					</div>
					<div class="ibox-content">
						<div class="row">
							{{Form::open(['route' => 'categories.routes.api.saveLang', 'class' => 'form-horizontal', 'id' => 'form-edit-category-lang'])}}
								@include('categories.partials._form_language')
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

		$(".table").delegate(".edit-category", "click", function() {
        	action = getAttributeIdActionSelect($(this).attr('id'));
            //console.log(action);
            loadDataToEditCategory(action.number);
        });

		$(".table").delegate(".edit-category-lang", "click", function() {
        	action = getAttributeIdActionSelect($(this).attr('id'));
            //console.log(action);
            loadDataToCategoryLang(action.number);
        });


		$(".table").delegate(".delete-category", "click", function() {
        	action = getAttributeIdActionSelect($(this).attr('id'));
            //console.log(action);
            fancyConfirm('Are you sure you want to delete?', deleteCategory , action.number);
        });

		var loadDataToEditCategory = function(categoryId) 
		{
			$.ajax({
				type: 'GET',
				url: '{{ URL::route('categories.api.show') }}',	
				data: {'categoryId': categoryId},
				dataType: "JSON",
				success: function(response) 
				{
					console.log(response);
					if (response.success == true) 
					{
						$('#language-edit-id').val(response.category.categoryLang.language_id);
						$('#category-edit-id').val(response.category.attributes.id);
						if(response.category.parentCategory)
							$('#parent-category-edit').val(response.category.parentCategory.categories_id);
						else 
							$('#parent-category-edit').val('');
						$('#category-name-edit').val(response.category.categoryLang.name);
						$('.chosen-select').trigger("chosen:updated");
						showPopUpFancybox('#fancybox-edit-category');
					}
				}
			});
		}

			var loadDataToCategoryLang = function (categoryId) {
				$.ajax({
					type: 'GET',
					url: '{{ URL::route('categories.api.show') }}',	
					data: {'categoryId': categoryId},
					dataType: "JSON",
					success: function(response) {
						//console.log(response.product);
						if (response.success == true) {
							$('#lang_id').val(response.category.categoryLang.language_id);
							$('#category_id_language').val(response.category.attributes.id);
							$('#name_language').val(response.category.categoryLang.name);
							showPopUpFancybox('#fancybox-edit-category-lang');
						}
					}
				});
			}

			$('#lang_id').click(function () {
				//console.log($('#product_id_language').val() +" "+ $('#lang_id').val());
				$.ajax({
					type: 'GET',
					url: '{{ URL::route('categories.api.show-lang') }}',	
					data: {'categoryId':$('#category_id_language').val(), 'languageId':$('#lang_id').val()},
					dataType: "JSON",
					success: function(response) {
						//console.log(response);
						if (response.success == true && response.categoryLang)
						{
							$('#name_language').val(response.categoryLang.name);
						}else{
							$('#name_language').val('');
						}
					}
				});

			}) ;

		var deleteCategory = function (categoryId) 
		{
			$.ajax({
				type: 'GET',
				url: '{{ URL::route('categories.api.delete') }}',
				data: {'categoryId': categoryId},
				dataType: "JSON",
				success: function(response) {
					if (response.success == true) {
						$('#delet_category_'+categoryId).parent().parent().remove();
						reloadDataTable('#datatable');
					};
				}
			});
		}

		$('#form-edit-category').validate({
			rules:{
				name:{
					required:true,
					rangelength: [2, 128],
					onlyLettersNumbersAndSpaces: true
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

		$('#form-edit-category-lang').validate({
			rules:{
				name:{
					required:true,
					rangelength: [2, 128],
					onlyLettersNumbersAndSpaces: true
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
			url:  '{{ URL::route('categories.api.update') }}',
			type:'POST'
		};

		var optionsCategoryLang = {
			beforeSubmit:  showRequestLang,  // pre-submit callback
			success:       showResponseLang,  // post-submit callback
			url:  '{{ URL::route('categories.routes.api.saveLang') }}',
			type:'POST'
		}

		$('#form-edit-category').ajaxForm(options);
		$('#form-edit-category-lang').ajaxForm(optionsCategoryLang);

	});

	// pre-submit callback
		function showRequest(formData, jqForm, options) {
			setTimeout(jQuery.fancybox({
				'content':'<h1>' + '{{ trans('categories.sending') }}' + '</h1>',
				'autoScale' : true,
				'transitionIn' : 'none',
				'transitionOut' : 'none',
				'scrolling' : 'no',
				'type' : 'inline',
				'showCloseButton' : false,
				'hideOnOverlayClick' : false,
				'hideOnContentClick' : false
			}), 5000 );
			return $('#form-edit-category').valid();
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
				'content':'<h1>' + '{{ trans('categories.sending') }}' + '</h1>',
				'autoScale' : true,
				'transitionIn' : 'none',
				'transitionOut' : 'none',
				'scrolling' : 'no',
				'type' : 'inline',
				'showCloseButton' : false,
				'hideOnOverlayClick' : false,
				'hideOnContentClick' : false
			}), 5000 );
			return $('#form-edit-category').valid();
		}

		// post-submit callback
		function showResponseLang(responseText, statusText, xhr, $form)  {
			//console.log(responseText);
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