<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('email');
                $table->string('password')->nullable();
                $table->rememberToken();
                $table->timestamps();
                $table->softDeletes();

                $table->unique(['email', 'deleted_at']);
            });
        } else if (!Schema::hasColumn('users', 'deleted_at')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropUnique('users_email_unique');
                $table->dropColumn('password');
                $table->string('password')->nullable();
                $table->softDeletes();
                $table->unique(['email', 'deleted_at']);
            });
        }

        if (!Schema::hasTable('user_extras')) {
            Schema::create('user_extras', function (Blueprint $table) {
                $table->extras('user');
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
        Schema::dropIfExists('user_extras');
        Schema::dropIfExists('users');
    }
}
