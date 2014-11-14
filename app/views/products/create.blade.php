@extends('layouts.template')

@section('title')

@stop

@section('content')

	<div class="col-lg-12">

				{{Form::open(['route' => 'products.store', 'class' => 'form-horizontal', 'id' => 'formCreateProduct'])}}
					<div class="col-lg-7">
						<div class="form-group">
							{{ Form::label('name',  trans('products.labels.name') , ['class' => 'col-sm-2 control-label']) }}
							<div class="col-sm-10">
								{{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name']) }}
							</div>
						</div>

						<div class="form-group">
							{{ Form::label('description', trans('products.labels.description'), ['class' => 'col-sm-2 control-label']) }}
							<div class="col-sm-10">
								<div class="ibox-content no-padding">

								{{ Form::textarea('description', null, array('class' => 'form-control')) }}
								</div>
							</div>
						</div>

						<div class="form-group">
							{{ Form::label('quantity', trans('products.labels.quantity'), ['class' => 'col-sm-2 control-label']) }}
							<div class="col-sm-10">
								{{ Form::text('quantity', null, ['class' => 'form-control', 'placeholder' => 'Quantity']) }}
							</div>
						</div>

						<div class="form-group">
							{{ Form::label('price', trans('products.labels.price'), ['class' => 'col-sm-2 control-label']) }}
							<div class="col-sm-10">
								{{ Form::text('price', null, ['class' => 'form-control', 'placeholder' => 'Price']) }}
							</div>
						</div>

						<div class="form-group">
							{{ Form::label('width', trans('products.labels.width'), ['class' => 'col-sm-2 control-label']) }}
							<div class="col-sm-10">
								<div class="input-group m-b">
									{{ Form::text('width', null, ['class' => 'form-control', 'placeholder' => 'Width']) }}
									<span class="input-group-addon">x</span>
									{{ Form::text('height', null, ['class' => 'form-control', 'placeholder' => 'Height']) }}
									<span class="input-group-addon">x</span>
									{{ Form::text('depth', null, ['class' => 'form-control', 'placeholder' => 'Depth']) }}
									<span class="input-group-addon">inches</span>
								</div>
							</div>
							<div class="col-sm-1">
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('weight', trans('products.labels.weight'), ['class' => 'col-sm-2 control-label']) }}
							<div class="col-sm-10">
								<div class="input-group m-b">
									{{ Form::text('weight', null, ['class' => 'form-control', 'placeholder' => 'Weight']) }}
									<span class="input-group-addon">pounds</span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-5">
						<div class="form-group">
							{{ Form::label('on_sale', trans('products.labels.on_sale'), ['class' => 'col-sm-4 control-label']) }}
							<div class="col-sm-8">
								<div class="radio i-checks">
									<label>
										{{ Form::radio('on_sale', '1', 1)}}
										<i></i> Yes
									</label>
								</div>
								<div class="radio i-checks">
									<label>
										{{ Form::radio('on_sale', '0', 0)}}
										<i></i> No
									</label>
								</div>
							</div>
						</div>

						<div class="form-group">
							{{ Form::label('active', trans('products.labels.active'), ['class' => 'col-sm-4 control-label']) }}
							<div class="col-sm-8">
								<div class="radio i-checks">
									<label>
										{{ Form::radio('active', '1', 1)}}
										<i></i> Yes
									</label>
								</div>
								<div class="radio i-checks">
									<label>
										{{ Form::radio('active', '0', 0)}}
										<i></i> No
									</label>
								</div>
							</div>
						</div>

						<div class="form-group">
							{{ Form::label('available_for_order', trans('products.labels.available_for_order'), ['class' => 'col-sm-4 control-label']) }}
							<div class="col-sm-8">
								<div class="radio i-checks">
									<label>
										{{ Form::radio('available_for_order', '1', 1)}}
										<i></i> Yes </label>
								</div>
								<div class="radio i-checks">
									<label>
										{{ Form::radio('available_for_order', '0', 0)}}
										<i></i> No </label>
								</div>
							</div>
						</div>

						<div class="form-group">
							{{ Form::label('show_price', trans('products.labels.show_price'), ['class' => 'col-sm-4 control-label']) }}
							<div class="col-sm-8">
								<div class="radio i-checks">
									<label>
										{{ Form::radio('show_price', '1', 1)}}
										<i></i> Yes
									</label>
								</div>
								<div class="radio i-checks">
									<label>
										{{ Form::radio('show_price', '0', 0)}}
										<i></i> No
									</label>
								</div>
							</div>
						</div>

						<div class="form-group">
							{{ Form::label('accept_barter', trans('products.labels.accept_barter'), ['class' => 'col-sm-4 control-label']) }}
							<div class="col-sm-8">
								<div class="radio i-checks">
									<label>
										{{ Form::radio('accept_barter', '1', 1)}}
										<i></i> Yes
									</label>
								</div>
								<div class="radio i-checks">
									<label>
										{{ Form::radio('accept_barter', '0', 0)}}
										<i></i> No
									</label>
								</div>
							</div>
						</div>

						<div class="form-group">
							{{ Form::label('product_for_barter', trans('products.labels.product_for_barter'), ['class' => 'col-sm-4 control-label']) }}
							<div class="col-sm-8">
								<div class="radio i-checks">
									<label>
										{{ Form::radio('product_for_barter', '1', 1)}}
										<i></i> Yes
									</label>
								</div>
								<div class="radio i-checks">
									<label>
										{{ Form::radio('product_for_barter', '0', 0)}}
										<i></i> No
									</label>
								</div>
							</div>
						</div>
					</div>

					<div class="col-lg-7">
						<div class="form-group">
							{{ Form::label('categories', trans('products.labels.categories'), ['class' => 'col-sm-2 control-label']) }}
							<div class="col-sm-10">
								{{ Form::select('categories[]',$categories,null,array('class' => 'chosen-select form-control', 'multiple' => 'multiple', 'data-placeholder' => 'Choose a Categories...')) }}

							</div>
						</div>

						<div class="form-group">
							{{ Form::label('condition_id', trans('products.labels.condition'), ['class' => 'col-sm-2 control-label']) }}
							<div class="col-sm-10">
								{{ Form::select('condition_id',$condition,null,array('class' => 'chosen-select form-control', 'data-placeholder' => 'Choose a Condition...')) }}
							</div>
						</div>
					</div>

					<div class="col-lg-12">
						<div class="form-group">
							<div class="col-sm-4 col-sm-offset-2">
								{{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
							</div>
						</div>
					</div>

					<div class="clearfix"></div>

				{{Form::close()}}

	</div>
@stop

@section('scripts')
	<script type="text/javascript">
		$(document).ready(function () {
			// Iniciar checks
			$('.i-checks').iCheck({
				checkboxClass: 'icheckbox_square-green',
				radioClass: 'iradio_square-green',
			});

			// Iniciar select chosen
			$('.chosen-select').chosen();

			 $('#description').summernote();

			$.validator.addMethod('onlyLettersNumbersAndSpaces', function(value, element) {
				return this.optional(element) || /^[a-zA-Z0-9ñÑ\s]+$/i.test(value);
			}, 'only letters, numbers and spaces.');

			$.validator.addMethod('onlyLettersNumbersAndDash', function(value, element) {
				return this.optional(element) || /^[a-zA-Z0-9ñÑ\-]+$/i.test(value);
			}, 'only letters, numbers and dash.');

			$('#formCreateProduct').validate({
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
					url:  '{{URL::route('products.store')}}',
					type:'POST'
				};
			$('#formCreateProduct').ajaxForm(options);

			// pre-submit callback
			function showRequest(formData, jqForm, options) {
				setTimeout(jQuery.fancybox({
					'content': '<h1>Enviando datos</h1>',
					'autoScale' : true,
					'transitionIn' : 'none',
					'transitionOut' : 'none',
					'scrolling' : 'no',
					'type' : 'inline',
					'showCloseButton' : false,
					'hideOnOverlayClick' : false,
					'hideOnContentClick' : false
				}), 5000 );
				return $('#formCreateProduct').valid();
			}

			// post-submit callback
			function showResponse(responseText, statusText, xhr, $form)  {
				jQuery.fancybox({
					'content' : '<h1>'+ responseText + '</h1>',
					'autoScale' : true
				});
			}
		});
	</script>
@stop