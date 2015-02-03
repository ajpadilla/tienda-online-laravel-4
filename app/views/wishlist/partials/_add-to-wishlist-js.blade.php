<script>
	var addToWishlist = function () {
		jQuery('.add_wishlist').click(function(){
			var url = jQuery(this).attr('href');
			alert(url);
			return false;
			jQuery.ajax({
                type: 'GET',
                url: url,
                dataType:'json',
                success: function(response) {
                    if (response != null) {

                    }else{

                    }
                }
            });

		});
	}

	jQuery(document).ready(function(){
		addToWishlist();
	});
</script>