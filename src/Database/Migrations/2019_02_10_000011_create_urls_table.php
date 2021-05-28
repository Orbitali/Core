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
        if (!Schema::hasTable("urls")) {
            Schema::create("urls", function (Blueprint $table) {
                $table->increments("id");
                $table->unsignedInteger("website_id");
                $table->string("url");
                $table->morphs("model");
                $table
                    ->enum("type", ["original", "redirect"])
                    ->default("original");
                $table->timestamps();
                $table->softDeletes();

                $table->unique(["website_id", "url", "deleted_at"]);
                $table
                    ->foreign("website_id")
                    ->references("id")
                    ->on("websites")
                    ->onUpdate("cascade")
                    ->onDelete("cascade");
            });
        }

        if (!Schema::hasTable("url_extras")) {
            Schema::create("url_extras", function (Blueprint $table) {
                $table->extras("url");
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
        Schema::dropIfExists("urls");
    }
};
