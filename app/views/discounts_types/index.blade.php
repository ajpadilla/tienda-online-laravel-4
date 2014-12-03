@extends('layouts.template')

@section('title')
{{--{{ Lang::get('modulo.variable') }}--}}
{{ trans('discountType.list.title') }}
@stop

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>{{ trans('discountType.list.subtitle') }}</h5>
			</div>
			@include('flash::message')
			<div class="ibox-content">
				<a class="btn btn-info " href="{{route('discountType.create')}}"><i class="fa fa-paste"></i> {{ trans('discountType.labels.new') }} </a>
				<?php
					$columns = [
						trans('discountType.list.Name'),
						trans('discountType.list.Actions')
				];
				$table = Datatable::table()
				->addColumn($columns)
				->setUrl(route('api.discountType'))
				->noScript();
				?>
				<div class="row"><br/></div>
				{{ $table->render() }}
			</div>
		</div>
	</div>
</div>
@stop

@section('scripts')
	{{ $table->script() }}
	<script>
		jQuery(".btn.btn-info").fancybox({
           		centerOnScroll: true,
            	hideOnOverlayClick: true,
            	type:'iframe',
        });

        jQuery(".btn.btn-warning").fancybox({
           		centerOnScroll: true,
            	hideOnOverlayClick: true,
            	type:'iframe',
        });
        
	</script>
@stop