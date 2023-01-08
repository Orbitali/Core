@can('view',$menu)
<li class="nav-main-item">
    @if($menu->children->count() > 0)
    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" href="#">
        @if(isset($menu->icon))
        <i class="nav-main-link-icon {{$menu->icon->implode(' ')}}" aria-hidden="true"></i>
        @endif
        <span class="nav-main-link-name">{{$menu->detail->name ?? ""}}</span>
    </a>
    <ul class="nav-main-submenu">
        @each('Orbitali::inc.menu', $menu->children, 'menu')
    </ul>
    @else
    <a class="nav-main-link" href="{{$menu->data}}">
        @if(isset($menu->icon))
        <i class="nav-main-link-icon {{$menu->icon->implode(' ')}}" aria-hidden="true"></i>
        @endif
        <span class="nav-main-link-name">{{$menu->detail->name ?? ""}}</span>
    </a>
    @endif
</li>
@endcan
