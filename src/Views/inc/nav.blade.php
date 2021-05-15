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
                <li class="nav-main-heading">Manage</li>
                <li class="nav-main-item">
                    <a class="nav-main-link {{ \Orbitali\Foundations\Helpers\Route::isActiveRoute("panel.index") }}"
                        href="{{route("panel.index")}}">
                        <i class="nav-main-link-icon fa fa-chart-pie" aria-hidden="true"></i>
                        <span class="nav-main-link-name">Dashboard</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link {{ \Orbitali\Foundations\Helpers\Route::isActiveRoute("panel.website.*") }}"
                        href="{{route('panel.website.index')}}">
                        <i class="nav-main-link-icon fas fa-atlas" aria-hidden="true"></i>
                        <span class="nav-main-link-name">Websites</span>
                    </a>
                </li>
                @can('*',\Orbitali\Http\Models\Structure::class)
                <li class="nav-main-item">
                    <a class="nav-main-link {{ \Orbitali\Foundations\Helpers\Route::isActiveRoute("panel.structure.*") }}"
                        href="{{route('panel.structure.index')}}">
                        <i class="nav-main-link-icon fas fa-cubes" aria-hidden="true"></i>
                        <span class="nav-main-link-name">Structures</span>
                    </a>
                </li>
                @endcan
                <li class="nav-main-item">
                    <a class="nav-main-link nav-main-link-submenu {{ \Orbitali\Foundations\Helpers\Route::isActiveRoute("panel.node.*") }}"
                        data-toggle="submenu" aria-haspopup="true" href="#">
                        <i class="nav-main-link-icon fas fa-code-branch" aria-hidden="true"></i>
                        <span class="nav-main-link-name">Nodes</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link {{ \Orbitali\Foundations\Helpers\Route::isActiveRoute("panel.node.index") }}"
                                href="{{route('panel.node.index')}}">
                                <span class="nav-main-link-name">All</span>
                            </a>
                        </li>
                        @foreach($orbitali->website->loadMissing('nodes.detail')->nodes->loadCount('pages') as $node)
                        <li class="nav-main-item">
                            @php($routeName = $node->single ? "panel.node.edit":"panel.node.show")
                            <a class="nav-main-link {{ \Orbitali\Foundations\Helpers\Route::isActiveRoute($routeName) }}"
                                href="{{route($routeName ,$node)}}">
                                <span class="nav-main-link-name">{{$node->detail->name ?? $node->id }}</span>
                                @if(!$node->single)
                                <span
                                    class="nav-main-link-badge badge badge-pill badge-success">{{$node->pages_count}}</span>
                                @endif
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </li>
                @can('*',\Orbitali\Http\Models\User::class)
                <li class="nav-main-item">
                    <a class="nav-main-link {{ \Orbitali\Foundations\Helpers\Route::isActiveRoute("panel.user.*") }}"
                        href="{{route('panel.user.index')}}">
                        <i class="nav-main-link-icon fas fa-users" aria-hidden="true"></i>
                        <span class="nav-main-link-name">Users</span>
                    </a>
                </li>
                @endcan
                @can('*',\Orbitali\Http\Models\Form::class)
                <li class="nav-main-item">
                    <a class="nav-main-link {{ \Orbitali\Foundations\Helpers\Route::isActiveRoute("panel.form.*") }}"
                        href="{{route('panel.form.index')}}">
                        <i class="nav-main-link-icon fas fa-2x fa-file-invoice" aria-hidden="true"></i>
                        <span class="nav-main-link-name">Forms</span>
                    </a>
                </li>
                @endcan
            </ul>
        </div>
        {{-- END Main Navigation --}}
    </div>
</div>
{{-- END Navigation --}}