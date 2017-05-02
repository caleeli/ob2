<?php

namespace App\Http\Controllers\Api;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;
use App\Exceptions\NotFoundException;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use ReflectionMethod;

class CallOperation extends BaseOperation
{
    protected $createNewRows = false;

    public function callMethod($call)
    {
        $this->call = $call;
        return $this->execute($this->model, null);
    }

    protected function isBelongsTo(BelongsTo $model, Model $target = null, $data)
    {
        return $this->doModelCall($model->getRelated());
    }

    protected function isBelongsToMany(BelongsToMany $model,
                                       array $targets = null, $data)
    {
        return $this->doModelCall($model->getRelated());
    }

    protected function isHasMany(HasMany $model, array $targets = null, $data)
    {
        return $this->doModelCall($model->getRelated());
    }

    protected function isHasOne(HasOne $model, Model $target = null, $data)
    {
        return $this->doModelCall($model->getRelated());
    }

    protected function isModel(Model $model, Model $target = null, $data)
    {
        return $this->doModelCall($model);
    }

    protected function isNull($model, Model $target = null, $data)
    {
        throw new NotFoundException();
    }

    protected function isString($model, Model $target = null, $data)
    {
        $modelC = new $model();
        return $this->doModelCall($modelC);
    }

    private function doModelCall(Model $model)
    {
        $method = $this->call['method'];
        $reflection = new ReflectionMethod($model, $method);
        $args = [];
        foreach ($reflection->getParameters() as $param) {
            $args[] = isset($this->call['arguments'][$param->getName()]) ?
                $this->call['arguments'][$param->getName()] :
                $param->getDefaultValue();
        }
        if (is_string($model)) {
            $model = new $model();
        }
        return $model->$method(...$args);
    }
}
