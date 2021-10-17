<div class="js-wizard-simple block block-rounded block-bordered" id="{{$id}}" {{$attributes}}>
    <ul class="nav nav-tabs nav-tabs-alt nav-justified sticky-top bg-white-95" role="tablist">
        @foreach($that->children as $child)
        <li class="nav-item">
            <a class="nav-link {{ $loop->first ? " active":"" }}" href="#{{$id}}-{{$child->id}}" data-toggle="tab"
                role="tab">
                {{$child->title}}
                @if($child->errorCount > 0)
                <span class="badge badge-pill badge-danger">{{$child->errorCount}}</span>
                @endif
            </a>
        </li>
        @endforeach
    </ul>
    <div class="block-content block-content-full tab-content">
        @foreach ($that->children as $child)
        <div class="tab-pane {{ $loop->first ? " active":"" }}" id="{{$id}}-{{$child->id}}" role="tabpanel">
            {{$renderChild($child)}}
        </div>
        @endforeach
    </div>
</div>