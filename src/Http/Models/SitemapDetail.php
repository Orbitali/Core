<?php

namespace Orbitali\Http\Models;

use Orbitali\Http\Traits\Cacheable;
use Orbitali\Http\Traits\ExtendExtra;
use Illuminate\Database\Eloquent\Model;

class SitemapDetail extends Model
{
    use Cacheable, ExtendExtra;

    public $timestamps = false;
    protected $guarded = [];
    protected $table = 'sitemap_details';
    protected $touches = ['parent'];
    protected $withoutExtra = ['id', 'sitemap_id', 'language', 'country', 'name'];

    public function parent()
    {
        return $this->belongsTo(Sitemap::class, 'sitemap_id');
    }

    public function url()
    {
        return $this->morphOne(Url::class, 'model');
    }

    public function extras()
    {
        return $this->hasMany(SitemapDetailExtra::class);
    }
}
