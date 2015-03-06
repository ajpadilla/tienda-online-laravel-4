
@extends('layouts.template')

@section('content')
	<div class="panel-body">
		<div class="panel blank-panel">
	        <div class="row margin-bottom-40">
	          <!-- BEGIN CONTENT -->
	          <div class="col-md-12 col-sm-12">
	            <h1>{{	trans('cart.title') }}</h1>
	            @if(!$cart)
		            <div class="shopping-cart-page">
		              <div class="shopping-cart-data clearfix">
		                <p>{{	trans('cart.cart-empty') }}</p>
		              </div>
		            </div>
		        @else
					<div class="goods-page">
		              <div class="goods-data clearfix">
		                <div class="table-wrapper-responsive">
		                <table summary="Shopping cart">
		                  <tr>
		                    <th class="goods-page-image">{{ Lang::get('cart.labels.Image') }}</th>
		                    <th class="goods-page-description">{{ Lang::get('cart.labels.description') }}</th>
		                    <th class="goods-page-quantity">{{ Lang::get('cart.labels.quantity') }}</th>
		                    <th class="goods-page-price">{{ Lang::get('cart.labels.UnitPrice') }}</th>
		                    <th class="goods-page-total" colspan="2">{{ Lang::get('cart.labels.total') }}</th>
		                  </tr>
		                  @foreach($cart->products as $product)
		                  <tr>
		                    <td class="goods-page-image">
		                    	@if($product->hasPhotos())
		                    		<a href="#"><img src="{{ $product->firstPhoto->complete_thumbnail_path }}" alt="$product->inCurrentLang->name"></a>
		                    	@else
		                      		<a href="#"><img src="../../assets/frontend/pages/img/products/model3.jpg" alt="Berry Lace Dress"></a>
		                      	@endif
		                    </td>
		                    <td class="goods-page-description">
		                      <h3><a href="#">{{ $product->inCurrentLang->name }}</a></h3>
		                      <p><strong>Item 1</strong> - Color: Green; Size: S</p>
		                      <em><a href="{{ route('products.show', $product->id) }}">Detalles del producto.</a></em>
		                    </td>
		                    {{-- <td class="goods-page-ref-no">
		                      javc2133
		                    </td> --}}
		                    <td class="goods-page-quantity">
		                      <div class="product-quantity">
		                          <input data-url="{{ route('cart.change-quantity', $product->id) }}" type="text" value="{{ $product->pivot->quantity }}" readonly class="product-quantity-change form-control input-sm">
		                      </div>
		                    </td>
		                    <td class="goods-page-price">
		                      <strong><span>$</span>{{ $product->price }}</strong>
		                    </td>
		                    <td class="goods-page-total">
		                      <strong><span>$</span>{{ $product->price }}</strong>
		                    </td>
		                    <td class="del-goods-col">
		                      <a class="del-goods delete-from-cart-list" href="{{ route('cart.delete-ajax', $product->id) }}">&nbsp;</a>
		                    </td>
		                  </tr>
		                  @endforeach
		                </table>
		                </div>

		                <div class="shopping-total">
		                  <ul>
		                    <li>
		                      <em>{{ Lang::get('cart.labels.sub-total') }}</em>
		                      <strong class="price"><span>$</span><p id='sub-total' style='display: inline-block'>{{ $cart->total }}</p></strong>
		                    </li>
		                    <li>
		                      <em>{{ Lang::get('cart.labels.cost') }}</em>
		                      <strong class="price"><span>$</span><p id='ship-cost' style='display: inline-block'>3</p></strong>
		                    </li>
		                    <li class="shopping-total-price">
		                      <em>{{ Lang::get('cart.labels.total') }}</em>
		                      <strong class="price"><span>$</span><p id='total' style='display: inline-block'>{{ $cart->total }}</p></strong>
		                    </li>
		                  </ul>
		                </div>
		              </div>
		              <a href="{{ route('pages.home') }}"><button class="btn btn-default" type="button">{{ Lang::get('cart.labels.continue-shopping') }}<i class="fa fa-shopping-cart"></i></button></a>
		              <button class="btn btn-primary" type="submit">{{ Lang::get('cart.labels.pay') }}<i class="fa fa-check"></i></button>
		            </div>
		        @endif
	          </div>
	          <!-- END CONTENT -->
	        </div>
	    </div>
    </div>
@stop

 {{-- @include('products.partials._pop-up-products')

@include('products.partials._product-show-js') --}}
