@if($newProducts)
	@foreach($newProducts as $product)
		<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
		    <div class="product-item">
		        <div class="pi-img-wrapper">
					@if($product->hasPhotos())
			            <img class="img-responsive" src="{{ asset($product->getFirstPhoto()->complete_path) }}" alt="{{ $product->getFirstPhoto()->filename }}"/>
			            <div>
			              <a href="{{ asset($product->getFirstPhoto()->complete_path) }}" class="btn btn-default fancybox-button" alt="{{ $product->getFirstPhoto()->filename }}"><i class="fa fa-search-plus fa-3x"></i>
			</a>
					@else
			            <img class="img-responsive" src="{{ asset('/uploads/products/images/model1.jpg') }}" alt="not-path"/>
			            <div>
			              <a href="{{ asset('/uploads/products/images/model1.jpg') }}" class="btn btn-default fancybox-button" alt="not-path"><i class="fa fa-search-plus fa-3x"></i>
			</a>
					@endif
		              <a href="#product-pop-up-{{ $product->product_id }}" class="btn btn-default fancybox-fast-view"><i class="fa fa-eye fa-3x"></i></a>
		            </div>
		        </div>
		        <h3>
		            <a href="{{ route('products.show', $product->id) }}">{{ $product->inCurrentLang->name }}</a>
		        </h3>
		        <div class="pi-price">{{ $product->price }}</div>
		        <a href="{{ route('cart.create', $product->id) }}" class="add_cart btn btn-default add2cart"><i class="fa fa-shopping-cart"></i></a>
		        <a href="{{ route('wishlist.create', $product->id) }}" class="add_wishlist btn btn-default add2cart"><i class="fa fa-check-square-o"></i></a>
		        <div class="sticker sticker-sale"></div>
		    </div>
		</div>
    @endforeach
@endif
