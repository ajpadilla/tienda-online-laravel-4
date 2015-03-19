 @if(!$products->isEmpty())
 <!-- BEGIN PAGINATOR -->
 <div id="total-items-produts-1" class="row">
  <div class="col-md-4 col-sm-4 items-info">Productos por pagina {{ $products->getPerPage() }} de {{ $products->getTotal()}}  en pagina {{ $products->count()  }} total</div>
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
  <div class="col-md-4 col-sm-4 items-info">Productos total</div>
  <div class="col-md-8 col-sm-8 links-products">
    {{ $products->links()}}
  </div>
</div>
<!-- END PAGINATOR -->
@endif