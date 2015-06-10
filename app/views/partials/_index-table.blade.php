{{ $table->render() }}

@if(!isset($scriptTableTemplate))
	@section('table')	
		{{ $table->script() }}
	@stop
@endif