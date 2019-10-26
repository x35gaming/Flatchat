<?php
session_start();
$conf = json_decode(file_get_contents("../config.json"),true);
if (isset($_POST["removeid"])){
    if (isset($_SESSION["passwd"])) {
        if(password_verify($_SESSION["passwd"],$conf["password-hash"])){
        $getridof = $_POST["removeid"];
        $kill = $getridof - 1;
        $keep = $getridof;
        $array = json_decode(file_get_contents("chats.json"),true);
        $array2 = array_slice($array,0,$kill);
        $array3 = array_slice($array,$keep);
        $array4 = array_merge($array2, $array3);
        // echo json_encode($array4);
        file_put_contents("chats.json", json_encode($array4));
        echo 'DONE!<br><script>window.location.href = \'../admin/adminajax.php\';</script>';
        }
    }
}
?>