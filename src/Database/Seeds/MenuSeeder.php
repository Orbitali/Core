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
        $panelPrefix = "/" . config("orbitali.panelPrefix") . "/";
        DB::table("menus")->insert([
            [
                "id" => 1,
                "lft" => 1,
                "rgt" => 20,
                "type" => "root",
                "data" => null,
                "menu_id" => null,
                "user_id" => 1,
                "website_id" => null,
                "status" => 1,
            ],
            [
                "id" => 2,
                "lft" => 2,
                "rgt" => 3,
                "type" => "route",
                "data" => "panel.index",
                "menu_id" => 1,
                "user_id" => 1,
                "website_id" => null,
                "status" => 1,
            ],
            [
                "id" => 3,
                "lft" => 4,
                "rgt" => 5,
                "type" => "route",
                "data" => "panel.website.index",
                "menu_id" => 1,
                "user_id" => 1,
                "website_id" => null,
                "status" => 1,
            ],
            [
                "id" => 5,
                "lft" => 6,
                "rgt" => 7,
                "type" => "route",
                "data" => "panel.structure.index",
                "menu_id" => 1,
                "user_id" => 1,
                "website_id" => null,
                "status" => 1,
            ],
            [
                "id" => 6,
                "lft" => 8,
                "rgt" => 11,
                "type" => "route",
                "data" => "panel.node.index",
                "menu_id" => 1,
                "user_id" => 1,
                "website_id" => null,
                "status" => 1,
            ],
            [
                "id" => 7,
                "lft" => 9,
                "rgt" => 10,
                "type" => "datasource",
                "data" => "Orbitali\Foundations\Datasources\NodeMenu",
                "menu_id" => 6,
                "user_id" => 1,
                "website_id" => null,
                "status" => 1,
            ],
            [
                "id" => 8,
                "lft" => 12,
                "rgt" => 13,
                "type" => "route",
                "data" => "panel.user.index",
                "menu_id" => 1,
                "user_id" => 1,
                "website_id" => null,
                "status" => 1,
            ],
            [
                "id" => 9,
                "lft" => 14,
                "rgt" => 15,
                "type" => "route",
                "data" => "panel.form.index",
                "menu_id" => 1,
                "user_id" => 1,
                "website_id" => null,
                "status" => 1,
            ],
            [
                "id" => 10,
                "lft" => 16,
                "rgt" => 17,
                "type" => "route",
                "data" => "panel.url.index",
                "menu_id" => 1,
                "user_id" => 1,
                "website_id" => null,
                "status" => 1,
            ],
            [
                "id" => 11,
                "lft" => 18,
                "rgt" => 19,
                "type" => "route",
                "data" => "panel.task.index",
                "menu_id" => 1,
                "user_id" => 1,
                "website_id" => null,
                "status" => 1,
            ],
        ]);
    }
}
