<?php

return [
    /*
     *|-------------------------------
     *|--- panel prefix
     *|-------------------------------
     */
    "panelPrefix" => "opanel",
    /*
     *|-------------------------------
     *|--- register activity
     *|-------------------------------
     */
    "registerActivity" => true,
    /*
     *|-------------------------------
     *|--- password reset activity
     *|-------------------------------
     */
    "passwordResetActivity" => true,
    /*
     *|-------------------------------
     *|--- for auth
     *|-------------------------------
     */
    "auth" => [
        "providers" => [
            "users" => [
                "driver" => "eloquent",
                "model" => "Orbitali\Http\Models\User",
            ],
        ],
    ],
    /*
     *|-------------------------------
     *|--- services for socialite
     *|-------------------------------
     */
    "services" => [
        /*"github" => [
            "client_id" => env("GITHUB_CLIENT_ID", "**SECRET**"),
            "client_secret" => env("GITHUB_CLIENT_SECRET", "**SECRET**"),
            "redirect" => "/login/github/callback",
        ],*/
    ],
    /*
     *|-------------------------------
     *|--- for clockwork
     *|-------------------------------
     */
    "clockwork" => [
        "enable" => env("CLOCKWORK_ENABLE", true),
        "web" => env("CLOCKWORK_WEB", false),
        "storage" => env("CLOCKWORK_STORAGE", "sql"),
        "storage_sql_database" => env(
            "CLOCKWORK_STORAGE_SQL_DATABASE",
            config("database.default")
        ),
        "storage_sql_table" => env("CLOCKWORK_STORAGE_SQL_TABLE", "clockwork"),
        "collect_data_always" => env("CLOCKWORK_COLLECT_DATA_ALWAYS", true),
        "authentication" => env(
            "CLOCKWORK_AUTHENTICATION",
            "\Orbitali\Foundations\ClockWorkAuthenticator"
        ),
        "artisan" => [
            "collect" => env("CLOCKWORK_ARTISAN_COLLECT", true),
            "collect_output" => env("CLOCKWORK_ARTISAN_COLLECT_OUTPUT", true),
            "except_laravel_commands" => env(
                "CLOCKWORK_ARTISAN_EXCEPT_LARAVEL_COMMANDS",
                true
            ),
            "except" => ["schedule:run", "schedule:finish"],
        ],
        "queue" => [
            "collect" => env("CLOCKWORK_QUEUE_COLLECT", true),
        ],
        "storage_expiration" => env("CLOCKWORK_STORAGE_EXPIRATION", false),
    ],

    /*
     *|-------------------------------
     *|--- for cache
     *|-------------------------------
     */
    "cache" => [
        /*
        "replacer" => [
            "<replacer-key>"=>"replacer-value or function"
        ],
        */
    ],
];
