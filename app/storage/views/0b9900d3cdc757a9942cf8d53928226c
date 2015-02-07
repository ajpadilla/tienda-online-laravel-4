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
                            var wishlistCount =  parseInt(jQuery('#wishlist-count').html());
                            if(wishlistCount < 1) wishlistCount = 0;
                            jQuery('#wishlist-count').html(wishlistCount + 1);
                    	} else {
                    		alert('No se pudo agregar el producto!');
                    	}
                    }else{

                    }
                }
            });
            return false;
		});

        jQuery(document).on('click', '.delete-from-wishlist', function() {
            var element = jQuery(this);
            var url = element.attr('href');
            alert(url);
            jQuery.ajax({
                type: 'GET',
                url: url,
                dataType:'json',
                success: function(response) {
                    if (response != null) {
                        if(response.success) {
                            element.closest('.li').remove();
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