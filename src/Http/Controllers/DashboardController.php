<?php

namespace Orbitali\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    private $floatingKeys = ["", "K", "M"];

    public function index(Request $request)
    {
        $user = auth()->user();
        $user->dashboard_range = $request->get("range", $user->dashboard_range);
        $user->push();
        $range = $user->dashboard_range;
        $data = Cache::remember('orbitali.cache.dashboard_statistics_'.$range, 60*30, function () use ($request) {
            [$minTime, $maxTime, $selector] = $this->getRange($request);
            $listRange = $this->listRange();
            $table = config("clockwork.storage_sql_table");
            $query = DB::table($table)
                ->selectRaw(
                    "COUNT(*) as `view`, JSON_UNQUOTE(JSON_EXTRACT(headers, '$.opanel-track[0]')) AS `session`, DATE(from_unixtime(`time`)) AS `date`"
                )
                ->where("type", "request")
                ->whereRaw(
                    "`time` BETWEEN ? AND ?",
                    compact("minTime", "maxTime")
                )
                ->whereRaw(
                    "JSON_SEARCH(middleware,'all','can:panel.dashboard.view') IS NULL"
                )
                ->groupBy("date", "session")
                ->orderBy("date", "DESC");

            $result = $query->get();
            $pageViews = $result->sum("view");
            $visitors = $result->count("session");

            $part = (int) log($pageViews, 1000);
            if ($part > 0) {
                $pageViews = $pageViews / pow(1000, $part);
                $pageViews =
                    number_format($pageViews, 2) . $this->floatingKeys[$part];
            }
            return $data = compact("pageViews", "visitors", "selector", "listRange");
        });


        return view("Orbitali::dashboard.index",$data);
    }

    private function listRange()
    {
        return [
            "last30D" => "Last 30 days",
            "thisWeek" => "This Week",
            "prevWeek" => "Previous Week",
            "thisMonth" => "This Month",
            "prevMonth" => "Previous Month",
        ];
    }

    private function getRange(Request $request)
    {
        $user = auth()->user();
        $user->dashboard_range = $request->get("range", $user->dashboard_range);
        $user->push();
        switch ($user->dashboard_range) {
            case "thisWeek":
                //This Week
                return [
                    now("utc")
                        ->startOfWeek()
                        ->timestamp,
                    now("utc")->timestamp,
                    "thisWeek",
                ];

            case "prevWeek":
                //Previous Week
                return [
                    now("utc")
                        ->startOfWeek()
                        ->addDays(-7)
                        ->timestamp,
                    now("utc")
                        ->endOfWeek()
                        ->addDays(-7)
                        ->timestamp,
                    "prevWeek",
                ];

            case "thisMonth":
                //This Month
                return [
                    now("utc")
                        ->firstOfMonth()
                        ->timestamp,
                    now("utc")->timestamp,
                    "thisMonth",
                ];

            case "prevMonth":
                //Previous Month
                return [
                    now("utc")
                        ->firstOfMonth()
                        ->addMonths(-1)
                        ->timestamp,
                    now("utc")
                        ->firstOfMonth()
                        ->addDays(-1)
                        ->timestamp,
                    "prevMonth",
                ];

            case "last30D":
            default:
                //Last 30 Day
                return [
                    now("utc")
                        ->addDays(-30)
                        ->timestamp,
                    now("utc")->timestamp,
                    "last30D",
                ];
        }
    }
}
