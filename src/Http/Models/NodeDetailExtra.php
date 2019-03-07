<?php

namespace Orbitali\Http\Models;

use Orbitali\Http\Traits\KeyValueModel;
use Illuminate\Database\Eloquent\Model;

class NodeDetailExtra extends Model
{
    use KeyValueModel;

    public $timestamps = false;
    protected $table = 'node_detail_extras';
    protected $guarded = [];
    protected $touches = ["parent"];

    public function parent()
    {
        return $this->belongsTo(NodeDetail::class, 'node_detail_id');
    }

}
