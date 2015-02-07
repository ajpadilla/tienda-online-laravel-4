@extends('layouts.template')

@section('title')
    {{--{{ Lang::get('modulo.variable') }}--}}
@stop

@section('content')
<!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">
          <!-- BEGIN SIDEBAR -->
          <div class="sidebar col-md-3 col-sm-5">
            <ul class="list-group margin-bottom-25 sidebar-menu">
              <li class="list-group-item clearfix"><a href="shop-product-list.html"><i class="fa fa-angle-right"></i> Ladies</a></li>
              <li class="list-group-item clearfix"><a href="shop-product-list.html"><i class="fa fa-angle-right"></i> Kids</a></li>
              <li class="list-group-item clearfix"><a href="shop-product-list.html"><i class="fa fa-angle-right"></i> Accessories</a></li>
              <li class="list-group-item clearfix"><a href="shop-product-list.html"><i class="fa fa-angle-right"></i> Sports</a></li>
              <li class="list-group-item clearfix"><a href="shop-product-list.html"><i class="fa fa-angle-right"></i> Brands</a></li>
              <li class="list-group-item clearfix"><a href="shop-product-list.html"><i class="fa fa-angle-right"></i> Electronics</a></li>
              <li class="list-group-item clearfix"><a href="shop-product-list.html"><i class="fa fa-angle-right"></i> Home & Garden</a></li>
              <li class="list-group-item clearfix"><a href="shop-product-list.html"><i class="fa fa-angle-right"></i> Custom Link</a></li>
            </ul>
          </div>
          <!-- END SIDEBAR -->

          <!-- BEGIN CONTENT -->
          <div class="col-md-7 col-sm-6">
            <h1>My Wish List</h1>
            <div class="goods-page">
              <div class="goods-data clearfix">
                <div class="table-wrapper-responsive">
                <table summary="Shopping cart">
                  <tr>
                    <th class="goods-page-image">Image</th>
                    <th class="goods-page-description">Description</th>
                    <th class="goods-page-stock">Stock</th>
                    <th class="goods-page-price" colspan="2">Unit price</th>
                  </tr>
                  <tr>
                    <td class="goods-page-image">
                      <a href="#"><img src="{{ asset('uploads/products/images/model3.jpg') }}" alt="Berry Lace Dress"></a>
                    </td>
                    <td class="goods-page-description">
                      <h3><a href="#">Cool green dress with red bell</a></h3>
                      <p><strong>Item 1</strong> - Color: Green; Size: S</p>
                      <em>More info is here</em>
                    </td>
                    <td class="goods-page-stock">
                      In Stock
                    </td>
                    <td class="goods-page-price">
                      <strong><span>$</span>47.00</strong>
                    </td>
                    <td class="del-goods-col">
                      <a class="del-goods" href="#">&nbsp;</a>
                      <a class="add-goods" href="#">&nbsp;</a>
                    </td>
                  </tr>
                  <tr>
                    <td class="goods-page-image">
                      <a href="#"><img src="{{ asset('uploads/products/images/model4.jpg') }}" alt="Berry Lace Dress"></a>
                    </td>
                    <td class="goods-page-description">
                      <h3><a href="#">Cool green dress with red bell</a></h3>
                      <p><strong>Item 1</strong> - Color: Green; Size: S</p>
                      <em>More info is here</em>
                    </td>
                    <td class="goods-page-stock">
                      In Stock
                    </td>
                    <td class="goods-page-price">
                      <strong><span>$</span>47.00</strong>
                    </td>
                    <td class="del-goods-col">
                      <a class="del-goods" href="#">&nbsp;</a>
                      <a class="add-goods" href="#">&nbsp;</a>
                    </td>
                  </tr>
                </table>
                </div>
              </div>
            </div>
          </div>
          <!-- END CONTENT -->
        </div>
        <!-- END SIDEBAR & CONTENT -->

        {{ $wishlistProducts }}

        @foreach ($wishlistProducts as $wishlistProduct)
          {{ $wishlistProduct->product->id }}
        @endforeach
@stop

@section('in-situ-css')
	<link rel="stylesheet" href="{{ asset('assets/css/plugins/rateit/rateit.css') }}"/>
	<link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}"/>
	{{--<link rel="stylesheet" href="{{ asset('assets/css/components.css') }}"/>
	<link rel="stylesheet" href="{{ asset('assets/css/style-shop.css') }}"/>
	<link rel="stylesheet" href="{{ asset('assets/css/m-style.css') }}"/>--}}
@stop

@section('in-situ-js')
	<script src="{{ asset('assets/js/plugins/rateit/jquery.rateit.min.js') }}" type="text/javascript"></script><!-- product zoom -->
	<script src="{{ asset('assets/js/plugins/zoom/jquery.zoom.min.js') }}" type="text/javascript"></script><!-- product zoom -->
	<script src="{{ asset('assets/js/plugins/bootstrap-touchspin/bootstrap.touchspin.js') }}" type="text/javascript"></script><!-- product zoom -->
@stop