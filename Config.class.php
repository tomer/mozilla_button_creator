<?php
require_once("common.inc.php");
class Config {
    public $config = array();
    
    public function __construct($iniFile = 'config.ini') {

        $args = $this->parse_argv();
        if (isset($args['config']))     $this->parseIniFile($args['config']);
        else if (file_exists($iniFile)) $this->parseIniFile($iniFile);
        
        //print_r($this->config);
    }
    
    public function parseIniFile($iniFile = null) {
        printerr ("Parsing ini file '$iniFile'...");
        if ($iniFile == null) return; 
        else if (file_exists($iniFile)) {
            $tmp = parse_ini_file($iniFile);
            $this->config = array_merge($this->config, $tmp);
            
        }
        else printerr ("Unable to parse ini file '$iniFile'.");
    }
    
    public function parse_argv() {
        $shortopts  = "";
        //$shortopts .= "c:";  // Required value
        //$shortopts .= "v::"; // Optional value
        //$shortopts .= "v"; // These options do not accept values

        $longopts  = array(
            "config:",     // Required value
            "tag_feed:", "builds_feed:", 
        //    "config::",        // Optional value
        //    "option",        // No value
           "verbose",           // No value
        );
        $options = getopt($shortopts, $longopts);
        
        //print_r($options);
        
        $this->config = array_merge($this->config, $options);
        return $options;
        
    }
    
    public function __invoke($key) {
        if (isset($this->config[$key])) return $this->config[$key];
        else return null;
    }
}
/*
$c = new Config('config.ini');

print_r($c('tags_feed'));*/
