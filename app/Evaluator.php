<?php

namespace App;

use App\Models\UserAdministration\Empresa;
use App\Models\UserAdministration\EstadoFinanciero;
use DB;
use Blade;

/**
 * Description of Evaluator
 *
 * @author angela
 */
class Evaluator
{
    //From CSV/XLS
    const THOUSAND_SEPARATOR = ',';
    const DECIMAL_SEPARATOR = '.';

    private $tablas = [];
    private $tablasPre = [];
    private $eeffs = [];
    private $gestion = '';
    private $empresaId = '';

    public function __construct($empresaId, $gestion, $tipos = null)
    {
        /* @var $ef EstadoFinanciero */
        $this->gestion = $gestion;
        $this->empresaId = $empresaId;
        $estados_financieros = EstadoFinanciero
            ::where('gestion', '=', $gestion)
            ->where('empresa_id', '=', $empresaId)
            ->orderBy('updated_at', 'desc');
        if ($tipos) {
            $estados_financieros = $estados_financieros
                ->whereIn('tipo_estado_financiero', $tipos);
        }
        $estados_financieros = $estados_financieros
            ->get();
        foreach ($estados_financieros as $ef) {
            if (empty($ef->tablas) || !is_array($ef->tablas)) {
                continue;
            }
            foreach ($ef->tablas as $tabla) {
                $this->tablas[] = $tabla;
            }
        }
        $estados_financieros_pre = EstadoFinanciero
            ::where('gestion', '=', $gestion-1)
            ->where('empresa_id', '=', $empresaId);
        if ($tipos) {
            $estados_financieros_pre = $estados_financieros_pre
                ->whereIn('tipo_estado_financiero', $tipos);
        }
        $estados_financieros_pre = $estados_financieros_pre
            ->get();
        foreach ($estados_financieros_pre as $ef) {
            if (empty($ef->tablas) || !is_array($ef->tablas)) {
                continue;
            }
            foreach ($ef->tablas as $tabla) {
                $this->tablasPre[] = $tabla;
            }
        }
    }

    private function loadEEFFs($gestion)
    {
        if (!empty($this->eeffs[$gestion])) {
            return $this->eeffs[$gestion];
        }
        $table = [];
        $estados_financieros_pre = EstadoFinanciero
            ::where('gestion', '=', $gestion)
            ->where('empresa_id', '=', $this->empresaId)
            ->get();
        foreach ($estados_financieros_pre as $ef) {
            if (empty($ef->tablas) || !is_array($ef->tablas)) {
                continue;
            }
            foreach ($ef->tablas as $tabla) {
                $table[] = $tabla;
            }
        }
        $this->eeffs[$gestion] = $table;
        return $table;
    }

    private function uc($codigo)
    {
        return $this->getValue($codigo, $this->tablas);
    }

    private function uf($codigo)
    {
        return $this->getValueLastRow($codigo, $this->tablas);
    }

    private function ucp($codigo, $prev)
    {
        if ($prev<-1) {
            return $this->getValue($codigo, $this->loadEEFFs($this->gestion + $prev ));
        } else {
            return $this->getValue($codigo, $this->tablasPre);
        }
    }

    private function uca($codigo)
    {
        return abs($this->uc($codigo));
    }

    private function ucpa($codigo, $prev)
    {
        return abs($this->ucp($codigo, $prev));
    }

    /**
     * Ultima Columna de $codigo.
     *
     * @param type $codigo
     * @param type $from
     * @return int
     */
    private function getValue($codigo, $from)
    {
        foreach ($from as $t) {
            foreach ($t['columns'] as $col) {
                $query = DB::table($t['table_name']);
                $query->where($col, 'like', $codigo);
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
        return 0;
    }

    /**
     * Ultima fila de la columna $codigo.
     *
     * @param type $codigo
     * @param type $from
     * @return int
     */
    private function getValueLastRow($codigo, $from)
    {
        foreach ($from as $t) {
            foreach ($t['columns'] as $col) {
                $query = DB::table($t['table_name']);
                $query->where($col, 'like', $codigo);
                $row = $query->first();
                if ($row) {
                    $rows = DB::table($t['table_name'])->select($col)
                        ->where('id','>',$row->id)->orderBy('id', 'desc')->get()->toArray();
                    foreach ($rows as $rowVal) {
                        $val = $rowVal->$col;
                        $num = $this->toNumber($val);
                        if ($num !== '') {
                            return $num;
                        }
                    }
                }
            }
        }
        return 0;
    }

    public function calculate($html, $formatFn=false)
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
                return $this->uc($codigo);
            },
            /**
             * Valor de la (U)ltima (C)olumna con código $codigo
             */
            'ucp' => function ($codigo, $prev=-1) {
                return $this->ucp($codigo, $prev);
            },
            /**
             * Valor de la (U)ltima (C)olumna con código $codigo
             */
            'uca' => function ($codigo) {
                return $this->uca($codigo);
            },
            /**
             * Valor de la (U)ltima (C)olumna con código $codigo
             */
            'ucpa' => function ($codigo, $prev=-1) {
                return $this->ucpa($codigo, $prev);
            },
            /**
             * Valor de la (U)ltima (F)ila con cabecera $codigo
             */
            'uf' => function ($codigo) {
                return $this->uf($codigo);
            },
            'format' => function ($value) {
                return is_numeric($value) ? number_format($value, 2, '.', ',') : $value;
            },
            'gestion' => $this->gestion,
        ];
        if ($formatFn && !is_callable($formatFn)) {
            $args['format'] = function ($value) {
                return $value;
            };
        } elseif ($formatFn && is_callable($formatFn)) {
            $args['format'] = $formatFn;
        }
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
            //ob_get_clean();
            //throw $e;
            echo $e->getMessage();
        } catch(\Symfony\Component\Debug\Exception\FatalErrorException $e) {
            echo $e->getMessage();
        }

        $content = ob_get_clean();

        return $content;
    }
}
