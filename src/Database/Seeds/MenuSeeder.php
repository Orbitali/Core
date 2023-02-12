<?php

namespace Orbitali\Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Orbitali\Http\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rootMenu = Menu::create([
            "type" => "root",
            "user_id" => 1,
            "status" => 1,
            "icon" => null,
            "detail" => [
                "name" => "Panel Menu"
            ],
            "children"=>[
                [
                    "type" => "route",
                    "data" => "panel.index",
                    "user_id" => 1,
                    "status" => 1,
                    "icon" => ["fas fa-chart-pie"],
                    "detail" => [
                        "name" => "Ana Sayfa"
                    ]
                ],
                [
                    "type" => "route",
                    "data" => "panel.website.index",
                    "user_id" => 1,
                    "status" => 1,
                    "icon" => ["fas fa-atlas"],
                    "detail" => [
                        "name" => "Websiteleri"
                    ]
                ],
                [
                    "type" => "route",
                    "data" => "panel.structure.index",
                    "user_id" => 1,
                    "status" => 1,
                    "icon" => ["fas fa-cubes"],
                    "detail" => [
                        "name" => "Yapılar"
                    ]
                ],
                [
                    "type" => "route",
                    "data" => "panel.node.index",
                    "user_id" => 1,
                    "status" => 1,
                    "icon" => ["fas fa-code-branch"],
                    "detail" => [
                        "name" => "Düğümler"
                    ],
                    "children" => [
                        [
                            "type" => "datasource",
                            "data" => "Orbitali\\Foundations\\Datasources\\NodeMenu",
                            "user_id" => 1,
                            "status" => 1,
                            "detail" => [
                                "name" => "Aktif Düğümler"
                            ]
                        ]
                    ]
                ],
                [
                    "type" => "route",
                    "data" => "panel.user.index",
                    "user_id" => 1,
                    "status" => 1,
                    "icon" => ["fas fa-user"],
                    "detail" => [
                        "name" => "Kullanıcılar"
                    ]
                ],
                [
                    "type" => "route",
                    "data" => "panel.form.index",
                    "user_id" => 1,
                    "status" => 1,
                    "icon" => ["fa-2x", "fas fa-file-invoice"],
                    "detail" => [
                        "name" => "Formlar"
                    ]
                ],
                [
                    "type" => "route",
                    "data" => "panel.url.index",
                    "user_id" => 1,
                    "status" => 1,
                    "icon" => ["fa-2x", "fas fa-link"],
                    "detail" => [
                        "name" => "Linkler"
                    ]
                ],
                [
                    "type" => "route",
                    "data" => "panel.task.index",
                    "user_id" => 1,
                    "status" => 1,
                    "icon" => ["fa-2x", "fas fa-clock"],
                    "detail" => [
                        "name" => "Görevler"
                    ]
                ],
                [
                    "type" => "route",
                    "data" => "panel.menu.index",
                    "user_id" => 1,
                    "status" => 1,
                    "icon" => ["fas fa-stream"],
                    "detail" => [
                        "name" => "Menüler"
                    ]
                ]
            ]
        ]);
    }
}
