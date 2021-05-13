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
        if (!Schema::hasTable("users")) {
            Schema::create("users", function (Blueprint $table) {
                $table->increments("id");
                $table->string("name");
                $table->string("email");
                $table->timestamp("email_verified_at")->nullable();
                $table->string("password")->nullable();
                $table->rememberToken();
                $table->timestamps();
                $table->softDeletes();

                $table->unique(["email", "deleted_at"]);
            });
        } elseif (!Schema::hasColumn("users", "deleted_at")) {
            Schema::table("users", function (Blueprint $table) {
                $table->dropUnique("users_email_unique");
                $table->dropColumn("password");
                $table->string("password")->nullable();
                $table->softDeletes();
                $table->unique(["email", "deleted_at"]);
            });
        }

        if (!Schema::hasTable("user_extras")) {
            Schema::create("user_extras", function (Blueprint $table) {
                $table->extras("user");
            });
        }

        if (!Schema::hasTable("user_details")) {
            Schema::create("user_details", function (Blueprint $table) {
                $table->details("user");
            });
        }

        if (!Schema::hasTable("user_detail_extras")) {
            Schema::create("user_detail_extras", function (Blueprint $table) {
                $table->extras("user_detail");
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
        Schema::dropIfExists("user_detail_extras");
        Schema::dropIfExists("user_details");
        Schema::dropIfExists("user_extras");
        Schema::dropIfExists("users");
    }
};
