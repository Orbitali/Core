<?php

namespace Orbitali\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Url extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $table = "urls";

    public function model()
    {
        return $this->morphTo();
    }

    public function website()
    {
        return $this->belongsTo(Website::class);
    }
}
