<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSitemapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('sitemaps')) {
            Schema::create('sitemaps', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('website_id')->index();

                $table->string('type')->unique();

                $table->boolean('detail')->default(false);
                $table->boolean('search')->default(false);
                $table->boolean('category')->default(false);
//                $table->boolean('criteria')->default(false);
//                $table->boolean('property')->default(false);

                $table->defaultFields();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        if (!Schema::hasTable('sitemap_extras')) {
            Schema::create('sitemap_extras', function (Blueprint $table) {
                $table->extras('sitemap');
            });
        }

        if (!Schema::hasTable('sitemap_details')) {
            Schema::create('sitemap_details', function (Blueprint $table) {
                $table->details('sitemap');
            });
        }

        if (!Schema::hasTable('sitemap_detail_extras')) {
            Schema::create('sitemap_detail_extras', function (Blueprint $table) {
                $table->extras('sitemap_detail');
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
        Schema::dropIfExists('sitemap_detail_extras');
        Schema::dropIfExists('sitemap_details');
        Schema::dropIfExists('sitemap_extras');
        Schema::dropIfExists('sitemaps');
    }
}
