<?php

namespace Orbitali\Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("tasks")->insert([
            [
                "command" => "inspire",
                "parameters" => null,
                "expression" => "* * * * *",
                "dont_overlap" => 1,
                "run_in_maintenance" => 1,
                "run_on_one_server" => 1,
                "run_in_background" => 1,
                "status" => 0,
            ],
            [
                "command" => "orbitali:backup-db",
                "parameters" => null,
                "expression" => "* * * * *",
                "dont_overlap" => 1,
                "run_in_maintenance" => 1,
                "run_on_one_server" => 0,
                "run_in_background" => 1,
                "status" => 0,
            ],
            [
                "command" => "cache:clear",
                "parameters" => null,
                "expression" => "* * * * *",
                "dont_overlap" => 1,
                "run_in_maintenance" => 1,
                "run_on_one_server" => 0,
                "run_in_background" => 1,
                "status" => 0,
            ],
            [
                "command" => "clockwork:clean",
                "parameters" => null,
                "expression" => "* * * * *",
                "dont_overlap" => 1,
                "run_in_maintenance" => 1,
                "run_on_one_server" => 0,
                "run_in_background" => 1,
                "status" => 0,
            ],
            [
                "command" => "config:cache",
                "parameters" => null,
                "expression" => "* * * * *",
                "dont_overlap" => 1,
                "run_in_maintenance" => 1,
                "run_on_one_server" => 0,
                "run_in_background" => 1,
                "status" => 0,
            ],
            [
                "command" => "config:clear",
                "parameters" => null,
                "expression" => "* * * * *",
                "dont_overlap" => 1,
                "run_in_maintenance" => 1,
                "run_on_one_server" => 0,
                "run_in_background" => 1,
                "status" => 0,
            ],
            [
                "command" => "migrate:status",
                "parameters" => null,
                "expression" => "* * * * *",
                "dont_overlap" => 1,
                "run_in_maintenance" => 1,
                "run_on_one_server" => 0,
                "run_in_background" => 1,
                "status" => 0,
            ],
            [
                "command" => "migrate:install",
                "parameters" => null,
                "expression" => "* * * * *",
                "dont_overlap" => 1,
                "run_in_maintenance" => 1,
                "run_on_one_server" => 0,
                "run_in_background" => 1,
                "status" => 0,
            ],
            [
                "command" => "optimize",
                "parameters" => null,
                "expression" => "* * * * *",
                "dont_overlap" => 1,
                "run_in_maintenance" => 1,
                "run_on_one_server" => 0,
                "run_in_background" => 1,
                "status" => 0,
            ],
            [
                "command" => "optimize:clear",
                "parameters" => null,
                "expression" => "* * * * *",
                "dont_overlap" => 1,
                "run_in_maintenance" => 1,
                "run_on_one_server" => 0,
                "run_in_background" => 1,
                "status" => 0,
            ],
            [
                "command" => "queue:restart",
                "parameters" => null,
                "expression" => "* * * * *",
                "dont_overlap" => 1,
                "run_in_maintenance" => 1,
                "run_on_one_server" => 0,
                "run_in_background" => 1,
                "status" => 0,
            ],
            [
                "command" => "queue:retry",
                "parameters" => null,
                "expression" => "* * * * *",
                "dont_overlap" => 1,
                "run_in_maintenance" => 1,
                "run_on_one_server" => 0,
                "run_in_background" => 1,
                "status" => 0,
            ],
        ]);
    }
}
