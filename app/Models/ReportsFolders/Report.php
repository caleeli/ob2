<?php
namespace App\Models\ReportsFolders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{
    use SoftDeletes;
    protected $table = 'be_reports';
    protected $fillable = array(
      0 => 'name',
      1 => 'variables',
      2 => 'aggregator',
      3 => 'rows',
      4 => 'cols',
      5 => 'filter',
      6 => 'folder_id',
    );
    protected $attributes = array(
      'name' => null,
      'variables' => null,
      'aggregator' => null,
      'rows' => null,
      'cols' => null,
      'filter' => null,
    );
    protected $casts = array(
      'name' => 'string',
      'variables' => 'string',
      'aggregator' => 'string',
      'rows' => 'string',
      'cols' => 'string',
      'filter' => 'string',
    );
    public function folder()
    {
        return $this->belongsTo('App\Models\ReportsFolders\Folder');
    }


    public function variables()
    {
        return $this->hasMany('App\Models\ReportsFolders\Variable');
    }


    public function dashboard1($t=0)
    {
        $res = ['x'=>[],'series'=>['reportes'=>[]]];
        $rep = \DB::select("select (select be_folders.name from be_folders where be_folders.id=be_reports.folder_id) as name, count(*) as count from be_reports group by folder_id");
        foreach ($rep as $row) {
            $res['x'][] = $row->name;
            $res['series']['reportes'][] = $row->count;
        }
        return $res;
    }
                    

    public function tablas($conn=null)
    {
        $collection = [];
        $tables = \DB::connection("datos")->getDoctrineSchemaManager()->listTableNames();
        $type = 'tables';
        foreach ($tables as $name) {
            $collection[] = [
                                'type'          => $type,
                                'id'            => $name,
                                'attributes'    => ['name'=>$name],
                                'relationships' => [],
                            ];
        }
        return ['data'=>$collection];
    }
                    

    public function columnas($tabla='ejemplo')
    {
        $collection = [];
        $columns = \DB::connection("datos")->getSchemaBuilder()->getColumnListing($tabla);
        $type = 'columns';
        foreach ($columns as $name) {
            $collection[] = [
                                'type'          => $type,
                                'id'            => $name,
                                'attributes'    => ['name'=>$name],
                                'relationships' => [],
                            ];
        }
        return ['data'=>$collection];
    }
                    

    public function dimensiones($variables='', $domains=false)
    {
        $collection = [];
        $variableRows = \App\Models\ReportsFolders\Variable::whereIn(
                            'id',
                            explode(',', $variables)
                        )->get();
        $dims = [];
        $first = true;
        foreach ($variableRows as $var) {
            $dims1 = [];
            foreach ($var->dimensions()->get() as $dim) {
                if ($first || isset($dims[$dim->id])) {
                    $dims1[$dim->id] = $dim;
                }
            }
            $dims = $dims1;
            $first = false;
        }
        uasort($dims, function ($a, $b) {
            return strcasecmp($a->name, $b->name);
        });
        $type = 'ReportsFolders.Dimension';
        foreach ($dims as $dim) {
            $relationships = [];
            if ($domains) {
                $relationships["domains"]=[];
                foreach ($dim->domains()->get() as $dom) {
                    $relationships["domains"][]=[
                                        'type'          => "ReportsFolders.Domain",
                                        'id'            => $dom->name,
                                        'attributes'    => ['name'=>$dom->name],
                                        'relationships' => [],
                                    ];
                }
            }
            $collection[] = [
                                'type'          => $type,
                                'id'            => $dim->id,
                                'attributes'    => ['name'=>$dim->name],
                                'relationships' => $relationships,
                            ];
        }
        return ['data'=>$collection];
    }
}
