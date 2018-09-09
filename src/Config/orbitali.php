<?php

return [
    "panelPrefix" => "opanel",

    /**
     * 0 => no capture, default site locale
     * 1 => language and country, capture by url
     * 2 => language and country, capture by auto
     */
    "localizationCaptureType" => 1,

    "auth" => [
        'providers' => [
            'users' => [
                'driver' => 'eloquent',
                'model' => 'Orbitali\Http\Models\User',
            ]
        ]
    ],

    "services" => [
        'github' => [
            'client_id' => "e1564b8baf2770601cf0",
            'client_secret' => "220265792b9bd1ab36a8bd3ba443eb8633c8ab2f",
            'redirect' => '/auth/github/callback',
        ],

        'twitter' => [
            'client_id' => "ENU4eBmLzJIPMjeXwiaCbQ",
            'client_secret' => "5vvrWNHSlgWx6oi2LOuqTQSg0O0N7aCbUKEDYYCQk",
            'redirect' => '/auth/twitter/callback',
        ],

        'bitbucket' => [
            'client_id' => "JF0Q1uOQijRR2gy0g34vyxp1jwiI13ys",
            'client_secret' => "Cdsqp18IGRfblIxcxG3mklWMmMpZhR58KnQidUkyzyZvTbt3K3fZ4P8QTg1lmXX_",
            'redirect' => '/auth/bitbucket/callback',
        ]
    ]
];
