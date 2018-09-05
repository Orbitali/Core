<?php

namespace Orbitali\Http\Models;

use Illuminate\Database\Eloquent\Model;

class UserProvider extends Model
{

    protected $fillable = ["user_id", "provider", "provider_id"];
    protected $table = "user_provider";
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }
}
