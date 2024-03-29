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
        $expression = "* * * * *";
        DB::table("tasks")->insert([
            [
                "command" => "inspire",
                "parameters" => null,
                "expression" => $expression,
                "dont_overlap" => 1,
                "run_in_maintenance" => 1,
                "run_on_one_server" => 1,
                "run_in_background" => 1,
                "status" => 0,
            ],
            [
                "command" => "orbitali:backup",
                "parameters" => null,
                "expression" => $expression,
                "dont_overlap" => 1,
                "run_in_maintenance" => 1,
                "run_on_one_server" => 0,
                "run_in_background" => 1,
                "status" => 0,
            ],
            [
                "command" => "orbitali:remove-unused-files",
                "parameters" => null,
                "expression" => $expression,
                "dont_overlap" => 1,
                "run_in_maintenance" => 1,
                "run_on_one_server" => 0,
                "run_in_background" => 1,
                "status" => 0,
            ],
            [
                "command" => "orbitali:clock-work-cleanup",
                "parameters" => null,
                "expression" => "0 0 * * *",
                "dont_overlap" => 1,
                "run_in_maintenance" => 1,
                "run_on_one_server" => 0,
                "run_in_background" => 1,
                "status" => 1,
            ],
            [
                "command" => "cache:clear",
                "parameters" => null,
                "expression" => $expression,
                "dont_overlap" => 1,
                "run_in_maintenance" => 1,
                "run_on_one_server" => 0,
                "run_in_background" => 1,
                "status" => 0,
            ],
            [
                "command" => "clockwork:clean",
                "parameters" => null,
                "expression" => $expression,
                "dont_overlap" => 1,
                "run_in_maintenance" => 1,
                "run_on_one_server" => 0,
                "run_in_background" => 1,
                "status" => 0,
            ],
            [
                "command" => "config:cache",
                "parameters" => null,
                "expression" => $expression,
                "dont_overlap" => 1,
                "run_in_maintenance" => 1,
                "run_on_one_server" => 0,
                "run_in_background" => 1,
                "status" => 0,
            ],
            [
                "command" => "config:clear",
                "parameters" => null,
                "expression" => $expression,
                "dont_overlap" => 1,
                "run_in_maintenance" => 1,
                "run_on_one_server" => 0,
                "run_in_background" => 1,
                "status" => 0,
            ],
            [
                "command" => "migrate:status",
                "parameters" => null,
                "expression" => $expression,
                "dont_overlap" => 1,
                "run_in_maintenance" => 1,
                "run_on_one_server" => 0,
                "run_in_background" => 1,
                "status" => 0,
            ],
            [
                "command" => "migrate:install",
                "parameters" => null,
                "expression" => $expression,
                "dont_overlap" => 1,
                "run_in_maintenance" => 1,
                "run_on_one_server" => 0,
                "run_in_background" => 1,
                "status" => 0,
            ],
            [
                "command" => "optimize",
                "parameters" => null,
                "expression" => $expression,
                "dont_overlap" => 1,
                "run_in_maintenance" => 1,
                "run_on_one_server" => 0,
                "run_in_background" => 1,
                "status" => 0,
            ],
            [
                "command" => "optimize:clear",
                "parameters" => null,
                "expression" => $expression,
                "dont_overlap" => 1,
                "run_in_maintenance" => 1,
                "run_on_one_server" => 0,
                "run_in_background" => 1,
                "status" => 0,
            ],
            [
                "command" => "queue:restart",
                "parameters" => null,
                "expression" => $expression,
                "dont_overlap" => 1,
                "run_in_maintenance" => 1,
                "run_on_one_server" => 0,
                "run_in_background" => 1,
                "status" => 0,
            ],
            [
                "command" => "queue:retry",
                "parameters" => null,
                "expression" => $expression,
                "dont_overlap" => 1,
                "run_in_maintenance" => 1,
                "run_on_one_server" => 0,
                "run_in_background" => 1,
                "status" => 0,
            ],
        ]);
    }
}
