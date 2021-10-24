<div>
    <div class="form-group">
        <label class="d-block" id="opBDPiJh2_label" for="opBDPiJh2">Isim</label>
        <input class="form-control form-control-alt" id="opBDPiJh2" type="text" wire:model="model.detail_tr.name">
    </div>
    <div class="form-group">
        <label class="d-block" id="opBDPiJh_label" for="opBDPiJh">Addres</label>
        <input class="form-control form-control-alt" id="opBDPiJh" type="text" wire:model="model.address">
    </div>
    <div class="form-group">
        <label class="d-block" id="opPgJdaC_label" for="opPgJdaC">E-Posta</label>
        <input class="form-control form-control-alt" id="opPgJdaC" type="text" wire:model="model.email">
    </div>
    <div class="form-group">
        <label class="d-block" id="opvIqOoe_label" for="opvIqOoe">Telefon</label>
        <input class="form-control form-control-alt" id="opvIqOoe" type="text" wire:model="model.phone">
    </div>
    <div class="js-wizard-simple block block-rounded block-bordered" id="opPYqPHE">
        @php($maxCount=range(0,max([count($model->feature_icon)])-1))
        <ul class="nav nav-tabs nav-tabs-alt nav-justified sticky-top bg-white-95" role="tablist">
            @foreach ($maxCount as $i)
            <li class="nav-item">
                <a class="nav-link {{$loop->first ? " active":""}}" href="#opGsH7SM-{{$i}}" data-toggle="tab"
                    role="tab">{{$i}}</a>
            </li>
            @endforeach
        </ul>
        <div class="block-content block-content-full tab-content">
            @foreach ($maxCount as $i)
            <div class="tab-pane {{$loop->first ? " active":""}}" id="opGsH7SM-{{$i}}" role="tabpanel">
                <div class="form-group">
                    <label class="d-block" id="opeXKEJy-{{$i}}_label" for="opeXKEJy-{{$i}}">Resim Adı</label>
                    <input class="form-control form-control-alt" id="opeXKEJy-{{$i}}" type="text"
                        wire:model="model.feature_icon.{{$i}}">
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <button class="btn btn-sm btn-primary" wire:click="save">Save</button>
</div>