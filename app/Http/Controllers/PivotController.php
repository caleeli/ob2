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
use App\Models\ReportsFolders\Dimension;
use App\Models\ReportsFolders\Variable;

class PivotController extends Controller
{

    /**
     * /api/users?page=2&filter[]=where,username,=,david&fields=username,firstname
     */
    public function index(Request $request, $table, $aggregator, $measure,
                          $rows, $cols, $variables)
    {
        if ($rows === 'null') {
            $rows = '';
        }
        if ($cols === 'null') {
            $cols = '';
        }
        $dim = Dimension::all();
        $rows = $this->convertToColumns(trim($rows), $dim);
        $cols = $this->convertToColumns(trim($cols), $dim);
        $groups = $cols.($cols && $rows ? "," : "").$rows;
        $where = "id_variable in ($variables)";
        $sql = "SELECT $groups, id_variable, $aggregator($measure) as agg_value_1 from $table where $where group by $groups, id_variable order by $groups, id_variable";
        $results = \DB::connection("datos")->select(
            DB::raw(
                $sql
            ), array()
        );
        $x = [];
        $series = [];
        foreach ($results as $i => $data) {
            $xi = [];
            foreach (explode(",", $groups) as $col) {
                if (!$col) {
                    continue;
                }
                $xi[] = $data->$col;
            }
            $xValue = implode('-', $xi);
            $x[$xValue] = $xValue;
            foreach (explode(",", $variables) as $var) {
                if ($var == $data->id_variable) {
                    $varModel = Variable::find($data->id_variable);
                    $name = $varModel->name;
                } else {
                    continue;
                }
                $yValue = isset($data->AGG_VALUE_1) ? $data->AGG_VALUE_1 : $data->agg_value_1;
                $series[$name][$xValue] = $yValue;
            }
        }
        foreach($series as $name => $serie) {
            $vals = [];
            foreach($x as $xValue) {
                $vals[] = isset($serie[$xValue]) ? $serie[$xValue] : 0;
            }
            $series[$name] = $vals;
        }
        return response()->json(['sql' => $sql, 'x' => array_values($x), 'series' => $series]);
    }

    private function convertToColumns($groups0, $dim)
    {
        $groups1 = [];
        foreach (explode(',', $groups0) as $c) {
            foreach ($dim as $d) {
                if ($d->id == $c) {
                    $groups1[] = $d->column;
                    break;
                }
            }
        }
        return implode(',', $groups1);
    }
}
