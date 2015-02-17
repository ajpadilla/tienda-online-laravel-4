<div class="product-item">
  <div class="pi-img-wrapper">
    <img src="../../assets/frontend/pages/img/products/model1.jpg" class="img-responsive" alt="Berry Lace Dress">
    <div>
      <a href="../../assets/frontend/pages/img/products/model1.jpg" class="btn btn-default fancybox-button">Zoom</a>
      <a href="#product-pop-up" class="btn btn-default fancybox-fast-view">View</a>
    </div>
  </div>
  <h3><a href="shop-item.html">Berry Lace Dress</a></h3>
  <div class="pi-price">$29.00</div>
  <a href="#" class="btn btn-default add2cart">Add to cart</a>
</div>

{{--
<div class="product-item">
  <div class="pi-img-wrapper">
    @if($product->hasPhotos())
    <img class="img-responsive" src="{{ asset($product->getFirstPhoto()->complete_path) }}" alt="{{ $product->getFirstPhoto()->filename }}"/>
    <div>
      <a href="{{ asset($product->getFirstPhoto()->complete_path) }}" class="btn btn-default fancybox-button" alt=" {{ $product->getFirstPhoto()->filename }}"><i class="fa fa-search-plus fa-3x"></i>
      </a>
      @else
      <img class="img-responsive" src="{{ asset('/uploads/products/images/model1.jpg') }}" alt="not-path"/>
      <div>
        <a href="{{ asset('/uploads/products/images/model1.jpg') }}" class="btn btn-default fancybox-button" alt="not-path">
          <i class="fa fa-search-plus fa-3x"></i>
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
  --}}