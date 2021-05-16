<?php

namespace Orbitali\Http\Models;

use Orbitali\Http\Traits\Cacheable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormEntry extends Model
{
    use Cacheable, SoftDeletes;

    protected $guarded = [];
    protected $table = "form_entries";
    protected $casts = [
        "data" => "json",
    ];
    public static $withoutExtra = [
        "id",
        "form_id",
        "ip",
        "data",
        "read_at",
        "created_at",
        "updated_at",
        "deleted_at",
    ];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}
