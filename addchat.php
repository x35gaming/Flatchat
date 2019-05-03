<?php
/*
* flatchat
* flat file php cms/forum/chat all in one
* 
* (C) X35gaming, under GNU GPL-v3
* */
session_start();
$conf = json_decode(file_get_contents("config.json"),true);                                   // load config file.
?>
<div class="form">
<?php
if (isset($_GET["admin"]) && !isset($_POST["msg"])){
    $_POST["user"]= $conf["adminuser"];
    $_POST["msg"]="**[joined from webadmin]**";
    $user = $conf["adminuser"];
} else {
    $user = null;
};
if (isset($_GET["clearuser"])){
    unset($_SESSION["user"]);
    echo "type a new username";
}
$newmsg;
$userclear= "please enter a username"."<script> alert(".var_export("please enter a username",true).")</script>";
$passwdincorr= "this username is reserved for the webmaster, please use another one"."<script> alert(".var_export("this username is reserved for the webmaster, please use another one",true).")</script>";
$messreq="message requred"."<script> alert(".var_export("message required",true).")</script>";
$chat = json_decode(file_get_contents("chats/chats.json"),true);                               // load chats file
if (isset($_POST["user"])) { if(!$_POST["user"] == ""){
    if ($_POST["user"] !== $conf["adminuser"]) {
        $user=$_POST['user'];                                                              // set user var
        if (!isset($_SESSION["user"])){
            $user=$_POST['user'];  
            $_SESSION["user"] = $user;
        }else{
            if ($_SESSION["user"] !== $_POST["user"] && isset($_POST["user"]) && $_POST["user"] !== "") {
                $user = $_SESSION["user"];
            }else{
                $_SESSION["user"] = $user;
            }
        }
        if (!$_POST["msg"] == '') {                                                            // check for empty msg
            $newmsg=[["user" =>$_POST["user"],"msg" =>$_POST["msg"]],];                        // format the user inputted data as an array.
            $newchat = array_merge($chat,$newmsg);                                             // add the existing msgs to the new one.
            file_put_contents("chats/chats.json",json_encode($newchat,JSON_PRETTY_PRINT));     // save to chats file
        }else{
            echo $messreq;
        };
    }else{
        if (!isset($_SESSION["passwd"])){
            echo $passwdincorr;
        }else { if (password_verify($_SESSION["passwd"],$conf["password-hash"])){              // check passwd for admin users.
            $user=$_POST['user'];                                                              // set user var.
            if (!isset($_SESSION["user"])){
                $user=$_POST['user'];  
                $_SESSION["user"] = $user;
            }else{
                if ($_SESSION["user"] !== $_POST["user"] && isset($_POST["user"]) && $_POST["user"] !== "") {
                    $user = $_SESSION["user"];
                }else{
                    $_SESSION["user"] = $user;
                }
            }
            if (!$_POST["msg"] == '') {                                                        // check for empty msg
                $newmsg=[["user" =>$_POST["user"],"msg" =>$_POST["msg"]],];                    // format the user inputted data as an array.
                $newchat = array_merge($chat,$newmsg);                                         // add the existing msgs to the new one.
                file_put_contents("chats/chats.json",json_encode($newchat,JSON_PRETTY_PRINT)); // save to chats file.
            }else{
                echo $messreq;
            };
        }}
        
    }
}else{echo $userclear;}                                                          // if username is empty
}else{echo $userclear;}                                                          // <-----/
?>
<form method="post">
User: <input type="text" name="user" value="<?php echo $_SESSION["user"]?>"/>
Msg: <textarea type="text" rows="2" cols="40" name="msg"></textarea>
<input type="submit">
<a href="addchat.php?clearuser">reset username</a> <a href="addchat.php?noraml">normal mode</a></form>

</div>