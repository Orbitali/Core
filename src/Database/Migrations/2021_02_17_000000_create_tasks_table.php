<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable("tasks")) {
            Schema::create("tasks", function (Blueprint $table) {
                $table->increments("id");
                $table->string("command")->nullable();
                $table->mediumText("parameters")->nullable();
                $table->string("expression")->default("* * * * *");
                $table->boolean("dont_overlap")->default(false);
                $table->boolean("run_in_maintenance")->default(false);
                $table->boolean("run_on_one_server")->default(false);
                $table->boolean("run_in_background")->default(false);
                $table->defaultFields();
                $table->timestamps();
                $table->softDeletes();
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
        Schema::dropIfExists("tasks");
    }
};
