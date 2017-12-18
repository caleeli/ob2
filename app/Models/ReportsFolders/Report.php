<?php
namespace App\Models\ReportsFolders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Report extends Model
{
    use SoftDeletes, Notifiable;
    protected $table = 'be_reports';
    protected $fillable = array(
      0 => 'name',
      1 => 'variables',
      2 => 'aggregator',
      3 => 'rows',
      4 => 'cols',
      5 => 'chart_type',
      6 => 'filter',
      7 => 'folder_id',
    );
    protected $attributes = array(
      'name' => null,
      'variables' => null,
      'aggregator' => null,
      'rows' => null,
      'cols' => null,
      'chart_type' => 'line',
      'filter' => null,
    );
    protected $casts = array(
      'name' => 'string',
      'variables' => 'string',
      'aggregator' => 'string',
      'rows' => 'string',
      'cols' => 'string',
      'chart_type' => 'string',
      'filter' => 'string',
    );
    protected $events = array(
    );
    public function folder()
    {
        return $this->belongsTo('App\Models\ReportsFolders\Folder');
    }


    public function variableTags()
    {
        return $this->belongsToMany('App\Models\ReportsFolders\VariableTag');
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
                    

    public function listVariables($ids)
    {
        $variables = explode(',', $ids);
        $list = [];
        foreach ($variables as $var) {
            $list[] = \App\Models\ReportsFolders\Variable::findOrFail($var);
        }
        return $list;
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
        if (empty($variables)) {
            return ['data'=>$collection];
        }
        if (!is_array($variables)) {
            $ids = explode(',', "$variables");
        } else {
            $ids = [];
            foreach ($variables as $v) {
                $ids[] = $v['id'];
            }
        }
        $variableRows = \App\Models\ReportsFolders\Variable::whereIn(
                            'id',
                            $ids
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
