<?php
/*
 * flatchat
 * flat file php cms/forum/chat all in one
 * 
 * (C) X35gaming, under GNU GPL-v3
 * */
// main file

$conf;        // declare vars
$Parsedown;   // 

$conf = json_decode(file_get_contents("config.json"),true); // load config file.
function joinToLinks($text) {
    global $links;                      // declare $links as global
    $newmain = $links.$text;            // join $text to $links as $newmain
    $links = $newmain;                  // set $links to $newmain

};
$customlinks = $conf["links"];
foreach ($customlinks as $j){
    joinToLinks("<a class=\"myButton\" href=\"".$j["url"]."\">".$j["name"]."</a> ");
}


require_once("core/php_libs/Parsedown/Parsedown.php");      // init parsedown.
$Parsedown = new Parsedown();                               // create a parsedown object to parse markdown.



                                    // enironment vars
                                    // use these in your theme for title and content.

$mainpage = $Parsedown->text(file_get_contents("pages/"."index".".md"));    // before the $_GET["page"] is not set.
if (isset($_GET["page"])) {                                                 // set page if $_GET["page"] is set.
    if (file_exists("pages/".$_GET["page"].".md")) {
$mainpage= $Parsedown->text(file_get_contents("pages/".$_GET["page"].".md")); 
}else{$mainpage=
    $Parsedown->text(
    "<div class=\"red\"><h1> error 404</h1></div>\n### page missing or deleted\n##### did the creeper blow it up?\n### [back to home](index.php)
    ");}};
$title = $Parsedown->line($conf["title"]);                                  //set title 

                                    // theme
require("themes/".$conf["theme"]."/theme.php"); //load theme
function loadCss($file) { 
    global $conf;                      
    $style = file_get_contents("themes/".$conf["theme"]."/$file");          //load css files without typing the dir
    echo "<style>$style</style>" ;
}


?>
