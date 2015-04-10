@extends('layouts.template')

@section('title')
    {{  trans('products.show_data.title') }}
@stop

@section('content')
    <div class="row">
        {{--<div class="col-md-3 col-sm-5">
            --}}{{--@include('products.partials._category-sidebar')--}}{{--
            --}}{{--@include('products.partials._relate-sidebar')--}}{{--
        </div>--}}
        <div class="col-md-1 col-sm-2"></div>
        <div class="col-md-10 col-sm-8">
			<div class="product-page">
			<div class="row">
			@include('products.partials._show-photo')
			<div class="col-md-6 col-sm-6">
			  <h1>{{ $product->inCurrentLang->name }}</h1>
			  <div class="price-availability-block clearfix">
			    <div class="price">
			      <strong>{{ $product->priceWithCurrency }}</strong>
			      <em><span>{{ $product->priceWithCurrency }}</span></em>
			    </div>
			    <div class="availability">
			      Availability: <strong>{{ $product->quantity }}</strong>
			    </div>
			  </div>
			  <div class="description">
			    <p>{{ $product->inCurrentLang->description }}</p>
			  </div>
			  <div class="product-page-options">
			    <div class="pull-left">
			      <label class="control-label">Size:</label>
			      <select class="form-control input-sm">
			        <option>L</option>
			        <option>M</option>
			        <option>XL</option>
			      </select>
			    </div>
			    <div class="pull-left">
			      <label class="control-label">Color:</label>
			      <select class="form-control input-sm">
			        <option>Red</option>
			        <option>Blue</option>
			        <option>Black</option>
			      </select>
			    </div>
			  </div>
			  @include('products.partials._buttons-actions-set')
			  <div class="review">
			  	<div class="rateit" data-rateit-value="{{ $product->rating }}" data-rateit-ispreset="true" data-rateit-readonly="true"></div>			  
			    <a href="#">7 reviews</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#">Write a review</a>
			  </div>
			  @include('products.partials._social-icons')
			</div>
				@include('products.partials._show-content-product')
				<div class="sticker sticker-sale"></div>
			</div>
            </div>
        </div>
    </div>
@stop

@section('in-situ-css')
	<link rel="stylesheet" href="{{ asset('assets/css/plugins/rateit/rateit.css') }}"/>
@stop