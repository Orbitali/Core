@extends("Orbitali::inc.app")

@section('content')
    <div class="block block-rounded block-bordered">
        <div class="block-header block-header-default">
            <h3 class="block-title">Websiteleri</h3>
        </div>
        <div class="block-content">
            <table class="table table-borderless table-vcenter">
                <thead>
                <tr>
                    <th class="d-none d-sm-table-cell" style="width: 50px;"></th>
                    <th>İsim</th>
                    <th style="width: 100px;">Diller</th>
                    <th class="text-center" style="width: 100px;">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($websites as $website)
                    <tr>
                        <th class="text-center" scope="row">{{$website->status}}</th>
                        <td class="font-w600">{{$website->name}}</td>
                        <td class="font-w600">
                            @if(is_array($website->languages))
                                <button type="button" class="btn btn-block btn-secondary js-tooltip"
                                        data-toggle="tooltip"
                                        data-animation="true"
                                        data-placement="top"
                                        title=""
                                        data-original-title="{{array_reduce($website->languages,function($k,$lang){return $k.($k?", ":"").trans("native.language.$lang");})}}">
                                    {{ count($website->languages) }}
                                </button>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-primary js-tooltip-enabled"
                                        data-toggle="tooltip" title="" data-original-title="Edit">
                                    <i class="fa fa-pencil-alt"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-primary js-tooltip-enabled"
                                        data-toggle="tooltip" title="" data-original-title="Delete">
                                    <i class="fa fa-times"></i>
                                </button>
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
