<?php

namespace Orbitali\Http\Models;

use Orbitali\Http\Traits\Cacheable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormEntry extends Model
{
    use Cacheable, SoftDeletes;

    protected $guarded = [];
    protected $table = 'form_entries';

    public function form()
    {
        return $this->belongsTo(Form::class);
    }

}
