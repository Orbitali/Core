<?php

namespace Orbitali\Http\Models;

use Orbitali\Http\Traits\Cacheable;
use Orbitali\Http\Traits\ExtendExtra;
use Illuminate\Database\Eloquent\Model;

class CategoryDetail extends Model
{
    use Cacheable, ExtendExtra;

    public $timestamps = false;
    protected $guarded = [];
    protected $table = 'category_details';
    protected $touches = ['parent'];
    protected $withoutExtra = ['id', 'category_id', 'language', 'country', 'name'];

    public function parent()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function url()
    {
        return $this->morphOne(Url::class, 'model');
    }

    public function extras()
    {
        return $this->hasMany(CategoryDetailExtra::class);
    }
}
