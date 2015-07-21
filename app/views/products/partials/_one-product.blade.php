 @if(!empty($product->inCurrentLang))
<div class="product-item">
  <div class="pi-img-wrapper">
    @if($product->hasPhotos())
      <img class="img-responsive" src="{{ asset($product->getFirstPhotoAttribute()->complete_path) }}" alt="{{ $product->getFirstPhotoAttribute()->filename }}"/>
      <div>
        <a href="{{ asset($product->getFirstPhotoAttribute()->complete_path) }}" class="btn btn-default fancybox-button" alt=" {{ $product->getFirstPhotoAttribute()->filename }}"><i class="fa fa-search-plus fa-3x"></i>
        </a>
    @else
      <img class="img-responsive" src="{{ asset('/uploads/products/images/model1.jpg') }}" alt="not-path"/>
      <div>
      <a href="{{ asset('/uploads/products/images/model1.jpg') }}" class="btn btn-default fancybox-button" alt="not-path">
        <i class="fa fa-search-plus fa-3x"></i>
      </a>
    @endif
      <a href="#product-pop-up-{{ $product->id }}" class="btn btn-default fancybox-fast-view"><i class="fa fa-eye fa-3x"></i></a>
    </div>
    </div>
    <h3>
    <a href="{{ route('products.show', $product->id) }}">{{ $product->inCurrentLang->name }}</a>
    </h3>
    <div class="pi-price">{{ $product->priceWithCurrency }}</div><br>
    @if($product->hasInCartForUser($currentUser))
      <a href="{{ route('cart.create', $product->id) }}" class="delete-from-cart delete-from-cart-background btn btn-default add2cart"><i class="fa fa-shopping-cart"></i></a>
    @else
      <a href="{{ route('cart.create', $product->id) }}" class="add_cart btn btn-default add2cart"><i class="fa fa-shopping-cart"></i></a>
    @endif
    
    @if($product->hasInWishlistForUser($currentUser))
      <a href="{{ route('wishlist.create', $product->id) }}" class="delete-from-wishlist delete-from-wishlist-background btn btn-default add2cart"><i class="fa fa-check-square-o"></i></a>
    @else
      <a href="{{ route('wishlist.create', $product->id) }}" class="add_wishlist btn btn-default add2cart"><i class="fa fa-check-square-o"></i></a>
    @endif    
    {{--<div class="sticker {{ $currentSticker }}"></div>--}} 
</div>
@endif
