<?php

namespace App;

use App\Models\UserAdministration\HojaTrabajo;
use App\Models\UserAdministration\Tarea;
use DB;

/**
 * Convierte un documento google docs en una pagina dinamica con vuejs
 *
 * @author davidcallizaya
 */
class GTemplate
{
    const SHORT_CUTS = [
        'ch()' => 'check(✔|✕|N/A)',
        '✔/✕' => '[check*=check(✔|✕|N/A)]',
        '&#10004;/&#10005;' => '[check*=check(✔|✕|N/A)]',
        '[texto()]' => '[texto*=texto()]',
    ];
    const REGEXP_VARIABLE = '/\[([\w\*\.]+)=(\w+)\s*\(([^\]]*)\)\]/';

    private $rawContent = '';

    private $listas = [];

    public function __construct(GDrive $gdrive, $fileId)
    {
        $this->rawContent = $gdrive->getContent($fileId);
    }

    public function parseVariables(array $valores = [])
    {
        $multiples = [];
        $variables = [];
        $html = str_replace(array_keys(self::SHORT_CUTS), array_values(self::SHORT_CUTS), $this->rawContent);
        $html = preg_replace_callback(self::REGEXP_VARIABLE,
                                      function ($match) use($valores, &$variables, &$multiples) {
            $varName = $match[1];
            if (substr($varName, -1) === '*') {
                $varName = substr($varName, 0, -1);
                $multiples[$varName] = isset($multiples[$varName]) ? $multiples[$varName] + 1 : 1;
                $varName = $varName . $multiples[$varName];
            }
            if (strpos($varName, '.')>-1) {
                $names = explode('.', $varName);
                $last = count($names) - 1;
                $ref = '$variables';
                $refRef = '$variables';
                $valRef = '$valores';
                foreach($names as $i=>$singular) {
                    if ($i === 0) {
                        $plural = $this->plural($singular);
                        $ref.='['. var_export($plural, true).'][0]';
                        $refRef.='['. var_export($plural, true).']';
                        $valRef.='['. var_export($plural, true).']';
                        $child = $singular;
                        $owner = $last > 1 ? $singular : $plural;
                    } elseif ($i < $last) {
                        $plural = $this->plural($singular);
                        $ref.='['. var_export($plural, true).'][0]';
                        $child = $singular;
                        if ($i < $last - 1) {
                            $owner = $singular;
                        } else {
                            $owner = $owner . '.' . $plural;
                        }
                    } else {
                        $ref.='['. var_export($singular, true).']';
                        $varName = $child . '.' . $singular;
                    }
                }
                eval('if (isset(' . $valRef . ') && !isset(' . $refRef . ')) ' . $refRef . '= ' . $valRef . ';');
                eval('if (!isset(' . $ref . ')) ' . $ref . '= "";');
            } else {
                $variables[$varName] = isset($valores[$varName]) ? $valores[$varName] : '';
                $owner = null;
            }
            $params = $match[3];
            if ($params && strpos($params, '|')!==false) {
                $params = htmlentities(json_encode(explode('|', $params)), ENT_QUOTES);
            }
            return "<{$match[2]} v-model='{$varName}' ". ($owner ? "w-owner='{$owner}' w-child='{$child}' " : '') .
                ($params ? "v-bind:data=\"{$params}\"" : "")
                . " title='{$varName}'></{$match[2]}>";
        }, $html);
        $html = $this->addMultipleButtons($html);
        $html .= '<script>var variables = ' . json_encode($variables) . ';parent && parent.app && parent.app.variablesCargadas ? parent.app.variablesCargadas(variables):null;</script>';
        return $html;
    }

    private function addMultipleButtons($html)
    {
        return preg_replace_callback(
            '/\{\+([\w\.]+)\}/',
            function ($match) {
                $plural = $this->plural($match[1]);
                return '<a class="abutton" v-on:click="addRow(' . $plural . ', i)">+</a>' .
                    '<a class="abutton" v-if="' . $plural . '.length>1" class="button" v-on:click="removeRow(' . $plural . ', i)">x</a>';
            },
            $html
        );
    }

    /**
     * Remove the add buttons from view.
     *
     * @param string $html
     *
     * @return string
     */
    private function removeMultipleButtons($html)
    {
        return preg_replace_callback(
            '/\{\+([\w\.]+)\}/',
            function ($match) {
                $plural = $this->plural($match[1]);
                return '';
            },
            $html
        );
    }

