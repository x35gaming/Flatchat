<?php
/*
 * flatchat
 * flat file php cms/forum/chat all in one
 * 
 * (C) X35gaming, under GNU GPL-v3
 * */
//ajax chat panel
$page_type="admin";
session_start();
$conf = json_decode(file_get_contents("../config.json"),true); // load config file.
// theme
function joinToLinks($text) {
    global $links;                      // declare $links as global
    $newmain = $links.$text;            // join $text to $links as $newmain
    $links = $newmain;                  // set $links to $newmain

};
$customlinks = $conf["links"];
foreach ($customlinks as $j){
    joinToLinks("<a class=\"myButton\" href=\"../".$j["url"]."\">"."<li>".$j["name"]."</li>"."</a>");
}


function loadCss($file) { 
    global $conf;                      
    $style = "../themes/".$conf["secondary-theme"]."/$file";          //load css files without typing the dir
    echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"$style\"></link>" ;
}
function loadJs($file) { 
    global $conf;                      
    $script = "../themes/".$conf["secondary-theme"]."/$file";          //load css files without typing the dir
    echo "<script src=\"$script\"></script>" ;
}
if (isset($_SESSION["passwd"])) {
    if(password_verify($_SESSION["passwd"],$conf["password-hash"])){
$conf;        // declare vars
$Parsedown;   // 
chdir("..");
require("core/flatchat_modules/plugin_support/plugins.php");
chdir("../admin/");


require_once("../core/php_libs/Parsedown/Parsedown.php");      // init parsedown.
$Parsedown = new Parsedown();                               // create a parsedown object to parse markdown.



                                    // enironment vars
                                    // use these in your theme for title and content.

$mainpage=""                  ;      // mainpage decleration
function joinToMain($text) {
    global $mainpage;                      // declare mainpage var
    $newmain = $mainpage.$text;            // join $text to $mainpage as $newmain
    $mainpage = $newmain;                  // set $mainpage to $newmain

};
$title = $Parsedown->line($conf["title"]);//set title 

// page formation
// <body>
joinToMain($Parsedown->text(file_get_contents("admin.md")));

// </body>
require("../themes/".$conf["secondary-theme"]."/theme.php"); //load theme
};}else{echo "<script> window.location.href=\"index.php\" </script>";}
?>
