<div class="col-sm-6 b-r">

	<div class="form-group">
		{{ Form::label('language_id', trans('categories.labels.language'),['class'=>'col-sm-2 control-label']) }}
		<div class="col-sm-6">
			{{ Form::select('language_id',$languages,null,array('class' => 'form-control','id'=>'language-edit-id')) }}
		</div>
	</div>

	<div class="form-group" style="display: none">
		{{ Form::label('category_id','id', ['class' => 'col-sm-2 control-label']) }}
		<div class="col-sm-10">
			{{ Form::text('category_id', null, ['class' => 'form-control', 'placeholder' =>'','id'=> 'category-edit-id']) }}
		</div>
	</div>

	@if(!empty($categories))
	<div class="form-group">
		{{ Form::label('parent_category', trans('categories.labels.parent_category'),['class'=>'col-sm-2 control-label']) }}
		<div class="col-sm-6">
			{{ Form::select('parent_category',$categories,null,array('class' => 'chosen-select form-control', 'data-placeholder' => 'Choose a parent category...', 'id' => 'parent-category-edit')) }}
		</div>
	</div>
	@endif
	<div class="form-group">
		{{ Form::label('name', trans('categories.labels.name'),['class'=>'col-sm-2 control-label']) }}
		<div class="col-sm-6">
			{{ Form::text('name',null, ['class' => 'form-control', 'id' => 'category-name-edit']) }}
		</div>
	</div>
</div>

<div class="col-sm-6">
	<div class="form-group">
		<div class="col-sm-4 col-sm-offset-2">
			{{ Form::submit(trans('categories.labels.save'), ['class' => 'btn btn-primary']) }}
		</div>
	</div>
</div>