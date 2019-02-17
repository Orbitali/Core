<?php

namespace Orbitali\Http\Models;

use Orbitali\Http\Traits\Cacheable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Structure extends Model
{
    use SoftDeletes, Cacheable;

    public $timestamps = false;
    protected $table = 'structures';
    protected $guarded = [];

    public function model()
    {
        return $this->morphTo();
    }
}
