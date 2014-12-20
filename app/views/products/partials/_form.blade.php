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
			{{ Form::text('quantity', null, ['class' => 'form-control', 'placeholder' => '']) }}
		</div>
	</div>

	<div class="form-group">
		{{ Form::label('price', trans('products.labels.price'), ['class' => 'col-sm-2 control-label']) }}
		<div class="col-sm-10">
			{{ Form::text('price', null, ['class' => 'form-control', 'placeholder' =>'']) }}
		</div>
	</div>

	<div class="form-group">
		{{ Form::label('point_price', trans('products.labels.point_price'), ['class' => 'col-sm-2 control-label']) }}
		<div class="col-sm-10">
			{{ Form::text('point_price', null, ['class' => 'form-control', 'placeholder' => '']) }}
		</div>
	</div>

	<div class="form-group"><label class="col-sm-2 control-label">{{ trans('products.labels.measure') }}</label>
	    <div class="col-sm-10">
	        <div class="row">
	            <div class="col-md-3">{{ Form::text('width', null, ['class' => 'form-control', 'placeholder' => trans('products.labels.width')]) }}</div>
	            <div class="col-md-3">{{ Form::text('height', null, ['class' => 'form-control', 'placeholder' => trans('products.labels.height')]) }}</div>
	            <div class="col-md-3">{{ Form::text('depth', null, ['class' => 'form-control', 'placeholder' => trans('products.labels.depth')]) }}</div>
	            <div class="col-sm-3">
	                {{
	                    Form::select('measure_id', $measures, null,
	                    array('class' => 'chosen-select form-control',
	                    'data-placeholder' => trans('products.labels.measure')))
	                }}
	            </div>
	        </div>
	    </div>
	</div>

	<div class="form-group">
		{{ Form::label('weight', trans('products.labels.weight'), ['class' => 'col-sm-2 control-label']) }}
	    <div class="col-sm-10">
	        <div class="input-group m-b">
	            <div class="col-sm-6">
	                {{ Form::text('weight', null, ['class' => 'form-control', 'placeholder' => '']) }}
	            </div>
	            <div class="col-sm-4">
		            {{
				        Form::select('weight_id', $weights, null,
				        array('class' => 'chosen-select form-control',
				        'data-placeholder' => trans('products.labels.measure')))
				    }}
			    </div>
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

<div class="col-lg-6 col-lg-offset-2">
	<div class="form-group">
		<div class="col-sm-3">
			<button type="submit" class="pull-right btn btn-primary" name="add_photos" value="1">Guardar</button>
		</div>
		<div class="col-sm-3">
			<button type="submit" class="pull-right btn btn-primary" name="add_photos" value="0">{{ trans('products.labels.add_photos') }}</button>
		</div>
	</div>
</div>

<div class="clearfix"></div>

