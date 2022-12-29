<?php

namespace Orbitali\Http\Models;

use Illuminate\Database\Eloquent\Model;

class ClockworkEntry extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    protected $casts = [
        "id" => "string",
        "version" => "int",
        "type" => "string",
        "time" => "float",
        "method" => "string",
        "url" => "string",
        "uri" => "string",
        "headers" => "json",
        "controller" => "string",
        "getData" => "json",
        "postData" => "json",
        "requestData" => "json",
        "sessionData" => "json",
        "authenticatedUser" => "json",
        "cookies" => "json",
        "responseTime" => "float",
        "responseStatus" => "int",
        "responseDuration" => "float",
        "memoryUsage" => "int",
        "middleware" => "json",
        "databaseQueries" => "json",
        "databaseQueriesCount" => "int",
        "databaseSlowQueries" => "int",
        'databaseSelects' => "int",
        'databaseInserts' => "int",
        'databaseUpdates' => "int",
        'databaseDeletes' => "int",
        'databaseOthers' => "int",
        'databaseDuration' => "float",
        "cacheQueries" => "json",
        'cacheReads' => "int",
        'cacheHits' => "int",
        'cacheWrites' => "int",
        'cacheDeletes' => "int",
        "cacheTime"  => "float",
        "modelsActions" => "json",
        "modelsRetrieved" => "json",
        "modelsCreated" => "json",
        "modelsUpdated" => "json",
        "modelsDeleted" => "json",
        "redisCommands" => "json",
        "queueJobs" => "json",
        "timelineData" => "json",
        "log" => "json",
        "events" => "json",
        "routes" => "json",
        "notifications" => "json",
        "emailsData" => "json",
        "viewsData" => "json",
        "userData" => "json",
        "subrequests" => "json",
        "xdebug" => "json",
        "commandName" => "string",
        "commandArguments" => "json",
        "commandArgumentsDefaults" => "json",
        "commandOptions" => "json",
        "commandOptionsDefaults" => "json",
        "commandExitCode" => "int",
        "commandOutput" => "string",
        "jobName" => "string",
        "jobDescription" => "string",
        "jobStatus" => "string",
        "jobPayload" => "json",
        "jobConnection" => "json",
        "jobOptions" => "json",
        "testName" => "string",
        "testStatus" => "string",
        "testStatusMessage" => "string",
        "testAsserts" => "json",
        "clientMetrics" => "json",
        "webVitals" => "json",
        "parent" => "string",
        "updateToken" => "string",
    ];

    public function getTable()
    {
        return config("clockwork.storage_sql_table");
    }
}
