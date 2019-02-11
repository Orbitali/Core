<?php

namespace Orbitali\Http\Models;

use Orbitali\Http\Traits\KeyValueModel;
use Illuminate\Database\Eloquent\Model;

class CategoryExtra extends Model
{
    use KeyValueModel;

    public $timestamps = false;
    protected $table = "category_extras";
    protected $guarded = [];
    protected $touches = ['parent'];

    public function parent()
    {
        return $this->belongsTo(Category::class);
    }
}
