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
        if (!Schema::hasTable("menus")) {
            Schema::create("menus", function (Blueprint $table) {
                $table->increments("id");
                $table
                    ->unsignedInteger("website_id")
                    ->nullable()
                    ->index();
                $table
                    ->enum("type", [
                        "root",
                        "route",
                        "datasource",
                        "internal",
                        "external",
                        "javascript",
                    ])
                    ->default("root");

                $table->unsignedInteger("url_id")->nullable();
                $table->string("data")->nullable();

                $table->nestable("menu_id");
                $table->defaultFields();
                $table->timestamps();
                $table->softDeletes();

                $table
                    ->foreign("url_id")
                    ->references("id")
                    ->on("urls")
                    ->onUpdate("cascade")
                    ->onDelete("cascade");
                $table
                    ->foreign("website_id")
                    ->references("id")
                    ->on("websites")
                    ->onUpdate("cascade")
                    ->onDelete("cascade");
            });
        }

        if (!Schema::hasTable("menu_extras")) {
            Schema::create("menu_extras", function (Blueprint $table) {
                $table->extras("menu");
            });
        }

        if (!Schema::hasTable("menu_details")) {
            Schema::create("menu_details", function (Blueprint $table) {
                $table->details("menu");
            });
        }

        if (!Schema::hasTable("menu_detail_extras")) {
            Schema::create("menu_detail_extras", function (Blueprint $table) {
                $table->extras("menu_detail");
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
        Schema::dropIfExists("menu_detail_extras");
        Schema::dropIfExists("menu_details");
        Schema::dropIfExists("menu_extras");
        Schema::dropIfExists("menus");
    }
};
