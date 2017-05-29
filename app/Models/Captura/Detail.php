<?php
namespace App\Models\Captura;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Detail extends Model
{
    use SoftDeletes, Notifiable;
    protected $table = 'exc_details';
    protected $fillable = array(
      0 => 'name',
      1 => 'type',
      2 => 'dimension_name',
      3 => 'capture',
      4 => 'default_value',
      5 => 'copia_inicio_fila',
      6 => 'copia_inicio_columna',
      7 => 'copia_fin_fila',
      8 => 'copia_fin_columna',
      9 => 'incremento_secuencia',
      10 => 'direccion_incremento',
      11 => 'pegado_inicio_fila',
      12 => 'repetir_pegado',
      13 => 'sheet_id',
      14 => 'dimension_id',
    );
    protected $attributes = array(
      'name' => null,
      'type' => 'Dimension/Columna',
      'dimension_name' => null,
      'capture' => 'Sin captura',
      'default_value' => null,
      'copia_inicio_fila' => null,
      'copia_inicio_columna' => null,
      'copia_fin_fila' => null,
      'copia_fin_columna' => null,
      'incremento_secuencia' => '1',
      'direccion_incremento' => 'columna',
      'pegado_inicio_fila' => null,
      'repetir_pegado' => '1',
    );
    protected $casts = array(
      'name' => 'string',
      'type' => 'string',
      'dimension_name' => 'string',
      'capture' => 'string',
      'default_value' => 'string',
      'copia_inicio_fila' => 'string',
      'copia_inicio_columna' => 'string',
      'copia_fin_fila' => 'string',
      'copia_fin_columna' => 'string',
      'incremento_secuencia' => 'string',
      'direccion_incremento' => 'string',
      'pegado_inicio_fila' => 'string',
      'repetir_pegado' => 'integer',
    );
    protected $events = array(
    );
    public function sheet()
    {
        return $this->belongsTo('App\Models\Captura\Sheet');
    }


    public function dimension()
    {
        return $this->belongsTo('App\Models\ReportsFolders\Dimension');
    }


