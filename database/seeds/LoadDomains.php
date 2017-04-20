<?php

use Illuminate\Database\Seeder;
use App\Models\ReportsFolders\Variable;
use App\Models\ReportsFolders\Dimension;
use App\Models\ReportsFolders\Domain;
use App\Models\ReportsFolders\Family;

class LoadDomains extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* @var Variable $variable */
        /* @var Dimension $dimension */
        /* @var Family $family */

        $table = 'valores_produccion';
        Family::query()->truncate();
        Domain::query()->truncate();
        Dimension::query()->truncate();
        Variable::query()->truncate();
        DB::connection()->select(
            DB::raw(
                'TRUNCATE TABLE dimension_variable'
            ), []
        );

        $sql = "select
            variables_estadisticas.nombre_variable_estadistica,
            atributo_tabla_origen,
            nombre_dimension,
            tipo_dimension,
            variables_estadisticas.desc_variable_estadistica,
            variables_estadisticas.id_variable_estadistica
        from 
        variables_estadisticas_dimensiones 
        left join variables_estadisticas on (variables_estadisticas_dimensiones.id_variable_estadistica=variables_estadisticas.id_variable_estadistica)";
        $variableList = DB::connection("datos")->select(
            DB::raw(
                $sql
            ), []
        );
        $variables = [];
        $dimensions = [];
        $families = [];
        foreach ($variableList as $line) {
            $data = [
                $line->nombre_variable_estadistica,
                $line->atributo_tabla_origen,
                $line->nombre_dimension,
                $line->tipo_dimension,
                $line->desc_variable_estadistica,
                $line->id_variable_estadistica,
            ];
            if (!isset($variables[$data[0]])) {
                $variables[$data[0]] = Variable::firstOrNew([
                    "id" => $data[5],
                ]);
                if (!$variables[$data[0]]->exists) {
                    $variables[$data[0]]->name = $data[0];
                    $variables[$data[0]]->description = $data[4];
                    $variables[$data[0]]->save();
                }
            }
            if (!isset($dimensions[$data[1] . ';' . $data[2]])) {
                $dimensions[$data[1] . ';' . $data[2]] = Dimension::firstOrNew([
                    "name" => $data[2],
                    "column" => $data[1],
                ]);
                if (!$dimensions[$data[1] . ';' . $data[2]]->exists) {
                    $dimensions[$data[1] . ';' . $data[2]]->save();
                }
            }
            if (!isset($families[$data[3]])) {
                $families[$data[3]] = Domain::firstOrNew([
                    "name" => $data[3],
                ]);
                if (!$families[$data[3]]->exists) {
                    $families[$data[3]]->save();
                }
            }
            $variable = $variables[$data[0]];
            $dimension = $dimensions[$data[1] . ';' . $data[2]];
            $family = $families[$data[3]];
            $variable->dimensions()->attach($dimension);
            $dimension->family()->associate($family);
            $dimension->save();
        }

        foreach (Dimension::all() as $dimension) {
            $column = $dimension->column;
            $sql = "select distinct $column as value from $table";
            $sqlParams = [];
            $results = DB::connection("datos")->select(
                DB::raw(
                    $sql
                ), $sqlParams
            );
            dump($column);
            foreach ($results as $res) {
                if( !empty($res->value) && !is_numeric($res->value) ) {
                    echo '    ';dump($res->value);
                    $domain = Domain::create([
                        'name' => $res->value
                    ]);
                    $dimension->domains()->save($domain);
                }
            }
        }
    }
}

