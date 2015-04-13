<div class="col-md-10 col-sm-10">
  <div class="pull-right">
    <label class="control-label">{{ trans('products.search-blade.show') }}:</label>
    <!--<select id="paginate-quantity-search" class="form-control input-sm">
      <option value="#?limit=24" selected="selected">10</option>
      <option value="#?limit=25">20</option>
      <option value="#?limit=50">30</option>
      <option value="#?limit=75">40</option>
      <option value="#?limit=100">50</option>
    </select>-->
  
    {{ Form::select(
        'paginate', 
        array(
          '10' => '10',
          '20' => '20',
          '30' => '30',
          '40' => '40',
          '50' => '50'
        ), 
        null,
        ['class' => 'form-control input-sm', 'id' => 'paginate-quantity-search'])
    }}

  </div>

  <div class="pull-right">
    <label class="control-label">{{ trans('products.search-blade.order-by') }}:</label>
    <a href="{{ URL::route('products.filterWord') }}" id="filter-current-word"></a>
      {{ Form::select(
        'paginate', 
        array(
          'name-asc' => trans('products.search-blade.name').' '.'(A - Z)',
          'name-desc' => trans('products.search-blade.name').' '.'(Z - A)',
          'price-asc' => trans('products.search-blade.price').' '.trans('products.search-blade.low-high'),
          'price-desc' => trans('products.search-blade.price').' '.trans('products.search-blade.high-low'),
          'rating-desc' => trans('products.search-blade.rating').' '.trans('products.search-blade.highest'),
          'rating-asc' => trans('products.search-blade.rating').' '.trans('products.search-blade.lowest'),
          'condition-asc' => trans('products.search-blade.condition').' '.trans('products.search-blade.new-used'),
          'condition-desc' => trans('products.search-blade.condition').' '.trans('products.search-blade.used-new'),
        ), 
        'rating-desc',
        ['class' => 'form-control input-sm', 'id' => 'order-by-search'])
    }}
  </div>
</div>