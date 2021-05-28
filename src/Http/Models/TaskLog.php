<?php

namespace Orbitali\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Orbitali\Http\Traits\Cacheable;

class TaskLog extends Model
{
    use Cacheable;

    protected $guarded = [];
    protected $table = "clockwork";

    protected $casts = [
        "headers" => "json",
        "getData" => "json",
        "postData" => "json",
        "requestData" => "json",
        "sessionData" => "json",
        "authenticatedUser" => "json",
        "cookies" => "json",
        "databaseQueries" => "json",
        "cacheQueries" => "json",
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
        "commandArguments" => "json",
        "commandArgumentsDefaults" => "json",
        "commandOptions" => "json",
        "commandOptionsDefaults" => "json",
        "jobPayload" => "json",
        "jobOptions" => "json",
        "testAsserts" => "json",
        "clientMetrics" => "json",
        "webVitals" => "json",
    ];
}
