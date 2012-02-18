<?php
require_once("common.inc.php");

class MozillaVersionData {

    public $tags;
//    private $builds;
    public $versions;
    
    public $data = array();
    
    function __construct ($buildsFeed, $tagsFeed) {
        //print ("$buildsFeed, $tagsFeed");
        
        //print_r ($this->fetch_json($tagsFeed));
        
        //$this->versions = $this->fetch_json($tagsFeed);
        //$this->builds   = $this->fetch_json($buildsFeed);
        
        $this->addFeed($buildsFeed, $tagsFeed);
        
        //print_r($this->data);
        
    }
    
    public function addFeed($buildsFeed = null, $tagsFeed = null) {
        if ($buildsFeed != null && $tagsFeed != null) {
            $data = $this->build_array($buildsFeed, $tagsFeed);
            $this->data = array_merge($this->data, $data);
        }
    }
    
    private function build_array($buildsFeed, $tagsFeed) {
        $tags     = $this->fetch_json($tagsFeed);
        $builds   = $this->fetch_json($buildsFeed);
        
        $this->tags = $tags;
        
        $ftags = array_flip($tags);
                

        $out = array();
        
        printerr ("Total ". count(array_keys($builds)) ." languages");

        foreach (array_keys($builds) as $lang) {
            printerr("Processing $lang...");
                    
            foreach (array_keys($builds[$lang]) as $ver) {
                if (isset($ftags[$ver])) {
                    $out[$lang][$ftags[$ver]] = $builds[$lang][$ver];
                    foreach ($out[$lang][$ftags[$ver]] as $os => $value) {
//                        print("$key->$value\n"); print_r($value);
                        $out[$lang][$ftags[$ver]][$os]['version'] = $ver;
                    }
                }
                else printerr("No tag for version $value-$lang!");
            }
        }
        
        return $this->cleanup($out);
        
    }
    
    /*private function cleanup($input) {
        //$output = $input;
    
        foreach ($input as $key=>$val) {
            $key = strtolower($key);
            if (is_array($val)) $output[$key] = $this->cleanup($val);
            else $output[$key] = $val;
        }
        
        return $output;
    }*/
    
    function cleanup($in) {
    //function arraykey_strtolower ($in) {
        $out = array();
        foreach ($in as $key=>$val) {
            $key = strtolower($key);
            $key = str_replace(' ', '', $key);
            
            if (is_array($val)) $out[$key] = $this->cleanup($val);
            else $out[$key] = $val;
        }
        return $out;
    }
    
    private function fetch_json($url) {
        printerr ("Fetching feed ". basename($url) ."...");    
    
        $file = file_get_contents($url);
        
        return json_decode ($file, TRUE);
    }
}

