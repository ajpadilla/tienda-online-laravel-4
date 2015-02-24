<div class="sidebar-filter margin-bottom-25">
  <h2>Opciones de Búsqueda</h2>
  <h3>Condición</h3>
  <div class="checkbox-list">
    <label><input type="checkbox"> Nuevos</label>
    <label><input type="checkbox"> Usados</label>
    <label><input type="checkbox"> En venta</label>
    <label><input type="checkbox"> Para trueque</label>
  </div>

  <h3>Precio</h3>
  <p>
    <label for="price">Rango:</label>
    <input type="text" id="price" style="border:0; color:#f6931f; font-weight:bold;">
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