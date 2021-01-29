@extends("Orbitali::inc.app")

@section('content')
    <div class="block block-rounded block-bordered invisible" data-toggle="appear">
        <div class="block-header block-header-default">
            <h3 class="block-title">@lang(['native.panel.website.title','Websiteleri'])</h3>
            <div class="block-options">
                <a href="{{route("panel.website.create")}}"
                   class="btn btn-sm btn-light js-tooltip"
                   title="@lang(['native.panel.website.add','Yeni websitesi ekle'])">
                    <i class="fas fa-fw fa-plus"></i>
                </a>
            </div>
        </div>
        <div class="block-content">
            <table class="table table-borderless table-vcenter">
                <thead>
                <tr>
                    <th class="d-none d-sm-table-cell" style="width: .875em;"></th>
                    <th>İsim</th>
                    <th style="width: .875em;">Diller</th>
                    <th class="text-center" style="width: .875em;"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($websites as $website)
                    <tr>
                        <th class="text-center" scope="row"><i
                                class="fa fa-sm fa-circle text-{{ ["danger","success","dark"][$website->status??0] }}"></i>
                        </th>
                        <td class="font-w600">{{$website->detail->name ?? $website->id}}</td>
                        <td class="font-w600">
                            @if(is_array($website->languages))
                                <button type="button" class="btn btn-sm js-tooltip w-100"
                                        data-toggle="tooltip"
                                        data-animation="true"
                                        title="{{array_reduce($website->languages,function($k,$lang){return $k.($k?", ":"").trans("native.language.$lang");})}}">
                                    {{ count($website->languages) }}
                                </button>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="{{route("panel.website.show",$website->id)}}"
                                   class="btn btn-sm btn-primary js-tooltip"
                                   data-toggle="tooltip" data-animation="true"
                                   title="@lang(['native.panel.website.show','Görüntüle'])">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="{{route("panel.website.edit",$website->id)}}"
                                   class="btn btn-sm btn-primary js-tooltip"
                                   data-toggle="tooltip" data-animation="true"
                                   title="@lang(['native.panel.website.edit','Düzenle'])">
                                    <i class="fa fa-pencil-alt"></i>
                                </a>
                                <a href="{{route("panel.website.destroy",$website->id)}}"
                                   onclick="ask(event)"
                                   class="btn btn-sm btn-primary js-tooltip"
                                   data-toggle="tooltip" data-animation="true"
                                   title="@lang(['native.panel.website.destroy','Sil'])">
                                    <i class="fa fa-times"></i>
                                    {{ html()->form('DELETE',  route('panel.website.destroy', $website->id))->class('d-none') }}
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
                            {!! $websites->links() !!}
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
