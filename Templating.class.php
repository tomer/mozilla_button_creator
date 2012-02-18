<?php
require_once("common.inc.php");

class Template { 
    private $replacements = array();
    function __construct($arr = array()) {
        $this->replacements = $arr;
        //print_r($this->replacements);
    }

    function parse($infile, $outfile) {
        
    }
    
    function replace_callback($matches) {    
        //[0] => {{keyword}}
        //[1] => keyword

        return $this->convert_keyword($matches[1]);
    }
    
    function arraykey_strtolower ($in) {
        $out = array();
        foreach ($in as $key=>$val) {
            $key = strtolower($key);
            $out[$key] = $val;
        }
        return $out;
    }
    
    function convert_keyword($keyword) {
        printerr ("Found keyword '$keyword'.");
        $keywords = explode('.', $keyword);
        //$keywords = $this->arraykey_strtolower($keywords);
        
        switch (count($keywords)) {
            case 1: return $this->replacements[$keywords[0]]; break;
            case 2: return $this->replacements[$keywords[0]][$keywords[1]]; break;
            case 3: return $this->replacements[$keywords[0]][$keywords[1]][$keywords[2]]; break;
            case 4: return $this->replacements[$keywords[0]][$keywords[1]][$keywords[2]][$keywords[3]]; break;
            case 5: return $this->replacements[$keywords[0]][$keywords[1]][$keywords[2]][$keywords[3]][$keywords[4]]; break;
            case 0: 
            default: return; break;
        }
        
    }
    
    
    function replace($subject) {
        $pattern = "|\n?\{\{([a-zA-Z0-9_\.]*)\}\}\n?|";
        $out = preg_replace_callback($pattern, array($this, 'replace_callback'), $subject);    
        return $out;
    }
}



class FileUtils {
    function __construct() {
    }
    
    function listFiles($dir, $pattern = '*.tpl') {
        return glob($dir .'/'. $pattern);
    }
}

/*
$replacements = array("hello"=> array("foo"=> "Tomer"), "woRlD"=>array("bar"=>"Cohen"));

$t = new Template($replacements);

$s = "{{hello.foo}} {{woRlD.bar}}!";

print ($t->replace($s));


print("\n");*/
