<?php

namespace Orbitali\Http\Models;

use Orbitali\Foundations\Model;
use Orbitali\Http\Traits\Cacheable;
use Orbitali\Http\Traits\ExtendExtra;
use Illuminate\Database\Eloquent\SoftDeletes;

class Node extends Model
{
    use SoftDeletes, Cacheable, ExtendExtra;

    protected $table = 'nodes';
    protected $guarded = [];
    protected $withoutExtra = ['id', 'website_id', 'has_detail', 'has_category', 'searchable', 'user_id', 'status', 'created_at', 'updated_at', 'deleted_at'];

    public function website()
    {
        return $this->belongsTo(Website::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function urls()
    {
        return $this->hasManyThrough(Url::class, NodeDetail::class, null, 'model_id')->where('model_type', NodeDetail::class);
    }

    public function pages()
    {
        return $this->hasMany(Page::class);
    }

    public function extras()
    {
        return $this->hasMany(NodeExtra::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function detail()
    {
        return $this->hasOne(NodeDetail::class)
            ->where(
                [
                    'language' => orbitali('language'),
                    'country' => orbitali('country')
                ]
            )
            ->orWhere(function ($q) {
                $q->where(
                    [
                        'language' => orbitali('language'),
                        'country' => null]
                );
            })
            ->orderBy('country', 'DESC')->take(1);
    }

    public function details()
    {
        return $this->hasMany(NodeDetail::class);
    }

    public function forms()
    {
        return $this->morphToMany(Form::class, 'model', 'form_pivots');
    }

    public function structure()
    {
        return $this->morphOne(Structure::class, 'model');
    }
}
