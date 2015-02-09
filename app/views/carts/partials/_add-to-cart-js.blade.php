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

