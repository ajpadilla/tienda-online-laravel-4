 <!-- BEGIN CONTENT -->
          <div class="col-md-9 col-sm-7">
            <!--<div class="content-search margin-bottom-20">
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
            </div>-->
            <div class="row list-view-sorting clearfix">
              <div class="col-md-2 col-sm-2 list-view">
                <a href="#"><i class="fa fa-th-large"></i></a>
                <a href="#"><i class="fa fa-th-list"></i></a>
              </div>
              @include('products.partials.search._order-by-search')
            </div>

            @if(!$products->isEmpty())
            <!-- BEGIN PAGINATOR -->
            <div id="total-items-produts-1" class="row">
              <div class="col-md-4 col-sm-4 items-info">Productos {{ $products->getTotal()}}  en total pagina {{ $products->getCurrentPage() }}</div>
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
          </div>
          <!-- END CONTENT -->


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
