<?php

namespace Orbitali\Providers;

use Orbitali\Http\Models\CategoryDetail;
use Orbitali\Http\Models\PageDetail;
use Orbitali\Http\Models\SitemapDetail;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\ServiceProvider;

class BlueprintServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function register()
    {
        $this->extendBlueprint();
        $this->relationMorphMap();
    }

    protected function extendBlueprint()
    {
        Blueprint::macro('details', function ($name, $table = null) {
            $this->increments('id');
            $this->unsignedInteger($name . '_id')->index();
            $this->string('language', 64)->index();
            $this->string('country', 10)->nullable()->index();
            $this->string('name');

            $this->unique([$name . '_id', 'language', 'country']);

            $this->foreign($name . '_id')
                ->references('id')
                ->on($table ?? str_plural($name))
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Blueprint::macro('extras', function ($name, $table = null) {
            $this->increments('id');
            $this->unsignedInteger($name . '_id')->index();
            $this->string('key');
            $this->string('value');

            $this->unique([$name . '_id', 'key']);

            $this->foreign($name . '_id')
                ->references('id')
                ->on($table ?? str_plural($name))
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Blueprint::macro('defaultFields', function () {
            $this->unsignedInteger("user_id")->nullable();
            $this->integer("status")->default(3);
        });

        Blueprint::macro('nestable', function ($parent = "") {
            $this->unsignedInteger("lft")->nullable();
            $this->unsignedInteger("rgt")->nullable();
            $this->unsignedInteger("depth")->nullable();

            $index = ["lft", "rgt", "depth"];

            if ($parent != "") {
                $this->unsignedInteger($parent)->nullable()->index();
                $index[] = $parent;
            }

            $this->index($index);
        });

        Blueprint::macro('orderable', function () {
            $this->unsignedInteger("order")->nullable()->index();
        });

    }


    protected function relationMorphMap()
    {
        Relation::morphMap([
            "category_details" => CategoryDetail::class,
            "sitemap_details" => SitemapDetail::class,
            "page_details" => PageDetail::class,
        ]);
    }

}
