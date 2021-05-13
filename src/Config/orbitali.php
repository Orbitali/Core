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
        "github" => [
            "client_id" => env("GITHUB_CLIENT_ID", "**SECRET**"),
            "client_secret" => env("GITHUB_CLIENT_SECRET", "**SECRET**"),
            "redirect" => "/login/github/callback",
        ],
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
        "collect_data_always" => env("CLOCKWORK_COLLECT_DATA_ALWAYS", false),
        "authentication" => env(
            "CLOCKWORK_AUTHENTICATION",
            "\Orbitali\Foundations\ClockWorkAuthenticator"
        ),
    ],
];
