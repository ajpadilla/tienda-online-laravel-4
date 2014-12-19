<div class="row wrapper border-bottom white-bg page-heading">
{{--	<div class="header-navigation">
		<ul>
		@if($categoriesMenu)
			@foreach($categoriesMenu as $category)
				<li class="dropdown dropdown-megamenu">
			        <a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-target="#" href="#">{{ $category['name'] }}</a>
			        @if(isset($category['array']))
				        <ul class="dropdown-menu">
					        <li>
					          <div class="header-navigation-content">
					            <div class="row">
					            @foreach($category['array'] as $subCategory)
					              <div class="col-md-4 header-navigation-col">
					                <h4><a href="#">{{ $subCategory['name'] }}</a></h4>
					                @if(isset($subCategory['array']))
						                <ul>
						                    @foreach($subCategory['array'] as $thirdCategory)
						                        <li><a href="shop-product-list.html">{{ $thirdCategory['name'] }}</a></li>
						                    @endforeach
						                </ul>
					                @endif
					              </div>
					            @endforeach
					              --}}{{--<div class="col-md-12 nav-brands">
					                <ul>
					                  <li><a href="shop-product-list.html"><img title="esprit" alt="esprit" src="../../assets/frontend/pages/img/brands/esprit.jpg"></a></li>
					                  <li><a href="shop-product-list.html"><img title="gap" alt="gap" src="../../assets/frontend/pages/img/brands/gap.jpg"></a></li>
					                </ul>
					              </div>--}}{{--
					            </div>
					          </div>
					        </li>
				        </ul>
				    @endif
			    </li>
			@endforeach
	    @endif
	    </ul>
    </div>--}}
{{--	<div class="dropdown">
	  <button class="btn dropdown-toggle sr-only" type="button"
	          id="dropdownMenu1" data-toggle="dropdown">
	    Menú desplegable
	    <span class="caret"></span>
	  </button>

	  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
	    <li role="presentation">
	      <a role="menuitem" tabindex="-1" href="#">Acción</a>
	    </li>
	    <li role="presentation">
	      <a role="menuitem" tabindex="-1" href="#">Otra acción</a>
	    </li>
	    <li role="presentation">
	      <a role="menuitem" tabindex="-1" href="#">Otra acción más</a>
	    </li>
	    <li role="presentation" class="divider"></li>
	    <li role="presentation">
	      <a role="menuitem" tabindex="-1" href="#">Acción separada</a>
	    </li>
	  </ul>
	</div>--}}


	{{--<p>Tabs With Dropdown Example</p>
	<ul class="nav nav-tabs">
	   <li class="active"><a href="#">Home</a></li>
	   <li><a href="#">SVN</a></li>
	   <li><a href="#">iOS</a></li>
	   <li><a href="#">VB.Net</a></li>
	   <li class="dropdown">
	      <a class="dropdown-toggle" data-toggle="dropdown" href="#">
	         Java <span class="caret"></span>
	      </a>
	      <ul class="dropdown-menu">
	         <li><a href="#">Swing</a></li>
	         <li><a href="#">jMeter</a></li>
	         <li><a href="#">EJB</a></li>
	         <li class="divider"></li>
	         <li><a href="#">Separated link</a></li>
	      </ul>
	   </li>
	   <li><a href="#">PHP</a></li>
	</ul>--}}

	{{--<nav class="navbar navbar-default" role="navigation">
	   --}}{{--<div class="navbar-header">
	      <a class="navbar-brand" href="#">TutorialsPoint</a>
	   </div>--}}{{--
	   <div>
	      <ul class="nav navbar-nav">
	         <li class="active"><a href="#">iOS</a></li>
	         <li><a href="#">SVN</a></li>
	         <li class="dropdown dropdown-submenu">
	            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
	               Java
	               <b class="caret"></b>
	            </a>
	            <ul class="dropdown-menu">
	               <li><a href="#">jmeter</a></li>
	               <li><a href="#">EJB</a></li>
	               <li><a href="#">Jasper Report</a></li>
	               <li role="presentation" class="dropdown-header">Título de sección #1</li>
	               <li class="divider"></li>
	               <li><a href="#">Separated link</a></li>
	               <li class="divider"></li>
	               <li><a href="#">One more separated link</a></li>
	            </ul>
	         </li>
	      </ul>
	   </div>
	</nav>--}}

{{--	<div class="dropdown">
        <a id="dLabel" role="button" data-toggle="dropdown" class="btn btn-primary" data-target="#" href="/page.html">
            Dropdown <span class="caret"></span>
        </a>
        <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
          <li><a href="#">Some action</a></li>
          <li><a href="#">Some other action</a></li>
          <li class="divider"></li>
          <li class="dropdown-submenu">
            <a tabindex="-1" href="#">Hover me for more options</a>
            <ul class="dropdown-menu">
              <li><a tabindex="-1" href="#">Second level</a></li>
              <li class="dropdown-submenu">
                <a href="#">Even More..</a>
                <ul class="dropdown-menu">
                    <li><a href="#">3rd level</a></li>
                    <li><a href="#">3rd level</a></li>
                </ul>
              </li>
              <li><a href="#">Second level</a></li>
              <li><a href="#">Second level</a></li>
            </ul>
          </li>
        </ul>
    </div>--}}

	<nav class="navbar navbar-default" role="navigation">
		<div>
		@if($categoriesMenu)
            @foreach($categoriesMenu as $category)
			<ul class="nav navbar-nav">
				@if(isset($category['array']))
					<li class="dropdown multi-level">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">{{ $category['name'] }}</a>
                        <ul class="dropdown-menu">
                            @foreach($category['array'] as $subCategory)
                                @if(isset($subCategory['array']))
                                    <li class="dropdown-submenu">
                                        <a href="#">{{ $subCategory['name'] }}</a>
                                        <ul class="dropdown-menu">
                                            @foreach($subCategory['array'] as $thirdCategory)
                                                <li><a href="#">{{ $thirdCategory['name'] }}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @else
                                    <li><a href="#">{{ $subCategory['name'] }}</a></li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                @else
                    <li class="active"><a href="#">{{ $category['name'] }}</a></li>
				@endif
			</ul>
			@endforeach
		@endif
	    </div>
	</nav>
</div>