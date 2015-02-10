<div class="col-lg-7">

	<div class="form-group">
		{{ Form::label('language_id', trans('classifieds.labels.language'),['class'=>'col-sm-2 control-label']) }}
		<div class="col-sm-10">
			{{ Form::select('language_id',$languages,null,['class' => 'form-control','id'=>'lang_id']) }}
		</div>
	</div>

	<div class="form-group" style="display: none">
		{{ Form::label('classified_id','id', ['class' => 'col-sm-2 control-label']) }}
		<div class="col-sm-10">
			{{ Form::text('classified_id', null, ['class' => 'form-control', 'placeholder' =>'','id'=> 'classified_id_language']) }}
		</div>
	</div>


	<div class="form-group">
		{{ Form::label('name',  trans('classifieds.labels.name') , ['class' => 'col-sm-2 control-label']) }}
		<div class="col-sm-10">
			{{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name', 'id' => 'name_language']) }}
		</div>
	</div>

	<div class="form-group">
		{{ Form::label('description', trans('classifieds.labels.description'), ['class' => 'col-sm-2 control-label']) }}
		<div class="col-sm-10">
			<div class="ibox-content no-padding">
				{{ Form::textarea('description', null, ['class' => 'form-control summernote', 'id' => 'description_language']) }}
			</div>
		</div>
	</div>

	<div class="form-group">
		{{ Form::label('address', trans('classifieds.labels.address'),['class'=>'col-sm-2 control-label']) }}
		<div class="col-sm-10">
			{{ Form::textarea('address',null, ['class' => 'form-control summernote','id' => 'address_language']) }}
		</div>
	</div>
	
</div>

<div class="col-lg-6 col-lg-offset-2">
	<div class="form-group">
		<div class="col-sm-3">
			<button type="submit" class="pull-right btn btn-primary" name="add_photos" value="0">{{ trans('classifieds.labels.save') }}</button>
		</div>
	</div>
</div>

<div class="clearfix"></div>

