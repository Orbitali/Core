<?php

namespace Orbitali\Http\Models;

use Orbitali\Http\Traits\KeyValueModel;
use Illuminate\Database\Eloquent\Model;

class NodeExtra extends Model
{
    use KeyValueModel;

    public $timestamps = false;
    protected $table = 'node_extras';
    protected $guarded = [];
    protected $touches = ['parent'];

    public function parent()
    {
        return $this->belongsTo(Node::class,'node_id');
    }
}
