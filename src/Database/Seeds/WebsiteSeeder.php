<?php

namespace Orbitali\Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WebsiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $parsed = parse_url(config("app.url"));
        $ssl = isset($parsed["scheme"]) ? $parsed["scheme"] === "https" : false;
        $domain = isset($parsed["host"]) ? $parsed["host"] : "local";
        $exist = DB::table("websites")
            ->where("domain", $domain)
            ->count();
        if ($exist) {
            return;
        }

        DB::table("websites")->insert([
            [
                "domain" => $domain,
                "ssl" => $ssl,
                "status" => 1,
            ],
        ]);
        DB::table("website_extras")->insert([
            [
                "website_id" => 1,
                "key" => "languages",
                "value" => json_encode([config("app.locale")]),
            ],
        ]);
        DB::table("website_details")->insert([
            [
                "name" => env("APP_NAME", $domain),
                "language" => config("app.locale"),
                "website_id" => 1,
            ],
        ]);
        DB::table("urls")->insert([
            [
                "website_id" => 1,
                "url" => "/",
                "model_type" => "website_details",
                "model_id" => 1,
                "type" => "original",
            ],
        ]);
    }
}
