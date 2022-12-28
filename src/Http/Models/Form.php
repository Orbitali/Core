<?php

namespace Orbitali\Http\Models;

use Orbitali\Foundations\Helpers\Relation;
use Orbitali\Http\Traits\Model as BaseModel;
use Orbitali\Http\Traits\StatusScope;
use Illuminate\Database\Eloquent\Model;
use Orbitali\Http\Traits\Cacheable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Orbitali\Http\Traits\Structure;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Form extends Model implements \Stringable
{
    use Cacheable, SoftDeletes, Structure, StatusScope;

    public $timestamps = false;
    protected $guarded = [];
    protected $table = "forms";
    protected $fillable = [
        "id",
        "key",
        "user_id",
        "status",
        "created_at",
        "updated_at",
        "deleted_at",
    ];

    public function entries()
    {
        return $this->hasMany(FormEntry::class);
    }

    public function pages()
    {
        $default = ["model_type" => Relation::relationFinder(Page::class)];
        return $this->belongsToMany(Page::class, "form_pivots", "form_id", "model_id")->where($default)->withDefault($default);
    }

    public function nodes()
    {
        $default = ["model_type" => Relation::relationFinder(Node::class)];
        return $this->belongsToMany(Node::class, "form_pivots", "form_id", "model_id")->where($default)->withDefault($default);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function __toString()
    {
        return \Orbitali\Foundations\Helpers\Structure::renderStructure(
            $this->structure->data
        );
    }
}
