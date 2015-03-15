 @if(!$products->isEmpty())
 <!-- BEGIN PAGINATOR -->
 <div id="total-items-produts-1" class="row">
  <div class="col-md-4 col-sm-4 items-info">Productos {{ $products->getTotal()}}  en total</div>
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
<div class="col-md-4 col-sm-4 items-info">Productos total {{ $products->getTotal()}}</div>
  <div class="col-md-8 col-sm-8 links-products">
    {{ $products->links()}}
  </div>
</div>
<!-- END PAGINATOR -->
@endif

@if(!$classifieds->isEmpty())
<!-- BEGIN PAGINATOR -->
<div id="total-items-classifieds-1" class="row margen">
  <div class="col-md-4 col-sm-4 items-info">Clasificados {{ $classifieds->getTotal()}}  en total</div>
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
  <div class="col-md-4 col-sm-4 items-info">Clasificados total {{ $classifieds->getTotal()}}</div>
  <div class="col-md-8 col-sm-8">
    {{ $classifieds->links()}}
  </div>
</div>
<!-- END PAGINATOR -->
@endif

@if($products)
  @foreach($products as $product)
    @include('products.partials._pop-up-products')
  @endforeach
@endif

@if($classifieds)
  @foreach($classifieds as $classified)
    @include('classifieds.partials._pop-up-classifieds')
  @endforeach
@endif
