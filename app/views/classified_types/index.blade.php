@extends('layouts.template')

@section('title')
{{--{{ Lang::get('modulo.variable') }}--}}
{{ trans('classifiedTypes.list.title') }}
@stop

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>{{ trans('classifiedTypes.list.subtitle') }}</h5>
			</div>
			@include('flash::message')
			<div class="ibox-content">
			<a class="btn btn-info " href="{{route('classifiedTypes.create')}}"><i class="fa fa-paste"></i> {{ trans('classifiedTypes.labels.new') }} </a>
				<div class="row"><br/></div>
				@include('partials._index-table')
			</div>
		</div>
	</div>
</div>


<div class="row" style="display: none">
	<section id="fancybox-edit-classified-type">
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>{{	trans('products.subtitle') }}</h5>
					</div>
					<div class="ibox-content">
						<div class="row">
							{{Form::open(['route' => 'classifiedTypes.api.update', 'class' => 'form-horizontal', 'id' => 'form-edit-classified-type'])}}
								@include('classified_types.partials._form')
							{{Form::close()}}
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<div class="row" style="display: none">
	<section id="fancybox-edit-language-classified-type">
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>{{	trans('products.edit_language.title') }}</h5>
					</div>
					<div class="ibox-content">
						<div class="row">
							{{Form::open(['route' => 'classifiedTypes.api.saveLang', 'class' => 'form-horizontal', 'id' => 'form-edit-classified-type-language'])}}
								@include('classified_types.partials._form_language')
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

		$(".table").delegate(".edit-classified-type", "click", function() {
			action = getAttributeIdActionSelect($(this).attr('id'));
	     	//console.log(action);
	        loadDataToEditClassifiedType(action.number);
	    });

	    $(".table").delegate(".edit-classified-type-lang", "click", function() {
        	action = getAttributeIdActionSelect($(this).attr('id'));
        	//console.log(action);
            loadDataForClassifiedTypeLang(action.number);
        });

		$(".table").delegate(".delete-classified-type", "click", function() {
        	action = getAttributeIdActionSelect($(this).attr('id'));
       		//console.log(action);
        	fancyConfirm('Are you sure you want to delete?', deleteClassifiedType , action.number);
        });

	    var loadDataToEditClassifiedType = function(classifiedTypeId) 
		{
			$.ajax({
				type: 'GET',
				url: '{{ URL::route('classifiedTypes.api.show') }}',	
				data: {'classifiedTypeId': classifiedTypeId},
				dataType: "JSON",
				success: function(response) 
				{
					//console.log(response);
					if (response.success == true) 
					{
						$('#language_id').val(response.classifiedType.classifiedTypeLang.language_id);
						$('#classified_type_id').val(response.classifiedType.attributes.id);
						$('#name_classified_type').val(response.classifiedType.classifiedTypeLang.name);
						showPopUpFancybox('#fancybox-edit-classified-type');
					}
				}
			});
		};


		var loadDataForClassifiedTypeLang = function (classifiedTypeId) 
		{
			$.ajax({
				type: 'GET',
				url: '{{ URL::route('classifiedTypes.api.show') }}',	
				data: {'classifiedTypeId': classifiedTypeId},
				dataType: "JSON",
				success: function(response) {
					//console.log(response);
					if (response.success == true) 
					{
						$('#classified_type_id_lang').val(response.classifiedType.attributes.id);
						$('#lang_id').val(response.classifiedType.classifiedTypeLang.language_id);
						$('#name_classified_type_language').val(response.classifiedType.classifiedTypeLang.name);
						showPopUpFancybox('#fancybox-edit-language-classified-type');
					}
				}
			});
		};

		$('#lang_id').click(function () 
		{
			//console.log($('#shipment_status_id_language').val() +" "+ $('#lang_id').val());
			$.ajax({
				type: 'GET',
				url: '{{ URL::route('classifiedTypes.api.show-lang') }}',	
				data: {'classifiedTypeId': $('#classified_type_id_lang').val(), 'languageId':$('#lang_id').val()},
				dataType: "JSON",
				success: function(response) {
					//console.log(response);
					if (response.success == true) {
						$('#name_classified_type_language').val(response.classifiedTypeLang.name);
					}else{
						$('#name_classified_type_language').val('');
					}
				}
			});
		});

		function deleteClassifiedType (classifiedTypeId) {
			$.ajax({
				type: 'GET',
				url: '{{ URL::route('classifiedTypes.api.delete') }}',
				data: {'classifiedTypeId': classifiedTypeId},
				dataType: "JSON",
				success: function(response) {
					if (response.success == true) {
						$('#delete_classified-type_'+classifiedTypeId).parent().parent().remove();
						reloadDataTable('#datatable');
					};
				}
			});
		}

		$('#form-edit-classified-type').validate({
			rules:{
				name:{
					required:true,
					rangelength: [2, 64],
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
			url:  '{{ URL::route('classifiedTypes.api.update') }}',
			type:'POST'
		};

		$('#form-edit-classified-type').ajaxForm(options);

		$('#form-edit-classified-type-language').validate({
			rules:{
				name:{
					required:true,
					rangelength: [2, 64],
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
		var optionsLang = {
			beforeSubmit:  showRequestLang,  // pre-submit callback
			success:       showResponseLang,  // post-submit callback
			url:  '{{ URL::route('classifiedTypes.api.saveLang') }}',
			type:'POST'
		}
		$('#form-edit-classified-type-language').ajaxForm(optionsLang);
	});

	// pre-submit callback
		function showRequest(formData, jqForm, options) {
			setTimeout(jQuery.fancybox({
				'content':'<h1>' + '{{ trans('classifiedTypes.sending') }}' + '</h1>',
				'autoScale' : true,
				'transitionIn' : 'none',
				'transitionOut' : 'none',
				'scrolling' : 'no',
				'type' : 'inline',
				'showCloseButton' : false,
				'hideOnOverlayClick' : false,
				'hideOnContentClick' : false
			}), 5000 );
			return $('#form-edit-classified-type').valid();
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
				'content':'<h1>' + '{{ trans('classifiedTypes.sending') }}' + '</h1>',
				'autoScale' : true,
				'transitionIn' : 'none',
				'transitionOut' : 'none',
				'scrolling' : 'no',
				'type' : 'inline',
				'showCloseButton' : false,
				'hideOnOverlayClick' : false,
				'hideOnContentClick' : false
			}), 5000 );
			return $('#form-edit-classified-type').valid();
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