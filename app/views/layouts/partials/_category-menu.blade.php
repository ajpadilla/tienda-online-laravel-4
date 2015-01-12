<div class="row wrapper border-bottom white-bg page-heading" style="padding-bottom: 5px; padding-top: 5px">


    <nav class="navbar navbar-default" style="margin-bottom: 0px;" role="navigation">
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