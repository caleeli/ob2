<?php
namespace App\Models\ReportsFolders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VariableTag extends Model
{
    use SoftDeletes;
    protected $table = 'repfol_variable_tags';
    protected $fillable = array(
      0 => 'name',
    );
    protected $attributes = array(
      'name' => null,
    );
    protected $casts = array(
      'name' => 'string',
    );
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
