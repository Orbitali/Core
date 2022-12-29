{{-- User Dropdown --}}
<div class="dropdown d-inline-block">
    <button type="button" class="btn btn-alt-secondary border-0" id="page-header-user-dropdown" data-bs-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <img class="img-avatar img-avatar32 img-avatar-thumb" src="{{gravatar(auth()->user()->email,64)}}"
            alt="profile photo">
        <span class="d-none d-sm-inline ml-1">{{ auth()->user()->name }}</span>
        {{--<span class="badge badge-pill badge-warning ml-1">Dev</span>--}}
    </button>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0" aria-labelledby="page-header-user-dropdown">
        <div class="bg-body-light rounded-top text-center">
            <div class="pt-3">
                <img class="img-avatar img-avatar-thumb" src="{{gravatar(auth()->user()->email,64)}}"
                    alt="profile image">
            </div>
            <div class="pb-3 pt-1">
                <div class="text-body-color fw-bold">{{ auth()->user()->name }}</div>
                <div class="text-muted">{{auth()->user()->email}}</div>
            </div>
        </div>
        <div class="p-2">
            @if(config("clockwork.enable"))
            <a class="dropdown-item d-flex justify-content-between align-items-center"
                href="{{route('panel.clockwork')}}" target="_blank" rel="noopener">
                Logs
                <i class="fa fa-fw fa-dolly ml-1" aria-hidden="true"></i>
            </a>
            @endif
            <a class="dropdown-item d-flex justify-content-between align-items-center" href="#"
                onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                Log Out
                <i class="fa fa-fw fa-sign-out-alt ml-1" aria-hidden="true"></i>
            </a>
            <form id="logout-form" action="{{route('logout')}}" method="POST">@csrf</form>
        </div>
    </div>
</div>
{{-- END User Dropdown --}}
