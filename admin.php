<?php
session_start();
?>
<form method="post">
    <input type="password" placeholder="password" name="passwd">
    <input type="submit" value="verify">
</form>
<?php
$conf = json_decode(file_get_contents("config.json"),true);
if (isset($_POST["passwd"])) {
if(password_verify($_POST["passwd"],$conf["password-hash"])){
    $_SESSION['passwd']=$_POST["passwd"];
    echo "<script>window.location.href=\"manage.php\"</script>";
};

};
