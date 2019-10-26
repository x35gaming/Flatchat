<?php
session_start();
$conf = json_decode(file_get_contents("../config.json"),true);
if (isset($_SESSION["passwd"])) {
if(password_verify($_SESSION["passwd"],$conf["password-hash"])){
if(isset($_POST["clear"])){
file_put_contents("chats.json", '
[
    {
        "user": "",
        "msg": "This is the beginning off your *message* history"
    }
]
');
echo 'DONE';
};
echo '<form method="post"><input type="hidden" name="clear" value="clear"><input type="submit" value="Clear Chat"></form>';
;};};
?>