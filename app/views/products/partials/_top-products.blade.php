@if($topProducts)
	<?php $currentSticker = 'sticker-sale'; ?>
    @foreach($topProducts as $product)
        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
            @include('products.partials._one-product')
        </div>
    @endforeach
@endif