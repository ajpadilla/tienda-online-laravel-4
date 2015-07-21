 @if(!empty($products))
 <!-- BEGIN PAGINATOR -->
 <div id="total-items-produts-1" class="row">
  <div class="col-md-4 col-sm-4 items-info">{{ trans('products.search-blade.products-for-page') }} {{ $products->getPerPage() }} {{ trans('products.search-blade.of') }} {{ $products->getTotal()}} {{ trans('products.search-blade.in') }} {{ $products->getCurrentPage()  }}</div>
  <div class="col-md-8 col-sm-8 links-products">
   {{ $products->links() }}
 </div>
</div>
<!-- END PAGINATOR -->
<!-- BEGIN PRODUCT LIST -->
<div id="products-list" class="row product-list">
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
<div id="total-items-produts-2" class="row">
 <div class="col-md-4 col-sm-4 items-info">{{ trans('products.search-blade.products-for-page') }} {{ $products->getPerPage() }} {{ trans('products.search-blade.of') }} {{ $products->getTotal()}} {{ trans('products.search-blade.in') }} {{ $products->getCurrentPage()  }}</div>
  <div class="col-md-8 col-sm-8 links-products">
    {{ $products->links()}}
  </div>
</div>
<!-- END PAGINATOR -->
@endif

@if(!empty($classifieds))
<!-- BEGIN PAGINATOR -->
<div id="total-items-classifieds-1" class="row margen">
   <div class="col-md-4 col-sm-4 items-info">{{ trans('products.search-blade.classified-for-page') }} {{ $classifieds->getPerPage() }} {{ trans('products.search-blade.of') }} {{ $classifieds->getTotal()}} {{ trans('products.search-blade.in') }} {{ $classifieds->getCurrentPage()  }}</div>
  <div class="col-md-8 col-sm-8">
   {{ $classifieds->links() }}
 </div>
</div>
<!-- END PAGINATOR -->
<!-- BEGIN PRODUCT LIST -->
<div id="classifieds-list" class="row classified-list">
  <!-- PRODUCT ITEM START -->
  @foreach($classifieds as $classified)
  <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
    @include('classifieds.partials._one-classified')
  </div>
  @endforeach
  <!-- PRODUCT ITEM END -->
</div>
<!-- END PRODUCT LIST -->
<!-- BEGIN PAGINATOR -->
<div id="total-items-classifieds-2" class="row">
   <div class="col-md-4 col-sm-4 items-info">{{ trans('products.search-blade.classified-for-page') }} {{ $classifieds->getPerPage() }} {{ trans('products.search-blade.of') }} {{ $classifieds->getTotal()}} {{ trans('products.search-blade.in') }} {{ $classifieds->getCurrentPage()  }}</div>
  <div class="col-md-8 col-sm-8">
    {{ $classifieds->links()}}
  </div>
</div>
<!-- END PAGINATOR -->
@endif

@if(!empty($products))
  @foreach($products as $product)
    @include('products.partials._pop-up-products')
  @endforeach
@endif

@if(!empty($classifieds))
  @foreach($classifieds as $classified)
    @include('classifieds.partials._pop-up-classifieds')
  @endforeach
@endif
