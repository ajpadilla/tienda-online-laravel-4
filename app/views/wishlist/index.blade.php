@extends('...layouts.template')

@section('title')
    {{--{{ Lang::get('modulo.variable') }}--}}
@stop

@section('content')
<!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">
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
                    @if (!empty($wishlist))
                    @foreach ($wishlist as $wish)
                    <tr>
                      <td class="goods-page-image">
                       @if ($wish->product->getFirstPhoto())
                       <a href="{{ URL::route('products.show',$wish->product->id) }}"><img src="{{ asset($wish->product->getFirstPhoto()->complete_path) }}" alt="Berry Lace Dress"></a>
                       @endif 
                     </td>
                     <td class="goods-page-description">
                      <!--<h3><a href="#">Cool green dress with red bell</a></h3>
                      <p><strong>Item 1</strong> - Color: Green; Size: S</p>
                      <em>More info is here</em>-->
                      {{ $wish->description }}
                    </td>
                    <td class="goods-page-stock">
                      In Stock
                    </td>
                    <td class="goods-page-price">
                      <strong><span>$</span>{{ number_format($wish->product->price,2) }}</strong>
                    </td>
                    <td class="del-goods-col">
                      <a class="del-goods" href="#">&nbsp;</a>
                      <a class="add-goods" href="#">&nbsp;</a>
                    </td>
                  </tr>
                  @endforeach
                  @endif
                </table>
                </div>
              </div>
            </div>
          </div>
          <!-- END CONTENT -->
        </div>
        <!-- END SIDEBAR & CONTENT -->
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