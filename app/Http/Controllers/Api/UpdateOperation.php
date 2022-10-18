<?php

namespace App\Http\Controllers\Api;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;
use App\Exceptions\NotFoundException;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Exceptions\InvalidApiCall;

class UpdateOperation extends BaseOperation
{
    protected $createNewRows = false;

    public function update($data)
    {
        return $this->execute($this->model, $data);
    }

    protected function isBelongsTo(BelongsTo $model, Model $target = null, $data)
    {
        if ($target === null) {
            $model->dissociate();
        } else {
            $this->updateModel($target, $data);
            $model->associate($target);
        }
        $model->getParent()->save();
        return $target;
    }

    protected function isBelongsToMany(BelongsToMany $model, array $targets,
                                       $data)
    {
        $ids = [];
        foreach ($targets as $target) {
            $this->updateModel($target, $data);
            $ids[] = $target->id;
        }
        $model->sync($ids);
        return $targets;
    }

    protected function isHasMany(HasMany $model, array $targets, $data)
    {
        foreach ($targets as $target) {
            $this->updateModel($target, $data);
        }
        $model->saveMany($targets);
        return $targets;
    }

    protected function isHasOne(HasOne $model, Model $target, $data)
    {
        $this->updateModel($target, $data);
        $model->save($target);
        return $target;
    }

    protected function isModel(Model $model, Model $target = null, $data)
    {
        $this->updateModel($model, $data);
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

    private function updateModel(Model $target, $data)
    {
        if (isset($data['attributes'])) {
            $target->update($data['attributes']);
        }
        return $target;
    }
}
