<div class="product-page-content">
	<ul id="myTab" class="nav nav-tabs">
		<li><a href="#Description" data-toggle="tab">Description</a></li>
		<li><a href="#Information" data-toggle="tab">Information</a></li>
		<li class="active"><a href="#Reviews" data-toggle="tab">Reviews (2)</a></li>
	</ul>
	<div id="myTabContent" class="tab-content">
	<div class="tab-pane fade" id="Description">
	  <p>{{$product->inCurrentLang->description }} </p>
	</div>
	<div class="tab-pane fade" id="Information">
	  <table class="datasheet">
	    <tr>
	      <th colspan="2">Additional features</th>
	    </tr>
	    <tr>
	      <td class="datasheet-features-type">Value 1</td>
	      <td>21 cm</td>
	    </tr>
	    <tr>
	      <td class="datasheet-features-type">Value 2</td>
	      <td>700 gr.</td>
	    </tr>
	    <tr>
	      <td class="datasheet-features-type">Value 3</td>
	      <td>10 person</td>
	    </tr>
	    <tr>
	      <td class="datasheet-features-type">Value 4</td>
	      <td>14 cm</td>
	    </tr>
	    <tr>
	      <td class="datasheet-features-type">Value 5</td>
	      <td>plastic</td>
	    </tr>
	  </table>
	</div>
	<div class="tab-pane fade in active" id="Reviews">	  
		@if($product->hasRatings())
			@if($currentUser->ratingForProduct($product))
				<div class="review-item clearfix">
					<div class="review-item-submitted">
						<strong>You</strong>
						<em>{{ $currentUser->ratingForProduct($product)->created_at }}</em>
						<div class="rateit" data-rateit-value="{{ $currentUser->ratingForProduct($product)->points }}" data-rateit-ispreset="true" data-rateit-readonly="true"></div>
					</div>
					<div class="review-item-content">
					    <p>{{ $currentUser->ratingForProduct($product)->description }}</p>
					</div>
				</div>
			@endif			

			@foreach($product->ratings as $rating)
				@if($currentUser->ratingForProduct($product))	  
					@if($currentUser->id != $rating->user_id)	
						<div class="review-item clearfix">
							<div class="review-item-submitted">
								<strong>{{ $rating->user->people->name }}</strong>
								<em>{{ $rating->created_at }}</em>
								<div class="rateit" data-rateit-value="{{ $rating->points }}" data-rateit-ispreset="true" data-rateit-readonly="true"></div>
							</div>
							<div class="review-item-content">
							    <p>{{ $rating->description }}</p>
							</div>
						</div>
					@endif
				@else
					<div class="review-item clearfix">
						<div class="review-item-submitted">
							<strong>{{ $rating->user->people->name }}</strong>
							<em>{{ $rating->created_at }}</em>
							<div class="rateit" data-rateit-value="{{ $rating->points }}" data-rateit-ispreset="true" data-rateit-readonly="true"></div>
						</div>
						<div class="review-item-content">
						    <p>{{ $rating->description }}</p>
						</div>
					</div>				
				@endif
			@endforeach
		@else
			<p>There are no reviews for this product.</p>
		@endif
	  	<!-- BEGIN FORM-->
	  	@if(!$currentUser->ratingForProduct($product))
			<form id="reviews-form" action="{{ route('products.save-rating') }}" class="reviews-form" role="form">
				<input type="hidden" name="product_id" value="{{ $product->id }}">
				<h2>Write a review</h2>
				<div class="form-group">
					<label for="review">Review <span class="require">*</span></label>
					<textarea name="description" class="form-control" rows="8" id="review"></textarea>
				</div>
				<div class="form-group">
					<label for="email">Rating</label>
					<input id="rating-input" name="points" type="range" type="range" value="{{ $product->rating }}" step="0.5">
					<div id="rating" class="rateit" data-rateit-backingfld="#rating-input" data-rateit-resetable="false" data-rateit-ispreset="true" data-rateit-min="0" data-rateit-max="5"></div>
				</div>
			</form>
		@endif	
	  <!-- END FORM-->
	</div>
	</div>
</div>