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
            "client_id" => "e1564b8baf2770601cf0",
            "client_secret" => "220265792b9bd1ab36a8bd3ba443eb8633c8ab2f",
            "redirect" => "/login/github/callback",
        ],

        "twitter" => [
            "client_id" => "ENU4eBmLzJIPMjeXwiaCbQ",
            "client_secret" => "5vvrWNHSlgWx6oi2LOuqTQSg0O0N7aCbUKEDYYCQk",
            "redirect" => "/login/twitter/callback",
        ],

        "bitbucket" => [
            "client_id" => "JF0Q1uOQijRR2gy0g34vyxp1jwiI13ys",
            "client_secret" =>
                "Cdsqp18IGRfblIxcxG3mklWMmMpZhR58KnQidUkyzyZvTbt3K3fZ4P8QTg1lmXX_",
            "redirect" => "/login/bitbucket/callback",
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
