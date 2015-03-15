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
  <div class="col-md-4 col-sm-4 items-info">Clasificados total</div>
  <div class="col-md-8 col-sm-8">
    {{ $classifieds->links()}}
  </div>
</div>
<!-- END PAGINATOR -->
@endif