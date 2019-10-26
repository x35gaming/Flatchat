<?php
/*
 * flatchat
 * flat file php cms/forum/chat all in one
 * 
 * (C) X35gaming, under GNU GPL-v3
 * */
//ajax chat panel
$page_type="chat";
$conf;        // declare vars
$Parsedown;   // 

$conf = json_decode(file_get_contents("../config.json"),true); // load config file.
function joinToLinks($text) {
    global $links;                      // declare $links as global
    $newmain = $links.$text;            // join $text to $links as $newmain
    $links = $newmain;                  // set $links to $newmain

};
$customlinks = $conf["links"];
foreach ($customlinks as $j){
    joinToLinks("<a class=\"myButton\" href=\"../".$j["url"]."\">"."<li>".$j["name"]."</li>"."</a>");
}

require_once("../core/php_libs/Parsedown/Parsedown.php");      // init parsedown.
$Parsedown = new Parsedown();                               // create a parsedown object to parse markdown.

require("core/flatchat_modules/plugin_support/plugins.php");


                                    // environment vars
                                    // use these in your theme for title and content.

$mainpage=""                  ;      // mainpage declaration
function joinToMain($text) {
    global $mainpage;                      // declare mainpage var
    $newmain = $mainpage.$text;            // join $text to $mainpage as $newmain
    $mainpage = $newmain;                  // set $mainpage to $newmain

};
$title = $Parsedown->line($conf["title"]);//set title 

// page formation
// <body>
joinToMain("
<div id=\"chatarea\">
<iframe src=\"ajax.php\" class=\"msgs\" frameborder=\"0\"></iframe>

<iframe src=\"addchat.php\" class=\"addmsg\" frameborder=\"0\"></iframe>
</div>
");


// </body>
                                    // theme
require("themes/".$conf["theme"]."/theme.php"); //load theme
function loadCss($file) { 
    global $conf;                      
    $style = "themes/".$conf["theme"]."/$file";          //load css files without typing the dir
    echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"$style\"></link>" ;
}
function loadJs($file) { 
    global $conf;                      
    $script = "themes/".$conf["theme"]."/$file";          //load css files without typing the dir
    echo "<script src=\"$script\"></script>" ;
}



joinToMain("chat")
?>



