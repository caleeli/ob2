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

class ApiController extends Controller
{
    const PER_PAGE = 50;

    /**
     * /api/users?page=2&filter[]=where,username,=,david&fields=username,firstname
     */
    public function index(Request $request, ...$route)
    {
        $type = '';
        $method = function($model) use(&$type, $request) {
            $perPage = empty($request['per_page']) ?
                static::PER_PAGE : $request['per_page'];
            if (is_string($model)) {
                $result = $model::select();
                $result = $this->addFilter($result, $request);
                $result = $result->paginate($perPage)->getCollection();
            } elseif ($model instanceof Model) {
                $result = $model;
            } elseif ($model === null) {
                throw new NotFoundException();
            } else {
                $model = $this->addFilter($model, $request);
                $result = $model->paginate($perPage)->getCollection();
            }
            $type = $this->getType($model);
            return $result;
        };
        $result = $this->resolve($route, $method);
        $collection = $this->packResponse($result, $type, $request);
        $response = [
            'data' => $collection
        ];
        return response()->json($response);
    }

    protected function packResponse($result, $type, $request, $sparseFields = true)
    {
        if ($result instanceof Model) {
            /* @var $a Model */
            //$result->select(["username"]);
            $collection = [
                'type'          => $type,
                'id'            => $result->id,
                'attributes'    => $sparseFields ? $this->sparseFields($request,
                                                       $result->toArray()) : $result->toArray(),
                'relationships' => $this->sparseRelationships($request, $result),
            ];
        } elseif ($result === null) {
            $collection = null;
        } else {
            $collection = [];
            foreach ($result as $row) {
                $collection[] = [
                    'type'          => $type,
                    'id'            => $row->id,
                    'attributes'    => $sparseFields ? $this->sparseFields($request,
                                                           $row->toArray()) : $row->toArray(),
                    'relationships' => $this->sparseRelationships($request, $row),
                ];
            }
        }
        return $collection;
    }

    public function store(Request $request, ...$route)
    {
        $data = $request->json("data");
        $call = $request->json("call");
        if ($data) {
            $method = function($model, $data) {
                if (is_string($model) && isset($data['id'])) {
                    $result = $model::attach($data['id']);
                } elseif (is_string($model) && isset($data['attributes'])) {
                    $result = $model::create($data['attributes']);
                } elseif ($model instanceof Model) {
                    throw new InvalidApiCall();
                } elseif (isset($data['id'])) {
                    $related = $model->getRelated()->findOrFail($data['id']);
                    $result = $model->save($related);
                } else {
                    $result = $model->create($data['attributes']);
                }
                return $result;
            };
            $result = $this->resolve($route, $method, $data);
            $response = [
                'data' => [
                    'type'       => $this->getType($result),
                    'attributes' => $result
                ]
            ];
        } elseif ($call) {
            $method = function($model) use($call) {
                if($model instanceof HasMany) {
                    $model = $model->getRelated();
                }
                $method = $call['method'];
                $reflection = new ReflectionMethod($model, $method);
                $args = [];
                foreach ($reflection->getParameters() as $param) {
                    $args[] = isset($call['arguments'][$param->getName()]) ?
                        $call['arguments'][$param->getName()] :
                        $param->getDefaultValue();
                }
                if (is_string($model)) {
                    $model = new $model();
                }
                return $model->$method(...$args);
            };
            $result = $this->resolve($route, $method);
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
        $method = function($model, $data) {
            if (is_string($model) && isset($data['id'])) {
                throw new InvalidApiCall();
            } elseif (is_string($model) && isset($data['attributes'])) {
                throw new InvalidApiCall();
            } elseif ($model instanceof Model) {
                $model->update($data['attributes']);
                $result = $model;
            } elseif ($model === null) {
                throw new NotFoundException();
            } else {
                throw new InvalidApiCall();
            }
            return $result;
        };
        $result = $this->resolve($route, $method, $data);
        $response = [
            'data' => [
                'type'       => $this->getType($result),
                'attributes' => $result
            ]
        ];
        return response()->json($response);
    }

    public function delete(...$route)
    {
        $method = function($model) {
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
        $class = is_string($model) ? $model : get_class($model instanceof Model ? $model
                        : $model->getRelated());
        if (substr($class, 0, 1) != '\\') $class = '\\'.$class;
        return str_replace('\\', '.', substr($class, 12));
    }

    protected function resolve($route, $method, $data = null, $model = null)
    {
        while ($route) {
            if ($model === null) {
                $model = "\App\Models\\".ucfirst(array_shift($route))."\\".ucfirst(camel_case(str_singular(array_shift($route))));
            } elseif ($model instanceof Model) {
                $relationship = array_shift($route);
                $model = $model->$relationship();
                if ($model instanceof BelongsTo ||
                    $model instanceof HasOne) {
                    $model = $model->first();
                }
            } elseif (is_string($model)) {
                $id = array_shift($route);
                if ($id === 'create') {
                    $model = new $model();
                } else {
                    $model = $model::whereId($id)->first();
                }
            } else {
                $id = array_shift($route);
                if ($id === 'create') {
                    $model = $model->getRelated()->newInstance();
                } else {
                    $model = $model->whereId($id)->first();
                }
            }
        }
        if ($data !== null) {
            $res = $method($model, $data);
            if (isset($data['relationships'])) {
                foreach ($data['relationships'] as $rel => $json) {
                    $route[] = $rel;
                    $this->resolve($route, $method, $json['data'], $res);
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
    protected function sparseFields(Request $request, $row)
    {
        if (empty($request['fields'])) {
            return $row;
        }
        $fields = explode(",", $request['fields']);
        return array_intersect_key($row, array_flip($fields));
    }

    /**
     *
     * @param Request $request
     * @param array $row
     * @return array
     */
    protected function sparseRelationships(Request $request, $row)
    {
        $relationships = [];
        if (empty($request['fields'])) {
            return [];
        }
        $fields = explode(",", $request['fields']);
        foreach ($fields as $field) {
            $methodName = $field;
            if (method_exists($row, $methodName)) {
                $model = $row->$methodName();
                $type = $this->getType($model->getModel());
                if ($model instanceof BelongsTo ||
                    $model instanceof HasOne) {
                    $model = $model->first();
                }
                $response = $this->packResponse($model, $type, $request, false);
                $relationships[$field] = $response;
            }
        }
        return $relationships;
    }

    /**
     *
     * &filter[]=where,username,=,david
     * @param Builder $select
     * @param Request $request
     * @return Builder
     */
    protected function addFilter($select, Request $request)
    {
        if (empty($request['filter'])) {
            return $select;
        }
        foreach ($request['filter'] as $filter) {
            $params = explode(",", $filter);
            $method = array_shift($params);
            if ($method === 'where' && count($params) === 2) {
                $params[1] = json_decode($params[1]);
            }
            if ($method === 'where' && count($params) === 3) {
                $params[2] = json_decode($params[2]);
            }
            $select = call_user_func_array([$select, $method], $params);
        }
        return $select;
    }
}
