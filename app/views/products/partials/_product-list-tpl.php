<script id="product-list-tpl" type="text/x-handlebars-template">
  <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
    <div class="product-item">
      <div class="pi-img-wrapper">
        <img class="img-responsive" src="{{ url_img }}" alt="not-path">
        <div>
          <a href="{{ url_img }}" class="btn btn-default fancybox-button" alt="not-path">
            <i class="fa fa-search-plus fa-3x"></i>
          </a>
          <a href="#product-pop-up-{{ Id }}" class="btn btn-default fancybox-fast-view"><i class="fa fa-eye fa-3x"></i></a>
        </div>
      </div>
      <h3>
        <a href="{{ url_show }}">{{ name }}</a>
      </h3>
      <div class="pi-price">{{ price }}</div>
      <a href="{{ url_cart }}" class="add_cart btn btn-default add2cart"><i class="fa fa-shopping-cart"></i></a>
      <a href="{{ url_wishlist }}" class="add_wishlist btn btn-default add2cart"><i class="fa fa-check-square-o"></i></a>
      <div class="sticker sticker-sale"></div>
    </div>
  </div>
</script>



