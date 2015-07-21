<div class="product-item">
  <div class="pi-img-wrapper">
    @if($classified->hasPhotos())
      <img class="img-responsive" src="{{ asset($classified->firstPhoto->complete_path) }}" alt="{{ $classified->firstPhoto->filename }}"/>
      <div>
        <a href="{{ asset($classified->firstPhoto->complete_path) }}" class="btn btn-default fancybox-button" alt=" {{ $classified->firstPhoto->filename }}"><i class="fa fa-search-plus fa-3x"></i>
        </a>
    @else
      <img class="img-responsive" src="{{ asset('/uploads/products/images/model1.jpg') }}" alt="not-path"/>
      <div>
      <a href="{{ asset('/uploads/products/images/model1.jpg') }}" class="btn btn-default fancybox-button" alt="not-path">
        <i class="fa fa-search-plus fa-3x"></i>
      </a>
    @endif
      <a href="#product-pop-up-{{ $classified->id }}" class="btn btn-default fancybox-fast-view"><i class="fa fa-eye fa-3x"></i></a>
    </div>
    </div>
    <h3>
    <a href="{{ route('classifieds.show', $classified->id) }}">{{ $classified->inCurrentLang->name }}</a>
    </h3>
    <div class="pi-price">{{ $classified->priceWithCurrency }}</div><br>
    <a href="{{ route('cart.create', $classified->id) }}" class="add_cart btn btn-default add2cart"><i class="fa fa-shopping-cart"></i></a>
    <a href="{{ route('wishlist.create', $classified->id) }}" class="add_wishlist btn btn-default add2cart"><i class="fa fa-check-square-o"></i></a>
    {{--<div class="sticker {{ $currentSticker }}"></div>--}}
</div>