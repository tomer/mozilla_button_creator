<?php // first commit

//http://www.mozilla.com/includes/product-details/json/firefox_primary_builds.json
//http://www.mozilla.com/includes/product-details/json/firefox_versions.json


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

print_r($data->data);

$template = new Template($data->data);

//print $template->replace("Latest Hebrew version of Firefox is {{he.LATEST_FIREFOX_VERSION.Windows.version}}.");

foreach (FileUtils::listFiles($config('templates_dir')) as $filename) {
    printerr("Processing file ". basename($filename) ."...");
    $out = $template->replace(file_get_contents($filename));
    file_put_contents ($config('target_dir') .'/'. basename($filename), $out);
}

//$feed = new MozillaVersionData("http://www.mozilla.com/includes/product-details/json/firefox_primary_builds.json", "http://www.mozilla.com/includes/product-details/json/firefox_versions.json");
//$feed = new MozillaVersionData("firefox_primary_builds.json", "firefox_versions.json");

//print_r($feed->foo());

//print_r($feed->foo());

//print_r($feed->builds['he']);
