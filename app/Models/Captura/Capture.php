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
    );
    protected $attributes = array(
      'name' => null,
      'part_of' => null,
      'file' => null,
    );
    protected $casts = array(
      'name' => 'string',
      'part_of' => 'string',
      'file' => 'array',
    );
    protected $events = array(
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
        $tmpTable = uniqid('tpm_');
        $sql.= "CREATE TABLE $tmpTable ( like valores_produccion );\n";
        $sql.= 'ALTER TABLE "'.$tmpTable.'" ADD CONSTRAINT "'.$tmpTable.'_id_valor_index" UNIQUE ("id_valor");'."\n";
        foreach ($this->sheets()->orderBy('load_order')->get() as $sheet) {
            if ($sheet->to_load!='si') {
                continue;
            }
            $sql.=$sheet->import($import, $tmpTable);
        }
        $sql.= "COMMIT;\n";
        $tmpFile = uniqid('tmp_').'.sql';
        \Storage::disk('local')->put($tmpFile, $sql);
    }
}
