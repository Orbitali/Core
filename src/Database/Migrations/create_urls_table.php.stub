<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUrlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('urls')) {
            Schema::create('urls', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('website_id');
                $table->string('url');
                $table->morphs("model");
                $table->enum("type", ['original', 'redirect'])->default('original');
                $table->timestamps();
                $table->softDeletes();

                $table->unique(["website_id", "url"]);
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
        Schema::dropIfExists('urls');
    }
}
