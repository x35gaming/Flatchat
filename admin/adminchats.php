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
$bannedwords=explode(", ",file_get_contents("../core/flatchat_modules/noswearing/bannedwords.array"));// set banned words list for defilth module
require_once("../core/flatchat_modules/noswearing/defilth.php");                                    // init Defilth module.

if (password_verify($_SESSION["passwd"],$conf["password-hash"])) {//check passwd
require_once("../core/php_libs/Parsedown/Parsedown.php");      // init parsedown.
$Parsedown = new Parsedown();                               // create a parsedown object to parse markdown.
$count=1;
$chats = json_decode(file_get_contents("../chats/chats.json"),true); // converts the chat.json file into an array
foreach($chats as $i) { //loop through $chats and convert to html
    echo("<div class=\"message\"> <b> <div class=\"user\">". admindefilth($Parsedown->line(htmlspecialchars($i["user"])),$bannedwords)."</b>:"); // USERNAME
    echo("</div><div class=\"msg\">" . admindefilth($Parsedown->text(str_replace("\r\n","\r\n<br>",htmlspecialchars($i["msg" ]))),$bannedwords). "<div class=\"msgid\">id:$count</div>");               // Message

    require("../core/admin/assets/delmsg.php");
    echo"</div></div>"; // close the chats div
    $count++;
};};
?>
