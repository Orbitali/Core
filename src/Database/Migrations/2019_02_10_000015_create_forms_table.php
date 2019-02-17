<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('forms')) {
            Schema::create('forms', function (Blueprint $table) {
                $table->increments('id');

                $table->string('key')->unique();
                $table->string("captcha_key")->nullable();
                $table->string("captcha_secret_key")->nullable();

                $table->defaultFields();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        if (!Schema::hasTable('form_pivots')) {
            Schema::create('form_pivots', function (Blueprint $table) {
                $table->unsignedInteger('form_id')->index();
                $table->morphs('model');
                $table->foreign('form_id')
                    ->references('id')
                    ->on('forms')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            });
        }

        if (!Schema::hasTable('form_entries')) {
            Schema::create('form_entries', function (Blueprint $table) {
                $table->increments('id');

                $table->unsignedInteger('form_id')->index();

                $table->ipAddress('ip')->nullable();
                $table->mediumText('data');

                $table->timestamp('read_at');
                $table->timestamps();
                $table->softDeletes();

                $table->foreign('form_id')
                    ->references('id')
                    ->on('forms')
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
        Schema::dropIfExists('form_entries');
        Schema::dropIfExists('form_pivots');
        Schema::dropIfExists('forms');
    }
}
