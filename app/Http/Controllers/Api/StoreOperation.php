<?php

namespace App\Http\Controllers\Api;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;
use App\Exceptions\InvalidApiCall;
use App\Exceptions\NotFoundException;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class StoreOperation extends BaseOperation
{
    public function store($data)
    {
        return $this->execute($this->model, $data);
    }

    protected function isBelongsTo(BelongsTo $model, Model $target=null, $data=[])
    {
        $model->associate($target);
        $model->getParent()->save();
        return $target;
    }

    protected function isBelongsToMany(BelongsToMany $model, array $targets, $data)
    {
        $ids = [];
        foreach ($targets as $target) {
            $ids[] = $target->id;
        }
        $model->sync($ids);
        return $targets;
    }

    protected function isHasMany(HasMany $model, array $targets, $data)
    {
        $model->saveMany($targets);
        return $targets;
    }

    protected function isHasOne(HasOne $model, Model $target, $data)
    {
        $model->save($target);
        return $target;
    }

    protected function isModel(Model $model, Model $target, $data)
    {
        throw new InvalidApiCall();
    }

    protected function isNull($model, Model $target, $data)
    {
        throw new NotFoundException();
    }

    protected function isString($model, Model $target, $data)
    {
        return $target;
    }
}