    private function parseMultipleRows($html, $valores, &$variables, &$multiples, $loader='loadHTML') {
        $html = preg_replace_callback(self::REGEXP_VARIABLE,
                                      function ($match) use($valores, &$variables) {
            $varName = $match[1];
            if (strpos($varName, '.')>-1) {
                $names = explode('.', $varName);
                $last = count($names) - 1;
                $ref = '$variables';
                $refRef = '$variables';
                $valRef = '$valores';
                foreach($names as $i=>$singular) {
                    if ($i === 0) {
                        $plural = $this->plural($singular);
                        $ref.='['. var_export($plural, true).'][0]';
                        $refRef.='['. var_export($plural, true).']';
                        $valRef.='['. var_export($plural, true).']';
                        $child = $singular;
                        $owner = $last > 1 ? $singular : $plural;
                    } elseif ($i < $last) {
                        $plural = $this->plural($singular);
                        $ref.='['. var_export($plural, true).'][0]';
                        $child = $singular;
                        if ($i < $last - 1) {
                            $owner = $singular;
                        } else {
                            $owner = $owner . '.' . $plural;
                        }
                    } else {
                        $ref.='['. var_export($singular, true).']';
                        $varName = $child . '.' . $singular;
                    }
                }
                eval('if (isset(' . $valRef . ') && !isset(' . $refRef . ')) ' . $refRef . '= ' . $valRef . ';');
                eval('if (!isset(' . $ref . ')) ' . $ref . '= "";');
            } else {
                //$variables[$varName] = isset($valores[$varName]) ? $valores[$varName] : '';
                $owner = null;
            }
            $params = $match[3];
            if ($params && strpos($params, '|')!==false) {
                $params = htmlentities(json_encode(explode('|', $params)), ENT_QUOTES);
            }
            return $owner ? "<span w-owner='{$owner}' w-child='{$child}'>{$match[0]}</span>" : $match[0];
        }, $html);
        $dom = new \DomDocument;
        $dom->$loader($html);
        $xpath = new \DomXpath($dom);
        $trs = [];
        $changed = true;
        while($changed) {
            $elements = $xpath->query("//span[@w-owner]");
            $changed = false;
            foreach ($elements as $element) {
                $plural = $element->getAttribute("w-owner");
                $singular = $element->getAttribute("w-child");
                $element->removeAttribute("w-owner");
                $element->removeAttribute("w-child");
                $tr = $element->parentNode;
                while ($tr && strtoupper($tr->nodeName) !== 'TR') {
                    $tr = $tr->parentNode;
                }
                if ($tr && $tr !== $dom->firstChild) {
                    $tr->setAttribute('w-plural', $plural);
                    $tr->setAttribute('w-singular', $singular);
                    $this->renderFoEach($tr, $singular, $plural, $valores, $variables, $multiples);
                    $changed = true;
                    break;
                }
            }
        }
        return $dom->saveHTML();
    }
    
    private function renderFoEach(\DOMElement $tr, $singular, $plural, $valores, &$variables, &$multiples)
    {
        $tr->removeAttribute('w-plural');
        $tr->removeAttribute('w-singular');
        $htmlBase = $tr->ownerDocument->saveXML($tr);
        $refNode = $tr->nextSibling;
        foreach(array_get($valores, $plural, []) as $fila) {
            $valores2 = $valores;
            array_set($valores2, str_singular($plural), $fila);
            $html = $this->parseMultipleRows($htmlBase, $valores2, $variables, $multiples, 'loadXML');
            $html =  $this->parseInnerValores($valores2, $html, $variables, $multiples);
            $container = new \DOMDocument;
            $container->loadXML($html);
            $tr->parentNode->insertBefore(
                $tr->ownerDocument->importNode($container->documentElement, true),
                $refNode
            );
        }
        $parent = $tr->parentNode;
        $tr->parentNode->removeChild($tr);
    }
    
    private function plural($singular)
    {
        $lastLetter = strtolower(substr($singular, -1));
        return in_array($lastLetter, ['a', 'e', 'i', 'o', 'u']) ? $singular . 's' : $singular . 'es';
    }

    public function parseValores(array $valores = [])
    {
        $variables = [];
        $multiples = [];
        $html = str_replace(array_keys(self::SHORT_CUTS), array_values(self::SHORT_CUTS), $this->rawContent);
        $html = $this->parseMultipleRows($html, $valores, $variables, $multiples);
        $html =  $this->parseInnerValores($valores, $html, $variables, $multiples);
        $html = $this->removeMultipleButtons($html);
        $html .= '<script>var variables = ' . json_encode($variables) . ';parent && parent.app && parent.app.variablesCargadas ? parent.app.variablesCargadas(variables):null;</script>';
        return $html;
    }

    public function parseInnerValores(array $valores = [], $html, &$variables, &$multiples)
    {
        $html = preg_replace_callback(self::REGEXP_VARIABLE,
                                      function ($match) use($valores, &$variables, &$multiples) {
            $varName = $match[1];
            if (substr($varName, -1) === '*') {
                $varName = substr($varName, 0, -1);
                $multiples[$varName] = isset($multiples[$varName]) ? $multiples[$varName] + 1 : 1;
                $varName = $varName . $multiples[$varName];
            }
            $variables[$varName] = isset($valores[$varName]) ? $valores[$varName] : '';
            $params = $match[3];
            if ($params && strpos($params, '|')!==false) {
                $params = htmlentities(json_encode(explode('|', $params)), ENT_QUOTES);
            }
            $valor = array_get($valores, $varName, '');
            if ($match[2] === 'lista') {
                $lista = $this->loadLista($match[3]);
                $valor = @$lista[$valor];
            }
            if ($match[2] === 'enlace') {
                $enlace = json_decode($valor);
                if ($enlace) {
                    $link = str_replace('/documentacion/', '/pdfhl/view/', $enlace->file);
                    $valor = '<a href="'. htmlentities($link, ENT_QUOTES).'" target="_blank">'.$enlace->text.'</a>';
                } else {
                    $valor = '';
                }
            }
            return $valor;
        }, $html);
        return $html;
    }

    private function loadLista($name)
    {
        if (isset($this->listas[$name])) {
            return $this->listas[$name];
        }
        if ($name==='empresas') {
            $this->listas[$name] = [];
            foreach (DB::select('select id, nombre_empresa from adm_empresas') as $row) {
                $this->listas[$name][$row->id * 1] = $row->nombre_empresa;
            }
            return $this->listas[$name];
        }
        if ($name==='firmas') {
            $this->listas[$name] = [];
            foreach (DB::select('select id, nombre_empresa from adm_firmas') as $row) {
                $this->listas[$name][$row->id * 1] = $row->nombre_empresa;
            }
            return $this->listas[$name];
        }
    }

    /**
     * Parse hoja de trabajo
     *
     * @param HojaTrabajo $hojaTrabajo
     * @return type
     */
    public function parse(HojaTrabajo $hojaTrabajo = null)
    {
        return $this->parseVariables($hojaTrabajo ? $hojaTrabajo->valores : []);
    }
}
