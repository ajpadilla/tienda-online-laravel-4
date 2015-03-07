<div class="col-md-6 col-sm-6">
	<div class="product-main-image">
  	@if($product->hasPhotos())
        <img src="{{ asset($product->getFirstPhotoAttribute()->complete_path) }}" alt="{{ $product->getFirstPhotoAttribute()->filename }}" class="img-responsive" data-BigImgsrc="{{ asset($product->getFirstPhotoAttribute()->complete_path) }}">
      </div>
      <div class="product-other-images">
      	@foreach($product->photos as $photo)
        	<a href="#" class="active fancybox-button" rel="photos-lib"><img src="{{ asset($photo->complete_path) }}" alt="{{ $photo->filename }}"></a>
        @endforeach
      </div>
  @else
      <img src="{{ asset('uploads/products/images/model1.jpg') }}" alt="Cool green dress with red bell" class="img-responsive">
      </div>
      <div class="product-other-images">
        <a href="#" class="active"><img alt="Berry Lace Dress" src="{{ asset('uploads/products/images/model1.jpg') }}"></a>
        <a href="#"><img alt="Berry Lace Dress" src="{{ asset('uploads/products/images/model4.jpg') }}"></a>
        <a href="#"><img alt="Berry Lace Dress" src="{{ asset('uploads/products/images/model5.jpg') }}"></a>
      </div>
  @endif
</div>