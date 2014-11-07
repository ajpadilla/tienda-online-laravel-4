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
			</div>
			<div class="ibox-content">
				{{ Form::open(['route' => 'discounts_type.store','class'=>'form-horizontal','method' => 'POST','id' => 'formCreateDiscountType']) }}
				<div class="form-group">
					{{ Form::label('name', 'Name:',['class'=>'col-sm-2 control-label']) }}
					<div class="col-sm-8">
						{{ Form::text('name',null, ['class' => 'form-control']) }}
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
		var options = { 
				beforeSubmit:  showRequest,  // pre-submit callback 
				success:       showResponse,  // post-submit callback 
				url:  '{{URL::route('discounts.store')}}',
        		type:'POST'
			};
		$('#formCreateDiscountType').ajaxForm(options);
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
			//return $('#formCreateDiscountType').valid(); 
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