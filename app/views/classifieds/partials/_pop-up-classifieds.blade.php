<div id="product-pop-up-{{ $classified->id }}" style="display: none; width: 700px;">
		            <div class="product-page product-pop-up">
		              <div class="row">
		                <div class="col-md-6 col-sm-6 col-xs-3">
		                  <div class="product-main-image">
		                  	@if($classified->hasPhotos())
			                    <img src="{{ asset($classified->getFirstPhoto()->complete_path) }}" alt="{{ $classified->getFirstPhoto()->filename }}" class="img-responsive">
			                  </div>
			                  <div class="product-other-images">
			                  	@foreach($classified->photos as $photo)
			                    	<a href="#" class="active"><img src="{{ asset($photo->complete_path) }}" alt="{{ $photo->filename }}"></a>
			                    @endforeach
			                  </div>
		                  @else
			                  <img src="{{ asset('uploads/products/images/model1.jpg') }}" alt="Cool green dress with red bell" class="img-responsive">
			                  </div>
			                  <div class="product-other-images">
			                    <a href="#" class="active"><img alt="Berry Lace Dress" src="{{ asset('uploads/products/images/model1.jpg') }}"></a>
			                    <a href="#"><img alt="Berry Lace Dress" src="{{ asset('uploads/products/images/model4.jpg') }}"></a>
			                    <a href="#"><img alt="Berry Lace Dress" src="{{ asset('uploads/products/images/model5.jpg') }}"></a>
			                  </div>
		                  @endif
		                </div>
		                <div class="col-md-6 col-sm-6 col-xs-9">
		                  <h2>{{ $classified->getInCurrentLangAttribute()->name }}</h2>
		                  <div class="price-availability-block clearfix">
		                    <div class="price">
		                      <strong><span>$</span>{{ $classified->price }}</strong>
		                      <em>$<span>{{ $classified->price }}</span></em>
		                    </div>
		                    <!--<div class="availability">
		                      Disponibilidad: <strong>{{ $classified->quantity }}</strong>
		                    </div>-->
		                  </div>
		                  <div class="description">
		                    <p>{{ $classified->getInCurrentLangAttribute()->description }}</p>
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
		                  {{--@include('products.partials._buttons-actions-set')--}}
		                </div>

		                <div class="sticker sticker-sale"></div>
		              </div>
		            </div>
		    </div>