<div class="col-md-10 col-sm-10">
  <div class="pull-right">
    <label class="control-label">Mostrar:</label>
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
    <label class="control-label">Ordenar por:</label>
    <a href="{{ URL::route('products.filterWord') }}" id="filter-current-word"></a>
      {{ Form::select(
        'paginate', 
        array(
          'name-asc' => 'Name (A - Z)',
          'name-desc' => 'Name (Z - A)',
          'price-asc' => 'Price (Low - High)',
          'price-desc' => 'Price (High - Low)',
          'rating-asc' => 'Rating (Highest)',
          'rating-desc' => 'Rating (Lowest)',
          'condition-asc' => 'Condition (New - Used)',
          'condition-desc' => 'Condition (Used - New)',
        ), 
        null,
        ['class' => 'form-control input-sm', 'id' => 'order-by-search'])
    }}

    <!--<select id="order-by-search" class="form-control input-sm">
      <option value="default" selected="selected">Default</option>
      <option value="alphabetic-asc">Name (A - Z)</option>
      <option value="alphabetic-desc">Name (Z - A)</option>
      <option value="price-asc">Price (Low - High)</option>
      <option value="price-desc">Price (High - Low)</option>
      <option value="rating-asc">Rating (Highest)</option>
      <option value="rating-desc">Rating (Lowest)</option>
      <option value="condition-asc">Condition (New - Used)</option>
      <option value="condition-desc">Condition (Used - New)</option>
      <option value="option-desc">Option (Sale - Barter)</option>
      <option value="option-asc">Option (Barter - Sale)</option>
    </select>-->
  </div>
</div>