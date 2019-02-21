<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebsitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('websites')) {
            Schema::create('websites', function (Blueprint $table) {
                $table->increments('id');

                $table->string('name')->nullable();
                $table->string('domain')->index();
                $table->boolean('ssl')->default(false);

                $table->defaultFields();
                $table->timestamps();
                $table->softDeletes();

                $table->unique(['domain', 'deleted_at']);
            });
        }

        if (!Schema::hasTable('website_extras')) {
            Schema::create('website_extras', function (Blueprint $table) {
                $table->extras('website');
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
        Schema::dropIfExists('website_languages');
        Schema::dropIfExists('websites');
    }
}
