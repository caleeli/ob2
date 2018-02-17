<?php

namespace App;
use App\Models\UserAdministration\HojaTrabajo;

/**
 * Convierte un documento google docs en una pagina dinamica con vuejs
 *
 * @author davidcallizaya
 */
class GTemplate
{
    const SHORT_CUTS = [
        '✔/✕' => '[check*=check(✔|✕|N/A)]',
        '&#10004;/&#10005;' => '[check*=check(✔|✕|N/A)]',
    ];
    const REGEXP_VARIABLE = '/\[([\w\*]+)=(\w+)\s*\(([^\]]*)\)\]/';

    private $rawContent = '';

    public function __construct(GDrive $gdrive, $fileId)
    {
        $this->rawContent = $gdrive->getContent($fileId);
    }

    public function parse(HojaTrabajo $hojaTrabajo = null)
    {
        $multiples = [];
        $variables = [];
        $html = str_replace(array_keys(self::SHORT_CUTS), array_values(self::SHORT_CUTS), $this->rawContent);
        $html = preg_replace_callback(self::REGEXP_VARIABLE,
                                      function ($match) use($hojaTrabajo, &$variables, &$multiples) {
            $varName = $match[1];
            if (substr($varName, -1) === '*') {
                $varName = substr($varName, 0, -1);
                $multiples[$varName] = isset($multiples[$varName]) ? $multiples[$varName] + 1 : 1;
                $varName = $varName . $multiples[$varName];
            }
            $variables[$varName] = $hojaTrabajo && isset($hojaTrabajo->valores[$varName])
                ? $hojaTrabajo->valores[$varName] : '';
            $params = $match[3];
            if ($params && strpos($params, '|')!==false) {
                $params = htmlentities(json_encode(explode('|', $params)), ENT_QUOTES);
            }
            return "<{$match[2]} v-model='{$varName}' ".
                ($params ? "v-bind:data=\"{$params}\"" : "")
                . "></{$match[2]}>";
        }, $html);
        $html .= '<script>var variables = ' . json_encode($variables) . '</script>';
        return $html;
    }
}
