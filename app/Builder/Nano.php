<?php

namespace App\Builder;
use V8Js;

/**
 * Description of Nano
 *
 * @author davidcallizaya
 */
class Nano
{

    /**
     * Load a code.
     *
     * @param type $code
     * @param type $filename
     * @throws \Exception
     */
    public function __construct($filename, $code=null)
    {
        $this->filename = $filename;
        if ($code===null) {
            $this->code = file_get_contents($filename);
        }
        $tokens = token_get_all($this->code);
        $phpCode = null;
        $xmlCode = '';
        foreach ($tokens as $t) {
            if (is_array($t)) {
                if (T_INLINE_HTML === $t[0]) {
                    $xmlCode.=$t[1];
                } elseif (T_OPEN_TAG === $t[0]) {
                    $tagName = $t[1];
                    $phpCode = '';
                } elseif (T_CLOSE_TAG === $t[0]) {
                    if ($tagName==='<?') {
                        $xmlCode.= $tagName.$phpCode.$t[1];
                    } else {
                        $lines = substr_count($phpCode, "\n") + 1;
                        $xmlCode.=htmlentities(
                                'PhpCode('.json_encode(['code' => $phpCode]).')',
                                                       ENT_NOQUOTES, 'utf-8').
                            str_repeat("\n", $lines);
                    }
                } else {
                    $phpCode.=$t[1];
                }
            } else {
                $phpCode.=$t;
            }
        }
        $dom = new \DOMDocument;
        try {
            $dom->loadXML($xmlCode);
        } catch (\Exception $e) {
            echo "Error in $filename: \n$xmlCode";
            throw $e;
        }
        $this->dom = $dom;
        $v8 = new V8Js("PHP");
        $this->v8 = $v8;
        $v8->log = function() {
            call_user_func_array('dump', func_get_args());
        };
        $v8->create = function ($class, $config) {
            return new $class($config);
        };
        foreach (glob(base_path().'/nano/base/Nano.js') as $filename) {
            $v8->executeString(file_get_contents($filename), $filename);
        }
    }

    /**
     * Build the code.
     */
    public function build()
    {
        foreach ($this->dom->getElementsByTagName('script') as $script) {
            $this->v8->executeString(
                str_repeat("\n", $script->getLineNo() - 1).
                $script->nodeValue, $this->filename
            );
        }
    }
}
