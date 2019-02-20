<?php

namespace Orbitali\Http\Models;

use Orbitali\Http\Traits\KeyValueModel;
use Illuminate\Database\Eloquent\Model;

class PageDetailExtra extends Model
{
    use KeyValueModel;

    public $timestamps = false;
    protected $table = 'page_detail_extras';
    protected $guarded = [];

    public function parent()
    {
        return $this->belongsTo(PageDetail::class, 'page_detail_id');
    }
}
