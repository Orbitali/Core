<?php

namespace Orbitali\Http\Models;

use Orbitali\Http\Traits\Cacheable;
use Orbitali\Http\Traits\ExtendExtra;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use SoftDeletes, Cacheable, ExtendExtra;

    protected $table = 'pages';
    protected $guarded = [];
    protected $withoutExtra = ['id', 'node_id', 'order', 'user_id', 'status', 'created_at', 'updated_at', 'deleted_at'];

    public function node()
    {
        return $this->belongsTo(Node::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function urls()
    {
        return $this->hasManyThrough(Url::class, PageDetail::class, null, 'model_id')->where('model_type', PageDetail::class);
    }

    public function extras()
    {
        return $this->hasMany(PageExtra::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function detail()
    {
        return $this->hasOne(PageDetail::class)
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
        return $this->hasMany(PageDetail::class);
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
