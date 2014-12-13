<div class="col-lg-7">
	<div class="form-group">
		{{ Form::label('language_id', trans('products.labels.language'),['class'=>'col-sm-2 control-label']) }}
		<div class="col-sm-10">
			{{ Form::select('language_id',$languages,null,array('class' => 'form-control','id'=>'language_id')) }}
		</div>
	</div>

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
		{{ Form::label('measure_id', trans('products.labels.measure'), ['class' => 'col-sm-2 control-label']) }}
		<div class="col-sm-10">
			{{ Form::select('measure_id',$measures,null,array('class' => 'chosen-select form-control', 'data-placeholder' => 'Choose a measure...')) }}
		</div>
	</div>

	<div class="form-group">
		{{ Form::label('width', trans('products.labels.width'), ['class' => 'col-sm-2 control-label']) }}
		<div class="col-sm-10">
			{{ Form::text('width', null, ['class' => 'form-control', 'placeholder' => 'Width']) }}
		</div>
	</div>

	<div class="form-group">
		{{ Form::label('height', trans('products.labels.height'), ['class' => 'col-sm-2 control-label']) }}
		<div class="col-sm-10">
			{{ Form::text('height', null, ['class' => 'form-control', 'placeholder' => 'Height']) }}
		</div>
	</div>

	<div class="form-group">
		{{ Form::label('depth', trans('products.labels.depth'), ['class' => 'col-sm-2 control-label']) }}
		<div class="col-sm-10">
			{{ Form::text('depth', null, ['class' => 'form-control', 'placeholder' => 'Depth']) }}
		</div>
	</div>

	<div class="form-group">
		{{ Form::label('weight', trans('products.labels.weight'), ['class' => 'col-sm-2 control-label']) }}
		<div class="col-sm-10">
			{{ Form::text('weight', null, ['class' => 'form-control', 'placeholder' => 'Weight']) }}
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
		{{ Form::label('accept_barter', trans('products.labels.accept_barter'), ['class' => 'col-sm-4 control-label']) }}
		<div class="col-sm-8">
			<div class="radio i-checks">
				<label>
					{{ Form::radio('accept_barter', '1', 1)}}<i></i>Yes
				</label>
			</div>
			<div class="radio i-checks">
				<label>
					{{ Form::radio('accept_barter', '0', 0)}}<i></i> No
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
</div>

<div class="col-lg-7">
	<div class="form-group">
		{{ Form::label('categories', trans('products.labels.categories'), ['class' => 'col-sm-2 control-label']) }}
		<div class="col-sm-10">
			{{
				Form::select('categories[]', $categories, null,
				array('class' => 'chosen-select form-control',
				'multiple' => 'multiple', 'data-placeholder' => 'Escoge Categorías...'))
			}}
		</div>
	</div>

	<div class="form-group">
		{{ Form::label('condition_id', trans('products.labels.condition'), ['class' => 'col-sm-2 control-label']) }}
		<div class="col-sm-10">
			{{
				Form::select('condition_id', $condition, null,
				array('class' => 'chosen-select form-control', 'data-placeholder' => 'Choose a Condition...'))
			}}
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

