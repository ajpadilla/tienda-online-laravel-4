<div class="row border-bottom">
    <nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            <!--<form role="search" class="navbar-form-custom" method="post" action="#">
                <div class="input-group" style="margin-top:13px;">
                    <input type="text" class="form-control" placeholder="{{ Lang::get('menu.search') }}" name="top-search" id="top-search">
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-primary">
                        <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
            </form>-->

            {{ Form::open(['route' => 'filtered_products_path','roel' => 'search','class' => 'navbar-form-custom','method'=>'post','id' => 'filterForm']) }}
                <div class="input-group" style="margin-top:13px;">
                    {{ Form::text('filter_word', null, ['class' => 'form-control','placeholder' => Lang::get('menu.search'), 'id' => 'filter_word']) }}
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
            {{ Form::close() }}

        </div>
        <ul class="nav navbar-top-links navbar-right">
            <li>
                <span class="m-r-sm text-muted welcome-message">{{ Lang::get('menu.welcome-message') }}</span>
            </li>
            @include('layouts.partials._language-switcher')
            @include('products.partials._topbar-cart-list')
            @include('products.partials._topbar-wishlist')
            <li>
                <a href="login.html">
                    <i class="fa fa-sign-out fa-lg"></i> {{ Lang::get('menu.log-out') }}
                </a>
            </li>

        </ul>
    </nav>
</div>


