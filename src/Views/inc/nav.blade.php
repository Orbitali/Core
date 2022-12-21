{{--TODO: Link with @lang all--}}
{{-- Navigation --}}
<div class="bg-white">
    <div class="content pt-3">
        {{-- Toggle Main Navigation --}}
        <div class="d-md-none push">
            {{-- Class Toggle, functionality initialized in Helpers.coreToggleClass() --}}
            <button type="button" class="btn btn-block btn-light d-flex justify-content-between align-items-center"
                data-toggle="class-toggle" data-target="#main-navigation" data-class="d-none">
                Menu
                <i class="fa fa-bars" aria-hidden="true"></i>
            </button>
        </div>
        {{-- END Toggle Main Navigation --}}

        {{-- Main Navigation --}}
        <div id="main-navigation" class="d-none d-md-block mb-3">
            <ul class="nav-main nav-main-horizontal nav-main-hover">
                @foreach (orbitali("menu") as $menu)
                <li class="nav-main-item">
                    @if($menu->children->count() > 0)
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" href="#">
                        @if(isset($menu->icon))
                        <i class="nav-main-link-icon {{$menu->icon->implode(" ")}}" aria-hidden="true"></i>
                        @endif
                        <span class="nav-main-link-name">{{$menu->detail->name ?? ""}}</span>
                        @if($menu->count > 0)
                        <span class="nav-main-link-badge badge badge-pill badge-success">{{$menu->count}}</span>
                        @endif
                    </a>
                    <ul class="nav-main-submenu">
                        @foreach($menu->children as $childMenu)
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{$childMenu->data}}">
                                @if(isset($childMenu->icon))
                                <i class="nav-main-link-icon {{$childMenu->icon->implode(" ")}}" aria-hidden="true"></i>
                                @endif
                                <span class="nav-main-link-name">{{$childMenu->detail->name ?? ""}}</span>
                                @if($childMenu->count > 0)
                                <span
                                    class="nav-main-link-badge badge badge-pill badge-success">{{$childMenu->count}}</span>
                                @endif
                            </a>
                        </li>
                        @endforeach
                    </ul>
                    @else
                    <a class="nav-main-link" href="{{$menu->data}}">
                        @if(isset($menu->icon))
                        <i class="nav-main-link-icon {{$menu->icon->implode(" ")}}" aria-hidden="true"></i>
                        @endif
                        <span class="nav-main-link-name">{{$menu->detail->name ?? ""}}</span>
                        @if($menu->count > 0)
                        <span class="nav-main-link-badge badge badge-pill badge-success">{{$menu->count}}</span>
                        @endif
                    </a>
                    @endif

                </li>
                @endforeach
            </ul>
        </div>
        {{-- END Main Navigation --}}
    </div>
</div>
{{-- END Navigation --}}