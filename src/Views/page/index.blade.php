@extends("Orbitali::inc.app")

@section('content')
<div class="block block-rounded block-bordered invisible" data-toggle="appear">
    <div class="block-header block-header-default">
        <h3 class="block-title">@lang(['native.panel.page.title','Sayfalar'])</h3>
        <div class="block-options">
            <a href="{{route("panel.node.page.create",[0])}}" class="btn btn-sm btn-light js-tooltip"
                title="@lang(['native.panel.page.add','Yeni sayfa ekle'])">
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
                @foreach($pages as $page)
                <tr>
                    <th class="text-center" scope="row"><i
                            class="fa fa-sm fa-circle text-{{ ["danger","success","dark"][$page->status??0] }}"
                            aria-hidden="true"></i>
                    </th>
                    <td>{{ $page->detail ? $page->detail->name : null }}</td>
                    <td class="text-center">
                        <div class="btn-group">
                            <a href="{{route("panel.page.show",$page->id)}}" class="btn btn-sm btn-primary js-tooltip"
                                data-toggle="tooltip" data-animation="true"
                                title="@lang(['native.panel.page.show','Görüntüle'])">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </a>
                            <a href="{{route("panel.page.edit",$page->id)}}" class="btn btn-sm btn-primary js-tooltip"
                                data-toggle="tooltip" data-animation="true"
                                title="@lang(['native.panel.page.edit','Düzenle'])">
                                <i class="fa fa-pencil-alt" aria-hidden="true"></i>
                            </a>
                            <a href="{{route("panel.page.destroy",$page->id)}}" class="btn btn-sm btn-primary"
                                data-remove-form>
                                <i class="fa fa-times" aria-hidden="true"></i>
                                {{ html()->form('DELETE',  route('panel.page.destroy', $page->id))->class('d-none') }}
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
                            {!! $pages->links('Orbitali::inc.paginate') !!}
                        </div>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<template id="block_remove_form_template" data-title="@lang(['native.are.you.sure'," Emin misiniz ?"])">
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                @lang(['native.wont.recover','Sayfay\'ı geri getiremeyeceksiniz'])
            </div>
            <div class="d-flex justify-content-around">
                <a href="#" class="btn btn-sm btn-secondary">@lang(['native.cancel','İptal'])</a>
                <a href="#" data-submit class="btn btn-sm btn-danger">@lang(['native.yes','Evet'])</a>
            </div>
        </div>
    </div>
</template>
@endpush