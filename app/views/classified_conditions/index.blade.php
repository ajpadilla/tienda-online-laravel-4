@extends('layouts.template')

@section('title')
{{--{{ Lang::get('modulo.variable') }}--}}
{{ trans('classifiedConditions.list.title') }}
@stop

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>{{ trans('classifiedConditions.list.title') }}</h5>
			</div>
			@include('flash::message')
			<div class="ibox-content">
				<div class="row"><br/></div>
				@include('partials._index-table')
			</div>
		</div>
	</div>
</div>

<div class="row" style="display: none">
	<section id="fancybox-edit-classified-condition">
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>{{	trans('products.subtitle') }}</h5>
					</div>
					<div class="ibox-content">
						<div class="row">
							{{Form::open(['route' => 'classifiedConditions.api.update', 'class' => 'form-horizontal', 'id' => 'form-edit-classified-condition'])}}
								@include('classified_conditions.partials._form')
							{{Form::close()}}
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>


<div class="row" style="display: none">
	<section id="fancybox-edit-language-classified-condition">
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>{{	trans('products.edit_language.title') }}</h5>
					</div>
					<div class="ibox-content">
						<div class="row">
							{{Form::open(['route' => 'classifiedConditions.api.saveLang', 'class' => 'form-horizontal', 'id' => 'form-edit-classified-condition-language'])}}
								@include('classified_conditions.partials._form_language')
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
 	$(document).ready(function (){

 		$(".table").delegate(".edit-classified-condition", "click", function() {
			action = getAttributeIdActionSelect($(this).attr('id'));
	     	//console.log(action);
	        loadDataToEditClassifiedCondition(action.number);
	    });

	    $(".table").delegate(".edit-classified-condition-lang", "click", function() {
        	action = getAttributeIdActionSelect($(this).attr('id'));
        	//console.log(action);
            loadDataForClassifiedCondition(action.number);
        });

		$(".table").delegate(".delete-classified-condition", "click", function() {
        	action = getAttributeIdActionSelect($(this).attr('id'));
       		//console.log(action);
        	fancyConfirm('Are you sure you want to delete?', deleteClassifiedCondition , action.number);
        });

 		var loadDataToEditClassifiedCondition = function(classifiedConditionId) 
		{
			$.ajax({
				type: 'GET',
				url: '{{ URL::route('classifiedConditions.api.show') }}',	
				data: {'classifiedConditionId': classifiedConditionId},
				dataType: "JSON",
				success: function(response) 
				{
					//console.log(response);
					if (response.success == true) 
					{
						$('#language_id').val(response.classifiedCondition.classifiedConditionLang.language_id);
						$('#classified_conditions_id').val(response.classifiedCondition.attributes.id);
						$('#name_classified_conditions').val(response.classifiedCondition.classifiedConditionLang.name);
						showPopUpFancybox('#fancybox-edit-classified-condition');
					}
				}
			});
		};


		var loadDataForClassifiedCondition = function (classifiedConditionId) 
		{
			$.ajax({
				type: 'GET',
				url: '{{ URL::route('classifiedConditions.api.show') }}',	
				data: {'classifiedConditionId': classifiedConditionId},
				dataType: "JSON",
				success: function(response) {
					//console.log(response);
					if (response.success == true) 
					{
						$('#classified_condition_id_lang').val(response.classifiedCondition.attributes.id);
						$('#lang_id').val(response.classifiedCondition.classifiedConditionLang.language_id);
						$('#name_classified_condition_language').val(response.classifiedCondition.classifiedConditionLang.name);
						showPopUpFancybox('#fancybox-edit-language-classified-condition');
					}
				}
			});
		};

		$('#lang_id').click(function () 
		{
			//console.log($('#shipment_status_id_language').val() +" "+ $('#lang_id').val());
			$.ajax({
				type: 'GET',
				url: '{{ URL::route('classifiedConditions.api.show-lang') }}',	
				data: {'classifiedConditionId': $('#classified_condition_id_lang').val(), 'languageId':$('#lang_id').val()},
				dataType: "JSON",
				success: function(response) {
					//console.log(response);
					if (response.success == true) {
						$('#name_classified_condition_language').val(response.classifiedConditionLang.name);
					}else{
						$('#name_classified_condition_language').val('');
					}
				}
			});
		});


		function deleteClassifiedCondition (classifiedConditionId) {
			$.ajax({
				type: 'GET',
				url: '{{ URL::route('classifiedConditions.api.delete') }}',
				data: {'classifiedConditionId': classifiedConditionId},
				dataType: "JSON",
				success: function(response) {
					if (response.success == true) {
						$('#delete_classified-condition_'+classifiedConditionId).parent().parent().remove();
						reloadDataTable('#datatable');
					};
				}
			});
		}

		$('#form-edit-classified-condition').validate({
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
			url:  '{{ URL::route('classifiedConditions.api.update') }}',
			type:'POST'
		};

		$('#form-edit-classified-condition').ajaxForm(options);

		$('#form-edit-classified-condition-language').validate({
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
			url:  '{{ URL::route('classifiedConditions.api.saveLang') }}',
			type:'POST'
		}
		$('#form-edit-classified-condition-language').ajaxForm(optionsLang);

 	});

	// pre-submit callback
	function showRequest(formData, jqForm, options) {
		setTimeout(jQuery.fancybox({
			'content':'<h1>' + '{{ trans('classifiedConditions.sending') }}' + '</h1>',
			'autoScale' : true,
			'transitionIn' : 'none',
			'transitionOut' : 'none',
			'scrolling' : 'no',
			'type' : 'inline',
			'showCloseButton' : false,
			'hideOnOverlayClick' : false,
			'hideOnContentClick' : false
		}), 5000 );
		return $('#form-edit-classified-condition').valid();
	};

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
	};

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
		return $('#form-edit-classified-condition-language').valid();
	};

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
	};
 </script>
@stop