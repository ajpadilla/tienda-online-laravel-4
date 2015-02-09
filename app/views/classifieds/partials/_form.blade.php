<div class="col-lg-7">
	<div class="form-group">
		{{ Form::label('language_id', trans('classifieds.labels.language'),['class'=>'col-sm-2 control-label']) }}
		<div class="col-sm-10">
			{{ Form::select('language_id',$languages,null,array('class' => 'form-control','id'=>'language_id')) }}
		</div>
	</div>

	<div class="form-group">
		{{ Form::label('name', trans('classifieds.labels.name'),['class'=>'col-sm-2 control-label']) }}
		<div class="col-sm-10">
			{{ Form::text('name',null, ['class' => 'form-control']) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('description', trans('classifieds.labels.description'),['class'=>'col-sm-2 control-label']) }}
		<div class="col-sm-10">
			{{ Form::textarea('description',null, ['class' => 'form-control summernote', 'rows' => '3']) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('address', trans('classifieds.labels.address'),['class'=>'col-sm-2 control-label']) }}
		<div class="col-sm-10">
			{{ Form::textarea('address',null, ['class' => 'form-control summernote', 'rows' => '3']) }}
		</div>
	</div>

	<div class="form-group">
		{{ Form::label('price', trans('classifieds.labels.price'),['class'=>'col-sm-2 control-label']) }}
		<div class="col-sm-10">
			{{ Form::text('price',null, ['class' => 'form-control']) }}
		</div>
	</div>

	<div class="form-group">
		{{ Form::label('classified_type_id', trans('classifieds.labels.classified_type'),['class'=>'col-sm-2 control-label']) }}
		<div class="col-sm-10">
			{{ Form::select('classified_type_id',$classified_types,null,array('class' => 'form-control')) }}
		</div>
	</div>

	<div class="form-group">
		{{ Form::label('classified_condition_id', trans('classifieds.labels.classified_condition'),['class'=>'col-sm-2 control-label']) }}
		<div class="col-sm-10">
			{{ Form::select('classified_condition_id',$classified_conditions,null,array('class' => 'form-control')) }}
		</div>
	</div>
</div>



<div class="col-lg-6 col-lg-offset-2">
	<div class="form-group">
		<div class="col-sm-3">
			<button type="submit" class="pull-right btn btn-primary" name="save_data" value="0">{{ trans('classifieds.labels.save') }}</button>
		</div>
		<div class="col-sm-3">
			<button type="submit" class="pull-right btn btn-primary" name="add_photos" value="1">{{ trans('classifieds.labels.add_photos') }}</button>
		</div>
	</div>
</div>

<div class="clearfix"></div>