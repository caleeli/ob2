<?php

namespace App\Http\Controllers\Api;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;
use App\Exceptions\NotFoundException;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Exceptions\InvalidApiCall;

class DeleteOperation extends BaseOperation
{
    protected $createNewRows = false;

    public function delete()
    {
        return $this->execute($this->model, null);
    }

    protected function isBelongsTo(BelongsTo $model, Model $target = null, $data = null)
    {
        $model->dissociate();
        $model->getParent()->save();
        return $target;
    }

    protected function isBelongsToMany(BelongsToMany $model, array $targets,
                                       $data)
    {
        $ids = [];
        foreach ($targets as $target) {
            $ids[] = $target->id;
        }
        $model->detach($ids);
        return $targets;
    }

    protected function isHasMany(HasMany $model, array $targets, $data)
    {
        //@todo: Does Eloquent implements detach on HasMany relationship?
        foreach ($targets as $target) {
            //$model->detach($target);
            $target->setAttribute($model->getForeignKeyName(), null);
            $target->save();
        }
        return $targets;
    }

    protected function isHasOne(HasOne $model, Model $target, $data)
    {
        //@todo: Does Eloquent implements detach on HasOn relationship?
        //$model->detach($target);
        $target->setAttribute($model->getForeignKeyName(), null);
        $target->save();
        return $target;
    }

    protected function isModel(Model $model, Model $target = null, $data)
    {
        $model->delete();
        return $model;
    }

    protected function isNull($model, Model $target, $data)
    {
        throw new NotFoundException();
    }

    protected function isString($model, Model $target, $data)
    {
        throw new InvalidApiCall;
    }
}
