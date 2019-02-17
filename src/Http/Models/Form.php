<?php

namespace Orbitali\Http\Models;

use Orbitali\Http\Traits\Cacheable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\SoftDeletes;

class Form extends Model
{
    use Cacheable, SoftDeletes;

    public $timestamps = false;
    protected $guarded = [];
    protected $table = 'forms';

    public function entries()
    {
        return $this->hasMany(FormEntry::class);
    }

    public function pages()
    {
        return $this
            ->belongsToMany(Page::class, 'form_pivots', 'form_id', 'model_id')
            ->where('model_type', array_search(Page::class, Relation::$morphMap));
    }

    public function nodes()
    {
        return $this
            ->belongsToMany(Node::class, 'form_pivots', 'form_id', 'model_id')
            ->where('model_type', array_search(Node::class, Relation::$morphMap));
    }

    public function structure()
    {
        return $this->morphOne(Structure::class, 'model');
    }
}
