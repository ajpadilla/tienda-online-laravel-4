<script>
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
                    		alert('Producto agregado con exito!');
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
</script>