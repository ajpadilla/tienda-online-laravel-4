<div class="col-sm-6 b-r">
	<div class="form-group">
		{{ Form::label('language_id', trans('discounts.labels.language'),['class'=>'col-sm-2 control-label']) }}
		<div class="col-sm-6">
			{{ Form::select('language_id',$languages,null,array('class' => 'form-control chosen-select','id'=>'language_id')) }}
		</div>
	</div>

	<div class="form-group" style="display: none">
		{{ Form::label('discount_id','id', ['class' => 'col-sm-2 control-label']) }}
		<div class="col-sm-10">
			{{ Form::text('discount_id', null, ['class' => 'form-control', 'placeholder' =>'','id'=> 'discount_id']) }}
		</div>
	</div>

	<div class="form-group">
		{{ Form::label('code', trans('discounts.labels.code'),['class'=>'col-sm-2 control-label']) }}
		<div class="col-sm-6">
			{{ Form::text('code',Session::get('discount_code'), ['class' => 'form-control','id' =>'code']) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('name', trans('discounts.labels.name'),['class'=>'col-sm-2 control-label']) }}
		<div class="col-sm-6">
			{{ Form::text('name',null, ['class' => 'form-control', 'id' => 'name']) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('description', trans('discounts.labels.description'),['class'=>'col-sm-2 control-label']) }}
		<div class="col-sm-6">
		{{ Form::textarea('description',null, ['class' => 'form-control summernote', 'rows' => '3','id' => 'description']) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('value',  trans('discounts.labels.value'),['class'=>'col-sm-2 control-label']) }}
		<div class="col-sm-6">
			{{ Form::text('value',null, ['class' => 'form-control', 'id' => 'value']) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('percent', trans('discounts.labels.percent'),['class'=>'col-sm-2 control-label']) }}
		<div class="col-sm-6">
			{{ Form::text('percent',null, ['class' => 'form-control', 'id' => 'percent']) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('quantity', trans('discounts.labels.quantity'),['class'=>'col-sm-2 control-label']) }}
		<div class="col-sm-6">
			{{ Form::text('quantity',null, ['class' => 'form-control', 'id' => 'quantity']) }}
		</div>
	</div>
</div>

<div class="col-sm-6">
	<div class="form-group">
		{{ Form::label('quantity_per_user', trans('discounts.labels.quantity_per_user'),['class'=>'col-sm-4 control-label']) }}
		<div class="col-sm-6 ">
			{{ Form::text('quantity_per_user',null, ['class' => 'form-control', 'id' => 'quantity_per_user']) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('active', trans('discounts.labels.active'),['class'=>'col-sm-2 control-label']) }}
		<div class="col-sm-10">
			<div class="radio i-checks">
				<label> 
					<!--<input type="radio" value="option1" name="a">-->
					{{ Form::radio('active', '1', 1)}}
					<i></i> {{ trans('discounts.labels.Yes') }}
				</label>
			</div>
			<div class="radio i-checks">
				<label> 
					<!--<input type="radio" value="option1" name="a">--> 
					{{ Form::radio('active', '0', 0)}}
					<i></i> {{ trans('discounts.labels.No') }}
				</label>
			</div>
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('from', trans('discounts.labels.from'),['class'=>'col-sm-2 control-label']) }}
		<div class="col-sm-6">
			{{ Form::text('from',null, ['class' => 'form-control datepicker', 'id' => 'from']) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('to', trans('discounts.labels.to'),['class'=>'col-sm-2 control-label']) }}
		<div class="col-sm-6">
			{{ Form::text('to',null, ['class' => 'form-control datepicker', 'id' => 'to']) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('discount_type_id', trans('discounts.labels.discount_type'),['class'=>'col-sm-2 control-label']) }}
		<div class="col-sm-6">
			{{ Form::select('discount_type_id',$discountTypes,null,array('class' => 'form-control chosen-select', 'id' => 'discount_type_id')) }}
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-4 col-sm-offset-2">
			{{ Form::submit(trans('discounts.labels.save'), ['class' => 'btn btn-primary']) }}
		</div>
	</div>
</div>
