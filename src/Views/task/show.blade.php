@extends("Orbitali::inc.app")

@section('content')
<div class="block block-rounded block-bordered invisible" data-toggle="appear">
    <div class="block-header block-header-default">
        <h3 class="block-title">@lang(['native.panel.task.show','Detaylar'])</h3>
    </div>
    <div class="block-content">
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label class="d-block" for="opiD1reb">Command</label>
                    <input class="form-control form-control-alt" id="opiD1reb" type="text" readonly
                        value="{{$task->command}}">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label class="d-block" for="opkD1reb">Parameters</label>
                    <input class="form-control form-control-alt" id="opkD1reb" type="text" readonly
                        value="{{$task->parameters}}">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label class="d-block" for="opia1reb">Expression</label>
                    <input class="form-control form-control-alt" id="opia1reb" type="text" readonly
                        value="{{$task->expression}}">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col">
                    <div class="form-control-file custom-control custom-control-inline custom-checkbox mb-1 w-auto">
                        <input class="custom-control-input" id="opHFxxF61" type="checkbox" value="1"
                            onclick="return false;" {{$task->dont_overlap?"checked":""}}>
                        <label class="custom-control-label" id="opHFxxF61_label" for="opHFxxF61">Dont Overlap</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-control-file custom-control custom-control-inline custom-checkbox mb-1 w-auto">
                        <input class="custom-control-input" id="opHFxxF62" type="checkbox" value="1"
                            onclick="return false;" {{$task->run_in_maintenance?"checked":""}}>
                        <label class="custom-control-label" id="opHFxxF62_label" for="opHFxxF62">Run In
                            Maintenance</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-control-file custom-control custom-control-inline custom-checkbox mb-1 w-auto">
                        <input class="custom-control-input" id="opHFxxF63" type="checkbox" value="1"
                            onclick="return false;" {{$task->run_on_one_server?"checked":""}}>
                        <label class="custom-control-label" id="opHFxxF63_label" for="opHFxxF63">Run on One
                            Server</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-control-file custom-control custom-control-inline custom-checkbox mb-1 w-auto">
                        <input class="custom-control-input" id="opHFxxF64" type="checkbox" value="1"
                            onclick="return false;" {{$task->run_in_background?"checked":""}}>
                        <label class="custom-control-label" id="opHFxxF64_label" for="opHFxxF64">Run In
                            Background</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="block block-rounded block-bordered invisible" data-toggle="appear">
    <div class="block-header block-header-default">
        <h3 id="page_desc" class="block-title">@lang(['native.panel.task.logs','Günlükler'])</h3>
    </div>
    <div class="block-content">
        <table class="table table-borderless table-vcenter" aria-describedby="page_desc">
            <thead>
                <tr>
                    <th class="d-none d-sm-table-cell" style="width: .875em;" scope="col"></th>
                    <th scope="col">Output</th>
                    <th scope="col">Duration</th>
                    <th scope="col">Memory Usage</th>
                </tr>
            </thead>
            <tbody>
                @foreach($entries as $entry)
                <tr>
                    <td class="text-center" scope="row"><i class="fa fa-sm fa-circle text-{{ $entry->status }}"
                            aria-hidden="true"></i>
                    </td>
                    <td>
                        {{$entry->commandOutput}}
                    </td>
                    <td>
                        {{ sprintf("%.2f", $entry->responseDuration) }} ms
                    </td>
                    <td>
                        {{ human_filesize($entry->memoryUsage) }}
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4">
                        <div class="row justify-content-center">
                            {!! $entries->links('Orbitali::inc.paginate') !!}
                        </div>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection