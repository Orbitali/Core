<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('categories')) {
            Schema::create('categories', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('sitemap_id')->index();
                $table->nestable("category_id");
                $table->defaultFields();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        if (!Schema::hasTable('category_extras')) {
            Schema::create('category_extras', function (Blueprint $table) {
                $table->extras('categories');
            });
        }

        if (!Schema::hasTable('category_details')) {
            Schema::create('category_details', function (Blueprint $table) {
                $table->details('categories');
            });
        }

        if (!Schema::hasTable('category_detail_extras')) {
            Schema::create('category_detail_extras', function (Blueprint $table) {
                $table->extras('category_details');
            });
        }

        if (!Schema::hasTable('category_sitemap')) {
            Schema::create('category_sitemap', function (Blueprint $table) {
                $table->unsignedInteger('category_id');
                $table->unsignedInteger('sitemap_id');

                $table->index(['category_id', 'sitemap_id']);
                $table->foreign('category_id')
                    ->references('id')
                    ->on('categories')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
                $table->foreign('sitemap_id')
                    ->references('id')
                    ->on('sitemaps')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            });
        }

        if (!Schema::hasTable('category_page')) {
            Schema::create('category_page', function (Blueprint $table) {
                $table->unsignedInteger('category_id');
                $table->unsignedInteger('page_id');

                $table->index(['category_id', 'page_id']);
                $table->foreign('category_id')
                    ->references('id')
                    ->on('categories')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
                $table->foreign('page_id')
                    ->references('id')
                    ->on('pages')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_page');
        Schema::dropIfExists('category_sitemap');
        Schema::dropIfExists('category_detail_extras');
        Schema::dropIfExists('category_details');
        Schema::dropIfExists('category_extras');
        Schema::dropIfExists('categories');
    }
}
