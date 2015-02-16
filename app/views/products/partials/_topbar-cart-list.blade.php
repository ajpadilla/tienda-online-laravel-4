 {{-- @if($cart) --}}
    <li class="dropdown">
        <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
            <i class="fa fa-shopping-cart fa-lg"></i>
            <span id="cart-count" class="label label-warning">
                @if($cart)
                    {{ $cart->products->count() }}
                @else
                    0
                @endif
            </span>
        </a>
        <ul id="products-cart" class="dropdown-menu dropdown-alerts">
            @if($cart)
                @foreach($cart->products as $product)
                    <li class="li">
                        <div class="row">
                            <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
                                <a href="{{ route('products.show', $product->id) }}"><i class="fa fa-check fa-2x"></i> {{ $product->inCurrentLang->name }}</a>
                            </div>
                            <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                                {{ $product->pivot->quantity }}
                            </div>
                            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                <span class="pull-right text-muted small">
                                    <a href="{{ route('cart.delete-ajax', $product->id) }}" class="delete-from-cart">
                                        <i class="fa fa-minus-circle fa-2x"></i>
                                    </a>
                                </span>
                            </div>
                        </div>
                    </li>
                @endforeach
                <li class="divider"></li>
                <li>
                    <div class="text-center link-block">
                        <a href="{{ route('cart.show', $cart->id) }}">
                            <strong>Más Detalles</strong>
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                </li>
            @endif
        </ul>
    </li>
{{-- @endif --}}