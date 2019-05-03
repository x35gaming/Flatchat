<?php
session_start();
?>
<form method="post">
    <input type="password" placeholder="password" name="passwd">
    <input type="submit" value="go">
</form>
<?php
if (isset($_POST["passwd"])) {
echo password_hash($_POST["passwd"],1);
};
