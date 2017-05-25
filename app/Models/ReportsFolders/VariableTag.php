<?php
namespace App\Models\ReportsFolders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class VariableTag extends Model
{
    use SoftDeletes, Notifiable;
    protected $table = 'be_variable_tags';
    protected $fillable = array(
      0 => 'name',
    );
    protected $attributes = array(
      'name' => null,
    );
    protected $casts = array(
      'name' => 'string',
    );
    protected $events = array(
    );
    public function variables()
    {
        return $this->belongsToMany('App\Models\ReportsFolders\Variable');
    }


    public function reports()
    {
        return $this->belongsToMany('App\Models\ReportsFolders\Report');
    }


    public function tagsList()
    {
        $collection = [];
        $list = $this->all();
        $type = 'variable_tag';
        foreach ($list as $row) {
            $collection[] = [
                                'type'          => $type,
                                'id'            => $row->name,
                                'attributes'    => $row,
                                'relationships' => [],
                            ];
        }
        return ['data'=>$collection];
    }
}
