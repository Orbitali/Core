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
        if (!Schema::hasTable("websites")) {
            Schema::create("websites", function (Blueprint $table) {
                $table->increments("id");

                $table->string("domain")->index();
                $table->boolean("ssl")->default(false);

                $table->defaultFields();
                $table->timestamps();
                $table->softDeletes();

                $table->unique(["domain", "deleted_at"]);
            });
        }

        if (!Schema::hasTable("website_extras")) {
            Schema::create("website_extras", function (Blueprint $table) {
                $table->extras("website");
            });
        }

        if (!Schema::hasTable("website_details")) {
            Schema::create("website_details", function (Blueprint $table) {
                $table->details("website");
            });
        }

        if (!Schema::hasTable("website_detail_extras")) {
            Schema::create("website_detail_extras", function (
                Blueprint $table
            ) {
                $table->extras("website_detail");
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
        Schema::dropIfExists("website_detail_extras");
        Schema::dropIfExists("website_details");
        Schema::dropIfExists("website_extras");
        Schema::dropIfExists("websites");
    }
}
