@extends("Orbitali::inc.app")

@section('content')
<div class="block block-rounded block-bordered invisible" data-toggle="appear">
    <div class="block-header block-header-default">
        <h3 class="block-title">{{$title}}</h3>
        <div class="block-options">
            @if($search)
            <form class="d-inline-block" method="GET">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-alt" type="text" placeholder="Search"
                        value="{{request("q")}}" name="q" />
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-alt-primary">
                            <i class="fa fa-fw fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
            @endif
            @foreach ($options as $option)
            <a href="{{$option->route}}" class="btn btn-sm btn-light js-tooltip" title="{{$option->title}}">
                <i class="fas fa-fw {{$option->icon}}" aria-hidden="true"></i>{{$option->text}}
            </a>
            @endforeach
        </div>
    </div>
    <div class="block-content">
        <div class="table-responsive">
            <table class="table table-borderless table-vcenter">
                <thead>
                    <tr>
                        {{-- <th class="d-none d-sm-table-cell" style="width: .875em;" scope="col"></th> --}}
                        @foreach ($columns as $column)
                        <th scope="col">{{$column["title"]}}</th>
                        @endforeach
                        @if(count($actions) > 0)
                        <th class="min-w px-0" scope="col"></th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse($query as $entity)
                    <tr>
                        @foreach ($columns as $column)
                        @if(Illuminate\Support\Str::endsWith($column["name"],"status"))
                        <td class="text-center min-w" scope="row"><i
                                class="fa fa-sm fa-circle text-{{ ["danger","success","dark"][data_get($entity,$column["name"])??0] }}"
                                aria-hidden="true"></i>
                        </td>
                        @else
                        <td>
                            @php($render = data_get($entity,$column["name"]))
                            @if (is_array($render))
                            <button type="button" class="btn btn-light btn-sm js-tooltip w-100" data-toggle="tooltip"
                                data-animation="true" title="{{ implode(", ",$render) }}">
                                {{ count($render) }}
                            </button>
                            @else
                            {{$render}}
                            @endif
                        </td>
                        @endif
                        @endforeach
                        @if(count($actions) > 0)
                        <td class="text-center min-w">
                            <div class="btn-group">
                                @foreach ($actions as $action)
                                @php($act = $action($entity))
                                @if(isset($act) && count((array)$act)>0)
                                <a href="{{$act->route}}" class="btn btn-sm btn-primary js-tooltip"
                                    data-toggle="tooltip" data-animation="true" title="{{$act->title}}">
                                    <i class="fa {{$act->icon}}" aria-hidden="true"></i>{{$act->text}}
                                </a>
                                @endif
                                @endforeach
                            </div>
                        </td>
                        @endif
                    </tr>
                    @empty
                    <tr>
                        <td class="text-center" scope="row" colspan="100%">@lang(['native.panel.empty_record',"No Record
                            Found"])</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="row justify-content-center">
            {!! $query->links('Orbitali::inc.paginate') !!}
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script>
    function ask(e) {
            e.preventDefault();
            var $form = $('form', e.target);
            var $swal = swal.mixin({
                buttonsStyling: !1,
                confirmButtonClass: "btn btn-success m-1",
                cancelButtonClass: "btn btn-danger m-1",
                inputClass: "form-control"
            });
            $swal.fire({
                showCancelButton: !0,
                title: "@lang(['native.are.you.sure',"Emin misiniz ?"])",
                confirmButtonText: "@lang(['native.yes','Evet'])",
                cancelButtonText: "@lang(['native.cancel','İptal'])",
                text: "@lang(['native.wont.recover','Düğüm\'ü geri getiremeyeceksiniz'])",
                type: "warning",
                html: !1,
            }).then(function (e) {
                if (e.value) {
                    $swal.fire("@lang(["native.deleted","Silindi"])", "", "success").then(function () {
                        $form.submit();
                    });
                }
            });
        }
</script>
@endpush