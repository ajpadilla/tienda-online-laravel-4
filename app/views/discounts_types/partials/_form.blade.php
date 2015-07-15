<div class="col-sm-6 b-r">
	<div class="form-group">
		{{ Form::label('language_id', trans('discountType.labels.language'),['class'=>'col-sm-2 control-label']) }}
		<div class="col-sm-8">
			{{ Form::select('language_id',$languages,null,array('class' => 'form-control','id'=>'language_id')) }}
		</div>
	</div>
	
	<div class="form-group" style="display: none">
		{{ Form::label('discount_type_id','id', ['class' => 'col-sm-2 control-label']) }}
		<div class="col-sm-10">
			{{ Form::text('discount_type_id', null, ['class' => 'form-control', 'placeholder' =>'','id'=> 'discount_type_id']) }}
		</div>
	</div>

	<div class="form-group">
		{{ Form::label('name',trans('discountType.labels.name'),['class'=>'col-sm-2 control-label']) }}
		<div class="col-sm-8">
			{{ Form::text('name',null, ['class' => 'form-control','id'=>'name_discount_type']) }}
		</div>
	</div>
</div>
<div class="col-sm-6">
	<div class="form-group">
		<div class="col-sm-4 col-sm-offset-2">
			{{ Form::submit(trans('discountType.labels.save'), ['class' => 'btn btn-primary']) }}
		</div>
	</div>
</div>