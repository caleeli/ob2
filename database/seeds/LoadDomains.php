<?php

use Illuminate\Database\Seeder;
use App\Models\ReportsFolders\Dimension;
use App\Models\ReportsFolders\Domain;

class LoadDomains extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* @var Dimension $dimension */
        $table = 'valores_produccion';
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

