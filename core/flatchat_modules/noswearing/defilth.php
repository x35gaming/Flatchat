<?php
/*
* flatchat
* flat file php cms/forum/chat all in one
* 
* (C) X35gaming, under GNU GPL-v3
* */
// defilther

function defilth($msg,$badwords){
    global $conf;
    $bettermsg=$msg;
    $censor="*";
    $nrep="";
    if($conf["defilth-words"] == "true"){
        global $conf;
        array_multisort(array_map('strlen', $badwords), $badwords);
        $bettermsg=$msg;
        $censor="*";
        $nrep="";
        if($conf["defilth-words"] == "true"){
            $bettermsg=str_ireplace(array_reverse($badwords), $censor,  $msg);
            return $bettermsg;
        }else{return $msg;}
    }
}
function admindefilth($msg,$badwords){
    global $conf;
    array_multisort(array_map('strlen', $badwords), $badwords);
    $bettermsg=$msg;
    $censor="*";
    $nrep="";
    if($conf["defilth-words-admin"] == "true"){
        $bettermsg=str_ireplace(array_reverse($badwords), $censor,  $msg);
        return $bettermsg;
    }
    else{
        return $msg;
    }
}
    
?>