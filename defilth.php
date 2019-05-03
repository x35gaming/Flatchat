<?php
function defilth($msg,$badwords){
global $conf;
$bettermsg=$msg;
$censor="*";
$nrep="";
if($conf["defilth-words"] == "true"){
foreach($badwords as $sanitize){
    $rep=str_repeat($censor,strlen($sanitize));
    unset($x);
    $cleanermsg = str_ireplace($sanitize, $rep , $bettermsg);
    $bettermsg = $cleanermsg;
    };
    return $bettermsg;
}else{return $msg;}}
?>