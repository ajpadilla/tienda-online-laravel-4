
<div class="col-sm-6 b-r">
	<div class="form-group">
		{{ Form::label('language_id', trans('classifiedConditions.labels.language'),['class'=>'col-sm-2 control-label']) }}
		<div class="col-sm-6">
			{{ Form::select('language_id',$languages,null,array('class' => 'form-control','id'=>'language_id')) }}
		</div>
	</div>
	
	<div class="form-group" style="display: none">
		{{ Form::label('classified_condition_id','id', ['class' => 'col-sm-2 control-label']) }}
		<div class="col-sm-10">
			{{ Form::text('classified_condition_id', null, ['class' => 'form-control', 'placeholder' =>'','id'=> 'classified_conditions_id']) }}
		</div>
	</div>

	<div class="form-group">
		{{ Form::label('name', trans('classifiedConditions.labels.name'),['class'=>'col-sm-2 control-label']) }}
		<div class="col-sm-6">
			{{ Form::text('name',null, ['class' => 'form-control', 'id' => 'name_classified_conditions']) }}
		</div>
	</div>

</div>

<div class="col-sm-6">
	<div class="form-group">
		<div class="col-sm-4 col-sm-offset-2">
			{{ Form::submit(trans('classifiedConditions.labels.save'), ['class' => 'btn btn-primary']) }}
		</div>
	</div>
</div>