<script id="product-list-tpl" type="text/x-handlebars-template">
  <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
    <div class="product-item">
      <div class="pi-img-wrapper">
        <img class="img-responsive" src="{{ url_img }}" alt="not-path">
        <div>
          <a href="{{ url_img }}" class="btn btn-default fancybox-button" alt="not-path">
            <i class="fa fa-search-plus fa-3x"></i>
          </a>
          <a href="#product-pop-up-" class="btn btn-default fancybox-fast-view"><i class="fa fa-eye fa-3x"></i></a>
        </div>
      </div>
      <h3>
        <a href="">{{ name }}</a>
      </h3>
      <div class="pi-price">{{ price }}</div>
      <a href="" class="add_cart btn btn-default add2cart"><i class="fa fa-shopping-cart"></i></a>
      <a href="" class="add_wishlist btn btn-default add2cart"><i class="fa fa-check-square-o"></i></a>
      <div class="sticker sticker-sale"></div>
    </div>
  </div>
</script>

<script id="total-items-1-tpl" type="text/x-handlebars-template">
  <div class="col-md-4 col-sm-4 items-info">Productos desde {{ from }} hasta {{ to }} de {{ total }}</div>
  <div class="col-md-8 col-sm-8">
    {{ links }} 
  </div>
</script>

<script id="total-items-2-tpl" type="text/x-handlebars-template">
  <div class="col-md-4 col-sm-4 items-info">Productos desde {{ from }} hasta {{ to }}de {{ total }}</div>
  <div class="col-md-8 col-sm-8">
    {{ links }} 
  </div>
</script>

