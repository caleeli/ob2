<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Exceptions\InvalidApiCall;
use App\Exceptions\NotFoundException;
use Illuminate\Database\Eloquent\Builder;
use ReflectionMethod;
use DB;

class PivotController extends Controller
{

    /**
     * /api/users?page=2&filter[]=where,username,=,david&fields=username,firstname
     */
    public function index(Request $request, $table, $aggregator, $measure,
                          $rows, $cols)
    {
        if ($rows === 'null') {
            $rows = '';
        }
        if ($cols === 'null') {
            $cols = '';
        }
        $rows = trim($rows);
        $cols = trim($cols);
        $groups = ($rows ? "$rows," : "").($cols ? "$cols" : "");
        $sql = "SELECT $groups, $aggregator($measure) AGG_VALUE_1 from $table group by $groups";
        $results = DB::select(
                DB::raw(
                    $sql
                ), array()
        );
        $x = [];
        $series = [];
        foreach ($results as $i => $data) {
            $xi = [];
            foreach (explode(",", $cols) as $col) {
                $xi[] = $data->$col;
            }
            $x[] = implode('-', $xi);
            foreach (explode(",", $rows) as $row) {
                $name = "$measure($row)";
                $series[$name][] = $data->AGG_VALUE_1; //['x'=>implode('-', $xi), 'y'=>$data->AGG_VALUE_1];
            }
        }
        return response()->json(['sql' => $sql, 'x' => $x, 'series' => $series]);
    }
}
