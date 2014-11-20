@extends('layouts.template')

@section('title')
{{--{{ Lang::get('modulo.variable') }}--}}
{{ trans('classifiedTypes.title') }}
@stop

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>{{ trans('classifiedTypes.subtitle') }}</h5>
			</div>
			<div class="ibox-content">
				<div class="row">
					{{ Form::open(['url' => LaravelLocalization::transRoute('classifiedTypes.store'),'class'=>'form-horizontal','method' => 'POST','id' => 'formCreateclassifiedTypes']) }}
					<div class="col-sm-6 b-r">
						<div class="form-group">
							{{ Form::label('language_id', trans('classifiedTypes.labels.language'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-8">
								{{ Form::text('language_id',$classified_type_language->name, ['class' => 'form-control','id'=>'language_id','readonly']) }}
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('name',trans('classifiedTypes.labels.name'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-8">
								{{ Form::text('name',$classified_type_language->pivot->name, ['class' => 'form-control','id'=>'name','readonly']) }}
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