    public function import($sheet, $tmpTable, $tmpDimensions, $tmpVariables, &$targetCols)
    {
        $sql = '';
        $pegado_inicio_fila = $this->pegado_inicio_fila;
                        //for($rep=0;$rep<$this->repetir_pegado;$rep++) {
                            if ($this->capture==='Sin captura') {
                                return '';
                            }
        if ($this->direccion_incremento==='columna') {
            if ($this->type=='variable') {
                $targetCol = 'id_variable';
                $sourceColCasted = $targetCol;
            } else {
                if (empty($this->dimension)) {
                    return '';
                }
                $targetCol = $this->dimension->column;
            }
            for ($c=$this->copia_inicio_columna;$c<=$this->copia_fin_columna;$c+=$this->incremento_secuencia) {
                for ($rep=0;$rep<$this->repetir_pegado;$rep++) {
                    $sourceCol = 'Columna_'.\App\Xls2Csv2Db::columnName($c-1);
                    $copia_inicio_fila = $this->copia_inicio_fila;
                    $copia_fin_fila = $this->copia_fin_fila;
                    if ($this->type=='variable' && $rep===0) {
                        $sql.= 'insert into be_variables(name) select distinct '.$sheet->table_name.'."'.$sourceCol.'" from '.$sheet->table_name.' where id>='.$copia_inicio_fila.' and id<='.$copia_fin_fila.' and '.$sheet->table_name.'."'.$sourceCol.'" not in (select name from be_variables);'."\n";
                    }
                    if ($this->type=='variable') {
                        $sourceCol = "(select be_variables.id from be_variables where be_variables.name=".$sheet->table_name.".\"$sourceCol\")";
                    }
                    if ($this->capture==='Capturar de hoja') {
                        if (empty($this->dimension)) {
                            $sourceColCasted = $sourceCol;
                        } else {
                            $sourceColCasted = $this->dimension->numeric=='si'? 'cast(replace("'.$sourceCol.'", \',\', \'\') as numeric)' : '"'.$sourceCol.'"';
                        }
                    } elseif ($this->capture==='Por defecto') {
                        if (empty($this->dimension)) {
                            $sourceColCasted = $this->default_value;
                        } else {
                            $sourceColCasted = $this->dimension->numeric=='si'? $this->default_value * 1 : "'".str_replace("'", "\\'", $this->default_value)."'";
                        }
                    }
                    $targetCols[$targetCol]=$targetCol;
                                    //$sql.= "insert into $tmpTable(id_valor,$targetCol) select $pegado_inicio_fila+id-$copia_inicio_fila, $sourceColCasted from ".$sheet->table_name." where id>=$copia_inicio_fila and id<=$copia_fin_fila ON CONFLICT(id_valor) DO UPDATE SET $targetCol=excluded.$targetCol;\n";
                                    $sql.= "insert into $tmpTable(id_valor) select $pegado_inicio_fila+id-$copia_inicio_fila from ".$sheet->table_name." where id>=$copia_inicio_fila and id<=$copia_fin_fila and $pegado_inicio_fila+id-$copia_inicio_fila not in (select id_valor from $tmpTable);\n";
                    $sql.= "update $tmpTable set $targetCol = $sourceColCasted from ".$sheet->table_name." where id>=$copia_inicio_fila and id<=$copia_fin_fila and id_valor=$pegado_inicio_fila+id-$copia_inicio_fila;\n";
                    $pegado_inicio_fila+=$this->copia_fin_fila - $this->copia_inicio_fila + 1;
                                    //$pegado_inicio_fila+=$this->pegado_salto;
                }
            }
        } else {
            if ($this->type=='variable') {
                $targetCol = 'id_variable';
                $sourceColCasted = $targetCol;
            } else {
                if (empty($this->dimension)) {
                    return '';
                }
                $targetCol = $this->dimension->column;
            }
            for ($fila=$this->copia_inicio_fila;$fila<=$this->copia_fin_fila;$fila+=$this->incremento_secuencia) {
                for ($c=$this->copia_inicio_columna;$c<=$this->copia_fin_columna;$c+=$this->incremento_secuencia) {
                    for ($rep=0;$rep<$this->repetir_pegado;$rep++) {
                        $sourceCol = 'Columna_'.\App\Xls2Csv2Db::columnName($c-1);
                        $copia_inicio_fila = $fila;
                        $copia_fin_fila = $fila;
                        if ($this->type=='variable' && $rep===0) {
                            $sql.= 'insert into be_variables(name) select distinct '.$sheet->table_name.'."'.$sourceCol.'" from '.$sheet->table_name.' where id>='.$copia_inicio_fila.' and id<='.$copia_fin_fila.' and '.$sheet->table_name.'."'.$sourceCol.'" not in (select name from be_variables);'."\n";
                        }
                        if ($this->type=='variable') {
                            $sourceCol = "(select be_variables.id from be_variables where be_variables.name=".$sheet->table_name.".\"$sourceCol\")";
                        }
                        if ($this->capture==='Capturar de hoja') {
                            if (empty($this->dimension)) {
                                $sourceColCasted = $sourceCol;
                            } else {
                                $sourceColCasted = $this->dimension->numeric=='si'? 'cast(replace("'.$sourceCol.'", \',\', \'\') as numeric)' : '"'.$sourceCol.'"';
                            }
                        } elseif ($this->capture==='Por defecto') {
                            if (empty($this->dimension)) {
                                $sourceColCasted = $this->default_value;
                            } else {
                                $sourceColCasted = $this->dimension->numeric=='si'? $this->default_value * 1 : "'".str_replace("'", "\\'", $this->default_value)."'";
                            }
                        }
                        $targetCols[$targetCol]=$targetCol;
                                        //$sql.= "insert into $tmpTable(id_valor,$targetCol) select $pegado_inicio_fila+id-$copia_inicio_fila, $sourceColCasted from ".$sheet->table_name." where id>=$copia_inicio_fila and id<=$copia_fin_fila ON CONFLICT(id_valor) DO UPDATE SET $targetCol=excluded.$targetCol;\n";
                                        $sql.= "insert into $tmpTable(id_valor) select $pegado_inicio_fila+id-$copia_inicio_fila from ".$sheet->table_name." where id>=$copia_inicio_fila and id<=$copia_fin_fila and $pegado_inicio_fila+id-$copia_inicio_fila not in (select id_valor from $tmpTable);\n";
                        $sql.= "update $tmpTable set $targetCol = $sourceColCasted from ".$sheet->table_name." where id>=$copia_inicio_fila and id<=$copia_fin_fila and id=$pegado_inicio_fila+id-$copia_inicio_fila;\n";
                        $pegado_inicio_fila+= 1;
                    }
                }
                                    //$pegado_inicio_fila+=$this->pegado_salto;
            }
        }
                        //}
                        $sql.= "insert into $tmpVariables(id) select id_variable from $tmpTable where id_variable is not null;\n";
        if ($this->type==='nueva dimension') {
            $sql.="insert into be_dimensions(\"name\",\"column\") values ('".str_replace("'", "\\'", $this->dimension_name)."','".$this->dimension->column."');\n";
            $sql.="insert into $tmpDimensions(id) values (currval('be_dimensions_id_seq'));\n";
        } elseif ($this->type==='dimension') {
            $sql.="insert into $tmpDimensions(id) values (".$this->dimension->id.");\n";
        }
        return $sql;
    }
}
