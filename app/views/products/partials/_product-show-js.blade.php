@section('in-situ-js')
	<script src="{{ asset('assets/js/plugins/rateit/jquery.rateit.min.js') }}" type="text/javascript"></script><!-- product zoom -->
	<script src="{{ asset('assets/js/plugins/zoom/jquery.zoom.min.js') }}" type="text/javascript"></script><!-- product zoom -->
	<script src="{{ asset('assets/js/plugins/bootstrap-touchspin/bootstrap.touchspin.js') }}" type="text/javascript"></script><!-- product zoom -->
@stop

@section('scripts')
  <script>

    @include('wishlist.partials._add-to-wishlist-js')

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
    jQuery(document).ready(function(){
		handleFancybox();
		initImageZoom();
		initTouchspin();
        addToWishlist();
        removeFromWishList();
    });
  </script>
@stop