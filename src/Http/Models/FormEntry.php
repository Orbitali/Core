<?php

namespace Orbitali\Http\Models;

use Orbitali\Http\Traits\Cacheable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Orbitali\Http\Traits\Structure;
use Orbitali\Http\Traits\ExtendExtra;
use Orbitali\Foundations\KeyValueCollection;

class FormEntry extends Model
{
    use Cacheable, SoftDeletes, Structure, ExtendExtra;

    protected $guarded = [];
    protected $table = "form_entries";
    protected $casts = [
        "data" => "json",
        "ip" => "json",
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

    public function getExtrasAttribute()
    {
        return new KeyValueCollection(
            collect($this->data)
                ->keys()
                ->map(function ($key) {
                    return (object) [
                        "key" => $key,
                        "value" => $this->data[$key],
                    ];
                })
        );
    }
}
