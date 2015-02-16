@extends('layouts.template')

@section('content')
	<div class="panel-body">
		<div class="panel blank-panel">
	        <div class="row margin-bottom-40">
	          <!-- BEGIN CONTENT -->
	          <div class="col-md-12 col-sm-12">
	            <h1>Carro de Compras</h1>
	            @if(!$cart)
		            <div class="shopping-cart-page">
		              <div class="shopping-cart-data clearfix">
		                <p>Tu carro de compras está vacío!</p>
		              </div>
		            </div>
		        @else
					<div class="goods-page">
		              <div class="goods-data clearfix">
		                <div class="table-wrapper-responsive">
		                <table summary="Shopping cart">
		                  <tr>
		                    <th class="goods-page-image">Image</th>
		                    <th class="goods-page-description">Description</th>
		                    <th class="goods-page-quantity">Quantity</th>
		                    <th class="goods-page-price">Unit price</th>
		                    <th class="goods-page-total" colspan="2">Total</th>
		                  </tr>
		                  @foreach($cart->products as $product)
		                  <tr>
		                    <td class="goods-page-image">
		                      <a href="#"><img src="../../assets/frontend/pages/img/products/model3.jpg" alt="Berry Lace Dress"></a>
		                    </td>
		                    <td class="goods-page-description">
		                      <h3><a href="#">Cool green dress with red bell</a></h3>
		                      <p><strong>Item 1</strong> - Color: Green; Size: S</p>
		                      <em>More info is here</em>
		                    </td>
		                    <td class="goods-page-ref-no">
		                      javc2133
		                    </td>
		                    <td class="goods-page-quantity">
		                      <div class="product-quantity">
		                          <input id="product-quantity" type="text" value="1" readonly class="form-control input-sm">
		                      </div>
		                    </td>
		                    <td class="goods-page-price">
		                      <strong><span>$</span>47.00</strong>
		                    </td>
		                    <td class="goods-page-total">
		                      <strong><span>$</span>47.00</strong>
		                    </td>
		                    <td class="del-goods-col">
		                      <a class="del-goods" href="#">&nbsp;</a>
		                    </td>
		                  </tr>
		                  @endforeach
		                </table>
		                </div>

		                <div class="shopping-total">
		                  <ul>
		                    <li>
		                      <em>Sub total</em>
		                      <strong class="price"><span>$</span>47.00</strong>
		                    </li>
		                    <li>
		                      <em>Costo de envío</em>
		                      <strong class="price"><span>$</span>3.00</strong>
		                    </li>
		                    <li class="shopping-total-price">
		                      <em>Total</em>
		                      <strong class="price"><span>$</span>50.00</strong>
		                    </li>
		                  </ul>
		                </div>
		              </div>
		              <button class="btn btn-default" type="submit">Continuar compra <i class="fa fa-shopping-cart"></i></button>
		              <button class="btn btn-primary" type="submit">Pagar <i class="fa fa-check"></i></button>
		            </div>
		        @endif
	          </div>
	          <!-- END CONTENT -->
	        </div>
	    </div>
    </div>
@stop

 {{-- @include('products.partials._pop-up-products') --}}

@include('products.partials._product-show-js')