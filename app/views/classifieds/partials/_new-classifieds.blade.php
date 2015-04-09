@if($newClassifieds)
	@foreach($newClassifieds as $classified)
		<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
			@include('classifieds.partials._one-classified')
		</div>
    @endforeach
@endif