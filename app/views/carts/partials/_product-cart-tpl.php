<script id="cart-tpl" type="text/x-handlebars-template">
	<li class="li">
	    <div class="row">
	        <div class="col-xs-7 col-sm-5 col-md-5 col-lg-5">
	            <a href="{{ url }}"><i class="fa fa-check fa-2x"></i>{{ name }}</a>
	        </div>
		    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
			    {{ quantity }}
		    </div>
	        <div class="col-xs-2 col-sm-4 col-md-4 col-lg-4">
	            <span class="pull-right text-muted small">
	                <a href="{{ url-delete }}" class="delete-from-cart">
	                    <i class="fa fa-minus-circle fa-2x"></i>
	                </a>
	            </span>
	        </div>
	    </div>
	</li>
</script>