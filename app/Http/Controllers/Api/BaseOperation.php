<?php

namespace App\Http\Controllers\Api;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Exceptions\InvalidApiCall;
use App\Exceptions\NotFoundException;
use Illuminate\Support\Collection;

abstract class BaseOperation
{
    protected $createNewRows = true;
    public $route;
    public $model;

    public function __construct($route, $model = null)
    {
        $this->route = $route;
        $this->model = $this->resolve($route, $model);
    }

    protected function resolve($routesArray, $model = null)
    {
        $routes = $routesArray;
        while ($routes) {
            $route = array_shift($routes);
            if ($route === '' || !is_string($route)) {
                throw new InvalidApiCall('Invalid route component ('.json_encode($route).') in '.json_encode($routesArray));
            }
            $isZero = $route == '0' || $route === 'create';
            $isNumeric = !$isZero && is_numeric($route);
            $isString = !$isZero && !$isNumeric;
            if ($model === null && $isString) {
                $model = "\App\Models\\".ucfirst($route)."\\".ucfirst(camel_case(str_singular(array_shift($routes))));
            } elseif (is_string($model) && $isZero) {
                $model = new $model();
            } elseif (is_string($model) && $isNumeric) {
                $model = $model::whereId($route)->first();
            } elseif ($model instanceof Model && $isString) {
                $model = $model->$route();
            } elseif ($model instanceof BelongsTo && $isString) {
                $model = $model->$route();
            } elseif ($model instanceof HasOne && $isString) {
                $model = $model->$route();
            } elseif ($model instanceof HasMany && $isZero) {
                $model = $model->getRelated()->newInstance();
            } elseif ($model instanceof HasMany && $isNumeric) {
                $model = $model->whereId($route)->first();
            } elseif ($model instanceof BelongsToMany && $isZero) {
                $model = $model->getRelated()->newInstance();
            } elseif ($model instanceof Collection) {
                $model = $model;
            } elseif (is_array($model)) {
                $model = $model;
            } else {
                throw new NotFoundException('Resource not found ('.json_encode($route).') in '
                .json_encode($routesArray).' from '.(is_object($model) ? get_class($model)
                        : gettype($model)));
            }
        }
        return $model;
    }

    private function getTarget($model, $data)
    {
        $target = null;
        if ($model === null) {
            //@todo could be from type of $data
        } elseif ($data===null) {
        } elseif (!empty($data['id']) && is_string($model)) {
            $target = $model::findOrFail($data['id']);
        } elseif (!empty($data['id']) && $model instanceof Model) {
            $target = $model->findOrFail($data['id']);
        } elseif (!empty($data['id'])) {
            $target = $model->getRelated()->findOrFail($data['id']);
        } elseif (!empty($data['attributes']) && is_string($model)) {
            if ($this->createNewRows) {
                $target = $model::create($data['attributes']);
            }
        } elseif (!empty($data['attributes']) && $model instanceof Model) {
            if ($this->createNewRows) {
                $target = $model->create($data['attributes']);
            }
        } elseif (!empty($data['attributes'])) {
            if ($this->createNewRows) {
                $target = $model->getRelated()->create($data['attributes']);
            }
        } elseif (array_key_exists('id', $data) && empty($data['id'])) {
            $target = null;
        } elseif (!isset($data['id']) && !isset($data['attributes'])) {
            $target = [];
            foreach ($data as $row) {
                $target[] = $this->getTarget($model, $row);
            }
        } else {
            throw new NotFoundException('Resource not found for '.json_encode($data));
        }
        return $target;
    }

    protected function execute($model, $data)
    {
        $target = $this->getTarget($model, $data);
        if ($model === null) {
            $target = $this->isNull($model, $target, $data);
        } elseif (is_string($model)) {
            $target = $this->isString($model, $target, $data);
        } elseif ($model instanceof Model) {
            $target = $this->isModel($model, $target, $data);
        } elseif ($model instanceof BelongsTo) {
            $target = $this->isBelongsTo($model, $target, $data);
        } elseif ($model instanceof HasOne) {
            $target = $this->isHasOne($model, $target, $data);
        } elseif ($model instanceof HasMany) {
            $target = $this->isHasMany($model,
                                       is_array($target) ? $target : [$target],
                                                $data);
        } elseif ($model instanceof BelongsToMany) {
            $target = $this->isBelongsToMany($model,
                                             is_array($target) ? $target : [$target],
                                                      $data);
        } elseif ($model instanceof Collection) {
            $target = $this->isCollection($model, $target, $data);
        } elseif (is_array($model)) {
            $target = $this->isArray($model, $target, $data);
        } else {
            throw new \Exception('Invalid $model');
        }
        if (isset($data['relationships'])) {
            foreach ($data['relationships'] as $rel => $json) {
                if (is_array($target)) {
                    //Case when one only model is stored to hasMany or BelongsToMany
                    $relModel = $this->resolve([$rel], $target[0]);
                } else {
                    $relModel = $this->resolve([$rel], $target);
                }
                $this->execute($relModel, $json['data']);
            }
        }
        return $target;
    }

    abstract protected function isBelongsTo(BelongsTo $model, Model $target,
                                            $data);

    abstract protected function isBelongsToMany(BelongsToMany $model,
                                                array $targets, $data);

    abstract protected function isHasMany(HasMany $model, array $targets, $data);

    abstract protected function isHasOne(HasOne $model, Model $target, $data);

    abstract protected function isModel(Model $model, Model $target, $data);

    abstract protected function isNull($model, Model $target, $data);

    abstract protected function isString($model, Model $target, $data);
}
