@section('scripts')
  <script>

    @include('wishlist.partials._add-to-wishlist-js')
    @include('carts.partials._add-to-cart-js')

    var initImageZoom = function () {
        jQuery('.product-main-image').zoom({url: jQuery('.product-main-image img').attr('data-BigImgSrc')});
	}

    var initTouchspin = function () {
	  jQuery(".product-quantity .form-control").TouchSpin({
	      buttondown_class: "btn quantity-down",
          buttonup_class: "btn quantity-up"
	  });
	  jQuery(".quantity-down").html("<i class='fa fa-angle-down'></i>");
	  jQuery(".quantity-up").html("<i class='fa fa-angle-up'></i>");
	}

    var handleFancybox = function () {
        if (!jQuery.fancybox) {
            return;
        }

        jQuery(".fancybox-fast-view").fancybox();

        if (jQuery(".fancybox-button").size() > 0) {
            jQuery(".fancybox-button").fancybox({
                groupAttr: 'data-rel',
                prevEffect: 'none',
                nextEffect: 'none',
                closeBtn: true,
                helpers: {
                    title: {
                        type: 'inside'
                    }
                }
            });

            $('.fancybox-video').fancybox({
                type: 'iframe'
            });
        }
    }

    var rating = function() {
        jQuery("#rating").bind('rated', function (event, value) {
            alert('You\'ve rated it: ' + value);
        });
    }

    jQuery(document).ready(function(){
		handleFancybox();
		initImageZoom();
		initTouchspin();
        addToWishlist();
        removeFromWishList();
        addToCart();
        removeFromCart();
        rating();
    });
  </script>
@stop