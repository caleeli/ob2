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
        $this->client->addScope(Google_Service_Drive::DRIVE);
        $this->client->setAccessType("offline");
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
                Cache::forget('gdrive_token');
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
}
