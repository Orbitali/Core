<div class="main-header">
    <!-- Logo Header -->
    <div class="logo-header" data-background-color="dark">

        <a href="javascript:;" class="logo">
            orbitali
        </a>
        <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="icon-menu"></i>
					</span>
        </button>
        <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
        <div class="nav-toggle">
            <button class="btn btn-toggle toggle-sidebar">
                <i class="icon-menu"></i>
            </button>
        </div>
    </div>
    <!-- End Logo Header -->

    <!-- Navbar Header -->
    <nav class="navbar navbar-header navbar-expand-lg" data-background-color="dark2">

        <div class="container-fluid">
            <div class="collapse d-block col-md-auto">
                <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                    @foreach(panel_header_menu() as $key => $menu)
                        <li class="nav-item dropdown hidden-caret">
                            <a class="nav-link dropdown-toggle" href="#" id="{{ $menu['id'] }}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="{{ $menu['icon'] }}"></i>
                                <strong>{{ $menu['title'] }}</strong>
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="{{ $menu['id'] }}">
                                @foreach($menu['sub'] as $menuSub)
                                    <a class="dropdown-item" href="{{ $menuSub['url'] }}">{{ $menuSub['title'] }}</a>
                                    @if(!$loop->last)
                                        <div role="separator" class="dropdown-divider"></div>
                                    @endif
                                @endforeach
                            </div>
                        </li>
                    @endforeach
                    @if(function_exists('panel_header_add_menu'))
                        @foreach(panel_header_add_menu() as $addKey => $addMenu)
                            <li class="nav-item dropdown hidden-caret">
                                <a class="nav-link dropdown-toggle" href="#" id="{{ $addMenu['id'] }}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="{{ $addMenu['icon'] }}"></i>
                                    <strong>{{ $addMenu['title'] }}</strong>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="{{ $addMenu['id'] }}">
                                    @foreach($addMenu['sub'] as $addMenuSub)
                                        <a class="dropdown-item" href="{{ $addMenuSub['url'] }}">{{ $addMenuSub['title'] }}</a>
                                        @if(!$loop->last)
                                            <div role="separator" class="dropdown-divider"></div>
                                        @endif
                                    @endforeach
                                </div>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
            <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                <li class="nav-item dropdown hidden-caret">
                    <a class="nav-link dropdown-toggle" href="javascript:;" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-envelope"></i>
                        <span class="notification">0</span>
                    </a>
                </li>
                <li class="nav-item dropdown hidden-caret">
                    <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                        <div class="avatar-sm">
                            <img src="{{ config('orbitali.assetPath') . "img/profile.jpg" }}" class="avatar-img rounded-circle">
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-user animated fadeIn">
                        <div class="dropdown-user-scroll scrollbar-outer">
                            <li>
                                <div class="user-box">
                                    <div class="avatar-lg"><img src="{{ config('orbitali.assetPath') . "img/profile.jpg" }}" alt="image profile" class="avatar-img rounded"></div>
                                    <div class="u-text">
                                        <h4>Hizrian</h4>
                                        <p class="text-muted">hello@example.com</p><a href="#" class="btn btn-xs btn-default btn-sm">Hesabımı Görüntüle</a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Siteye Git</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Çıkış Yap</a>
                            </li>
                        </div>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <!-- End Navbar -->
</div>