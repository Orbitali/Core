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
        DB::table("website_details")->insert([
            [
                "name" => env("APP_NAME", $domain),
                "language" => "en",
                "website_id" => 1,
            ],
        ]);
    }
}
