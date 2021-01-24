{{--TODO: Link with @lang all--}}
{{-- Navigation --}}
<div class="bg-white">
    <div class="content">
        {{-- Toggle Main Navigation --}}
        <div class="d-lg-none push">
            {{-- Class Toggle, functionality initialized in Helpers.coreToggleClass() --}}
            <button type="button" class="btn btn-block btn-light d-flex justify-content-between align-items-center"
                    data-toggle="class-toggle" data-target="#main-navigation" data-class="d-none">
                Menu
                <i class="fa fa-bars"></i>
            </button>
        </div>
        {{-- END Toggle Main Navigation --}}

        {{-- Main Navigation --}}
        <div id="main-navigation" class="d-none d-lg-block push">
            <ul class="nav-main nav-main-horizontal nav-main-hover">
                <li class="nav-main-heading">Manage</li>
                <li class="nav-main-item">
                    <a class="nav-main-link {{ \Orbitali\Foundations\Helpers\Route::isActiveRoute("panel.index") }}" href="{{route("panel.index")}}">
                        <i class="nav-main-link-icon fa fa-chart-pie"></i>
                        <span class="nav-main-link-name">Dashboard</span>
                        <span class="nav-main-link-badge badge badge-pill badge-success">5</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link {{ \Orbitali\Foundations\Helpers\Route::isActiveRoute("panel.website.*") }}" href="{{route('panel.website.index')}}">
                        <i class="nav-main-link-icon fa fa-globe"></i>
                        <span class="nav-main-link-name">Websites</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link {{ \Orbitali\Foundations\Helpers\Route::isActiveRoute("panel.structure.*") }}" href="{{route('panel.structure.index')}}">
                        <i class="nav-main-link-icon fa fa-globe"></i>
                        <span class="nav-main-link-name">Structures</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link nav-main-link-submenu {{ \Orbitali\Foundations\Helpers\Route::isActiveRoute("panel.node.*") }}" data-toggle="submenu" aria-haspopup="true" href="#">
                        <i class="nav-main-link-icon fa fa-globe"></i>
                        <span class="nav-main-link-name">Nodes</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link {{ \Orbitali\Foundations\Helpers\Route::isActiveRoute("panel.node.index") }}" href="{{route('panel.node.index')}}">
                                <span class="nav-main-link-name">All</span>
                            </a>
                        </li>
                        @foreach(orbitali('website')->loadMissing('nodes.detail')->nodes as $node)
                        <li class="nav-main-item">
                            <a class="nav-main-link {{ \Orbitali\Foundations\Helpers\Route::isActiveRoute("panel.node.edit") }}" href="{{route('panel.node.show',$node)}}">
                                <span class="nav-main-link-name">{{$node->detail->name ?? $node->id }}</span>
                                <span class="nav-main-link-badge badge badge-pill badge-success">{{$node->pages()->count()}}</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </li>
            </ul>
        </div>
        {{-- END Main Navigation --}}
    </div>
</div>
{{-- END Navigation --}}
