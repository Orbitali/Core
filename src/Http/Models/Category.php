<?php

namespace Orbitali\Http\Models;

use Orbitali\Http\Traits\Cacheable;
use Orbitali\Http\Traits\ExtendExtra;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes, Cacheable, ExtendExtra;

    protected $table = 'categories';
    protected $guarded = [];
    protected $withoutExtra = ['id', 'node_id', 'lft', 'rgt', 'depth', 'category_id', 'user_id', 'status', 'created_at', 'updated_at', 'deleted_at'];

    public function nodes()
    {
        return $this->belongsToMany(Node::class);
    }

    public function pages()
    {
        return $this->belongsToMany(Page::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function urls()
    {
        return $this->hasManyThrough(Url::class, CategoryDetail::class, null, 'model_id')->where('model_type', CategoryDetail::class);
    }

    public function extras()
    {
        return $this->hasMany(CategoryExtra::class);
    }

    public function detail()
    {
        return $this->hasOne(CategoryDetail::class)
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
        return $this->hasMany(CategoryDetail::class);
    }

    public function structure()
    {
        return $this->morphOne(Structure::class, 'model');
    }
}
