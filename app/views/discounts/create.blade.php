@extends('layouts.template')

@section('title')
{{--{{ Lang::get('modulo.variable') }}--}}
@stop

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>Create discount</h5>
				@if ($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach($errors->all() as $error)
						<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
				@endif
			</div>
			<div class="ibox-content">
				{{ Form::open(['route' => 'discounts.store','class'=>'form-horizontal','method' => 'POST','id' => 'formCreateDiscount']) }}
				<div class="form-group">
					{{ Form::label('name', 'Name:',['class'=>'col-sm-2 control-label']) }}
					<div class="col-sm-8">
						{{ Form::text('name',null, ['class' => 'form-control']) }}
					</div>
				</div>
				<div class="hr-line-dashed"></div>
				<div class="form-group">
					{{ Form::label('description', 'Description:',['class'=>'col-sm-2 control-label']) }}
					<div class="col-sm-8">
						{{ Form::textarea('description',null, ['class' => 'form-control', 'rows' => '3']) }}
					</div>
				</div>
				<div class="hr-line-dashed"></div>
				<div class="form-group">
					{{ Form::label('value', 'Value:',['class'=>'col-sm-2 control-label']) }}
					<div class="col-sm-8">
						{{ Form::text('value',null, ['class' => 'form-control']) }}
					</div>
				</div>
				<div class="hr-line-dashed"></div>
				<div class="form-group">
					{{ Form::label('percent', 'Percent:',['class'=>'col-sm-2 control-label']) }}
					<div class="col-sm-8">
						{{ Form::text('percent',null, ['class' => 'form-control']) }}
					</div>
				</div>
				<div class="form-group">
					{{ Form::label('quantity', 'Quantity:',['class'=>'col-sm-2 control-label']) }}
					<div class="col-sm-8">
						{{ Form::text('quantity',null, ['class' => 'form-control']) }}
					</div>
				</div>
				<div class="hr-line-dashed"></div>
				<div class="form-group">
					{{ Form::label('quantity_per_user', 'Quantity Per User:',['class'=>'col-sm-2 control-label']) }}
					<div class="col-sm-8">
						{{ Form::text('quantity_per_user',null, ['class' => 'form-control']) }}
					</div>
				</div>
				<div class="form-group">
					{{ Form::label('code', 'Code:',['class'=>'col-sm-2 control-label']) }}
					<div class="col-sm-8">
						{{ Form::text('code',null, ['class' => 'form-control']) }}
					</div>
				</div>
				<div class="hr-line-dashed"></div>
				<div class="form-group">
					{{ Form::label('active', 'Active:',['class'=>'col-sm-2 control-label']) }}
					<div class="col-sm-10">
						<div class="radio i-checks">
							<label> 
								<!--<input type="radio" value="option1" name="a">-->
								{{ Form::radio('active', '1', 1)}}
								<i></i> Yes
							</label>
						</div>
						<div class="radio i-checks">
							<label> 
								<!--<input type="radio" value="option1" name="a">--> 
								{{ Form::radio('active', '0', 0)}}
								<i></i> No
							</label>
						</div>
					</div>
				</div>
				<div class="hr-line-dashed"></div>
				<div class="form-group">
					{{ Form::label('from', 'From:',['class'=>'col-sm-2 control-label']) }}
					<div class="col-sm-8">
						{{ Form::text('from',null, ['class' => 'form-control','id'=>'from']) }}
					</div>
				</div>
				<div class="hr-line-dashed"></div>
				<div class="form-group">
					{{ Form::label('to', 'To:',['class'=>'col-sm-2 control-label']) }}
					<div class="col-sm-8">
						{{ Form::text('to',null, ['class' => 'form-control','id'=>'to']) }}
					</div>
				</div>
				<div class="hr-line-dashed"></div>
				<div class="form-group">
					<div class="col-sm-4 col-sm-offset-2">
						{{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
					</div>
				</div>
				{{ Form::close() }}
			</div>
		</div>
	</div>
</div>
@stop

@section('scripts')
<script>
	$(document).ready(function () {
		$('.i-checks').iCheck({
			checkboxClass: 'icheckbox_square-green',
			radioClass: 'iradio_square-green',
		});

		$('#from').datepicker({
			showButtonPanel: true,
			changeMonth: true,
			changeYear: true,
			yearRange: '2014:2020',
			dateFormat: 'yy-mm-dd'
		});

		$('#to').datepicker({
			showButtonPanel: true,
			changeMonth: true,
			changeYear: true,
			yearRange: '2002:2012', 
			dateFormat: 'yy-mm-dd'
		});

		var options = { 
				beforeSubmit:  showRequest,  // pre-submit callback 
				success:       showResponse,  // post-submit callback 
				url:  '{{URL::route('discounts.store')}}',
        		type:'POST'
			};
		$('#formCreateDiscount').ajaxForm(options);
	});

	// pre-submit callback 
		function showRequest(formData, jqForm, options) {          
			setTimeout(jQuery.fancybox({
				'content': '<h1>Enviando datos</h1>',
				'autoScale' : true,
				'transitionIn' : 'none',
				'transitionOut' : 'none',
				'scrolling' : 'no',         
				'type' : 'inline',
				'showCloseButton' : false,
				'hideOnOverlayClick' : false,
				'hideOnContentClick' : false    
			}), 5000 );  
			//return $('#formCreateDiscount').valid(); 
		} 
														     
		// post-submit callback 
		function showResponse(responseText, statusText, xhr, $form)  {    
			jQuery.fancybox({
				'content' : '<h1>'+ responseText + '</h1>',
				'autoScale' : true
			});
		} 						
</script>
@stop