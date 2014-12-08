@extends('layouts.template')

@section('title')
{{--{{ Lang::get('modulo.variable') }}--}}
{{ trans('categories.show_data.title') }}
@stop

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>{{ trans('categories.show_data.subtitle') }}</h5>
			</div>
			<div class="ibox-content">
				<div class="row">
					{{ Form::open(['url' => LaravelLocalization::transRoute('categories.store'),'class'=>'form-horizontal','method' => 'POST','id' => 'formCreatecategories']) }}
					<div class="col-sm-6 b-r">
						<div class="form-group">
							{{ Form::label('language_id', trans('categories.labels.language'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-8">
								{{ Form::text('language_id',$categoryLanguage->name, ['class' => 'form-control','id'=>'language_id','readonly']) }}
							</div>
						</div>
							
						@if(!empty($parentCategoryLanguage))
							<div class="form-group">
								{{ Form::label('parent_category',trans('categories.labels.parent_category'),['class'=>'col-sm-2 control-label']) }}
								<div class="col-sm-8">
									{{ Form::text('parent_category',$parentCategoryLanguage->pivot->name, ['class' => 'form-control','id'=>'name','readonly']) }}
								</div>
							</div>
						@endif
						
						<div class="form-group">
							{{ Form::label('name',trans('categories.labels.name'),['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-8">
								{{ Form::text('name',$categoryLanguage->pivot->name, ['class' => 'form-control','id'=>'name','readonly']) }}
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