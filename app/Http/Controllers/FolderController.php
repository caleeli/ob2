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
        $regexp = $filter ? '/' . str_replace('%', '.*', preg_quote($filter, '/')) . '/i' : '';
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
            $url = isset($config['urlBase']) ? asset($config['urlBase'] . $filename) : '';
            $mime = $file->getMimeType();
            $id = $filename;
            if ($file->getExtension()==='marks') {
                continue;
            }
            if ($file->getExtension()==='link') {
                $data = json_decode(file_get_contents($file->path()), true);
                if ($data) {
                    $mime = !empty($data['mime']) ? $data['mime'] : $mime;
                    $url = !empty($data['url']) ? $data['url'] : $url;
                }
            }
            if ($storage==='tareas' && strtolower($file->getExtension())==='pdf') {
                $url = $this->urlPDFCommentsEditor($storage, $filename);
            }
            $list[] = [
                'id'         => $id,
                'attributes' => [
                    'id'         => $id,
                    'name'       => basename($filename),
                    'url'        => $url,
                    'updated_at' => $driver->lastModified($filename),
                    'mime'       => $mime,
                ]
            ];
        }
        return $list;
    }

    /**
     * /api/folder/normativa/filename
     */
    public function remove($storage, ...$file)
    {
        Storage::disk($storage)->delete(implode('/', $file));
        return response()->json([$storage, implode('/', $file)]);
    }

    /**
     * Guardar un archivo tipo link
     * link={"mime":"application/msword", "url": "http://..."}
     *
     * @param string $storage
     * @param string $filename
     * @param array $link
     */
    public static function saveLink($storage, $filename, array $link)
    {
        return Storage::disk($storage)->put($filename, json_encode($link));
    }

    /**
     * Crea un link para abrir un PDF con el editor de comentarios.
     *
     * @param string $storage
     * @param string $filename
     *
     * @return string
     */
    private function urlPDFCommentsEditor($storage, $filename)
    {
        return '/pdfhl/edit/' . $storage . '/' . $filename;
    }
}
