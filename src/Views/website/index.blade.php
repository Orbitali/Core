@extends("Orbitali::inc.app")

@section('content')
    <div class="block block-rounded block-bordered">
        <div class="block-header block-header-default">
            <h3 class="block-title">@lang(['native.panel.website.title','Websiteleri'])</h3>
            <div class="block-options">
                <button type="button"
                        class="btn btn-sm btn-success js-tooltip"
                        title="@lang(['native.panel.website.add','Yeni websitesi ekle'])">
                    <i class="fas fa-fw fa-plus"></i>
                </button>
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
                                class="fa fa-sm fa-circle text-{{$website->status == 1 ? "default" : ($website->status == 2 ? "warning": "danger")}}"></i>
                        </th>
                        <td class="font-w600">{{$website->name}}</td>
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
                                   class="btn btn-sm btn-primary js-tooltip"
                                   data-toggle="tooltip" data-animation="true"
                                   title="@lang(['native.panel.website.destroy','Sil'])">
                                    <i class="fa fa-times"></i>
                                </a>
                                {{ Form::open(array('url' => '', 'class' => 'pull-right')) }}
                                {{ Form::hidden('_method', 'DELETE') }}
                                {{ Form::submit('Delete this Nerd', array('class' => 'btn btn-warning')) }}
                                {{ Form::close() }}


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
