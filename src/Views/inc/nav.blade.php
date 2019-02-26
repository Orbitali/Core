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
                    <a class="nav-main-link {{ \Orbitali\Foundations\Helpers\Route::isActiveRoute("panel.website.*") }}" href="{{route('panel.website.index')}}">
                        <i class="nav-main-link-icon fa fa-globe"></i>
                        <span class="nav-main-link-name">Websites</span>
                    </a>
                </li>

                <li class="nav-main-item">
                    <a class="nav-main-link {{ \Orbitali\Foundations\Helpers\Route::isActiveRoute("panel.index") }}" href="{{route("panel.index")}}">
                        <i class="nav-main-link-icon fa fa-chart-pie"></i>
                        <span class="nav-main-link-name">Dashboard</span>
                        <span class="nav-main-link-badge badge badge-pill badge-success">5</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                       aria-expanded="false" href="#">
                        <i class="nav-main-link-icon fa fa-sync-alt"></i>
                        <span class="nav-main-link-name">Subscriptions</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="">
                                <span class="nav-main-link-name">Active</span>
                                <span class="nav-main-link-badge badge badge-pill badge-success">1</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="">
                                <span class="nav-main-link-name">Manage</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="">
                                <span class="nav-main-link-name">Settings</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-main-heading">Account</li>
                <li class="nav-main-item">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                       aria-expanded="false" href="#">
                        <i class="nav-main-link-icon fa fa-user-circle"></i>
                        <span class="nav-main-link-name">Billing &amp; Account</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="">
                                <span class="nav-main-link-name">Manage</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="">
                                <span class="nav-main-link-name">Privacy Settings</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="">
                                <span class="nav-main-link-name">Make Payment</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="">
                                <span class="nav-main-link-name">View Invoices</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="">
                                <span class="nav-main-link-name">Security</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="">
                                <span class="nav-main-link-name">Statistics</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                       aria-expanded="false" href="#">
                        <i class="nav-main-link-icon fa fa-life-ring"></i>
                        <span class="nav-main-link-name">Support</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="">
                                <span class="nav-main-link-name">Contact Support</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="">
                                <span class="nav-main-link-name">Knowledge Base</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        {{-- END Main Navigation --}}
    </div>
</div>
{{-- END Navigation --}}
