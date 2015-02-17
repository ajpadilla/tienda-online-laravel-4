/*
 * --------------- Config plugins ----------------
 */

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

var initSliderRange = function () {
    jQuery( "#slider-range" ).slider({
        range: true,
        min: 0,
        max: 9999,
        values: [ 1, 9999 ],
        slide: function( event, ui ) {
            jQuery( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
        },
        change: function(event, ui) {
            // when the user change the slider
        },
        stop: function(event, ui) {
            // when the user stopped changing the slider
            var firstValue = ui.values[0];
            var secondValue = ui.values[1];
            //alert('First: '+firstValue);
            //$.POST("to.php",{first_value:ui.values[0], second_value:ui.values[1]},function(data){},'json');
        }
    });
    jQuery( "#amount" ).val( "$" + jQuery( "#slider-range" ).slider( "values", 0 ) +
    " - $" + jQuery( "#slider-range" ).slider( "values", 1 ) );
}

/*
 * --------------- Custom scripts for bussiness logic ----------------
 */

/*
 * --------------------- Wishlist Logic ----------------------
 */
var addToWishlist = function () {
    jQuery('.add_wishlist').click(function(){
        var url = jQuery(this).attr('href');
        jQuery.ajax({
            type: 'GET',
            url: url,
            dataType:'json',
            success: function(response) {
                if (response != null) {
                    if(response.success) {
                        var wishlist = jQuery('#products-wishlist');
                        var product = response.product;
                        var template = jQuery('#wishlist-tpl').html();
                        var html = Mustache.to_html(template, product);
                        wishlist.prepend(html);
                        addCountToWishlist();
                    } else {
                        alert('No se pudo agregar el producto!');
                    }
                }else{

                }
            }
        });
        return false;
    });
}

var removeFromWishList = function () {
    jQuery(document).on('click', '.delete-from-wishlist', function() {
        var element = jQuery(this);
        var url = element.attr('href');
        jQuery.ajax({
            type: 'GET',
            url: url,
            dataType:'json',
            success: function(response) {
                if (response != null) {
                    if(response.success) {
                        element.closest('.li').remove();
                        discountFromWishlist();
                    } else {
                        alert('No se pudo eliminar el producto!');
                    }
                }else{

                }
            }
        });
        return false;
    });
}

var addCountToWishlist = function() {
    var wishlistCount =  parseInt(jQuery('#wishlist-count').html());
    if(isNaN(wishlistCount)) wishlistCount = 0;
    jQuery('#wishlist-count').html(wishlistCount + 1);
}

var discountFromWishlist = function() {
    var wishlistCount =  parseInt(jQuery('#wishlist-count').html());
    if(isNaN(wishlistCount)) wishlistCount = 0;
    if(wishlistCount > 0)
        wishlistCount --;
    jQuery('#wishlist-count').html(wishlistCount);
}


/*
 * --------------------- End Wishlist Logic ----------------------
 */
/*
 * --------------------- Shopping Cart Logic ----------------------
 */
var addToCart = function () {
    jQuery('.add_cart').click(function(){
        var url = jQuery(this).attr('href');
        jQuery.ajax({
            type: 'GET',
            url: url,
            dataType:'json',
            success: function(response) {
                if (response != null) {
                    if(response.success) {
                        var cart = jQuery('#products-cart');
                        var product = response.product;
                        var template = jQuery('#cart-tpl').html();
                        var html = Mustache.to_html(template, product);
                        cart.prepend(html);
                        addCountTocart();
                    } else {
                        alert('No se pudo agregar el producto!');
                    }
                }else{

                }
            }
        });
        return false;
    });
}

var removeFromCart = function () {
    jQuery(document).on('click', '.delete-from-cart', function() {
        var element = jQuery(this);
        var url = element.attr('href');
        jQuery.ajax({
            type: 'GET',
            url: url,
            dataType:'json',
            success: function(response) {
                if (response != null) {
                    if(response.success) {
                        element.closest('.li').remove();
                        discountFromcart();
                    } else {
                        alert('No se pudo eliminar el producto!');
                    }
                }else{

                }
            }
        });
        return false;
    });
}

var addCountTocart = function() {
    var cartCount =  parseInt(jQuery('#cart-count').html());
    if(isNaN(cartCount)) cartCount = 0;
    jQuery('#cart-count').html(cartCount + 1);
}

var discountFromcart = function() {
    var cartCount =  parseInt(jQuery('#cart-count').html());
    if(isNaN(cartCount)) cartCount = 0;
    if(cartCount > 0)
        cartCount --;
    jQuery('#cart-count').html(cartCount);
}
/*
 * ---------------------End Shopping Cart Logic ----------------------
 */
var rating = function() {
    jQuery("#rating").bind('rated', function (event, value) {
        alert('You\'ve rated it: ' + value);
    });
}

jQuery(document).ready(function(){
    // Init de plugins --------------------------
    handleFancybox();
    initImageZoom();
    initTouchspin();
    initSliderRange();

    // Init bussiness logic-----------------------
    addToWishlist();
    removeFromWishList();
    addToCart();
    removeFromCart();
    rating();
});