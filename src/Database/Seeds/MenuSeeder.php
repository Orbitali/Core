<?php

namespace Orbitali\Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("menus")->insert([
            [
                "id" => 1,
                "website_id" => null,
                "type" => "root",
                "data" => null,
                "lft" => 1,
                "rgt" => 30,
                "menu_id" => null,
                "user_id" => 1,
                "status" => 1,
            ],
            [
                "id" => 2,
                "website_id" => null,
                "type" => "route",
                "data" => "panel.index",
                "lft" => 2,
                "rgt" => 3,
                "menu_id" => 1,
                "user_id" => 1,
                "status" => 1,
            ],
            [
                "id" => 3,
                "website_id" => null,
                "type" => "route",
                "data" => "panel.website.index",
                "lft" => 4,
                "rgt" => 5,
                "menu_id" => 1,
                "user_id" => 1,
                "status" => 1,
            ],
            [
                "id" => 4,
                "website_id" => null,
                "type" => "route",
                "data" => "panel.structure.index",
                "lft" => 6,
                "rgt" => 7,
                "menu_id" => 1,
                "user_id" => 1,
                "status" => 1,
            ],
            [
                "id" => 5,
                "website_id" => null,
                "type" => "route",
                "data" => "panel.node.index",
                "lft" => 8,
                "rgt" => 11,
                "menu_id" => 1,
                "user_id" => 1,
                "status" => 1,
            ],
            [
                "id" => 6,
                "website_id" => null,
                "type" => "datasource",
                "data" => "Orbitali\\Foundations\\Datasources\\NodeMenu",
                "lft" => 9,
                "rgt" => 10,
                "menu_id" => 5,
                "user_id" => 1,
                "status" => 1,
            ],
            [
                "id" => 7,
                "website_id" => null,
                "type" => "route",
                "data" => "panel.user.index",
                "lft" => 12,
                "rgt" => 13,
                "menu_id" => 1,
                "user_id" => 1,
                "status" => 1,
            ],
            [
                "id" => 8,
                "website_id" => null,
                "type" => "route",
                "data" => "panel.form.index",
                "lft" => 14,
                "rgt" => 15,
                "menu_id" => 1,
                "user_id" => 1,
                "status" => 1,
            ],
            [
                "id" => 9,
                "website_id" => null,
                "type" => "route",
                "data" => "panel.url.index",
                "lft" => 16,
                "rgt" => 17,
                "menu_id" => 1,
                "user_id" => 1,
                "status" => 1,
            ],
            [
                "id" => 10,
                "website_id" => null,
                "type" => "route",
                "data" => "panel.task.index",
                "lft" => 18,
                "rgt" => 19,
                "menu_id" => 1,
                "user_id" => 1,
                "status" => 1,
            ],
            [
                "id" => 11,
                "website_id" => null,
                "type" => "route",
                "data" => "panel.menu.index",
                "lft" => 20,
                "rgt" => 21,
                "menu_id" => 1,
                "user_id" => 1,
                "status" => 1,
            ],
        ]);

        DB::table("menu_extras")->insert([
            [
                "id" => 1,
                "menu_id" => 1,
                "key" => "icon",
                "value" => null,
            ],
            [
                "id" => 2,
                "menu_id" => 2,
                "key" => "icon",
                "value" => "[\"fas fa-chart-pie\"]",
            ],
            [
                "id" => 3,
                "menu_id" => 3,
                "key" => "icon",
                "value" => "[\"fas fa-atlas\"]",
            ],
            [
                "id" => 4,
                "menu_id" => 4,
                "key" => "icon",
                "value" => "[\"fas fa-cubes\"]",
            ],
            [
                "id" => 5,
                "menu_id" => 5,
                "key" => "icon",
                "value" => "[\"fas fa-code-branch\"]",
            ],
            [
                "id" => 6,
                "menu_id" => 7,
                "key" => "icon",
                "value" => "[\"fas fa-user\"]",
            ],
            [
                "id" => 7,
                "menu_id" => 8,
                "key" => "icon",
                "value" => "[\"fa-2x\",\"fas fa-file-invoice\"]",
            ],
            [
                "id" => 8,
                "menu_id" => 9,
                "key" => "icon",
                "value" => "[\"fa-2x\",\"fas fa-link\"]",
            ],
            [
                "id" => 9,
                "menu_id" => 10,
                "key" => "icon",
                "value" => "[\"fa-2x\",\"far fa-clock\"]",
            ],
            [
                "id" => 10,
                "menu_id" => 11,
                "key" => "icon",
                "value" => "[\"fas fa-stream\"]",
            ],
        ]);

        DB::table("menu_details")->insert([
            [
                "id" => 1,
                "menu_id" => 1,
                "language" => "tr",
                "country" => null,
                "name" => "Panel Menü",
            ],
            [
                "id" => 2,
                "menu_id" => 2,
                "language" => "tr",
                "country" => null,
                "name" => "Ana Sayfa",
            ],
            [
                "id" => 3,
                "menu_id" => 3,
                "language" => "tr",
                "country" => null,
                "name" => "Websiteleri",
            ],
            [
                "id" => 4,
                "menu_id" => 4,
                "language" => "tr",
                "country" => null,
                "name" => "Yapılar",
            ],
            [
                "id" => 5,
                "menu_id" => 5,
                "language" => "tr",
                "country" => null,
                "name" => "Düğümler",
            ],
            [
                "id" => 6,
                "menu_id" => 6,
                "language" => "tr",
                "country" => null,
                "name" => "Aktif Düğümler",
            ],
            [
                "id" => 7,
                "menu_id" => 7,
                "language" => "tr",
                "country" => null,
                "name" => "Kullanıcılar",
            ],
            [
                "id" => 8,
                "menu_id" => 8,
                "language" => "tr",
                "country" => null,
                "name" => "Formlar",
            ],
            [
                "id" => 9,
                "menu_id" => 9,
                "language" => "tr",
                "country" => null,
                "name" => "Linkler",
            ],
            [
                "id" => 10,
                "menu_id" => 10,
                "language" => "tr",
                "country" => null,
                "name" => "Görevler",
            ],
            [
                "id" => 11,
                "menu_id" => 11,
                "language" => "tr",
                "country" => null,
                "name" => "Menüler",
            ],
        ]);
    }
}
