<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

/**
 * Description of ReporteFinalHRController
 *
 * @author David Callizaya <davidcallizaya@gmail.com>
 */
class ReporteFinalHRController
{

    private function getReporteQueryMultiple(array $usuarios)
    {
        $sql = '';
        foreach ($usuarios as $usuario) {
            $sql .= $sql ? "union\n" : '';
            $sql .= $this->getReporteQuery($usuario);
        }
        return $sql;
    }

    private function getReporteQuery($nombre)
    {
        $sql = file_get_contents(__DIR__ . '/reporteHR.sql');
        $sql = str_replace('Edgar Andrade', $nombre, $sql);
        $sql = str_replace('%Edgar%Andrade%',
            '%' . preg_replace('/\s+/', '%', trim($nombre)) . '%', $sql);
        return $sql;
    }

    public function index()
    {
        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment; filename=consolidado.xls");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);

        $usuarios = [
            'Delfín Ponce',
            'Sonia Velasquez',
            'Andrés Ortega',
            'Elena mallon',
            'Wilder Herrera',
            'Angela Choque',
            'Daniel Zapana',
            'Maritza Torrez',
            'Melissa Vargas',
            'Eddy Márquez',
            'Edgar Andrade',
        ];

        $sql = $this->getReporteQueryMultiple($usuarios);
        $connection = DB::connection('hr');

        $connection->select("SET lc_time_names = 'es_ES';");
        $first = true;
        echo '<table>', "\n";
        foreach ($connection->select($sql) as $row) {
            $row = (array) $row;
            if ($first) {
                $first = false;
                echo '<tr><th>', implode('</th><th>', array_keys($row)), '</th></tr>', "\n";
            }
            echo '<tr><td>', implode('</td><td>', $row), '</td></tr>', "\n";
        }
        echo '</table>', "\n";
    }
}
