@extends('layouts.template')

@section('title')
    {{--{{ Lang::get('modulo.variable') }}--}}
@stop

@section('content')
	    <div class="row">
	        <div class="col-md-3 col-sm-5">

	        </div>
	        <div class="col-md-9 col-sm-7">
	        
	        </div>
	    </div>
@stop

@section('in-situ-css')
	<link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}"/>
@stop

@section('in-situ-js')
	<script src="{{ asset('assets/js/plugins/zoom/jquery.zoom.min.js') }}" type="text/javascript"></script><!-- product zoom -->
	<script src="{{ asset('assets/js/plugins/bootstrap-touchspin/bootstrap.touchspin.js') }}" type="text/javascript"></script><!-- product zoom -->
@stop

@section('scripts')
  <script>
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
    $(document).ready(function(){
		handleFancybox();
		initImageZoom();
		initTouchspin();
    });
  </script>
@stop

@include('products.partials._pop-up-products')