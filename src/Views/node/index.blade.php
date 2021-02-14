@extends("Orbitali::inc.app")

@section('content')
<div class="block block-rounded block-bordered invisible" data-toggle="appear">
    <div class="block-header block-header-default">
        <h3 class="block-title">@lang(['native.panel.node.title','Düğümler'])</h3>
        <div class="block-options">
            <a href="{{route("panel.node.create")}}" class="btn btn-sm btn-light js-tooltip"
                title="@lang(['native.panel.node.add','Yeni düğüm ekle'])">
                <i class="fas fa-fw fa-plus" aria-hidden="true"></i>
            </a>
        </div>
    </div>
    <div class="block-content">
        <table class="table table-borderless table-vcenter">
            <thead>
                <tr>
                    <th class="d-none d-sm-table-cell" style="width: .875em;"></th>
                    <th>İsim</th>
                    <th class="text-center" style="width: .875em;"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($nodes as $node)
                <tr>
                    <th class="text-center" scope="row"><i
                            class="fa fa-sm fa-circle text-{{ ["danger","success","dark"][$node->status??0] }}"
                            aria-hidden="true"></i>
                    </th>
                    <td class="font-w600">{{ $node->detail ? $node->detail->name : null }}</td>
                    <td class="text-center">
                        <div class="btn-group">
                            <a href="{{route("panel.node.show",$node->id)}}" class="btn btn-sm btn-primary js-tooltip"
                                data-toggle="tooltip" data-animation="true"
                                title="@lang(['native.panel.node.show','Görüntüle'])">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </a>
                            <a href="{{route("panel.node.edit",$node->id)}}" class="btn btn-sm btn-primary js-tooltip"
                                data-toggle="tooltip" data-animation="true"
                                title="@lang(['native.panel.node.edit','Düzenle'])">
                                <i class="fa fa-pencil-alt" aria-hidden="true"></i>
                            </a>
                            <a href="{{route("panel.node.destroy",$node->id)}}" onclick="ask(event)"
                                class="btn btn-sm btn-primary js-tooltip" data-toggle="tooltip" data-animation="true"
                                title="@lang(['native.panel.node.destroy','Sil'])">
                                <i class="fa fa-times" aria-hidden="true"></i>
                                {{ html()->form('DELETE',  route('panel.node.destroy', $node->id))->class('d-none') }}
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4">
                        <div class="row justify-content-center">
                            {!! $nodes->links() !!}
                        </div>
                    </td>
                </tr>
            </tfoot>
        </table>
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