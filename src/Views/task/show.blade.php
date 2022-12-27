@extends("Orbitali::inc.app")

@section('content')
<div class="block block-rounded block-bordered invisible" data-toggle="appear">
    <div class="block-header block-header-default">
        <h3 class="block-title">@lang(['native.panel.task.show','Detaylar'])</h3>
         <div class="block-options">
            <a href="{{route('panel.task.run', $task)}}"
                class="btn btn-sm btn-light js-action js-tooltip"
                title="@lang(['native.panel.task.actions.run','Çalıştır'])">
                <i class="fas fa-fw fa-play" aria-hidden="true"></i>
                {!! html()->form("POST", route("panel.task.run", $task))->class("d-none") !!}
            </a>
        </div>
    </div>
    <div class="block-content">
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label class="d-block" for="opiD1reb">@lang(['native.panel.task.command','Komut'])</label>
                    <input class="form-control form-control-alt" id="opiD1reb" type="text" readonly
                        value="{{$task->command}}">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label class="d-block" for="opkD1reb">@lang(['native.panel.task.parameters','Parametreler'])</label>
                    <input class="form-control form-control-alt" id="opkD1reb" type="text" readonly
                        value="{{$task->parameters}}">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label class="d-block" for="opia1reb">@lang(['native.panel.task.expression','Zaman İfadesi'])</label>
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
                        <label class="custom-control-label" id="opHFxxF61_label" for="opHFxxF61">
                            @lang(['native.panel.task.dont_overlap','Üst Üste Çalıştırma'])
                        </label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-control-file custom-control custom-control-inline custom-checkbox mb-1 w-auto">
                        <input class="custom-control-input" id="opHFxxF62" type="checkbox" value="1"
                            onclick="return false;" {{$task->run_in_maintenance?"checked":""}}>
                        <label class="custom-control-label" id="opHFxxF62_label" for="opHFxxF62">
                            @lang(['native.panel.task.run_in_maintenance','Bakımda Çalıştır'])
                        </label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-control-file custom-control custom-control-inline custom-checkbox mb-1 w-auto">
                        <input class="custom-control-input" id="opHFxxF63" type="checkbox" value="1"
                            onclick="return false;" {{$task->run_on_one_server?"checked":""}}>
                        <label class="custom-control-label" id="opHFxxF63_label" for="opHFxxF63">
                            @lang(['native.panel.task.run_on_one_server','Bir Sunucuda Çalıştır'])
                        </label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-control-file custom-control custom-control-inline custom-checkbox mb-1 w-auto">
                        <input class="custom-control-input" id="opHFxxF64" type="checkbox" value="1"
                            onclick="return false;" {{$task->run_in_background?"checked":""}}>
                        <label class="custom-control-label" id="opHFxxF64_label" for="opHFxxF64">@lang(['native.panel.task.run_in_background','Arkaplanda Çalıştır'])</label>
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
        <table class="js-table-sections table table-borderless table-vcenter" aria-describedby="page_desc">
            <thead>
                <tr>
                    <th class="d-none d-sm-table-cell" style="width: 1.812em;" scope="col"></th>
                    <th class="d-none d-sm-table-cell" style="width: 0.437em;" scope="col"></th>
                    <th scope="col">@lang(['native.panel.task.duration','Süre'])</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th scope="col">@lang(['native.panel.task.memory_usage','Bellek Kullanımı'])</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th scope="col">@lang(['native.panel.task.time','Çalışma Zamanı'])</th>
                </tr>
            </thead>
            @foreach($entries as $entry)
            <tbody class="js-table-sections-header">
                <tr>
                    <td class="text-center" scope="row">
                        <i class="fa fa-angle-right text-muted"></i>
                    </td>
                    <td class="text-center" scope="row">
                        <i class="fa fa-sm fa-circle text-{{ $entry->status }}" aria-hidden="true"></i>
                    </td>
                    <td colspan="5">
                        {{ sprintf("%.2f", $entry->responseDuration) }} ms
                    </td>
                    <td colspan="4">
                        {{ human_filesize($entry->memoryUsage) }}
                    </td>
                    <td colspan="5">
                        {{ $entry->time }}
                    </td>
                </tr>
            </tbody>
            <tbody class="fs-sm">
                @if(!empty($entry->commandOutput))
                <tr>
                    <td colspan="2"></td>
                    <td colspan="10" class="font-weight-bold">
                        @lang(['native.panel.task.output','Çıktı'])
                    </td>
                </tr>
                <tr>
                    <td colspan="12">
                        <pre><code class="log hljs">{{$entry->commandOutput}}</code></pre>
                    </td>
                </tr>
                @endif
                @foreach($entry->userData as $key=>$value)
                @if($key=='__meta') @continue @endif
                <tr>
                    <td colspan="2"></td>
                    <td colspan="10" class="font-weight-bold">
                        @lang(['native.panel.task.'. $key, $value['__meta']['title'] ?? $key])
                    </td>
                </tr>
                @foreach($value as $nestedKey=>$nestedValue)
                @if($nestedKey=='__meta') @continue @endif
                @if($nestedValue['__meta']['showAs'] == 'table')
                    @foreach($nestedValue as $nestedNestedKey=>$nestedNestedValue)
                    @if($nestedNestedKey=='__meta') @continue @endif
                    @foreach($nestedNestedValue as $nestedNestedNestedKey=>$nestedNestedNestedValue)
                    @if($nestedNestedNestedKey=='__meta') @continue @endif
                    <tr>
                        <td colspan="3"></td>
                        <td colspan="3" class="font-weight-bold">
                            @lang(['native.panel.task.'. $key . '_' . $nestedNestedNestedKey, $nestedNestedNestedKey])
                        </td>
                        <td colspan="6">
                            {{$nestedNestedNestedValue}}
                        </td>
                    </tr>
                    @endforeach
                    @endforeach
                @elseif($nestedValue['__meta']['showAs'] == 'counters')
                    @foreach($nestedValue as $nestedNestedNestedKey=>$nestedNestedNestedValue)
                    @if($nestedNestedNestedKey=='__meta') @continue @endif
                    <tr>
                        <td colspan="3"></td>
                        <td colspan="3" class="font-weight-bold">
                            @lang(['native.panel.task.'. $key . '_' . $nestedNestedNestedKey, $nestedNestedNestedKey])
                        </td>
                        <td colspan="6">
                            {{$nestedNestedNestedValue}}
                        </td>
                    </tr>
                    @endforeach
                @elseif($nestedValue['__meta']['showAs'] == 'file')
                    @foreach($nestedValue as $nestedNestedKey=>$nestedNestedValue)
                    @if($nestedNestedKey=='__meta') @continue @endif
                     <tr>
                        <td colspan="2"></td>
                        <td colspan="10">
                            <a href="{{route('panel.task.download', [$task, $entry->id, $nestedKey, $nestedNestedKey])}}">
                                {{ basename($nestedNestedValue['File']) }} ({{ human_filesize($nestedNestedValue['Size']) }})
                            </a>
                        </td>
                    </tr>
                    @endforeach
                @endif
                @endforeach
                @endforeach
            </tbody>
            @endforeach
            <tfoot>
                <tr>
                    <td colspan="12">
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

@push('scripts')
<template id="block_remove_form_template"></template>
@endpush
