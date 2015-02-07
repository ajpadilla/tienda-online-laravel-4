<script id="wishlist-tpl" type="text/x-handlebars-template">
	<li class="li">
	    <div class="row">
	        <div class="col-xs-10 col-sm-8 col-md-8 col-lg-8">
	            <a href="{{ url }}"><i class="fa fa-check fa-2x"></i>{{ name }}</a>
	        </div>
	        <div class="col-xs-2 col-sm-4 col-md-4 col-lg-4">
	            <span class="pull-right text-muted small">
	                <a href="{{ url-delete }}" class="delete-from-wishlist">
	                    <i class="fa fa-minus-circle fa-2x"></i>
	                </a>
	            </span>
	        </div>
	    </div>
	</li>
</script>