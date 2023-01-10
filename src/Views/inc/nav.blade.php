{{--TODO: Link with @lang all--}}
{{-- Navigation --}}
<div class="bg-body-extra-light">
    <div class="content pt-3">
        {{-- Toggle Main Navigation --}}
        <div class="d-md-none push">
            {{-- Class Toggle, functionality initialized in Helpers.coreToggleClass() --}}
            <button type="button" class="btn btn-block btn-alt-secondary w-100 d-flex justify-content-between align-items-center"
                data-toggle="class-toggle" data-target="#main-navigation" data-class="d-none">
                Menu
                <i class="fa fa-fw fa-bars" aria-hidden="true"></i>
            </button>
        </div>
        {{-- END Toggle Main Navigation --}}

        {{-- Main Navigation --}}
        <div id="main-navigation" class="d-none d-md-block mb-3">
            <ul class="nav-main nav-main-horizontal nav-main-hover">
                @php($cache = collect([orbitali()->menu, auth()->user()]))
                @cache($cache)
                @each('Orbitali::inc.menu', orbitali("menu"), 'menu')
                @endcache
            </ul>
        </div>
        {{-- END Main Navigation --}}
    </div>
</div>
{{-- END Navigation --}}
