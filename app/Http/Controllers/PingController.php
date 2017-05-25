<?php

namespace App\Http\Controllers;

class PingController extends Controller
{

    public function data()
    {
        $minutes = 1440;
        $response = response()->json(
            [
            'data' => []
            ], 200,
            [
            'Cache-Control' => 'max-age='.($minutes * 60).', public',
            ]
        );
        $response->setLastModified(new \DateTime('now'));
        $response->setExpires(\Carbon\Carbon::now()->addMinutes($minutes));
        return $response;
    }

    public function ping()
    {
        return '';
    }
}
