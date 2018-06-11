<?php

namespace App;

use App\Models\UserAdministration\HojaTrabajo;
use App\Models\UserAdministration\Tarea;
use DB;

/**
 * Convierte un documento google docs en una pagina dinamica con vuejs
 *
 * @author davidcallizaya
 */
class GTemplate
{
    const SHORT_CUTS = [
        '✔/✕' => '[check*=check(✔|✕|N/A)]',
        '&#10004;/&#10005;' => '[check*=check(✔|✕|N/A)]',
        '[texto()]' => '[texto*=texto()]',
    ];
    const REGEXP_VARIABLE = '/\[([\w\*]+)=(\w+)\s*\(([^\]]*)\)\]/';

    private $rawContent = '';

    private $listas = [];

    public function __construct(GDrive $gdrive, $fileId)
    {
        $this->rawContent = $gdrive->getContent($fileId);
    }

    public function parseVariables(array $valores = [])
    {
        $multiples = [];
        $variables = [];
        $html = str_replace(array_keys(self::SHORT_CUTS), array_values(self::SHORT_CUTS), $this->rawContent);
        $html = preg_replace_callback(self::REGEXP_VARIABLE,
                                      function ($match) use($valores, &$variables, &$multiples) {
            $varName = $match[1];
            if (substr($varName, -1) === '*') {
                $varName = substr($varName, 0, -1);
                $multiples[$varName] = isset($multiples[$varName]) ? $multiples[$varName] + 1 : 1;
                $varName = $varName . $multiples[$varName];
            }
            $variables[$varName] = isset($valores[$varName]) ? $valores[$varName] : '';
            $params = $match[3];
            if ($params && strpos($params, '|')!==false) {
                $params = htmlentities(json_encode(explode('|', $params)), ENT_QUOTES);
            }
            return "<{$match[2]} v-model='{$varName}' ".
                ($params ? "v-bind:data=\"{$params}\"" : "")
                . "></{$match[2]}>";
        }, $html);
        $html .= '<script>var variables = ' . json_encode($variables) . ';parent && parent.app && parent.app.variablesCargadas ? parent.app.variablesCargadas(variables):null;</script>';
        return $html;
    }

    public function parseValores(array $valores = [])
    {
        $multiples = [];
        $variables = [];
        $html = str_replace(array_keys(self::SHORT_CUTS), array_values(self::SHORT_CUTS), $this->rawContent);
        $html = preg_replace_callback(self::REGEXP_VARIABLE,
                                      function ($match) use($valores, &$variables, &$multiples) {
            $varName = $match[1];
            if (substr($varName, -1) === '*') {
                $varName = substr($varName, 0, -1);
                $multiples[$varName] = isset($multiples[$varName]) ? $multiples[$varName] + 1 : 1;
                $varName = $varName . $multiples[$varName];
            }
            $variables[$varName] = isset($valores[$varName]) ? $valores[$varName] : '';
            $params = $match[3];
            if ($params && strpos($params, '|')!==false) {
                $params = htmlentities(json_encode(explode('|', $params)), ENT_QUOTES);
            }
            $valor = $variables[$varName];
            if ($match[2] === 'lista') {
                $lista = $this->loadLista($match[3]);
                $valor = $lista[$valor];
            }
            if ($match[2] === 'enlace') {
                $enlace = json_decode($match[3]);
                $valor = $enlace['texto'];
            }
            return $valor;
        }, $html);
        return $html;
    }

    private function loadLista($name)
    {
        if (isset($this->listas[$name])) {
            return $this->listas[$name];
        }
        if ($name==='empresas') {
            $this->listas[$name] = [];
            foreach (DB::select('select id, nombre_empresa from adm_empresas') as $row) {
                $this->listas[$name][$row->id * 1] = $row->nombre_empresa;
            }
            return $this->listas[$name];
        }
    }

    /**
     * Parse hoja de trabajo
     *
     * @param HojaTrabajo $hojaTrabajo
     * @return type
     */
    public function parse(HojaTrabajo $hojaTrabajo = null)
    {
        return $this->parseVariables($hojaTrabajo ? $hojaTrabajo->valores : []);
    }
}
