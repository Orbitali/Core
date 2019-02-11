<?php

namespace Orbitali\Http\Models;

use Orbitali\Http\Traits\KeyValueModel;
use Illuminate\Database\Eloquent\Model;

class PageExtra extends Model
{
    use KeyValueModel;

    public $timestamps = false;
    protected $table = 'page_extras';
    protected $guarded = [];
    protected $touches = ['parent'];

    public function parent()
    {
        return $this->belongsTo(Page::class, 'page_id');
    }
}
