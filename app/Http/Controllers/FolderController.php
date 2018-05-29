<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class FolderController extends Controller
{

    /**
     * /api/folder/normativa?filter={name:'%.png'}
     */
    public function index(Request $request, $storage, ...$pathArray)
    {
        $path = '/' . implode('/', $pathArray);
        $filter = $request->input('filter', '');
        $regexp = $filter ? '/' . str_replace('%', '.*', preg_quote($filter, '/')) . '/' : '';
        $list = $this->listFiles($storage, $regexp, [], '', $path);
        if ($storage==='tareas') {

        } else {
            $list = $this->listFiles('empresas', $regexp, $list, '/.+_crea\..+/', $path);
        }
        return $response = response()->json(['data' => $list], 200);
    }

    private function listFiles($storage, $regexp, $list, $extrareg, $path)
    {
        $config = config('filesystems.disks')[$storage];
        $driver = Storage::disk($storage);
        foreach ($driver->files($path) as $filename) {
            if (
                ($regexp && !preg_match($regexp, $filename))
                || ($extrareg && !preg_match($extrareg, $filename))
                || substr($filename, 0, 1) === '.'
            ) {
                continue;
            }
            $path = $driver->getDriver()->getAdapter()->applyPathPrefix($filename);
            $file = new File($path);
            $list[] = [
                'id'         => $filename,
                'attributes' => [
                    'id'         => $filename,
                    'name'       => $filename,
                    'url'        => isset($config['urlBase']) ? asset($config['urlBase'] . $filename) : '',
                    'updated_at' => $driver->lastModified($filename),
                    'mime'       => $file->getMimeType(),
                ]
            ];
        }
        return $list;
    }

    /**
     * /api/folder/normativa/filename
     */
    public function remove($storage, $file)
    {
        Storage::disk($storage)->delete($file);
        return response()->json([]);
    }
}
