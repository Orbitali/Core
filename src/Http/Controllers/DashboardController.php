<?php

namespace Orbitali\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    private $floatingKeys = ["", "K", "M"];

    public function index()
    {
        $time = now("utc")
            ->addDays(-30)
            ->format("Y-m-d");
        $query = DB::select(
            "SELECT
        COUNT(*) as `view`,
        JSON_UNQUOTE(JSON_EXTRACT(headers, '$.opanel-track[0]')) AS `session`,
        DATE(from_unixtime(`time`)) AS `date`
    FROM
        `laravel`.`clockwork`
    WHERE
        `method` = 'GET'
        /*AND controller IS NOT NULL*/
        AND DATE(from_unixtime(`time`)) > " .
                $time .
                "
        AND JSON_SEARCH(middleware,'all','can:panel.dashboard.view') IS NULL
    GROUP BY
        `date`,
        `session`
    ORDER BY
        `date` DESC;"
        );
        $result = collect($query);
        $pageViews = $result->sum("view");
        $visitors = $result->count("session");

        $part = (int) log($pageViews, 1000);
        if ($part > 0) {
            $pageViews = $pageViews / pow(1000, $part);
            $pageViews =
                number_format($pageViews, 2) . $this->floatingKeys[$part];
        }
        return view(
            "Orbitali::dashboard.index",
            compact("pageViews", "visitors")
        );
    }
}
