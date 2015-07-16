<div class="col-lg-7">	
	<div class="form-group">
		{{ Form::label('language_id', trans('invoiceStatus.labels.language'),['class'=>'col-sm-2 control-label']) }}
		<div class="col-sm-6">
			{{ Form::select('language_id',$languages,null,array('class' => 'form-control','id'=>'language_id')) }}
		</div>
	</div>

	<div class="form-group" style="display: none">
		{{ Form::label('invoice_status_id','id', ['class' => 'col-sm-2 control-label']) }}
		<div class="col-sm-10">
			{{ Form::text('invoice_status_id', null, ['class' => 'form-control', 'placeholder' =>'','id'=> 'invoice_status_id']) }}
		</div>
	</div>


	<div class="form-group">
		{{ Form::label('name', trans('invoiceStatus.labels.name'),['class'=>'col-sm-2 control-label']) }}
		<div class="col-sm-6">
			{{ Form::text('name',null, ['class' => 'form-control', 'id' => 'name_invoice_status']) }}
		</div>
	</div>

	<div class="form-group">
		{{ Form::label('description', trans('invoiceStatus.labels.description'),['class'=>'col-sm-2 control-label']) }}
		<div class="col-sm-6">
			{{ Form::textarea('description',null, ['class' => 'form-control summernote', 'rows' => '3','id' => 'description_invoice_status']) }}
		</div>
	</div>

</div>

<div class="col-lg-5">
	<div class="form-group">
		{{ Form::label('color', trans('invoiceStatus.labels.color'),['class'=>'col-sm-2 control-label']) }}
		<div class="col-sm-6">
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

<div class="col-lg-6 col-lg-offset-2">
	<div class="form-group">
		<div class="col-sm-3">
			{{ Form::submit(trans('invoiceStatus.labels.save'), ['class' => 'btn btn-primary']) }}
		</div>
	</div>
</div>

<div class="clearfix"></div>
