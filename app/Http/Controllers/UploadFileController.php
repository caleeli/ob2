<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadFileController extends Controller
{

    public function upload(Request $request)
    {
        $file = $request->file('file');
        $json = new \stdClass();
        $json->name = $file->getClientOriginalName();
        $json->mime = $file->getClientMimeType();
        $json->path = $file->storePublicly('', 'public');
        $json->url = asset('storage/'.$json->path);
        return response()->json($json);
    }
}
