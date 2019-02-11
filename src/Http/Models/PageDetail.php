<?php

namespace Orbitali\Http\Models;

use Orbitali\Http\Traits\Cacheable;
use Orbitali\Http\Traits\ExtendExtra;
use Illuminate\Database\Eloquent\Model;

class PageDetail extends Model
{
    use Cacheable, ExtendExtra;

    public $timestamps = false;
    protected $guarded = [];
    protected $table = 'page_details';
    protected $touches = ['parent'];
    protected $withoutExtra = ['id', 'page_id', 'language', 'country', 'name'];

    public function parent()
    {
        return $this->belongsTo(Page::class);
    }

    public function url()
    {
        return $this->morphOne(Url::class, 'model');
    }

    public function extras()
    {
        return $this->hasMany(PageDetailExtra::class);
    }
}
