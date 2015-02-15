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

