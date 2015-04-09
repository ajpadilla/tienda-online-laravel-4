<div class="sidebar-filter margin-bottom-25">
  <h2>Opciones de Búsqueda</h2>
  <!--<h3>Condición</h3>-->
  <!--<div class="checkbox-list">
    <label><input type="checkbox"> Nuevos</label>
    <label><input type="checkbox"> Usados</label>
    <label><input type="checkbox"> En venta</label>
    <label><input type="checkbox"> Para trueque</label>
  </div>-->
  
  <div class="checkbox-list">
    <label><input type="checkbox" name="select-search[]" id="product" value="product"> Productos </label>
    <label><input type="checkbox" name="select-search[]" id="classified" value="classified"> Clasificados </label>
  </div>


  <div class="col-sm-10">
    {{ Form::select('categories[]', $categories, null,
        ['class' => 'chosen-select form-control',
        'multiple' => 'multiple', 'data-placeholder' => 'Escoge Categorías...', 'id' =>'categories'])
    }}
  </div>

  <div class="col-sm-10" id="conditionProduct">
    {{
      Form::select('conditionsProducts', array(), null,
          ['class' => 'chosen-select form-control', 'data-placeholder' => 'Condition product', 'id' => 'conditionsProducts'])
      }}
    <a href="{{ URL::route('productCondition.current-lang') }}" id="search-data-conditions-product-lang"></a>
  </div>

  <div class="col-sm-10" id="conditionClassified">
    {{
      Form::select('conditionsClassifieds', array(), null,
          ['class' => 'chosen-select form-control', 'data-placeholder' => 'Condition classified', 'id' => 'conditionsClassifieds'])
      }}
    <a href="{{ URL::route('classifiedConditions.current-lang') }}" id="search-data-conditions-classified-lang"></a>
  </div>

  <div class="col-sm-10" id="type">
    {{
      Form::select('classified_type', array(), null,
          ['class' => 'chosen-select form-control', 'data-placeholder' => 'Type classified', 'id' => 'classifiedType'])
      }}
      <a href="{{ URL::route('classifiedTypes.current-lang') }}" id="search-data-classified-type-lang"></a>
  </div>

  <div class="row">

    <div class="col-sm-8 ">
      {{ Form::select('countryId',array(),null,['class' => 'chosen-select form-control','placeholder'=>'Pais','id'=>'countryId']) }}
      <a href="{{ URL::route('classifieds.countries') }}" id="search-data-for-country"></a>
    </div>

    <div class="col-sm-8">
    {{ Form::select('stateId',array(''),null,array('class' => 'chosen-select form-control','placeholder'=>'Estado','id'=>'stateId')) }}
      <a href="{{ URL::route('classifieds.statesForCountry') }}" id="search-data-for-states"></a>
    </div>

  <div class="col-sm-8">
    {{ Form::select('cityId',array(''),null,array('class' => 'chosen-select form-control','id'=>'cityId')) }}
    <a href="{{ URL::route('classifieds.citiesForState') }}" id="search-data-for-cities"></a>
  </div>

  <!--<div class="col-sm-8">
    {{ Form::select('operator',
      array(
          '>' => 'Mayor a', 
          '<' => 'Menor a',
          '=' => 'Igual a'
        ,),
        null,array('class' => 'form-control input-sm','id'=>'operator')) }}
  </div>

      <div class="col-sm-8">
        {{ Form::text('price',null, ['class' => 'form-control input-sm','placeholder' =>'Precio','id'=> 'price']) }}
      </div>-->

    </div>

  <h3>Precio</h3>
  <p>
    <label for="priceRange">Rango:</label>
    <input type="text" id="priceRange" style="border:0; color:#f6931f; font-weight:bold;">
    <a href="{{ URL::route('products.search') }}" id="search"></a>
  </p>
  <div id="slider-range-price"></div>

  <h3>Precio en puntos</h3>
  <p>
    <label for="price-points">Rango:</label>
    <input type="text" id="price-points" style="border:0; color:#f6931f; font-weight:bold;">
  </p>
  <div id="slider-range-price-points"></div>
</div>