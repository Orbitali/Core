<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clockwork', function (Blueprint $table) {
            $table->string('id', 32)->primary();
            $table->integer('version')->default(1);
            $table->string('type', 32)->nullable()->index();
            $table->decimal('time',20,6)->nullable()->index();
            $table->string('method', 10)->nullable();
            $table->string('url',2048)->nullable();
            $table->string('uri', 2048)->nullable();
            $table->json('headers')->nullable();
            $table->string('controller', 512)->nullable();
            $table->json('getData')->nullable();
            $table->json('postData')->nullable();
            $table->json('requestData')->nullable();
            $table->json('sessionData')->nullable();
            $table->json('authenticatedUser')->nullable();
            $table->json('cookies')->nullable();
            $table->decimal('responseTime',20,6)->nullable();
            $table->integer('responseStatus')->nullable();
            $table->decimal('responseDuration',8,2)->nullable();
            $table->integer('memoryUsage')->nullable();
            $table->json('middleware')->nullable()->index();
            $table->json('databaseQueries')->nullable();
            $table->integer('databaseQueriesCount')->nullable();
            $table->integer('databaseSlowQueries')->nullable();
            $table->integer('databaseSelects')->nullable();
            $table->integer('databaseInserts')->nullable();
            $table->integer('databaseUpdates')->nullable();
            $table->integer('databaseDeletes')->nullable();
            $table->integer('databaseOthers')->nullable();
            $table->decimal('databaseDuration',11,3)->nullable();
            $table->json('cacheQueries')->nullable();
            $table->integer('cacheReads')->nullable();
            $table->integer('cacheHits')->nullable();
            $table->integer('cacheWrites')->nullable();
            $table->integer('cacheDeletes')->nullable();
            $table->decimal('cacheTime',20,6)->nullable();
            $table->json('modelsActions')->nullable();
            $table->json('modelsRetrieved')->nullable();
            $table->json('modelsCreated')->nullable();
            $table->json('modelsUpdated')->nullable();
            $table->json('modelsDeleted')->nullable();
            $table->json('redisCommands')->nullable();
            $table->json('queueJobs')->nullable();
            $table->json('timelineData')->nullable();
            $table->json('log')->nullable();
            $table->json('events')->nullable();
            $table->json('routes')->nullable();
            $table->json('notifications')->nullable();
            $table->json('emailsData')->nullable();
            $table->json('viewsData')->nullable();
            $table->json('userData')->nullable();
            $table->json('subrequests')->nullable();
            $table->json('xdebug')->nullable();
            $table->string('commandName',512)->nullable();
            $table->json('commandArguments')->nullable();
            $table->json('commandArgumentsDefaults')->nullable();
            $table->json('commandOptions')->nullable();
            $table->json('commandOptionsDefaults')->nullable();
            $table->integer('commandExitCode')->nullable();
            $table->mediumtext('commandOutput')->nullable();
            $table->string('jobName', 512)->nullable();
            $table->mediumtext('jobDescription')->nullable();
            $table->mediumtext('jobStatus')->nullable();
            $table->json('jobPayload')->nullable();
            $table->mediumtext('jobQueue')->nullable();
            $table->mediumtext('jobConnection')->nullable();
            $table->json('jobOptions')->nullable();
            $table->string('testName', 512)->nullable();
            $table->mediumtext('testStatus')->nullable();
            $table->mediumtext('testStatusMessage')->nullable();
            $table->json('testAsserts')->nullable();
            $table->json('clientMetrics')->nullable();
            $table->json('webVitals')->nullable();
            $table->string('parent',32)->nullable();
            $table->string('updateToken', 8)->nullable()->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clockwork');
    }
};
