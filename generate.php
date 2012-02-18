<?php 

require_once("common.inc.php");
require_once("Config.class.php");
require_once("MozillaVersionData.class.php");
require_once("Templating.class.php");

$config = new Config();

$data = new MozillaVersionData($config('builds_feed'), $config('tags_feed'));

$i = 0; 

while ($config("builds_feed_$i") != null && $config("tags_feed_$i") != null) {
    $data->addFeed($config("builds_feed_$i"), $config("tags_feed_$i"));
    $i++;
}


$template = new Template($data->data);


foreach (FileUtils::listFiles($config('templates_dir')) as $filename) {
    printerr("Processing file ". basename($filename) ."...");
    $out = $template->replace(file_get_contents($filename));
    file_put_contents ($config('target_dir') .'/'. basename($filename), $out);
}
