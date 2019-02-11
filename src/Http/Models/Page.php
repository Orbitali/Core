<?php

namespace Orbitali\Http\Models;

use Orbitali\Http\Traits\Cacheable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use SoftDeletes, Cacheable;

    protected $table = "pages";
    protected $guarded = [];

    public function sitemap()
    {
        return $this->belongsTo(Sitemap::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function urls()
    {
        return $this->hasManyThrough(Url::class, PageDetail::class, null, "model_id")->where('model_type', PageDetail::class);
    }

    public function extras()
    {
        return $this->hasMany(PageExtra::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function details()
    {
        return $this->hasMany(PageDetail::class);
    }

}
