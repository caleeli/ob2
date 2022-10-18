<?php

namespace App\Http\Controllers;

use App\GDrive;

class GoogleDocsController extends Controller
{

    public function listDocs($storage, ...$path)
    {
        $directory = implode('/', $path);
        $res = [];

        return []; // disabled

        $drive = new GDrive;
        $files = $drive->files('SUPERVISIONES', true);
        foreach ($files as $file) {
            $url = $drive->getEditLinkFor($file);
            if ($url) {
                $res[] = [
                    "id"   => $file->id,
                    "name" => $file->name,
                    "url" => $url,
                ];
            }
        }
        return $res;
    }
}
