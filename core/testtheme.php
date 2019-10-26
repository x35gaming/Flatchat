<?php
/*
 * flatchat
 * flat file php cms/forum/chat all in one
 * 
 * (C) X35gaming, under GNU GPL-v3
 * */
$title="theme testing page"; // set title to a default
$conf = json_decode(file_get_contents("../config.json"),true); // load config file.
$mainpage=file_get_contents("testtheme.txt");// loads secondary file to reduce filesize
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
    $style = "themes/".$conf["theme"]."/$file";          //load css files without typing the dir
    echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"../$style\"></link>" ;
}
function loadJs($file) { 
    global $conf;                      
    $script = "themes/".$conf["theme"]."/$file";          //load css files without typing the dir
    echo "<script src=\"../$script\"></script>" ;
}


require("../themes/".$conf["theme"]."/theme.php"); //load theme

