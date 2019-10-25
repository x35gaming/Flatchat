<?php
/*
* flatchat
* flat file php cms/forum/chat all in one
* 
* (C) X35gaming, under GNU GPL-v3
* */
// chats display
$conf = json_decode(file_get_contents("config.json"),true);     // load config file.

require_once("defilth.php");                                    // init Defilth module.
$bannedwords=explode(",",file_get_contents("bannedwords.array"));// set banned words list for defilth module

require_once("core/php_libs/Parsedown/Parsedown.php");          // init parsedown.
$Parsedown = new Parsedown();                                   // create a parsedown object to parse markdown.
$count=1;
$chats = json_decode(file_get_contents("chats/chats.json"),true); // converts the chat.json file into an array
foreach($chats as $i) { //loop through $chats and convert to html
    
    echo("<div class=\"message\"> <b> <div class=\"user\">". defilth($Parsedown->line(htmlspecialchars($i["user"])),$bannedwords)."</b>:"); // USERNAME
    echo("</div><div class=\"msg\">" . defilth($Parsedown->text(str_ireplace("\r\n","\r\n<br>",htmlspecialchars($i["msg" ]))),$bannedwords). "<div class=\"msgid\">id:$count</div></div></div>");               // Message

    $count++;
}

?>
