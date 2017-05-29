<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Exceptions\InvalidApiCall;
use App\Exceptions\NotFoundException;
use Illuminate\Database\Eloquent\Builder;
use ReflectionMethod;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Exception;
use App\Http\Controllers\Api\IndexOperation;
use App\Http\Controllers\Api\StoreOperation;
use App\Http\Controllers\Api\UpdateOperation;
use App\Http\Controllers\Api\CallOperation;

class ApiController extends Controller
{
    const PER_PAGE = 150;

    /**
     * /api/users?page=2&filter[]=where,username,=,david&fields=username,firstname&include=roles,phone&sort=username
     */
    public function index(Request $request, ...$route)
    {
        $perPage = empty($request['per_page']) ?
            static::PER_PAGE : $request['per_page'];
        $collection = $this->doSelect(
            null, $route, $request['fields'], $request['include'], $perPage,
            $request['sort'], $request['filter'], $request['raw']
        );
        $minutes = 0.1;
        $response = response()->json(
            [
            'data' => $collection
            ], 200,
            [
            'Cache-Control' => 'max-age='.($minutes * 60).', public',
            ]
        );
        $response->setLastModified(new \DateTime('now'));
        $response->setExpires(\Carbon\Carbon::now()->addMinutes($minutes));
        return $response;
    }

    private function doSelect($modelBase, $route, $fields, $include, $perPage, $sort,
                              $filter, $raw=false)
    {
        $operation = new IndexOperation($route, $modelBase);
        $result = $operation->index($sort, $filter, $perPage);
        if ($raw) {
            return $result;
        }
        $type = $this->getType($operation->model);
        return $this->packResponse($result, $type, $fields, $include);
    }

    protected function packResponse($result, $type, $requiredFields,
                                    $requiredIncludes, $sparseFields = true)
    {
        if ($result instanceof Model) {
            /* @var $a Model */
            $collection = [
                'type'          => $type,
                'id'            => $result->id,
                'attributes'    => $sparseFields ?
                    $this->sparseFields($requiredFields, $result->toArray()) :
                    $result->toArray(),
                'relationships' => $this->sparseRelationships($requiredFields,
                                                              $requiredIncludes,
                                                              $result),
            ];
        } elseif ($result === null) {
            $collection = null;
        } else {
            $collection = [];
            foreach ($result as $row) {
                $sparcedFields = $sparseFields ?
                        $this->sparseFields($requiredFields, $row instanceof Model ? $row->toArray() : $row) :
                        ($row instanceof Model ? $row->toArray() : $row);
                $collection[] = [
                    'type'          => $type,
                    'id'            => $row->id,
                    'attributes'    => $sparcedFields,
                    'relationships' => $this->sparseRelationships($requiredFields,
                                                                  $requiredIncludes,
                                                                  $row),
                ];
            }
        }
        return $collection;
    }

    public function store(Request $request, ...$route)
    {
        $route0 = $route;
        $data = $request->json("data");
        $call = $request->json("call");
        if ($data) {
            $operation = new StoreOperation($route);
            $result = $operation->store($data);
            if (is_array($result)) {
                $response = $result;
            } else {
                $response = [
                    'data' => [
                        'type'       => $this->getType($result),
                        'id'         => $result->id,
                        'attributes' => $result
                    ]
                ];
            }
        } elseif ($call) {
            $operation = new CallOperation($route);
            $result = $operation->callMethod($call);
            $response = [
                "success"  => true,
                "response" => $result,
            ];
        }
        return response()->json($response);
    }

    public function update(Request $request, ...$route)
    {
        $data = $request->json("data");
        $operation = new UpdateOperation($route);
        $result = $operation->update($data);
        $response = [
            'data' => [
                'type'       => $this->getType($result),
                'id'         => $result->id,
                'attributes' => $result
            ]
        ];
        return response()->json($response);
    }

    public function delete(...$route)
    {
        $method = function ($model) {
            if (is_string($model)) {
                throw new InvalidApiCall();
            } elseif ($model instanceof Model) {
                $model->delete();
            } elseif ($model === null) {
                throw new NotFoundException();
            } else {
                throw new InvalidApiCall();
            }
            return $model;
        };
        $this->resolve($route, $method);
    }

    protected function getType($model)
    {
        if (is_array($model)) return isset($model[0]) ? $this->getType ($model[0]) : '';
        $class = is_string($model) ? $model : ($model instanceof Model ? get_class($model)
                        : ($model instanceof \Illuminate\Database\Eloquent\Relations\Relation ? get_class($model->getRelated()):'') );
        if (substr($class, 0, 1) != '\\') $class = '\\'.$class;
        return str_replace('\\', '.', substr($class, 12));
    }

    protected function resolve($routesArray, $method, $data = null,
                               $model = null)
    {
        $routes = $routesArray;
        while ($routes) {
            $route = array_shift($routes);
            if ($route === '' || !is_string($route)) {
                throw new Exception('Invalid route component ('.json_encode($route).') in '.json_encode($routesArray));
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
                $model = $model->newInstance();
            } elseif ($model instanceof HasMany && $isNumeric) {
                $model = $model->whereId($route)->first();
            } elseif ($model instanceof BelongsToMany && $isZero) {
                $model = $model->newInstance();
            } elseif ($model instanceof BelongsToMany && $isNumeric) {
                $model = $model->whereId($route)->first();
            } else {
                throw new Exception('Invalid route component ('.json_encode($route).') in '.json_encode($routesArray));
            }
        }
        if ($data !== null) {
            $res = $method($model, $data);
            if (isset($data['relationships'])) {
                foreach ($data['relationships'] as $rel => $json) {
                    $route1 = $routesArray;
                    $route1[] = $rel;
                    $this->resolve($route1, $method, $json['data'], $res);
                }
            }
            return $res;
        }
        return $method($model);
    }

    /**
     *
     * @param Request $request
     * @param array $row
     * @return array
     */
    protected function sparseFields($requiredFields, $row)
    {
        if (empty($requiredFields)) {
            return $row;
        }
        $fields = explode(",", $requiredFields);
        return array_intersect_key($row, array_flip($fields));
    }

    /**
     *
     * @param type $requiredFields
     * @param type $requiredIncludes
     * @param type $row
     * @return type
     */
    protected function sparseRelationships($requiredFields, $requiredIncludes,
                                           $row)
    {
        $relationships = [];
        if (empty($requiredFields) && empty($requiredIncludes)) {
            return [];
        }
        $fields = explode(",", $requiredFields.','.$requiredIncludes);
        foreach ($fields as $field) {
            if (method_exists($row, $field)) {
                $relationships[$field] = $this->doSelect($row, [$field], '', '', static::PER_PAGE, '', '');
            }
        }
        return $relationships;
    }
}
