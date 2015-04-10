<div class="dropdown profile-element"> 
    <span>
        <img alt="image" class="img-circle" src="{{ asset('assets/img/profile_small.jpg') }}">
    </span>
    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
        <span class="clear"> <span class="block m-t-xs"> 
            <strong class="font-bold">
                {{ $currentUser->people->name }}
            </strong>
            </span> 
            <span class="text-muted text-xs block">{{ $currentUser->people->lastname }}<b class="caret"></b></span> 
        </span> 
    </a>
    <ul class="dropdown-menu animated fadeInRight m-t-xs">
        <li><a href="#">{{ Lang::get('pages.partials.profile') }}</a></li>
        <li class="divider"></li>
        <li><a href="{{ route('logout') }}">{{ Lang::get('pages.partials.logout') }}</a></li>
    </ul>
</div>