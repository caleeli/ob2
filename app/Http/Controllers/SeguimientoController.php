<?php

namespace App\Http\Controllers;

use App\Models\UserAdministration\Tarea as Model;
use Illuminate\Http\Request;

class SeguimientoController extends Controller
{

    const field = 'datos';

    /**
     * Update a segment of a json data.
     *
     * @param Request $request
     * @param Model $model
     * @return type
     */
    public function show(Request $request, Model $model, $path)
    {
        $data = $model->{self::field};
        return response()->json([
                'data' => $this->getData($data, explode('.', $path))
        ]);
    }

    /**
     * Update a segment of a json data.
     *
     * @param Request $request
     * @param Model $model
     * @return type
     */
    public function update(Request $request, Model $model, $path)
    {
        $newData = $request->json("data");
        $data = $model->{self::field};
        $this->updateData($data, explode('.', $path), $newData);
        $model->{self::field} = $data;
        $model->saveOrFail();
        return response()->json($model->{self::field});
    }

    /**
     * Set the $newData to a property within the &$data.
     *
     * @param mixed $data
     * @param array $path
     * @param mixed $newData
     */
    private function updateData(&$data, array $path, $newData)
    {
        if (count($path) > 0) {
            $attribute = array_shift($path);
            if (!is_array($data)) {
                $data = [$attribute => null];
            }
            $this->updateData($data[$attribute], $path, $newData);
        } else {
            $data = $newData;
        }
    }

    /**
     * Set the $newData to a property within the &$data.
     *
     * @param mixed $data
     * @param array $path
     */
    private function getData($data, array $path)
    {
        if (count($path) > 0) {
            $attribute = array_shift($path);
            if (is_array($data)) {
                return $this->getData($data[$attribute], $path);
            } else {
                return null;
            }
        } else {
            return $data;
        }
    }
}
