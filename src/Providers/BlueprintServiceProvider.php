<?php

namespace Orbitali\Providers;

use Orbitali\Http\Models\Category;
use Orbitali\Http\Models\CategoryDetail;
use Orbitali\Http\Models\Node;
use Orbitali\Http\Models\NodeDetail;
use Orbitali\Http\Models\Page;
use Orbitali\Http\Models\PageDetail;
use Orbitali\Http\Models\User;
use Orbitali\Http\Models\UserDetail;
use Orbitali\Http\Models\Website;
use Orbitali\Http\Models\WebsiteDetail;
use Orbitali\Http\Models\Form;
use Orbitali\Http\Models\FormEntry;
use Orbitali\Http\Models\Structure;
use Orbitali\Http\Models\Url;
use Orbitali\Http\Models\Task;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

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
        Blueprint::macro("details", function ($name, $table = null) {
            $this->increments("id");
            $this->unsignedInteger($name . "_id")->index();
            $this->string("language", 64)->index();
            $this->string("country", 10)
                ->nullable()
                ->index();
            $this->string("name")->nullable();

            $this->unique([$name . "_id", "language", "country"]);

            $this->foreign($name . "_id")
                ->references("id")
                ->on($table ?? Str::plural($name))
                ->onUpdate("cascade")
                ->onDelete("cascade");
        });

        Blueprint::macro("extras", function ($name, $table = null) {
            $this->increments("id");
            $this->unsignedInteger($name . "_id")->index();
            $this->string("key");
            $this->mediumText("value")->nullable();

            $this->unique([$name . "_id", "key"]);

            $this->foreign($name . "_id")
                ->references("id")
                ->on($table ?? Str::plural($name))
                ->onUpdate("cascade")
                ->onDelete("cascade");
        });

        Blueprint::macro("defaultFields", function () {
            $this->unsignedInteger("user_id")->nullable();
            $this->integer("status")->default(3);
        });

        Blueprint::macro("nestable", function ($parent = "") {
            $this->unsignedInteger("lft")->default(0);
            $this->unsignedInteger("rgt")->default(0);

            $index = ["lft", "rgt"];

            if ($parent != "") {
                $this->unsignedInteger($parent)->nullable();
                $index[] = $parent;
            }

            $this->index($index);
        });

        Blueprint::macro("orderable", function () {
            $this->unsignedInteger("order")
                ->nullable()
                ->index();
        });
    }

    protected function relationMorphMap()
    {
        Relation::morphMap([
            "pages" => Page::class,
            "page_details" => PageDetail::class,
            "categories" => Category::class,
            "category_details" => CategoryDetail::class,
            "nodes" => Node::class,
            "node_details" => NodeDetail::class,
            "websites" => Website::class,
            "website_details" => WebsiteDetail::class,
            "users" => User::class,
            "user_details" => UserDetail::class,
            //
            "forms" => Form::class,
            "entries" => FormEntry::class,
            "urls" => Url::class,
            "structures" => Structure::class,
            "tasks" => Task::class,
        ]);
    }
}
