<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable("nodes")) {
            Schema::create("nodes", function (Blueprint $table) {
                $table->increments("id");
                $table->unsignedInteger("website_id")->index();

                $table->string("type")->nullable();

                //$table->boolean("has_detail")->default(false);
                //$table->boolean("has_category")->default(false);
                //$table->boolean('has_criteria')->default(false);
                //$table->boolean('has_property')->default(false);
                //$table->boolean("searchable")->default(false);

                $table->defaultFields();
                $table->timestamps();
                $table->softDeletes();

                $table->unique(["type", "deleted_at"]);
                $table
                    ->foreign("website_id")
                    ->references("id")
                    ->on("websites")
                    ->onUpdate("cascade")
                    ->onDelete("cascade");
            });
        }

        if (!Schema::hasTable("node_extras")) {
            Schema::create("node_extras", function (Blueprint $table) {
                $table->extras("node");
            });
        }

        if (!Schema::hasTable("node_details")) {
            Schema::create("node_details", function (Blueprint $table) {
                $table->details("node");
            });
        }

        if (!Schema::hasTable("node_detail_extras")) {
            Schema::create("node_detail_extras", function (Blueprint $table) {
                $table->extras("node_detail");
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
        Schema::dropIfExists("node_detail_extras");
        Schema::dropIfExists("node_details");
        Schema::dropIfExists("node_extras");
        Schema::dropIfExists("nodes");
    }
}
