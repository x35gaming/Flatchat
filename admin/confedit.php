<?php
session_start();
?>
<style>
  .tooltip {
    position: relative;
    display: inline-block;
    border-bottom: 1px dotted black;
  }
  .tooltip
  .tooltip .tooltiptext {
    visibility: hidden;
    width: 120px;
    background-color: #555;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px 0;
    position: absolute;
    z-index: 1;
    bottom: 125%;
    left: 50%;
    margin-left: -60px;
    opacity: 0;
    transition: opacity 0.3s;
  }

  .tooltip .tooltiptext::after {
    content: "";
    position: absolute;
    top: 100%;
    left: 50%;
    margin-left: -5px;
    border-width: 5px;
    border-style: solid;
    border-color: #555 transparent transparent transparent;
  }

  .tooltip:hover .tooltiptext {
    visibility: visible;
    opacity: 1;
  }
  input[type=submit]:hover {
    background-color: #45a049;
  }
  html{
      background:gray;
      color:#555;
  }
  h1{
      color:#333;
  }
  input[type=text], select, textarea {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
  }
  input[type=submit] {
    width: 100%;
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }
  block {
      float: top;
      display:block;
      border:3px ridge #666;
      font-family : Verdana, Geneva, sans-serif;
      padding:10px;
      border-radius:10px;
      background:rgb(230,230,230);
  }
</style>
<?php

$cnf = json_decode(file_get_contents("../config.json"),true);

if (password_verify($_SESSION["passwd"],$cnf["password-hash"])){
    if (isset ($_POST["links"])){
        $newpost=$_POST;
        $newpost["links"]=json_decode($_POST["links"],true);
        $jsonpost=json_encode($newpost,JSON_PRETTY_PRINT + JSON_UNESCAPED_SLASHES);
        if ($cnf['verbose']) {echo "<block>formatted output(for debug)<pre>".htmlspecialchars($jsonpost)."</pre></block>";};
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
    };
    if ($conf["defilth-words-admin"] == "true"){
        $admdefilthyes="checked";
        $admdefilthno="";
    } else {
        $admdefilthno="checked";
        $admdefithyes="";
    };
    $directory = '../themes';
    $scanned_directory = array_diff(scandir($directory), array('..', '.'));
    $available = "<select name=\"theme\">\r\n<option value=\"{$conf["theme"]}\">select a theme</option>\r\n";
    foreach ($scanned_directory as $nnn => $themename) {
    $available .= "<option  value=\"$themename\">$themename</option>\r\n";
    };
    $available .= "</select>\r\n";

    $available2 = "<select name=\"secondary-theme\">\r\n<option value=\"{$conf["secondary-theme"]}\">select a theme</option>\r\n";
    foreach ($scanned_directory as $nnn => $themename) {
    $available2 .= "<option  value=\"$themename\">$themename</option>\r\n";
    };
    $available2 .= "</select>\r\n";

    $links= json_encode($conf["links"],JSON_PRETTY_PRINT + JSON_UNESCAPED_SLASHES);
    echo <<<CONFIGURATION_FORM
    <form method="post">
    
    <block>
    <h1>SEO</h1>
    <p> Title: </p>
    <input type="text" value="{$conf["title"]}" name="title">
    <p class="tooltip"> Description: <span class="tooltiptext">a short summary of your site</span></p>
    <textarea cols="40" rows="2" name="seodesc">{$conf["seodesc"]}</textarea>
    </block>
    <br>
    <block>
    <h1> Customization </h1>
    <p class="tooltip"> Front page theme: <span class="tooltiptext">e.g a very well stylized theme for your front page</span></p>
    {$available}
    <p class="tooltip"> Alternate theme: <span class="tooltiptext">e.g a more readable theme, for docs and whatever doesnt need to be punchy</span></p>
    {$available2}
    <p class="tooltip"> Secondary theme pages: <span class="tooltiptext">a list of page ids in Json format</span></p>
    <textarea cols="40" rows="10" type="text" name="secondarypages">{$conf["secondarypages"]}</textarea>
    <p class="tooltip"> links: <span class="tooltiptext">a list of links for the top toolbar, formatted in JSON</span></p>
    <textarea cols="40" rows="10" type="text" name="links">{$links}</textarea>
    <p class="tooltip"> Footer: <span class="tooltiptext">[NOTE: only supported by some themes] text for the footer at the bottom.</span></p>
    <textarea cols="40" rows="10" type="text" name="footertext">{$conf["footertext"]}</textarea>
    <p class="tooltip"> Background image: <span class="tooltiptext">[NOTE: only some themes support this] the url for your chosen background image</span></p>
    <input type="text" name="backgroundimg" value="{$conf["backgroundimg"]}">
    </block>
    <br>
    <block>
    <h1>Admin Account</h1>
    <p> Name: </p>
    <input type="text" name="adminuser" value="{$conf["adminuser"]}">
    <input type="hidden" name="password-hash" value="{$conf["password-hash"]}"><br>generate a hash:<br>
    <iframe width="320" height="100" frameborder="0" style="display:inline" src="./passhash.php"></iframe>
    </block>
    <br>
    <block>
    <h1>Chat:</h1>
    <p> Block <b>swear words</b>: </p>
    <input type="radio" name="defilth-words" value="true" $defyes> Yes<br>
    <input type="radio" name="defilth-words" value="false" $defno> No<br>
    <p class="tooltip"> Filter swear words on admin panel: <span class="tooltiptext">Does the same as the option above, but on the admin panel</span></p><br>
    <input type="radio" name="defilth-words-admin" value="true" $admsgyes> Yes, keep me safe :)<br>
    <input type="radio" name="defilth-words-admin" value="false" $admsgno> No<br>
    <p> forum name: </p>
    <input type="text" name="forumtitle" value="{$conf["forumtitle"]}">
    <p>admin join msgs:</p>
    <input type="radio" name="adminjoinmsg" value="true" $admsgyes> Yes, annoy me!<br>
    <input type="radio" name="adminjoinmsg" value="false" $admsgno> No<br>
    </block>
    <br>
    <block>
    <h1> submit changes: </h1>
    click the <em>"apply"</em> button to save changes<br><br>
    <input type="submit" value="apply">
    </block>
    </form>
CONFIGURATION_FORM;
};
?>
