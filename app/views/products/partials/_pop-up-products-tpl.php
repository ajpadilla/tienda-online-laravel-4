<script id="pop-up-products-tpl" type="text/x-handlebars-template">

<div id="product-pop-up-{{ Id }}" style="width: 700px; display: block;">
	<div class="product-page product-pop-up">
		<div class="row">
			<div class="col-md-6 col-sm-6 col-xs-3">
				<div class="product-main-image" style="position: relative; overflow: hidden;">
					<img src="{{ url_img }}" alt="" class="img-responsive">
					<div class="product-other-images">
						<a href="#" class="active"><img alt="" src="{{  }}"></a>
					</div>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-9">
					<h2>{{ name }}</h2>
					<div class="price-availability-block clearfix">
						<div class="price">
							<strong><span>$</span>{{ price }}</strong>
							<em>$<span>{{ price }}</span></em>
						</div>
		                    <div class="availability">
		                      Disponibilidad: <strong>{{ quantity }}</strong>
		                  </div>
		              </div>
		              <div class="description">
		              	<p>{{ description }}</p>
		              </div>
		              <div class="product-page-options">
		              	<div class="pull-left">
		              		<label class="control-label">Size:</label>
		              		<select class="form-control input-sm">
		              			<option>L</option>
		              			<option>M</option>
		              			<option>XL</option>
		              		</select>
		              	</div>
		              	<div class="pull-left">
		              		<label class="control-label">Color:</label>
		              		<select class="form-control input-sm">
		              			<option>Red</option>
		              			<option>Blue</option>
		              			<option>Black</option>
		              		</select>
		              	</div>
		              </div>
		              <div class="row">
		              	<div class="product-page-cart tooltip-pop">
		              		<div class="col-sm-3">
		              			<div class="product-quantity">
		              				<input id="product-quantity" type="text" value="1" readonly name="product-quantity" class="form-control input-sm">
		              			</div>
		              		</div>
		              		<div class="col-sm-2">
		              			<button href="{{ url_cart }}" class="add_cart btn btn-success btn-outline dim" style="margin-left: 20px" type="button" data-toggle="tooltip" data-placement="top" title="Agregar al carro de compras" data-original-title="Agregar al carro de compras"><i class="fa fa-shopping-cart fa-2x"></i></button>
		              		</div>
		              		<div class="col-sm-2">
		              			<button href="{{ url_wishlist }}" class="add_wishlist btn btn-danger btn-outline dim" style="margin-left: 20px" type="button" data-toggle="tooltip" data-placement="top" title="Agregar a lista de deseos" data-original-title="Agregar a lista de deseos"><i class="fa fa-heart fa-2x"></i></button>
		              		</div>
		              		<div class="col-sm-2">
		              			<form action="{{ url_show }}">
		              				<button class="btn btn-primary btn-outline dim" style="margin-left: 20px" type="submit" data-toggle="tooltip" data-placement="top" title="Ver página del producto" data-original-title="Ver página del producto"><i class="fa fa-info-circle fa-2x"></i></button>
		              			</form>
		              		</div>
		              	</div>
		              </div>		               
		            </div>
		      	<div class="sticker sticker-sale">
		      	</div>
		</div>
	</div>
</div>	
</script>