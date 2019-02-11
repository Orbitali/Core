<?php

namespace Orbitali\Http\Models;

use Orbitali\Http\Traits\Cacheable;
use Illuminate\Database\Eloquent\Model;

class PageDetail extends Model
{
    use Cacheable;

    public $timestamps = false;
    protected $guarded = [];
    protected $table = "page_details";
    protected $touches = ['parent'];

    public function parent()
    {
        return $this->belongsTo(Page::class);
    }

    public function url()
    {
        return $this->morphOne(Url::class, "model");
    }

    public function extras()
    {
        return $this->hasMany(PageDetailExtra::class);
    }
}
