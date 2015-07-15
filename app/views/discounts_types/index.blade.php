@extends('layouts.template')

@section('title')
{{--{{ Lang::get('modulo.variable') }}--}}
{{ trans('discountType.list.title') }}
@stop

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>{{ trans('discountType.list.subtitle') }}</h5>
			</div>
			@include('flash::message')
			<div class="ibox-content">
				<a class="btn btn-info " href="{{route('discountType.create')}}"><i class="fa fa-paste"></i> {{ trans('discountType.labels.new') }} </a>
				<div class="row"><br/></div>
				@include('partials._index-table')
			</div>
		</div>
	</div>
</div>

<div class="row" style="display: none">
	<section id="fancybox-edit-discount-type">
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>{{	trans('products.subtitle') }}</h5>
					</div>
					<div class="ibox-content">
						<div class="row">
							{{Form::open(['route' => 'discountType.api.update', 'class' => 'form-horizontal', 'id' => 'form-edit-discount-type'])}}
								@include('discounts_types.partials._form')
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
		$(".table").delegate(".edit-discount-type", "click", function() {
			action = getAttributeIdActionSelect($(this).attr('id'));
	       // console.log(action);
	        loadDataToEditDiscountType(action.number);
	    });

		var loadDataToEditDiscountType = function(discountTypeId) 
		{
			$.ajax({
				type: 'GET',
				url: '{{ URL::route('discountType.api.show') }}',	
				data: {'discountTypeId': discountTypeId},
				dataType: "JSON",
				success: function(response) 
				{
					//console.log(response);
					if (response.success == true) 
					{
						$('#language_id').val(response.discountType.discountTypeLang.language_id);
						$('#discount_type_id').val(response.discountType.attributes.id);
						$('#name_discount_type').val(response.discountType.discountTypeLang.name);
						showPopUpFancybox('#fancybox-edit-discount-type');
					}
				}
			});
		};

		$('#form-edit-discount-type').validate({
			rules:{
				name:{
					required:!0,
					onlyLettersNumbersAndSpaces: true,
					/*remote:
						{
							url:'{{ URL::to('/checkName/') }}',
							type: 'POST',
							data: {
								name: function() {
									return $('#name').val();
								},
								language_id: function () {
									return $('#language_id').val();
								}

							},
							dataFilter: function (respuesta) {
								console.log('consulta:'+respuesta);
								return respuesta;
							}
						}*/
				},
			},
			messages:{
				name:{
					required: '{{ trans('discountType.validation.required') }}',
					rangelength: '{{ trans('discountType.validation.rangelength') }}'+'[2, 45]'+'{{ trans('discounts.validation.characters') }}',
					remote: jQuery.validator.format('{{ trans('discountType.alert') }}')
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
				url: '{{URL::route('discountType.api.update')}}',
        		type:'POST'
			};

		$('#form-edit-discount-type').ajaxForm(options);
	});
	
	// pre-submit callback 
		function showRequest(formData, jqForm, options) {          
			setTimeout(jQuery.fancybox({
				'content':'<h1>' + '{{ trans('discountType.sending') }}' + '</h1>',
				'autoScale' : true,
				'transitionIn' : 'none',
				'transitionOut' : 'none',
				'scrolling' : 'no',         
				'type' : 'inline',
				'showCloseButton' : false,
				'hideOnOverlayClick' : false,
				'hideOnContentClick' : false    
			}), 5000 );  
			return $('#form-edit-discount-type').valid(); 
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