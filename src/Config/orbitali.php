<?php

$panelPrefix = "opanel";

return [
    /*
     *|-------------------------------
     *|--- panel prefix
     *|-------------------------------
     */
    "panelPrefix" => $panelPrefix,
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
        "web" => "$panelPrefix/clockwork",
        "storage" => env("CLOCKWORK_STORAGE", "sql"),
        "storage_sql_database" => env(
            "CLOCKWORK_STORAGE_SQL_DATABASE",
            config("database.default")
        ),
        "storage_sql_table" => env("CLOCKWORK_STORAGE_SQL_TABLE", "clockwork"),
        "collect_data_always" => env("CLOCKWORK_COLLECT_DATA_ALWAYS", true),
        "authentication" => env(
            "CLOCKWORK_AUTHENTICATION",
            "\Orbitali\Foundations\Clockwork\ClockWorkAuthenticator"
        ),
        "artisan" => [
            "collect" => env("CLOCKWORK_ARTISAN_COLLECT", true),
            "collect_output" => env("CLOCKWORK_ARTISAN_COLLECT_OUTPUT", true),
            "except_laravel_commands" => env(
                "CLOCKWORK_ARTISAN_EXCEPT_LARAVEL_COMMANDS",
                false
            ),
            "except" => ["schedule:run", "schedule:finish", "db:seed"],
        ],
        "queue" => [
            "collect" => env("CLOCKWORK_QUEUE_COLLECT", true),
        ],
        "storage_expiration" => env("CLOCKWORK_STORAGE_EXPIRATION", false),
        "requests" => [
            "except" => [
                "/horizon/.*", // Laravel Horizon requests
                "/telescope/.*", // Laravel Telescope requests
                "/_debugbar/.*", // Laravel DebugBar requests
                "/livewire/.*", // Laravel Livewire requests
            ],
        ],
    ],

    /*
     *|-------------------------------
     *|--- for cache
     *|-------------------------------
     */
    "cache" => [
        /*
        "replacer" => [
            "<replacer-key>"=>"App\Class@staticFunction"
        ],
        */
    ],
];
