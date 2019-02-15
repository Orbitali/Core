{{-- User Dropdown --}}
<div class="dropdown d-inline-block">
    <button type="button" class="btn btn-dual dropdown-toggle" id="page-header-user-dropdown"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <img class="img-avatar img-avatar32 img-avatar-thumb" src="{{gravatar(auth()->user()->email,32)}}"
             alt="">
        <span class="d-none d-sm-inline ml-1">{{ auth()->user()->name }}</span>
        {{--<span class="badge badge-pill badge-success ml-1">PRO</span>--}}
    </button>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
         aria-labelledby="page-header-user-dropdown">
        <div class="rounded-top font-w600 text-white text-center bg-image"
             style="background-image: url('https://source.unsplash.com/random/300x200');">
            <div class="p-3">
                <img class="img-avatar img-avatar-thumb" src="{{gravatar(auth()->user()->email,64)}}"
                     alt="">
            </div>
            <div class="p-3 bg-primary-dark-op">
                <a class="text-white font-w600"
                   href="be_pages_generic_profile.html">{{ auth()->user()->name }}</a>
                <div class="text-white-75">{{auth()->user()->email}}</div>
            </div>
        </div>
        <div class="p-2">
            <div role="separator" class="dropdown-divider"></div>
            <a class="dropdown-item d-flex justify-content-between align-items-center"
               href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                Log Out
                <i class="fa fa-fw fa-sign-out-alt text-danger ml-1"></i>
            </a>
            <form id="logout-form" action="{{route('logout')}}" method="POST" >@csrf</form>
        </div>
    </div>
</div>
{{-- END User Dropdown --}}
