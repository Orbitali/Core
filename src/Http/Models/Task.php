<?php

namespace Orbitali\Http\Models;

use Orbitali\Http\Traits\Model as BaseModel;
use Illuminate\Database\Eloquent\Model;
use Orbitali\Http\Traits\Cacheable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes, Cacheable, BaseModel;

    protected $guarded = [];
    protected $table = "tasks";
    protected $fillable = [
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

    public function logs()
    {
        return $this->hasMany(TaskLog::class, "commandName", "command")
            ->where("type", "command")
            ->orderByDesc("time");
    }
}
