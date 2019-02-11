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
                $table->string('domain')->index()->unique();
                $table->boolean('ssl')->default(false);

                $table->defaultFields();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        if (!Schema::hasTable('website_languages')) {
            Schema::create('website_languages', function (Blueprint $table) {
                $table->unsignedInteger('website_id')->index();
                $table->string('language', 64);
                $table->string('country', 10)->nullable();

                $table->index(["language", "country"]);
                $table->unique(["website_id", "language", "country"]);

                $table->foreign('website_id')
                    ->references('id')
                    ->on('websites')
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
        Schema::dropIfExists('website_languages');
        Schema::dropIfExists('websites');
    }
}
