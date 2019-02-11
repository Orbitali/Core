<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLanguagePartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('language_parts')) {
            Schema::create('language_parts', function (Blueprint $table) {
                $table->increments('id');
                $table->string('group');
                $table->string('key');
                $table->mediumText('text');

                $table->index(['group', 'key']);
                $table->unique(["group","key"]);
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
        Schema::dropIfExists('language_parts');
    }
}
