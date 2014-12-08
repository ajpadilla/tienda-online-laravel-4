<li class="dropdown">
    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
        <i class="fa fa-flag fa-lg"> {{ Lang::get('menu.language') }}</i>
    </a>
    <ul class="dropdown-menu">
        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
        <li>
            <a rel="alternate" id="{{$localeCode}}" hreflang="{{$localeCode}}" href="{{LaravelLocalization::getLocalizedURL($localeCode) }}">
                {{{ $properties['native'] }}}
            </a>
        </li>
        @endforeach
    </ul>
</li>