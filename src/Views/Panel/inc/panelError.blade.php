@if(session("success") !== null || session("error") !== null)
    @if(session("success"))
        <div class="alert alert-success alert-dismissible fade show rounded-0" role="alert">
            {{ session("success") }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if(session("error"))
        <div class="alert alert-danger alert-dismissible fade show rounded-0" role="alert">
            {{ session("error") }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
@endisset
@if ($errors->any())
    <div class="alert alert-danger rounded-0">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
