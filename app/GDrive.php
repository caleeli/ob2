<?php

namespace App;

use Google_Client;
use Google_Service_Drive;
use Google_Service_Drive_DriveFile;
use InvalidArgumentException;
use Illuminate\Support\Facades\Cache;

/**
 * Description of GDrive
 *
 * @author davidcallizaya
 */
class GDrive {

    const MIME_FOLDER = 'application/vnd.google-apps.folder';

    /**
     *
     * @var Google_Client $client
     */
    private $client;
    /**
     *
     * @var Google_Service_Drive $service
     */
    private $service;
    public function __construct()
    {
        $config = base_path('client_secret_899025509338-2t5gv4i4o3hdo0uragvihtl3ipp8fnqd.apps.googleusercontent.com.json');
        $this->client = new Google_Client();
        $this->client->setAuthConfig($config);
        $this->client->setAccessType("offline");
        $this->client->setIncludeGrantedScopes(true);
        $this->client->setApprovalPrompt('force');
        $this->client->addScope(Google_Service_Drive::DRIVE);
        $redirect_uri = env('APP_URL') . '/gdrive_cb';
        $this->client->setRedirectUri($redirect_uri);
        $token = Cache::get('gdrive_token');
        if ($token) {
            try {
                $this->client->setAccessToken($token);
            } catch (InvalidArgumentException $exc) {
                Cache::forget('gdrive_token');
            }
            if ($this->client->isAccessTokenExpired()) {
                $token = $this->client->fetchAccessTokenWithRefreshToken();
                Cache::forever('gdrive_token', $token);
            }
            $this->service = new Google_Service_Drive($this->client);
        }
    }
    public function getAuthUrl() {
        return $this->client->createAuthUrl();
    }

    public function fetchAccessToken($code) {
        $token = $this->client->fetchAccessTokenWithAuthCode($code);
        return $token;
    }
    public function listIn($id=null, $recursive=true) {
        $index = json_decode(file_get_contents(public_path('plantillas/index.json')));
        foreach ($index as $item) {
            if ($item->id === $id) {
                return $item->files ?? [];
            }
        }
        return [];
        $id = $this->escape($id);
        $op = $recursive ? 'in' : '=';
        $params = [];
        if ($id) {
            $params['q'] = "$id $op parents";
        }
        return $this->service->files->listFiles($params)->files;
    }
    /**
     * $path no debe empezar con /
     * El separador es /
     *
     * @param type $path
     * @return type
     */
    public function findPath($path) {
        $pwd = 'root';
        foreach (explode('/', $path) as $p) {
            $file = $this->findIn($p, $pwd);
            $pwd = $file->id;
        }
        return $file;
    }
    public function findIn($name, $id=null, $recursive=true) {
\Log::debug($name);
\Log::debug($id);
	$index = json_decode(file_get_contents(public_path('plantillas/index.json')));
        foreach ($index as $item) {
            if ($item->name === $name) {
                return $item;
            }
        }
	return null;
        $id = $this->escape($id);
        $name = $this->escape($name);
        $op = $recursive ? 'in' : '=';
        $q = ["name = $name"];
        if ($id) {
            $q[] = "$id $op parents";
        }
        $files = $this->service->files->listFiles([
            'q' => implode(' and ', $q),
        ])->files;
        return $files[0];
    }
    public function downloadLink(Google_Service_Drive_DriveFile $file) {
        $id = $file->id;
        $token = $this->client->getAccessToken()['access_token'];
        return "https://www.googleapis.com/drive/v3/files/$id?alt=media&access_token=$token";
    }
    public function getContent($fileId)
    {
\Log::debug("Get Content: $fileId");
        $index = json_decode(file_get_contents(public_path('plantillas/index.json')));
        foreach ($index as $item) {
            if ($item->id === $fileId) {
                $content = file_get_contents(public_path('plantillas/' . $item->file));
                return $content;
            }
        }
        return "";
        /* @var $response \GuzzleHttp\Psr7\Response */
        $response = $this->service->files->export($fileId, 'text/html');
        return ($response->getBody()->__toString());
    }

    /**
     *
     * @param type $value
     * @param string $type
     */
    private function escape($value, $type = 'auto')
    {
        if ($type === 'auto') {
            $type = gettype($value);
        }
        switch ($type) {
            case 'string':
                return "'" . str_replace("'", "\\'", $value) . "'";
            case 'integer':
            case 'double':
                return $value;
            case 'boolean':
                return $value ? 'true' : 'false';
        }
    }

    public function files($path, $returnObjects = false)
    {
        /* @var $file \Google_Service_Drive_DriveFile*/
        if ($path === 'root') {
            $id = $path;
        } else {
            $gpath = $this->findPath($path);
            $id = $gpath->id;
        }
        $list = [];
        foreach ($this->listIn($id) as $file) {
            if ($file->mimeType === self::MIME_FOLDER) continue;
            if ($file->id=='1a4xoTiEzNrtCnjoLKxcO0mE7hzYgPkJySRkxe9b-WIc') {
                continue;
            }
            if ($returnObjects) {
                $list[$file->name] = $file;
            } else {
                $list[$file->name] =[
                    "id"   => $file->id,
                    "name" => $file->name,
                    "path" => "$path/" . $file->name,
                ];
            }
        }
        ksort($list);
        return array_values($list);
    }
    
    public function getEditLinkFor(Google_Service_Drive_DriveFile $file)
    {
        switch($file->mimeType)
        {
            case 'application/vnd.google-apps.document':
                return 'https://docs.google.com/document/d/' . $file->id . '/edit';
            case 'application/vnd.google-apps.spreadsheet':
                return 'https://docs.google.com/spreadsheets/d/' . $file->id . '/edit';
            default:
                //return 'https://drive.google.com/open?id=' . $file->id;
        }
        //https://docs.google.com/document/d/19Ts5TwOMmi7DRaNsiTz8TeQBbN4enyV-Wd36qPFJtLI/edit
        //https://docs.google.com/spreadsheets/d/1_B_JnQDuk5sHQDbmXCwUgK8MBA7B9wciT0xFe-sli2w/edit
        //https://drive.google.com/open?id=1NZWQq66t6XQGHT22t-U8q7BI0b-Q0TSSAotf_lMe6Ow
    }
}
