@extends('...layouts.template')

@section('title')
    {{--{{ Lang::get('modulo.variable') }}--}}
@stop

@section('content')
<!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">
          <!-- BEGIN CONTENT -->
          <div class=" col-md-offset-1 col-md-10 col-sm-offset-1 col-sm-10">
            <h1>{{ Lang::get('products.labels.MyWishList') }}</h1>
            <div class="goods-page">
              <div class="goods-data clearfix">
                <div class="table-wrapper-responsive">
                  <table summary="Shopping cart">
                    <tr>
                      <th class="goods-page-image">{{ Lang::get('products.labels.Image') }}</th>
                      <th class="goods-page-description">{{ Lang::get('products.labels.name') }}</th>
                      <th class="goods-page-description">{{ Lang::get('products.labels.description') }}</th>
                      <th class="goods-page-stock">{{ Lang::get('products.labels.Stock') }}</th>
                      <th class="goods-page-price" colspan="2">{{ Lang::get('products.labels.UnitPrice') }}</th>
                    </tr>
                    @if (!empty($wishlist))
                    @foreach ($wishlist as $wish)
                    <tr>
                      <td class="goods-page-image">
                       @if ($wish->getFirstPhoto())
                       <a href="{{ URL::route('products.show',$wish->id) }}"><img src="{{ asset($wish->getFirstPhoto()->complete_path) }}" alt="Berry Lace Dress"></a>
                       @else 
                        {{ Lang::get('products.labels.image') }}
                       @endif
                     </td>
                     <td class="goods-page-description">
                      <!--<h3><a href="#">Cool green dress with red bell</a></h3>
                      <p><strong>Item 1</strong> - Color: Green; Size: S</p>
                      <em>More info is here</em>-->
                      {{ $wish->inCurrentLang->name }}
                    </td>
                     <td class="goods-page-description">
                      {{ $wish->inCurrentLang->description }}
                    </td>
                    <td class="goods-page-stock">
                      @if($wish->quantity > 0) Disponibles
                      @else Agotados
                      @endif
                    </td>
                    <td class="goods-page-price">
                      <strong><span>$</span>{{ number_format($wish->price,2) }}</strong>
                    </td>
                    <td class="del-goods-col">
                      <a href="#" class="add_cart btn btn-default add2cart"><i class="fa fa-shopping-cart"></i></a>
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