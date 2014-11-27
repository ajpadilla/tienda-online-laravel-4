@extends('layouts.template')

@section('title')
{{--{{ trans('classifieds.labels.name')}}--}}
{{	trans('classifieds.show_data.title') }}
@stop

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>{{	trans('classifieds.show_data.subtitle') }}</h5>
			</div>
			<div class="ibox-content">
				<div class="row">
					{{ Form::open(['url' => LaravelLocalization::transRoute('classifieds.store'),'class'=>'form-horizontal','method' => 'POST','id' => 'formCreateClassified']) }}
					<div class="col-sm-6 b-r">
						<div class="form-group">
							{{ Form::label('language_id', trans('classifieds.labels.language'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
							{{ Form::text('language_id',$classified_language->name, ['class' => 'form-control','readonly']) }}
							</div>
						</div>
						
						<div class="form-group">
							{{ Form::label('name', trans('classifieds.labels.name'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::text('name',$classified_language->pivot->name, ['class' => 'form-control','readonly']) }}
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('description', trans('classifieds.labels.description'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::textarea('description',$classified_language->pivot->description, ['class' => 'form-control', 'rows' => '3','readonly']) }}
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('address', trans('classifieds.labels.address'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::textarea('address',$classified_language->pivot->address, ['class' => 'form-control', 'rows' => '3','readonly']) }}
							</div>
						</div>
					</div>

					<div class="col-sm-6">
						<div class="form-group">
							{{ Form::label('price', trans('classifieds.labels.price'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::text('price',$classified->price, ['class' => 'form-control','readonly']) }}
							</div>
						</div>

						<div class="form-group">
							{{ Form::label('classified_type_id', trans('classifieds.labels.classified_type'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::text('price',$classifiedType->pivot->name, ['class' => 'form-control','readonly']) }}
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('classified_condition_id', trans('classifieds.labels.classified_condition'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::text('price',$classifiedConditions->pivot->name, ['class' => 'form-control','readonly']) }}
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