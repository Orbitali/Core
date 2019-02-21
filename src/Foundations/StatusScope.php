<?php

namespace Orbitali\Foundations;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Scope;

class StatusScope implements Scope
{
    /**
     * All of the extensions to be added to the builder.
     *
     * @var array
     */
    protected $extensions = ['WithPredraft', 'WithoutPredraft', 'OnlyPredraft'];

    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $builder
     * @param  \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function apply(Builder $builder, \Illuminate\Database\Eloquent\Model $model)
    {
        $builder->where("status", "<>", Model::PREDRAFT);
    }

    /**
     * Extend the query builder with the needed functions.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $builder
     * @return void
     */
    public function extend(Builder $builder)
    {
        foreach ($this->extensions as $extension) {
            $this->{"add{$extension}"}($builder);
        }
    }

    /**
     * @param  \Illuminate\Database\Eloquent\Builder $builder
     * @return void
     */
    protected function addWithPredraft(Builder $builder)
    {
        $builder->macro('withPredraft', function (Builder $builder, $withPredraft = true) {
            if (!$withPredraft) {
                return $builder->withoutPredraft();
            }
            return $builder->withoutGlobalScope($this);
        });
    }

    /**
     * @param  \Illuminate\Database\Eloquent\Builder $builder
     * @return void
     */
    protected function addWithoutPredraft(Builder $builder)
    {
        $builder->macro('withoutPredraft', function (Builder $builder) {
            return $builder->withoutGlobalScope($this)->where("status", "<>", Model::PREDRAFT);
        });
    }

    /**
     * @param  \Illuminate\Database\Eloquent\Builder $builder
     * @return void
     */
    protected function addOnlyPredraft(Builder $builder)
    {
        $builder->macro('onlyPredraft', function (Builder $builder) {
            return $builder->withoutGlobalScope($this)->where("status", Model::PREDRAFT);
        });
    }
}
