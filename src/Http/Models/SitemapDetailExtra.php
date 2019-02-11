<?php

namespace Orbitali\Http\Models;

use Orbitali\Http\Traits\KeyValueModel;
use Illuminate\Database\Eloquent\Model;

class SitemapDetailExtra extends Model
{
    use KeyValueModel;

    public $timestamps = false;
    protected $table = 'sitemap_detail_extras';
    protected $guarded = [];
    protected $touches = ['parent'];

    public function parent()
    {
        return $this->belongsTo(SitemapDetail::class,'sitemap_detail_id');
    }
}
