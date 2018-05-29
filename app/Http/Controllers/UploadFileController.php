<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use stdClass;
use Illuminate\Http\UploadedFile;

class UploadFileController extends Controller
{

    public function upload(Request $request)
    {
        $files = $request->file('file');
        $multiple = is_array($files);
        $response = $multiple ? [] : $this->packResponse($files);
        if ($multiple) {
            foreach ($files as $file) {
                $response[] = $this->packResponse($file);
            }
        }
        return response()->json($response);
    }

    private function packResponse(UploadedFile $file)
    {
        $json = new stdClass();
        $json->name = $file->getClientOriginalName();
        $json->mime = $file->getClientMimeType();
        $json->path = $file->storePubliclyAs('', $this->getPublicName($file), 'public');
        $json->url = asset('storage/' . $json->path);
        return $json;
    }

    public function uploadDocument(Request $request, $disk, ...$pathArray)
    {
        $path = implode('/', $pathArray);
        $files = $request->file('file');
        $multiple = is_array($files);
        $response = $multiple ? [] : $this->packResponseDoc($files, $disk, $path);
        if ($multiple) {
            foreach ($files as $file) {
                $response[] = $this->packResponseDoc($file, $disk, $path);
            }
        }
        return response()->json($response);
    }

    private function packResponseDoc($file, $disk, $path)
    {
        $json = new stdClass();
        $json->name = preg_replace('/[^\w.]/', '-', $file->getClientOriginalName());
        $json->mime = $file->getClientMimeType();
        $json->path = $disk . ':/' . $file->storeAs($path, $json->name, ['disk' => $disk]);
        $config = config('filesystems.disks')[$disk];
        $json->url = isset($config['urlBase']) ? asset($config['urlBase'] . ($path ? $path . '/' : '') . $json->name) : '';
        return $json;
    }

    private function getPublicName(UploadedFile $file)
    {
        if (!$file->guessExtension()) {
            return uniqid('', true) . '.' . $file->clientExtension();
        } else {
            return $file->hashName();
        }
    }
}
