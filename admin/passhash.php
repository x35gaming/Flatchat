<?php
/*
* flatchat
* flat file php cms/forum/chat all in one
* 
* (C) X35gaming, under GNU GPL-v3
* */
session_start();
$conf = json_decode(file_get_contents("../config.json"),true); // load config file.
if (isset($_SESSION["passwd"])) {
    if(password_verify($_SESSION["passwd"],$conf["password-hash"])){
        $conf;        // declare vars
        echo '
        <form method="post">
            <input type="password" placeholder="password" name="passwd">
            <input type="submit" value="go">
        </form>
        ';
        if (isset($_POST["passwd"])) {
            $conf['password-hash'] = password_hash($_POST["passwd"],1);
            $newpost=$conf;
            file_put_contents("../config.json", json_encode($newpost,JSON_PRETTY_PRINT + JSON_UNESCAPED_SLASHES));
            echo "hash changed successfully";
        }
    }
}
