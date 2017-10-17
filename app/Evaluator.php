<?php

namespace App;

use App\Models\UserAdministration\Empresa;
use App\Models\UserAdministration\EstadoFinanciero;
use DB;
use Blade;

/**
 * Description of Evaluator
 *
 * @author davidcallizaya
 */
class Evaluator
{
    //From CSV/XLS
    const THOUSAND_SEPARATOR = ',';
    const DECIMAL_SEPARATOR = '.';

    private $tablas = [];

    public function __construct($empresaId, $gestion)
    {
        /* @var $ef EstadoFinanciero */
        $estados_financieros = EstadoFinanciero
            ::where('gestion', '=', $gestion)
            ->where('empresa_id', '=', $empresaId)
            ->get();
        foreach ($estados_financieros as $ef) {
            foreach ($ef->tablas as $tabla) {
                $this->tablas[] = $tabla;
            }
        }
    }

    public function calculate($html)
    {
        $html = str_replace(
            ['&#39;','&quot;','&gt;','&lt;'],
            ["'",'"','>','<'],
            $html
        );
        $args = [
            /**
             * Valor de la (U)ltima (C)olumna con código $codigo
             */
            'uc' => function ($codigo) {
                foreach ($this->tablas as $t) {
                    foreach ($t['columns'] as $col) {
                        $query = DB::table($t['table_name']);
                        $query->where($col, $codigo);
                        $row = $query->first();
                        if ($row) {
                            $cols = (array) $row;
                            unset($cols['id']);
                            $cols = array_reverse($cols);
                            foreach ($cols as $col => $val) {
                                $num = $this->toNumber($val);
                                if ($num !== '') {
                                    return $num;
                                }
                            }
                        }
                    }
                }
            },
            'format' => function ($value) {
                return is_numeric($value) ? number_format($value, 2, '.', ',') : $value;
            }
        ];
        return $this->bladeCompile($html, $args);
    }

    private function toNumber($value)
    {
        $value = trim($value);
        $negative = substr($value, 0, 1) === '(' && substr($value, -1, 1) === ')';
        $value = $negative ? trim(substr($value, 1, -1)) : $value;
        if ($value === '') return '';
        $value = str_replace(self::THOUSAND_SEPARATOR, '', $value);
        $value = str_replace(self::DECIMAL_SEPARATOR, '.', $value);
        return is_numeric($value) ? ($negative ? -abs($value * 1) : $value * 1) : '';
    }

    private function bladeCompile($value, array $args = array())
    {
        Blade::setEchoFormat('e($format(utf8_encode(%s)))');
        $generated = Blade::compileString($value);

        ob_start() and extract($args, EXTR_SKIP);

        // We'll include the view contents for parsing within a catcher
        // so we can avoid any WSOD errors. If an exception occurs we
        // will throw it out to the exception handler.
        try {
            eval('?'.'>' . $generated);
            //echo htmlentities($generated);
        }

        // If we caught an exception, we'll silently flush the output
        // buffer so that no partially rendered views get thrown out
        // to the client and confuse the user with junk.
        catch (\Exception $e) {
            ob_get_clean();
            throw $e;
        }

        $content = ob_get_clean();

        return $content;
    }
}
