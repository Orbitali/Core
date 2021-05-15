@extends("Orbitali::inc.app")

@section('content')
<div class="block block-rounded block-bordered invisible" data-toggle="appear">
    <div class="block-header block-header-default">
        <h3 class="block-title">@lang(['native.panel.form.title','Formlar'])</h3>
        <div class="block-options">
            @can('update',\Orbitali\Http\Models\Structure::class)
            <a href="{{route("panel.structure.edit",[$form->structure->id,"model_id"=>$form->id])}}"
                class="btn btn-sm btn-light js-tooltip"
                title="@lang(['native.panel.node.structure','Düğüm yapısını düzenle'])">
                <i class="fab fa-fw fa-wpforms" aria-hidden="true"></i>
            </a>
            @endcan
            <a href="{{route("panel.form.create")}}" class="btn btn-sm btn-light js-tooltip"
                title="@lang(['native.panel.form.add','Yeni form ekle'])">
                <i class="fas fa-fw fa-plus" aria-hidden="true"></i>
            </a>
        </div>
    </div>
    <div class="block-content">
        <table class="table table-borderless table-vcenter">
            <thead>
                <tr>
                    <th scope="col">Key</th>
                    <th class="text-center" style="width: .875em;" scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($entries as $entry)
                <tr>
                    <td>{{$entry->id}}</td>
                    <td>{{ \Orbitali\Foundations\Helpers\Arr::get($entry,'Isim: $data.name  Email: $data.email')}}</td>
                    <td class="text-center">
                        <div class="btn-group">
                            <a href="{{route("panel.form.entry",$entry->id)}}" class="btn btn-sm btn-primary js-tooltip"
                                data-toggle="tooltip" data-animation="true"
                                title="@lang(['native.panel.form.show','Görüntüle'])">
                                <i class="fa fa-eye" aria-hidden="true"></i>
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
                            {!! $entries->links() !!}
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
                text: "@lang(['native.wont.recover','Website\'yi geri getiremeyeceksiniz'])",
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