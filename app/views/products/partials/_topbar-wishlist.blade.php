 {{-- @if($wishlist) --}}
    <li class="dropdown">
        <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
            <i class="fa fa-check-square-o fa-lg"></i>
            <span id="wishlist-count" class="label label-primary">
                @if($wishlist)
                    {{ $wishlist->count() }}
                @else
                    0
                @endif
            </span>
        </a>
        <ul id="products-wishlist" class="dropdown-menu dropdown-alerts">
            @if($wishlist)
                @foreach($wishlist as $product)
                    <li class="li">
                        <div class="row">
                            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                                <a href="{{ route('products.show', $product->id) }}"><i class="fa fa-check fa-2x"></i> {{ $product->inCurrentLang->name }}</a>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <span class="pull-right text-muted small">
                                    <a href="{{ route('wishlist.delete-ajax', $product->id) }}" class="delete-from-wishlist">
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
                        <a href="{{ route('wishlist.index') }}">
                            <strong>More details</strong>
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                </li>
            @endif
        </ul>
    </li>
{{-- @endif --}}