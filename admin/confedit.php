<?php
session_start();
?>
<style>
block {
    float: top;
    display:block;
    border:3px solid red;
    font-family : Verdana, Geneva, sans-serif;
}
</style>
<?php

$cnf = json_decode(file_get_contents("../config.json"),true);

if (password_verify($_SESSION["passwd"],$cnf["password-hash"])){
    if (isset ($_POST["links"])){
        $newpost=$_POST;
        $newpost["links"]=json_decode($_POST["links"],true);
        $jsonpost=json_encode($newpost,JSON_PRETTY_PRINT + JSON_UNESCAPED_SLASHES);
        echo "<block>formatted output(for debug)<pre>".htmlspecialchars($jsonpost)."</pre></block>";
        file_put_contents("../config.json",$jsonpost);
        
    }//else {$_POST = $cnf;}; // put conts
    
    $conf = json_decode(file_get_contents("../config.json"),true);
    
    if ($conf["defilth-words"] == "true"){
        $defyes="checked";
        $defno="";
    } else {
        $defno="checked";
        $defyes="";
    }
    if ($conf["adminjoinmsg"] == "true"){
        $admsgyes="checked";
        $admsgno="";
    } else {
        $admsgno="checked";
        $admsgyes="";
    }
    $links= json_encode($conf["links"],JSON_PRETTY_PRINT + JSON_UNESCAPED_SLASHES);
    echo <<<CONFIGURATION_FORM
    <form method="post">
    
    <block>
    <h1>SEO</h1>
    <p> title: </p>
    <input type="text" value="{$conf["title"]}" name="title">
    <p> description: </p>
    <textarea cols="40" rows="2" name="seodesc">{$conf["seodesc"]}</textarea>
    <p> theme: </p>
    <input type="text" name="theme" value="{$conf["theme"]}">
    <p> links: </p>
    <textarea cols="40" rows="10" type="text" name="links">{$links}</textarea>
    <p> footer: </p>
    <textarea cols="40" rows="10" type="text" name="footertext">{$conf["footertext"]}</textarea>
    </block>
    
    <block>
    <h1>Admin Account</h1>
    <p> name: </p>
    <input type="text" name="adminuser" value="{$conf["adminuser"]}">
    <p> hash: </p>
    <input type="text" name="password-hash" value="{$conf["password-hash"]}"><br>generate a hash:<br>
    <iframe width="320" height="100" frameborder="0" style="display:inline" src="passhash.php"></iframe>
    </block>
    
    <block>
    <h1>chat</h1>
    <p> block <b>swear words</b>: </p>
    <input type="radio" name="defilth-words" value="true" $defyes> Yes<br>
    <input type="radio" name="defilth-words" value="false" $defno> No<br>
    <p> forum name: </p>
    <input type="text" name="forumtitle" value="{$conf["forumtitle"]}">
    <p>admin join msgs:</p>
    <input type="radio" name="adminjoinmsg" value="true" $admsgyes> Yes, annoy me!<br>
    <input type="radio" name="adminjoinmsg" value="false" $admsgno> No<br>
    </block>
    <block>
    <input type="submit" value="apply">
    </block>
    </form>
CONFIGURATION_FORM;
};
?>

