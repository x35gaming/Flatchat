<?php
/*
 * flatchat
 * flat file php cms/forum/chat all in one
 * 
 * (C) X35gaming, under GNU GPL-v3
 * */
// admin chats display
session_start();
$conf = json_decode(file_get_contents("../config.json"),true); // converts the chat.json file into an array
if (password_verify($_SESSION["passwd"],$conf["password-hash"])) {//check passwd
require_once("../core/php_libs/Parsedown/Parsedown.php");      // init parsedown.
$Parsedown = new Parsedown();                               // create a parsedown object to parse markdown.
$count=1;
$chats = json_decode(file_get_contents("../chats/chats.json"),true); // converts the chat.json file into an array
foreach($chats as $i) { //loop through $chats and convert to html
    echo("<div class=\"message\"> <b> <div class=\"user\">". $Parsedown->line(htmlspecialchars($i["user"]))."</b>:"); // USERNAME
    echo("</div><div class=\"msg\">" . $Parsedown->text(str_replace("\r\n","\r\n<br>",htmlspecialchars($i["msg" ]))). "<div class=\"msgid\">id:$count</div>");               // Message

    require("../core/admin/assets/delmsg.php");
    echo"</div></div>"; // close the chats div
    $count++;
};};
?>
