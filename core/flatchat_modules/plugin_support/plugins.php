/*
* flatchat
* flat file php cms/forum/chat all in one
* 
* (C) X35gaming, under GNU GPL-v3
* */
// plugin loader
<?php
chdir('../../../plugins');
$directory = '.';
$scndr = array_diff(scandir($directory), array('..', '.'));
foreach ($scndr as $NO => $name){
if (file_exists($name . '/plugin.json')){
    $plugin = json_decode(file_get_contents($name ."/xpluginfile"),true);
    include($name . "/" . $plugin['exec']);
    $Pluginlist .= $plugin["name"] . ", ";
}
}
?>
