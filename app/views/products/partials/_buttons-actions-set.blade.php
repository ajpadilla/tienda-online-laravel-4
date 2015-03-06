<div class="row">
	<div class="product-page-cart tooltip-pop">
		<div class="col-sm-3">
			<div class="product-quantity">
				<input id="product-quantity" type="text" value="1" readonly name="product-quantity" class="form-control input-sm">
			</div>
		</div>
		<div class="col-sm-2">
			<button href="{{ route('cart.create', $product->id) }}" class="add_cart btn btn-success btn-outline dim" style="margin-left: 20px" type="button" data-toggle="tooltip" data-placement="top" title="Agregar al carro de compras" data-original-title="Agregar al carro de compras"><i class="fa fa-shopping-cart fa-2x"></i></button>
		</div>
		<div class="col-sm-2">
			<button href="{{ route('wishlist.create', $product->id) }}" class="add_wishlist btn btn-danger btn-outline dim" style="margin-left: 20px" type="button"  data-toggle="tooltip" data-placement="top" title="Agregar a lista de deseos" data-original-title="Agregar a lista de deseos"><i class="fa fa-heart fa-2x"></i></button>
		</div>
		<div class="col-sm-2">
			<form action="{{ route('products.show', $product->id) }}">
			    <button class="btn btn-primary btn-outline dim" style="margin-left: 20px" type="submit" data-toggle="tooltip" data-placement="top" title="Ver página del producto" data-original-title="Ver página del producto"><i class="fa fa-info-circle fa-2x"></i></button>
			</form>
		</div>
	</div>
</div>