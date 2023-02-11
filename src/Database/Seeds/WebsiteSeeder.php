<?php

namespace Orbitali\Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Orbitali\Http\Models\Website;

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

        $website = new Website([
            "domain" => $domain,
            "ssl" => $ssl,
            "status" => 1,
            "languages" => [config("app.locale")],
            "detail" => [
                "name" => env("APP_NAME", $domain),
                "language" => config("app.locale"),
                //"slug" => "/"
            ]
        ]);
        $website->push();
        $website->detail->slug = "/";
        $website->detail->push();
    }
}
