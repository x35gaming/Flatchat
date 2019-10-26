<?php
"use strict";
/*
 * flatchat
 * flat file php cms/forum/chat all in one
 * 
 * (C) X35gaming, under GNU GPL-v3
 * */
// forum file

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
    joinToLinks("<a class=\"myButton\" href=\"".$j["url"]."\">"."<li>".$j["name"]."</li>"."</a>");
}

require_once("core/php_libs/Parsedown/Parsedown.php");      // init parsedown.
$Parsedown = new Parsedown();                               // create a parsedown object to parse markdown.

                                                            // env vars
$forumtitle=$conf["forumtitle"];
if (!isset($_GET["thread"])){
    require "forum/boardslist.php";
$mainpage=                                                                  // set the page content
$Parsedown->text(<<<MAINPAGECONTENT
<div class="forumhead"><h1>$forumtitle<h1></div>
<div class="forumcontent">
boards:<br>
$content</div>
MAINPAGECONTENT
);
}else{
    require "forum/viewthread.php";
    $mainpage=                                                                  // set the page content
<<<MAINPAGECONTENT
<div class="forumhead"><h1>$forumtitle<h1></div>
<div class="forumcontent">
$thread
</div>
MAINPAGECONTENT;
}
$title = $Parsedown->line($conf["title"]);                                  //set title 

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
?>

