@extends('layouts.template')
@section('main-title')
	<h2 style="display: inline-block">Resultados para: <em class="content-search-product">producto</em></h2>
@stop
@section('action-heading')
  <form class="content-search-form" action="#">
    <div class="input-group">
      <input type="text" placeholder="Buscar de nuevo" class="form-control">
      <span class="input-group-btn">
        <button class="btn btn-primary" type="submit">Buscar</button>
      </span>
    </div>
  </form>
@stop

@section('content')
@include('layouts.partials._error')
	<div class="panel-body">
		<div class="panel blank-panel">
	        <div class="row margin-bottom-40">
<!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">
          <!-- BEGIN SIDEBAR -->
          <div class="sidebar col-md-3 col-sm-5">
            @include('products.partials.search._more-search-options')
			@include('products.partials._bestsellers')
          </div>
          <!-- END SIDEBAR -->
          <!-- BEGIN CONTENT -->
          <div class="col-md-9 col-sm-7">
            {{--<div class="content-search margin-bottom-20">
              <div class="row">
                <div class="col-md-6">
                  <h1>Search result for <em>shoes</em></h1>
                </div>
                <div class="col-md-6">
                  <form action="#">
                    <div class="input-group">
                      <input type="text" placeholder="Search again" class="form-control">
                      <span class="input-group-btn">
                        <button class="btn btn-primary" type="submit">Search</button>
                      </span>
                    </div>
                  </form>
                </div>
              </div>
            </div>--}}             
            <div class="row list-view-sorting clearfix">
              <div class="col-md-2 col-sm-2 list-view">
                <a href="#"><i class="fa fa-th-large"></i></a>
                <a href="#"><i class="fa fa-th-list"></i></a>
              </div>	                       
              @include('products.partials.search._order-by-search')
            </div>
			<!-- BEGIN PAGINATOR -->	
            <div class="row">
              <div class="col-md-4 col-sm-4 items-info">Productos 1 a 9 de 10 en total</div>
              <div class="col-md-8 col-sm-8">
                <ul class="pagination pull-right">
                  <li><a href="#">&laquo;</a></li>
                  <li><a href="#">1</a></li>
                  <li><span>2</span></li>
                  <li><a href="#">3</a></li>
                  <li><a href="#">4</a></li>
                  <li><a href="#">5</a></li>
                  <li><a href="#">&raquo;</a></li>
                </ul>
              </div>
            </div>
            <!-- END PAGINATOR -->            
            <!-- BEGIN PRODUCT LIST -->
            <div class="row product-list">
              <!-- PRODUCT ITEM START -->
              @foreach($products as $product)
              	<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
					@include('products.partials._one-product')
				</div>
			  @endforeach
              <!-- PRODUCT ITEM END -->
            </div>
            <!-- END PRODUCT LIST -->
            <!-- BEGIN PAGINATOR -->
            <div class="row">
              <div class="col-md-4 col-sm-4 items-info">Productos 1 a 9 de 10 en total</div>
              <div class="col-md-8 col-sm-8">
                <ul class="pagination pull-right">
                  <li><a href="#">&laquo;</a></li>
                  <li><a href="#">1</a></li>
                  <li><span>2</span></li>
                  <li><a href="#">3</a></li>
                  <li><a href="#">4</a></li>
                  <li><a href="#">5</a></li>
                  <li><a href="#">&raquo;</a></li>
                </ul>
              </div>
            </div>
            <!-- END PAGINATOR -->
          </div>
          <!-- END CONTENT -->
        </div>
        <!-- END SIDEBAR & CONTENT -->
      </div>
	        </div>
	    </div>
    </div>
@stop

@if($products)
	@foreach($products as $product)
		@include('products.partials._pop-up-products')
	@endforeach		    
@endif