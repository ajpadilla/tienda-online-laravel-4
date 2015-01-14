@extends('layouts.template')

@section('title')
	{{	trans('products.show_data.title') }}
@stop

@section('content')

<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>	{{	trans('products.edit_view.subtitle') }}</h5>
			</div>
			<div class="ibox-content">
				<div class="row">
					{{Form::open(['route' => ['products.update', $productLanguage->product->id], 'class' => 'form-horizontal', 'id' => 'formUpdateProduct'])}}
					<div class="col-lg-7">
						<div class="form-group">
							{{ Form::label('language_id', trans('discounts.labels.language'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-10">
								{{ Form::select('language_id',$languages,$productLanguage->id,array('class' => 'form-control','id'=>'language_id')) }}
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('name',  trans('products.labels.name') , ['class' => 'col-sm-2 control-label']) }}
							<div class="col-sm-10">
								{{ Form::text('name', $productLanguage->name, ['class' => 'form-control', 'placeholder' => 'Name']) }}
							</div>
						</div>

						<div class="form-group">
							{{ Form::label('description', trans('products.labels.description'), ['class' => 'col-sm-2 control-label']) }}
							<div class="col-sm-10">
								<div class="ibox-content no-padding">

									{{ Form::textarea('description', $productLanguage->description, array('class' => 'form-control')) }}
								</div>
							</div>
						</div>

						<div class="form-group">
							{{ Form::label('quantity', trans('products.labels.quantity'), ['class' => 'col-sm-2 control-label']) }}
							<div class="col-sm-10">
								{{ Form::text('quantity', $productLanguage->product->quantity, ['class' => 'form-control', 'placeholder' => 'Quantity']) }}
							</div>
						</div>

						<div class="form-group">
							{{ Form::label('price', trans('products.labels.price'), ['class' => 'col-sm-2 control-label']) }}
							<div class="col-sm-10">
								{{ Form::text('price', $productLanguage->product->price, ['class' => 'form-control', 'placeholder' => 'Price']) }}
							</div>
						</div>

						<div class="form-group">
							{{ Form::label('measure_id', trans('products.labels.measure'), ['class' => 'col-sm-2 control-label']) }}
							<div class="col-sm-10">
								{{ Form::select('measure_id',$measures,$productLanguage->product->measure_id,array('class' => 'chosen-select form-control', 'data-placeholder' => 'Choose a measure...')) }}
							</div>
						</div>

						<div class="form-group">
							{{ Form::label('width', trans('products.labels.width'), ['class' => 'col-sm-2 control-label']) }}
							<div class="col-sm-10">
								{{ Form::text('width', $productLanguage->product->width, ['class' => 'form-control', 'placeholder' => 'Width']) }}
							</div>
						</div>

						<div class="form-group">
							{{ Form::label('height', trans('products.labels.height'), ['class' => 'col-sm-2 control-label']) }}
							<div class="col-sm-10">
								{{ Form::text('height', $productLanguage->product->height, ['class' => 'form-control', 'placeholder' => 'Height']) }}
							</div>
						</div>

						<div class="form-group">
							{{ Form::label('depth', trans('products.labels.depth'), ['class' => 'col-sm-2 control-label']) }}
							<div class="col-sm-10">
								{{ Form::text('depth', $productLanguage->product->depth, ['class' => 'form-control', 'placeholder' => 'Depth']) }}
							</div>
						</div>

						<div class="form-group">
							{{ Form::label('weight', trans('products.labels.weight'), ['class' => 'col-sm-2 control-label']) }}
							<div class="col-sm-10">
								{{ Form::text('weight', $productLanguage->product->weight, ['class' => 'form-control', 'placeholder' => 'Weight']) }}
								<!-- <span class="input-group-addon">pounds</span> -->
							</div>
						</div>
					</div>
					<div class="col-lg-5">
						<div class="form-group">
							{{ Form::label('on_sale', trans('products.labels.on_sale'), ['class' => 'col-sm-4 control-label']) }}
							<div class="col-sm-8">
								<div class="radio i-checks">
									<label>
										{{ Form::radio('on_sale', '1', $productLanguage->product->on_sale ? true : false)}}
										<i></i> Yes
									</label>
								</div>
								<div class="radio i-checks">
									<label>
										{{ Form::radio('on_sale', '0', !$productLanguage->product->on_sale ? true : false)}}
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
										{{ Form::radio('active', '1', $productLanguage->product->active ? true : false)}}
										<i></i> Yes
									</label>
								</div>
								<div class="radio i-checks">
									<label>
										{{ Form::radio('active', '0', !$productLanguage->product->active ? true : false)}}
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
										{{ Form::radio('available_for_order', '1', $productLanguage->product->available_for_order ? true : false)}}
										<i></i> Yes </label>
									</div>
									<div class="radio i-checks">
										<label>
											{{ Form::radio('available_for_order', '0', !$productLanguage->product->available_for_order ? true : false)}}
											<i></i> No </label>
										</div>
									</div>
								</div>

								<div class="form-group">
									{{ Form::label('show_price', trans('products.labels.show_price'), ['class' => 'col-sm-4 control-label']) }}
									<div class="col-sm-8">
										<div class="radio i-checks">
											<label>
												{{ Form::radio('show_price', '1', $productLanguage->product->show_price ? true : false)}}
												<i></i> Yes
											</label>
										</div>
										<div class="radio i-checks">
											<label>
												{{ Form::radio('show_price', '0', !$productLanguage->product->show_price ? true : false)}}
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
												{{ Form::radio('accept_barter', '1', $productLanguage->product->accept_barter ? true : false)}}
												<i></i> Yes
											</label>
										</div>
										<div class="radio i-checks">
											<label>
												{{ Form::radio('accept_barter', '0', !$productLanguage->product->accept_barter ? true : false)}}
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
												{{ Form::radio('product_for_barter', '1', $productLanguage->product->product_for_barter ? true : false)}}
												<i></i> Yes
											</label>
										</div>
										<div class="radio i-checks">
											<label>
												{{ Form::radio('product_for_barter', '0', !$productLanguage->product->product_for_barter ? true : false)}}
												<i></i> No
											</label>
										</div>
									</div>
								</div>

								<div class="form-group">
									{{ Form::label('add_photos', trans('products.labels.add_photos'), ['class' => 'col-sm-4 control-label']) }}
									<div class="col-sm-8">
										<div class="radio i-checks">
											<label>
												{{ Form::radio('add_photos', '1', 1)}}
												<i></i> Yes
											</label>
										</div>
										<div class="radio i-checks">
											<label>
												{{ Form::radio('add_photos', '0', 0)}}
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
										{{ Form::select('categories[]',$categories, $productLanguage->product->categories->lists('id') ,array('class' => 'chosen-select form-control', 'multiple' => 'multiple', 'data-placeholder' => 'Choose a Categories...')) }}

									</div>
								</div>

								<div class="form-group">
									{{ Form::label('condition_id', trans('products.labels.condition'), ['class' => 'col-sm-2 control-label']) }}
									<div class="col-sm-10">
										{{ Form::select('condition_id',$condition,$productLanguage->product->condition->id,array('class' => 'chosen-select form-control', 'data-placeholder' => 'Choose a Condition...')) }}
									</div>
								</div>
								
								<div class="form-group">
									{{ Form::label('color', trans('invoiceStatus.labels.color'),['class'=>'col-sm-4 control-label']) }}
									<div class="col-sm-8">
										{{ Form::select('color',array(
											'#7bd148' => 'Green',
											'#5484ed' =>'Bold blue',
											'#a4bdfc' => 'Blue',
											'#46d6db' => 'Turquoise',
											'#7ae7bf' => 'Light green',
											'#51b749' => 'Bold green',
											'#fbd75b' => 'Yellow',
											'#ffb878' => 'Orange',
											'#ff887c' => 'Red',
											'#dc2127' => 'Bold red',
											'#dbadff' => 'Purple',
											'#e1e1e1' => 'Gray',
											)
											,null,['class' => 'form-control','id' => 'color']) }}
									</div>
								</div>

							</div>

							<div class="col-lg-12">
								<div class="form-group">
									<div class="col-sm-4 col-sm-offset-2">
										{{ Form::submit(trans('products.edit_view.save'), ['class' => 'btn btn-primary']) }}
									</div>
								</div>
							</div>

							<div class="clearfix"></div>
							{{Form::close()}}
						</div>
					</div>
				</div>
			</div>		
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

			 $('select[name="color"]').simplecolorpicker({picker: true, theme: 'glyphicons'});

			$.validator.addMethod('onlyLettersNumbersAndSpaces', function(value, element) {
				return this.optional(element) || /^[a-zA-Z0-9ñÑ\s]+$/i.test(value);
			}, 'only letters, numbers and spaces.');

			$('#formUpdateProduct').validate({
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

			var options = {
					beforeSubmit:  showRequest,  // pre-submit callback
					success:       showResponse,  // post-submit callback
					url:  '{{URL::route('products.update', $productLanguage->product->id)}}',
					type:'POST'
				};
			$('#formUpdateProduct').ajaxForm(options);

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
				return $('#formUpdateProduct').valid();
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
