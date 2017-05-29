<?php
namespace App\Models\Captura;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Sheet extends Model
{
    use SoftDeletes, Notifiable;
    protected $table = 'exc_sheets';
    protected $fillable = array(
      0 => 'number',
      1 => 'name',
      2 => 'rows',
      3 => 'cols',
      4 => 'to_load',
      5 => 'load_order',
      6 => 'process',
      7 => 'capture_id',
    );
    protected $attributes = array(
      'number' => null,
      'name' => null,
      'rows' => null,
      'cols' => null,
      'to_load' => null,
      'load_order' => null,
      'process' => null,
    );
    protected $casts = array(
      'number' => 'string',
      'name' => 'string',
      'rows' => 'string',
      'cols' => 'string',
      'to_load' => 'string',
      'load_order' => 'integer',
      'process' => 'string',
    );
    protected $events = array(
    );
    public function capture()
    {
        return $this->belongsTo('App\Models\Captura\Capture');
    }


    public function details()
    {
        return $this->hasMany('App\Models\Captura\Detail');
    }


    public function import(\App\Xls2Csv2Db $import, $tmpTable, &$targetCols)
    {
        $sheet = (object) [
                            "number" => $this->number,
                            "source" => $this->capture->file['path'],
                            "file" => realpath(storage_path('/app')).'/public/'.
                                basename($this->capture->file['path']).'.'.$this->number.'.csv',
                            "table_name" => uniqid('tmp_'),
                            "columns" => [],
                        ];
        foreach ($this->details()->orderBy('id')->get() as $detail) {
            $sheet->columns[]=$detail->name;
        }
        $fillMergedCells = strpos(','.$this->process, ',descombinar,')!==false;
        $ignoreEmptyRows = strpos(','.$this->process, ',ignorar filas vacias,')!==false;
        $sql = $import->importSheet($sheet, \DB::connection("datos"), $fillMergedCells, $ignoreEmptyRows);

        $tmpDimensions = uniqid('tpm_');
        $sql.= "CREATE TABLE $tmpDimensions ( \"id\" integer NOT NULL );\n";

        $tmpVariables = uniqid('tpm_');
        $sql.= "CREATE TABLE $tmpVariables ( \"id\" integer NOT NULL );\n";
                        
        foreach ($this->details as $detail) {
            $sql.=$detail->import($sheet, $tmpTable, $tmpDimensions, $tmpVariables, $targetCols);
        }
                        /*$columns = \DB::connection("datos")->getSchemaBuilder()->getColumnListing("valores_produccion");
                        $vpc=[];
                        foreach($columns as $c) {
                            if($c!='id_valor') {
                                $vpc[]=$c;
                            }
                        }*/
                        $sql.= "update $tmpTable set defecto_valor_cargado=valor_cargado;\n";
                        /*$sql.= "insert into valores_produccion(".implode(',',$vpc).") select ".implode(',',$vpc)." from $tmpTable;\n";*/
                        $sql.= "insert into dimension_variable(dimension_id, variable_id) select distinct $tmpDimensions.id, $tmpVariables.id from $tmpDimensions, $tmpVariables;\n";
        $sql.= "drop table ".$sheet->table_name.";\n";
                        //$sql.= "drop table $tmpTable;\n";
                        $sql.= "drop table $tmpDimensions;\n";
        $sql.= "drop table $tmpVariables;\n";
        return $sql;
    }
}
