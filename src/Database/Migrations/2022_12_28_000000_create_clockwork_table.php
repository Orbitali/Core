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
            $table->string('id', 100);
            $table->integer('version')->nullable()->default(NULL);
            $table->string('type', 100)->nullable()->default(NULL);
            $table->double('time')->nullable()->default(NULL);
            $table->string('method', 10)->nullable()->default(NULL);
            $table->mediumtext('url')->nullable()->default(NULL);
            $table->mediumtext('uri')->nullable()->default(NULL);
            $table->mediumtext('headers')->nullable()->default(NULL);
            $table->string('controller', 250)->nullable()->default(NULL);
            $table->mediumtext('getData')->nullable()->default(NULL);
            $table->mediumtext('postData')->nullable()->default(NULL);
            $table->mediumtext('requestData')->nullable()->default(NULL);
            $table->mediumtext('sessionData')->nullable()->default(NULL);
            $table->mediumtext('authenticatedUser')->nullable()->default(NULL);
            $table->mediumtext('cookies')->nullable()->default(NULL);
            $table->double('responseTime')->nullable()->default(NULL);
            $table->integer('responseStatus')->nullable()->default(NULL);
            $table->double('responseDuration')->nullable()->default(NULL);
            $table->double('memoryUsage')->nullable()->default(NULL);
            $table->mediumtext('middleware')->nullable()->default(NULL);
            $table->mediumtext('databaseQueries')->nullable()->default(NULL);
            $table->integer('databaseQueriesCount')->nullable()->default(NULL);
            $table->integer('databaseSlowQueries')->nullable()->default(NULL);
            $table->integer('databaseSelects')->nullable()->default(NULL);
            $table->integer('databaseInserts')->nullable()->default(NULL);
            $table->integer('databaseUpdates')->nullable()->default(NULL);
            $table->integer('databaseDeletes')->nullable()->default(NULL);
            $table->integer('databaseOthers')->nullable()->default(NULL);
            $table->double('databaseDuration')->nullable()->default(NULL);
            $table->mediumtext('cacheQueries')->nullable()->default(NULL);
            $table->integer('cacheReads')->nullable()->default(NULL);
            $table->integer('cacheHits')->nullable()->default(NULL);
            $table->integer('cacheWrites')->nullable()->default(NULL);
            $table->integer('cacheDeletes')->nullable()->default(NULL);
            $table->double('cacheTime')->nullable()->default(NULL);
            $table->mediumtext('modelsActions')->nullable()->default(NULL);
            $table->mediumtext('modelsRetrieved')->nullable()->default(NULL);
            $table->mediumtext('modelsCreated')->nullable()->default(NULL);
            $table->mediumtext('modelsUpdated')->nullable()->default(NULL);
            $table->mediumtext('modelsDeleted')->nullable()->default(NULL);
            $table->mediumtext('redisCommands')->nullable()->default(NULL);
            $table->mediumtext('queueJobs')->nullable()->default(NULL);
            $table->mediumtext('timelineData')->nullable()->default(NULL);
            $table->mediumtext('log')->nullable()->default(NULL);
            $table->mediumtext('events')->nullable()->default(NULL);
            $table->mediumtext('routes')->nullable()->default(NULL);
            $table->mediumtext('notifications')->nullable()->default(NULL);
            $table->mediumtext('emailsData')->nullable()->default(NULL);
            $table->mediumtext('viewsData')->nullable()->default(NULL);
            $table->mediumtext('userData')->nullable()->default(NULL);
            $table->mediumtext('subrequests')->nullable()->default(NULL);
            $table->mediumtext('xdebug')->nullable()->default(NULL);
            $table->mediumtext('commandName')->nullable()->default(NULL);
            $table->mediumtext('commandArguments')->nullable()->default(NULL);
            $table->mediumtext('commandArgumentsDefaults')->nullable()->default(NULL);
            $table->mediumtext('commandOptions')->nullable()->default(NULL);
            $table->mediumtext('commandOptionsDefaults')->nullable()->default(NULL);
            $table->integer('commandExitCode')->nullable()->default(NULL);
            $table->mediumtext('commandOutput')->nullable()->default(NULL);
            $table->mediumtext('jobName')->nullable()->default(NULL);
            $table->mediumtext('jobDescription')->nullable()->default(NULL);
            $table->mediumtext('jobStatus')->nullable()->default(NULL);
            $table->mediumtext('jobPayload')->nullable()->default(NULL);
            $table->mediumtext('jobQueue')->nullable()->default(NULL);
            $table->mediumtext('jobConnection')->nullable()->default(NULL);
            $table->mediumtext('jobOptions')->nullable()->default(NULL);
            $table->mediumtext('testName')->nullable()->default(NULL);
            $table->mediumtext('testStatus')->nullable()->default(NULL);
            $table->mediumtext('testStatusMessage')->nullable()->default(NULL);
            $table->mediumtext('testAsserts')->nullable()->default(NULL);
            $table->mediumtext('clientMetrics')->nullable()->default(NULL);
            $table->mediumtext('webVitals')->nullable()->default(NULL);
            $table->mediumtext('parent')->nullable()->default(NULL);
            $table->string('updateToken', 100)->nullable()->default(NULL);

            $table->index('id');
            $table->index('time');
            $table->index('updateToken');
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
