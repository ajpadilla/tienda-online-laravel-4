@extends('layouts.template')

@section('title')
{{--{{ Lang::get('modulo.variable') }}--}}
{{ trans('discounts.list.title') }}
@stop

@section('content')
@include('layouts.partials._error')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>{{trans('discounts.list.subtitle')}}</h5>
			</div>
			@include('flash::message')
			<div class="ibox-content">
				<a class="btn btn-info " href="{{route('discounts.create')}}"><i class="fa fa-paste"></i> {{ trans('discounts.labels.new') }} </a>
				<div class="row"><br/></div>
				@include('partials._index-table')
			</div>
		</div>
	</div>
</div>

<div class="row" style="display: none">
	<section id="fancybox-edit-discount">
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>{{	trans('discounts.edit_view.subtitle') }}</h5>
					</div>
					<div class="ibox-content">
						<div class="row">
							{{Form::open(['route' => 'discounts.api.update', 'class' => 'form-horizontal', 'id' => 'form-edit-discount'])}}
								@include('discounts.partials._form')
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
 		$(".table").delegate(".edit-discount", "click", function() {
 			action = getAttributeIdActionSelect($(this).attr('id'));
            //console.log(action);
            loadDataToEditDiscount(action.number);
        });

 		$(".table").delegate(".delete-discount", "click", function() {
        	action = getAttributeIdActionSelect($(this).attr('id'));
            //console.log(action);
            fancyConfirm('Are you sure you want to delete?', deleteDiscount , action.number);
        });


 		var loadDataToEditDiscount = function(discountId) 
		{
				$.ajax({
					type: 'GET',
					url: '{{ URL::route('discounts.api.show') }}',	
					data: {'discountId': discountId},
					dataType: "JSON",
					success: function(response) 
					{
						//console.log(response);
						if (response.success == true) 
						{
							$('#discount_id').val(response.discount.attributes.id);
							$('#language_id').val(response.discount.language.id);
							$('#code').val(response.discount.attributes.code);
							$('#name').val(response.discount.language.name);
							$('#description').code(response.discount.language.description);
							$('#value').val(response.discount.attributes.value);
							$('#percent').val(response.discount.attributes.percent);
							$('#quantity').val(response.discount.attributes.quantity);
							$('#quantity_per_user').val(response.discount.attributes.quantity_per_user);
							$('input[name="active"]').val([response.discount.attributes.active]);
							$('#from').val(response.discount.from);
							$('#to').val(response.discount.to);
							$('#discount_type_id').val(response.discount.attributes.discount_type_id);
							$('.chosen-select').trigger("chosen:updated");
							$('.i-checks').iCheck('update');

							showPopUpFancybox('#fancybox-edit-discount');
						}
					}
				});
			}

			var deleteDiscount = function (discountId) 
			{
				$.ajax({
					type: 'GET',
					url: '{{ URL::route('discounts.api.delete') }}',
					data: {'discountId': discountId},
					dataType: "JSON",
					success: function(response) {
						if (response.success == true) {
							$('#delet_discount_'+discountId).parent().parent().remove();
                    		reloadDataTable('#datatable');
						};
					}
				});
			}

 		$('#form-edit-discount').validate({
			rules:{
				name:{
					required:!0,
					rangelength: [2, 255],
					onlyLettersNumbersAndSpaces: true
				},
				description:{
					required:!0,
					rangelength: [10, 255]
				},
				value:{
					required:!0,
					number: true
				},
				percent:{
					required:!0,
					number: true
				},
				quantity:{
					required:!0,
					digits: true
				},
				quantity_per_user:{
					required:!0,
					digits: true
				},
				code:{
					required:!0,
					onlyLettersNumbersAndDash: true,
					 /*remote:
						{
							url:'{{ URL::to('/checkCode/') }}',
							type: 'POST',
							data: {
								code: function() {
									return $('#code').val();
								}
							},
							dataFilter: function (respuesta) {
								//console.log('consulta:'+respuesta);
								return respuesta;
							}
						}*/ 
				},
				active:{
					required:!0,
					digits: true
				},
				from:{
					required:!0,
					customDateValidator: true
				},
				to:{
					required:!0,
					customDateValidator: true
				},
				discount_type_id:{
					required:!0,
					digits: true
				}
			},
			messages:{
				name:{
					required: '{{ trans('discounts.validation.required') }}',
					rangelength: '{{ trans('discounts.validation.rangelength') }}'+'[2, 255]'+'{{ trans('discounts.validation.characters') }}',
				},
				description:{
					required: '{{ trans('discounts.validation.required') }}',
					rangelength: '{{ trans('discounts.validation.rangelength') }}'+'[10, 255]'+'{{ trans('discounts.validation.characters') }}',
				},
				value:{
					required: '{{ trans('discounts.validation.required') }}',
					number: '{{ trans('discounts.validation.number') }}'
				},
				percent:{
					required: '{{ trans('discounts.validation.required') }}',
					number: '{{ trans('discounts.validation.number') }}'
				},
				quantity:{
					required: '{{ trans('discounts.validation.required') }}',
					digits: '{{ trans('discounts.validation.digits') }}'
				},
				quantity_per_user:{
					required: '{{ trans('discounts.validation.required') }}',
					digits: '{{ trans('discounts.validation.digits') }}'
				},
				code:{
					required: '{{ trans('discounts.validation.required') }}',
					remote: jQuery.validator.format('{{ trans('discounts.alert') }}')
				},
				active:{
					required: '{{ trans('discounts.validation.required') }}',
					digits: '{{ trans('discounts.validation.digits') }}'
				},
				from:{
					required: '{{ trans('discounts.validation.required') }}',
					//date: '{{ trans('discounts.validation.date') }}'
				},
				to:{
					required: '{{ trans('discounts.validation.required') }}',
					//date: '{{ trans('discounts.validation.date') }}'
				},
				discount_type_id:{
					required: '{{ trans('discounts.validation.required') }}',
					digits: '{{ trans('discounts.validation.digits') }}'
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
				url:  '{{URL::route('discounts.api.update')}}',
        		type:'POST'
			};
		$('#form-edit-discount').ajaxForm(options);
	});

	// pre-submit callback
	function showRequest(formData, jqForm, options) {
		setTimeout(jQuery.fancybox({
			'content':'<h1>' + '{{ trans('discounts.sending') }}' + '</h1>',
			'autoScale' : true,
			'transitionIn' : 'none',
			'transitionOut' : 'none',
			'scrolling' : 'no',
			'type' : 'inline',
			'showCloseButton' : false,
			'hideOnOverlayClick' : false,
			'hideOnContentClick' : false
		}), 5000 );
		return $('#form-edit-discount').valid();
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
 </script>
@stop