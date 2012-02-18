
<p>The following script meant to generate static code containing some data about Firefox/Thunderbird versions. We are doing this in order to require less manual editing on remote websites. 
</p>
<p><table id="toc" class="toc" summary="Contents"><tr><td><div style="font-weight:bold">Table of Contents</div><ul><ul><li><a href="#Requirements">Requirements</a></li><li><a href="#Installation">Installation</a></li><li><a href="#Usage">Usage</a></li><li><a href="#Creating_templates">Creating templates</a></li><li><a href="#Contact">Contact</a></li></ul></ul></td></tr></table><h2><span class="mw-headline" id="Requirements"><a name="Requirements">Requirements</a></span></h2>
</p>
<p>In order to get the script running, PHP 5.3 is a most. Also we've made our best to keep it simple as possible, so there is no additional libraries required. 
</p>
<p><h2><span class="mw-headline" id="Installation"><a name="Installation">Installation</a></span></h2>
</p>
<p>Clone the repository to a local directory on your site. It doesn't meant to sit inside a web-accessible directory, and meant to run directly from the CLI. 
</p>
<p>The file config.ini contain some important preferences, including from where to fetch the feeds and the location of the templates directory, and the location of the target directory for the generated files.
</p>
<p>Please note that you can specify the config file using the --config parameter. 
</p>
<p><h2><span class="mw-headline" id="Usage"><a name="Usage">Usage</a></span></h2>
</p>
<p>Run php generate.php from the CLI, than watch the generated files in the output subdirectory. 
</p>

<p><h2><span class="mw-headline" id="Creating_templates"><a name="Creating_templates">Creating templates</a></span></h2>
</p>
<p>By default, the template keywords are the indexes of the replacements array, and the values are the replacment strings. Multidimentional arrays are translated to dots and array keys are replaced to lowercase characters without spaces. Please watch the bundeled examples for some inspiration. 
</p>

<p><h2><span class="mw-headline" id="Contact"><a name="Contact">Contact</a></span></h2>
</p>
<p>Tomer Cohen, <a href="http://tomercohen.com">http://tomercohen.com</a></p>
