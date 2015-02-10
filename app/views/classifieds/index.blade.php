@extends('layouts.template')

@section('title')
{{--{{ Lang::get('modulo.variable') }}--}}
{{ trans('classifieds.list.title') }}
@stop

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>{{ trans('classifieds.list.subtitle') }}</h5>
			</div>
			@include('flash::message')
			<div class="ibox-content">
			<a class="btn btn-info " href="{{route('classifieds.create')}}"><i class="fa fa-paste"></i> {{ trans('classifieds.labels.new') }} </a>
				<?php
					$columns = [
						trans('classifieds.list.photo'),
						trans('classifieds.list.Name'),
						trans('classifieds.list.Description'),
						trans('classifieds.list.Address'),
						trans('classifieds.list.User'),
						trans('classifieds.list.Classifieds_types'),
						trans('classifieds.list.Classified_condition'),
						trans('classifieds.list.Actions')
				];
				$table = Datatable::table()
				->addColumn($columns)
				->setUrl(route('api.classifieds'))
				->noScript();
				?>
				<div class="row"><br/></div>
				{{ $table->render() }}
			</div>
		</div>
	</div>
</div>


<div class="row" style="display: none">
	<section id="fancybox-edit-classified">
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>{{	trans('classifieds.subtitle') }}</h5>
					</div>
					<div class="ibox-content">
						<div class="row">
							{{Form::open(['route' => 'classifieds.update', 'class' => 'form-horizontal', 'id' => 'formEditClassified'])}}
								@include('classifieds.partials._form')
							{{Form::close()}}
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>


<div class="row" style="display: none">
	<section id="fancybox-edit-language-classified">
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>{{	trans('classifieds.edit_language.title') }}</h5>
					</div>
					<div class="ibox-content">
						<div class="row">
							{{Form::open(['route' => 'classifieds.saveLang', 'class' => 'form-horizontal', 'id' => 'formEditClassifiedLanguage'])}}
								@include('classifieds.partials._form_language')
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
		$(document).ready(function() 
		{
			$('.chosen-select').chosen({width: "95%"});

			$('.summernote').summernote();

			$('.btn.btn-warning.btn-outline.dim.col-sm-8.edit').fancybox({
				openEffect	: 'elastic',
	    		closeEffect	: 'elastic',
				centerOnScroll: true,
				hideOnOverlayClick: true,
				beforeLoad: loadData()
			});

			$('.btn.btn-success.btn-outline.dim.col-sm-8.language').fancybox({
				openEffect	: 'elastic',
	    		closeEffect	: 'elastic',
				centerOnScroll: true,
				hideOnOverlayClick: true,
				beforeLoad: loadData()
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
							loadDataToEditClassified(numberId);
						}
						else
						{
							if (type == "language" ) 
							{
								loadDataForLanguageClassified(numberId);
							}
							else
							{
								if (type == "delet")
								{
									//console.log('delete');
									deleteClassified(numberId);
								}
							}
						}

					}			
				});
			}

			function loadDataToEditClassified(id) 
			{
				$.ajax({
					type: 'GET',
					url: '{{ URL::to('/returnDataClassified/') }}',	
					data: {'classifiedId': id},
					dataType: "JSON",
					success: function(response) {
						if (response.success == true) {
							$('#classified_id').val(response.classified.classified.id);
							$('#language_id').val(response.classified.language_id);
							$('#name').val(response.classified.name);
							$('#description').code(response.classified.description);
							$('#address').code(response.classified.address);
							$('#price').val(response.classified.classified.price);
							$('#classified_type_id').val(response.classified.classified.classified_type_id);
							$('#classified_condition_id').val(response.classified.classified.classified_condition_id);
							$('#categories').val(response.categories);
							$('.chosen-select').trigger("chosen:updated");
						}
					}
				});
			}

			function loadDataForLanguageClassified(id) {
				$.ajax({
					type: 'GET',
					url: '{{ URL::to('/returnDataClassified/') }}',	
					data: {'classifiedId': id},
					dataType: "JSON",
					success: function(response) {
						console.log(response.classified);
						if (response.success == true) {
							$('#classified_id_language').val(response.classified.classified.id);
							$('#lang_id').val(response.classified.language_id);
							$('#name_language').val(response.classified.name);
							$('#description_language').code(response.classified.description);
							$('#address_language').code(response.classified.address);
						}
					}
				});
			}

			$('#lang_id').click(function () {
				console.log($('#classified_id_language').val() +" "+ $('#lang_id').val());

				$.ajax({
					type: 'GET',
					url: '{{ URL::to('/returnDataClassifiedLang/') }}',	
					data: {'classifiedId':$('#classified_id_language').val(), 'languageId':$('#lang_id').val()},
					dataType: "JSON",
					success: function(response) {
						console.log(response);
						if (response.success == true) {
							$('#name_language').val(response.classifiedLang.name);
							$('#description_language').code(response.classifiedLang.description);
							$('#address_language').code(response.classifiedLang.address);
						}else{
							$('#name_language').val('');
							$('#description_language').code('');
							$('#address_language').code('');
						}
					}
				});

			}) ;

			function deleteClassified(id){
				$.ajax({
					type: 'GET',
					url: '{{ URL::route('classifieds.delete-ajax') }}',
					data: {'classifiedId': id},
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
			}, '{{ trans('classifieds.validation.onlyLettersNumbersAndSpaces') }}');

			$.validator.addMethod('onlyLettersNumbersAndDash', function(value, element) {
				return this.optional(element) || /^[a-zA-Z0-9ñÑ\-]+$/i.test(value);
			}, '{{ trans('classifieds.validation.onlyLettersNumbersAndDash') }}');

			jQuery.validator.addMethod('customDateValidator', function(value, element) {
				try{
					jQuery.datepicker.parseDate( '{{ trans('classifieds.date') }}' , value);return true;}
					catch(e){return false;}
				},'{{ trans('classifieds.validation.date') }}');

			$('#formEditClassified').validate({

				rules:{
					name:{
						required:!0,
						rangelength: [2, 255],
						onlyLettersNumbersAndSpaces: true,
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
	
			$('#formEditClassifiedLanguage').validate({
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
						addres:{
							required:!0,
							rangelength: [10, 255]
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
					url:  '{{URL::route('classifieds.update')}}',
					type:'POST'
				};

			var optionsClassifiedLang = {
					beforeSubmit:  showRequestLang,  // pre-submit callback
					success:       showResponseLang,  // post-submit callback
					url:  '{{ URL::route('classifieds.saveLang') }}',
					type:'POST'
				}

			$('#formEditClassified').ajaxForm(options);
			$('#formEditClassifiedLanguage').ajaxForm(optionsClassifiedLang);
			
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
			return $('#formEditClassified').valid();
		}

		// post-submit callback
		function showResponse(responseText, statusText, xhr, $form)  {

			/*jQuery.fancybox({
				'content' : '<h1>'+responseText + '</h1>',
				'autoScale' : true
			});*/


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
				'content':'<h1>' + '{{ trans('classifieds.sending') }}' + '</h1>',
				'autoScale' : true,
				'transitionIn' : 'none',
				'transitionOut' : 'none',
				'scrolling' : 'no',
				'type' : 'inline',
				'showCloseButton' : false,
				'hideOnOverlayClick' : false,
				'hideOnContentClick' : false
			}), 5000 );
			return $('#formEditClassifiedLanguage').valid();
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