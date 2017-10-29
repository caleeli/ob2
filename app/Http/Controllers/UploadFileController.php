<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use stdClass;

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

    private function packResponse($file)
    {
        $json = new stdClass();
        $json->name = $file->getClientOriginalName();
        $json->mime = $file->getClientMimeType();
        $json->path = $file->storePublicly('', 'public');
        $json->url = asset('storage/' . $json->path);
        return $json;
    }
}
