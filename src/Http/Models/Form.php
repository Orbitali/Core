<?php

namespace Orbitali\Http\Models;

use Orbitali\Foundations\Helpers\Relation;
use Orbitali\Foundations\Model;
use Orbitali\Http\Traits\Cacheable;
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
            ->where('model_type', Relation::relationFinder(Page::class));
    }

    public function nodes()
    {
        return $this
            ->belongsToMany(Node::class, 'form_pivots', 'form_id', 'model_id')
            ->where('model_type', Relation::relationFinder(Node::class));
    }

    public function structure()
    {
        return $this->morphOne(Structure::class, 'model');
    }

    public function __toString()
    {
        return \Orbitali\Foundations\Helpers\Structure::renderStructure($this->structure->data);
    }
}