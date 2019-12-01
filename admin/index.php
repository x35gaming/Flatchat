<?php
session_start();
?>
<html>

<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Flatchat login</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU"
crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
<link rel="stylesheet" href="login.css">
</head>

<body>

<div id="form_wrapper">
<div id="form_left">
<img src="icon.png" alt="computer icon">
</div><form method="post">
<div id="form_right">
<h1>Admin Login</h1>
<div class="input_container">
<i class="fas fa-user"></i>
<input placeholder="Username" type="text" name="Username" id="field_email" class='input_field'>
</div>
<div class="input_container">
<i class="fas fa-lock"></i>
<input  placeholder="Password" type="password" name="Password" id="field_password" class='input_field'>
</div>
<input type="submit" value="Login" id='input_submit' class='input_field'>
<span id='create_account'>
<a href="./manage.php">Log in via session &rsaquo;&rsaquo;&rsaquo; </a><br>
<a href="../">&lsaquo;&lsaquo;&lsaquo; Back to home </a>
</span>
</form></div>
</div>

</body>

</html>
<?php
$conf = json_decode(file_get_contents("../config.json"),true);
if (isset($_POST["Username"])) {
    if ($_POST["Username"] == $conf["adminuser"]) {
        if (isset($_POST["Password"])) {
            if(password_verify($_POST["Password"],$conf["password-hash"])){
                $_SESSION['passwd']=$_POST["Password"];
                echo "<script>window.location.href=\"./manage.php\"</script>";
            };
        }
    }
};
