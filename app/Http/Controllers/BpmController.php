<?php

namespace App\Http\Controllers;

use App\GDrive;
use DOMDocument;
use DOMXPath;

class BpmController extends Controller
{

    /**
     * /bpm/{tipo_revision}
     */
    public function postBpm($tipo_revision)
    {
        $bpmn = request()->get('bpmn');
        $path = request()->get('path');
        $dom = new DOMDocument();
        $dom->loadXML($bpmn);
        $xpath = new DOMXPath($dom);
        $xpath->registerNamespace('bpmn', 'http://www.omg.org/spec/BPMN/20100524/MODEL');
        // Find tasks
        $tasks = $xpath->query('//bpmn:userTask');
        $tareas = [];
        foreach ($tasks as $task) {
            // get documentation
            $documentation = $xpath->query('bpmn:documentation', $task);
            $documentation = $documentation->length > 0 ? trim($documentation->item(0)->nodeValue) : null;
            if ($documentation) {
                $extra = json_decode($documentation, true);
            } else {
                $extra = [];
            }
            $file = $task->getAttribute('implementation');
            if ($file) {
                $filepath = $path . '/' . $file;
                if (file_exists($filepath)) {
                    GDrive::uploadToIndex(basename($file, '.html'), $filepath);
                }
            }
            $tareas[] = [
                'id' => $task->getAttribute('id'),
                'name' => $task->getAttribute('name'),
                'implementation' => $file,
                'extra' => $extra,
            ];
        }
        VueEditorController::postPasos($tareas, $tipo_revision);
    }
}
