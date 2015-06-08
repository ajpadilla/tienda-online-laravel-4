{{ $table->render() }}

@if(!isset($scriptTableTemplate))
	@section('scripts')	
		{{ $table->script() }}
	@stop
@endif