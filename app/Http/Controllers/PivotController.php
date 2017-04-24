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
    const SEPARATOR = "\x1b";

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
        $groups = $cols . ($cols && $rows ? "," : "") . $rows;
        $where = "id_variable in ($variables)";
        $sqlParams = array();
        if (!empty($request['filter'])) {
            $filterJ = json_decode($request['filter']);
            $whereFilter = [];
            if (is_array($filterJ)) {
                foreach ($filterJ as $f) {
                    $dimension = Dimension::find($f[0]);
                    if ($dimension) {
                        $f0 = $dimension->column;
                        $whereFilter[] = '(' . $f0 . $f[1] . '?)';
                        $sqlParams[] = $f[2];
                    }
                }
            }
            if (count($whereFilter) > 0) {
                $where .= ' and (' . implode(' or ', $whereFilter) . ')';
            }
        }
        $sql = "SELECT $groups, id_variable, $aggregator($measure) as agg_value_1 from $table where $where group by $groups, id_variable order by $groups, id_variable";
        $results = \DB::connection("datos")->select(
            DB::raw(
                $sql
            ), $sqlParams
        );
        $x = [];
        $series = [];
        foreach ($results as $i => $data) {
            $yi = [];
            foreach (explode(",", $rows) as $row) {
                if (!$row) {
                    continue;
                }
                $yi[] = $data->$row;
            }
            $yLabel = implode(static::SEPARATOR, $yi);
            $xi = [];
            foreach (explode(",", $cols) as $col) {
                if (!$col) {
                    continue;
                }
                $xi[] = $data->$col;
            }
            $xValue = implode(static::SEPARATOR, $xi);
            $x[$xValue] = $xValue;
            foreach (explode(",", $variables) as $var) {
                if ($var == $data->id_variable) {
                    $varModel = Variable::find($data->id_variable);
                    $name = $varModel->name;
                } else {
                    continue;
                }
                $yValue = isset($data->AGG_VALUE_1) ? $data->AGG_VALUE_1 : $data->agg_value_1;
                $series[$yLabel][$name][$xValue] = $yValue;
            }
        }
        foreach ($series as $rowId => $serie0) {
            foreach ($serie0 as $name => $serie) {
                $vals = [];
                foreach ($x as $xValue) {
                    $vals[] = isset($serie[$xValue]) ? $serie[$xValue] : 0;
                }
                $series[$rowId][$name] = $vals;
            }
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
