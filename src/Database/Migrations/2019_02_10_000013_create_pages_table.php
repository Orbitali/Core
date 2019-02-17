<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('pages')) {
            Schema::create('pages', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('node_id')->index();
                $table->orderable();
                $table->defaultFields();
                $table->timestamps();
                $table->softDeletes();

                $table->foreign('node_id')
                    ->references('id')
                    ->on('nodes')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            });
        }

        if (!Schema::hasTable('page_extras')) {
            Schema::create('page_extras', function (Blueprint $table) {
                $table->extras('page');
            });
        }

        if (!Schema::hasTable('page_details')) {
            Schema::create('page_details', function (Blueprint $table) {
                $table->details('page');
            });
        }

        if (!Schema::hasTable('page_detail_extras')) {
            Schema::create('page_detail_extras', function (Blueprint $table) {
                $table->extras('page_detail');
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
        Schema::dropIfExists('page_detail_extras');
        Schema::dropIfExists('page_details');
        Schema::dropIfExists('page_extras');
        Schema::dropIfExists('pages');
    }
}
