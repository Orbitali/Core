<?php

namespace Orbitali\Http\Models;

use Orbitali\Foundations\Model;
use Orbitali\Http\Traits\Cacheable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes, Cacheable;

    protected $guarded = [];
    protected $table = "tasks";
    protected $withoutExtra = [
        "id",
        "command",
        "parameters",
        "expression",
        "dont_overlap",
        "run_in_maintenance",
        "run_on_one_server",
        "run_in_background",
        "user_id",
        "status",
        "created_at",
        "updated_at",
        "deleted_at",
    ];
    protected $casts = [
        "parameters" => "array",
    ];

    public function owner()
    {
        return $this->belongsTo(User::class);
    }
}
