<?php

namespace Orbitali\Http\Models;

use Orbitali\Http\Traits\KeyValueModel;
use Illuminate\Database\Eloquent\Model;

class CategoryDetailExtra extends Model
{
    use KeyValueModel;

    public $timestamps = false;
    protected $table = 'category_detail_extras';
    protected $guarded = [];
    protected $touches = ['parent'];

    public function parent()
    {
        return $this->belongsTo(CategoryDetail::class);
    }
}
