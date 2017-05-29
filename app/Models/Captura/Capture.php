<?php
namespace App\Models\Captura;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Capture extends Model
{
    use SoftDeletes, Notifiable;
    protected $table = 'exc_captures';
    protected $fillable = array(
      0 => 'name',
      1 => 'part_of',
      2 => 'file',
      3 => 'temporal_table',
      4 => 'imported_columns',
    );
    protected $attributes = array(
      'name' => null,
      'part_of' => null,
      'file' => null,
      'temporal_table' => null,
      'imported_columns' => null,
    );
    protected $casts = array(
      'name' => 'string',
      'part_of' => 'string',
      'file' => 'array',
      'temporal_table' => 'string',
      'imported_columns' => 'array',
    );
    protected $events = array(
      'creating' => 'App\\Events\\Captura\\CaptureCreating',
      'saved' => 'App\\Events\\Captura\\CaptureSaved',
    );
    public function sheets()
    {
        return $this->hasMany('App\Models\Captura\Sheet');
    }


    public function procesar()
    {
        $import = new \App\Xls2Csv2Db;
        $import->originalName = $this->file['name'];
        $import->filename = $this->file['path'];
        $sql = "BEGIN TRANSACTION;\n";
        $sql.= "truncate ".$this->temporal_table.";\n";
        $targetCols = [];
        foreach ($this->sheets()->orderBy('load_order')->get() as $sheet) {
            if ($sheet->to_load!='si') {
                continue;
            }
            $sql.=$sheet->import($import, $this->temporal_table, $targetCols);
        }
        $sql.= "COMMIT;\n";
        $tmpFile = $this->temporal_table.'.sql';
        \Storage::disk('local')->put($tmpFile, $sql);
        $datos = \App\Models\Connections\Connection::where("name", "datos")->first();
        $pdo = \DB::connection("datos")->getPdo();
        $pdo->setAttribute(\PDO::ATTR_EMULATE_PREPARES, 0);
        $pdo->exec($sql);
        $this->imported_columns = array_keys($targetCols);
        $this->save();
        return $this->imported_columns;
    }
                    

    public function preview()
    {
        if (empty($this->temporal_table)) {
            return [];
        }
        $importedColumns = $this->imported_columns;
        $importedColumns[] = \DB::raw('(select name from be_variables where be_variables.id=id_variable) as variable');
        return \DB::connection('datos')
                                ->table($this->temporal_table)
                                ->select($importedColumns)
                                ->get();
    }
                    

    public function importar()
    {
        $columns = \DB::connection("datos")->getSchemaBuilder()->getColumnListing("valores_produccion");
        $vpc=[];
        foreach ($columns as $c) {
            if ($c!='id_valor') {
                $vpc[]=$c;
            }
        }
        $sql = "BEGIN TRANSACTION;\n";
        $sql.= "insert into valores_produccion(".implode(',', $vpc).") select ".implode(',', $vpc)." from ".$this->temporal_table.";\n";
        $sql.= "COMMIT;\n";
        $pdo = \DB::connection("datos")->getPdo();
        $pdo->setAttribute(\PDO::ATTR_EMULATE_PREPARES, 0);
        $pdo->exec($sql);
    }
}
