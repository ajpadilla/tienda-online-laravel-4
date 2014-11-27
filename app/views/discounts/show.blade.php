@extends('layouts.template')

@section('title')
{{--{{ trans('discounts.labels.name')}}--}}
{{	trans('discounts.show_data.title') }}
@stop

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>{{	trans('discounts.show_data.subtitle') }}</h5>
			</div>
			<div class="ibox-content">
				<div class="row">
					{{ Form::open(['url' => LaravelLocalization::transRoute('discounts.store'),'class'=>'form-horizontal','method' => 'POST','id' => 'formCreateDiscount']) }}
					<div class="col-sm-6 b-r">
						<div class="form-group">
							{{ Form::label('language_id', trans('discounts.labels.language'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::text('code',$discount_language->name, ['class' => 'form-control','id' =>'code',
								'readonly']) }}
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('code', trans('discounts.labels.code'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::text('code',$discount->code, ['class' => 'form-control','id' =>'code',
								'readonly']) }}
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('name', trans('discounts.labels.name'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::text('name',$discount_language->pivot->name, ['class' => 'form-control','readonly']) }}
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('description', trans('discounts.labels.description'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::textarea('description',$discount_language->pivot->description, ['class' => 'form-control', 'rows' => '3','readonly']) }}
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('value',  trans('discounts.labels.value'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::text('value',$discount->value, ['class' => 'form-control','readonly']) }}
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('percent', trans('discounts.labels.percent'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::text('percent',$discount->percent, ['class' => 'form-control','readonly']) }}
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('quantity', trans('discounts.labels.quantity'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::text('quantity',$discount->quantity, ['class' => 'form-control','readonly']) }}
							</div>
						</div>
					</div>

					<div class="col-sm-6">
						<div class="form-group">
							{{ Form::label('quantity_per_user', trans('discounts.labels.quantity_per_user'),['class'=>'col-sm-4 control-label']) }}
							<div class="col-sm-6 ">
								{{ Form::text('quantity_per_user',$discount->quantity_per_user, ['class' => 'form-control','readonly']) }}
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('active', trans('discounts.labels.active'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::select('active',array('1'=>'Si','2'=>'No'),$discount->active,array('class' => 'form-control','readonly')) }}
							</div>
						</div>

						<div class="form-group">
							{{ Form::label('from', trans('discounts.labels.from'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::text('from',date($language->date_format ,strtotime($discount->from)), ['class' => 'form-control','readonly']) }}
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('to', trans('discounts.labels.to'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::text('to',date($language->date_format ,strtotime($discount->to)), ['class' => 'form-control','readonly']) }}
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('discount_type_id', trans('discounts.labels.discount_type'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::select('discount_type_id',$discountTypes,$discount->discountType->id,array('class' => 'form-control','selected')) }}
							</div>
						</div>
					</div>
					{{ Form::close() }}
				</div>
		</div>
	</div>
</div>
@stop

@section('scripts')
@stop