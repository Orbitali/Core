<?php

namespace Orbitali\Http\Models;

use Orbitali\Http\Traits\Cacheable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Website extends Model
{
    use SoftDeletes, Cacheable;

    protected $guarded = [];
    protected $table = "websites";

    public function urls()
    {
        return $this->hasMany(Url::class);
    }

    public function sitemaps()
    {
        return $this->hasMany(Sitemap::class);
    }
}
