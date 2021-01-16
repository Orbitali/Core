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
        $parsed = parse_url(env("APP_URL", "http://local"));
        $ssl = isset($parsed["scheme"]) ? $parsed["scheme"] === "https" : false;
        $domain = isset($parsed["host"]) ? $parsed["host"] : "local";
        $exist = DB::table("websites")
            ->where("domain", $domain)
            ->count();
        if ($exist) {
            DB::table("websites")
                ->where("domain", $domain)
                ->update(["domain" => $domain, "ssl" => $ssl]);
            return;
        }

        DB::table("websites")->insert([
            [
                "name" => env("APP_NAME", $domain),
                "domain" => $domain,
                "ssl" => $ssl,
                "status" => 1,
            ],
        ]);
    }
}
