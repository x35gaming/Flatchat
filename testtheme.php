<?php
/*
 * flatchat
 * flat file php cms/forum/chat all in one
 * 
 * (C) X35gaming, under GNU GPL-v3
 * */
$title="theme testing page"; // set title to a default
$conf = json_decode(file_get_contents("config.json"),true); // load config file.
$links="<a class=\"myButton\" href=\"index.php\">home</a> <a class=\"myButton\" href=\"chat.php\">chat</a>"; // inserts the links
$mainpage=file_get_contents("testtheme.txt");// loads secondary file to reduce filesize
require("themes/".$conf["theme"]."/theme.php"); //load theme

function loadCss($file) { 
    global $conf;                      
    $style = file_get_contents("themes/".$conf["theme"]."/$file");          //load css files without typing the dir
    echo "<style>$style</style>" ;
}
