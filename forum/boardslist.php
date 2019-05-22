<?php
/*
* flatchat
* flat file php cms/forum/chat all in one
* 
* (C) X35gaming, under GNU GPL-v3
* */
$content="";
$boardslist=json_decode(file_get_contents("forum/forum.json"),true);
function wrtln($txt="") {global $content;$content.=$txt;}
wrtln("<!-- boards --><pre>");
foreach($boardslist as $brdid => $brdprop){
    wrtln($brdid." : ".htmlspecialchars($brdprop["msgs"][count($brdprop["msgs"])-1][0]." : ".$brdprop["msgs"][count($brdprop["msgs"])-1][1]));
}
wrtln("</pre>");
?>