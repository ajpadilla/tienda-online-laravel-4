<div class="col-lg-7">
	<div class="form-group">
		{{ Form::label('language_id', trans('discounts.labels.language'),['class'=>'col-sm-2 control-label']) }}
		<div class="col-sm-10">
			{{ Form::select('language_id',$languages,null,array('class' => 'form-control','id'=>'language-edit-id')) }}
		</div>
	</div>

	<div class="form-group" style="display: none">
		{{ Form::label('discount_id','id', ['class' => 'col-sm-2 control-label']) }}
		<div class="col-sm-10">
			{{ Form::text('discount_id', null, ['class' => 'form-control', 'placeholder' =>'','id'=> 'discount-edit-id']) }}
		</div>
	</div>

	<div class="form-group">
		{{ Form::label('name', trans('discounts.labels.name'),['class'=>'col-sm-2 control-label']) }}
		<div class="col-sm-10">
			{{ Form::text('name',null, ['class' => 'form-control', 'id' => 'discount-name-edit-lang']) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('description', trans('discounts.labels.description'),['class'=>'col-sm-2 control-label']) }}
		<div class="col-sm-10">
		{{ Form::textarea('description',null, ['class' => 'form-control summernote', 'rows' => '3','id' => 'discount-description-edit-lang']) }}
		</div>
	</div>
</div>

<div class="col-lg-6 col-lg-offset-2">
	<div class="form-group">
		<div class="col-sm-3">
			<button type="submit" class="pull-right btn btn-primary" name="" value="0">Guardar</button>
		</div>
	</div>
</div>
<div class="clearfix"></div>