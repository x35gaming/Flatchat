<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="">
<!--<![endif]-->

<head>
<meta charset="utf-8">
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $conf["title"];?></title><?php
loadcss("style.css");
loadcss("css/bootstrap.min.css");
loadcss("css/flexslider.css");
loadcss("css/jquery.fancybox.css");
echo "<style>";
include("css/main.css.php");
echo "</style>";
loadcss("css/responsive.css");
loadcss("css/font-icon.css");
loadcss("css/animate.min.css");
loadcss("prism.css");
loadjs("prism.js");

?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
</head>

<body>
<!-- header section -->
<section class="banner" role="banner">
  <header id="header">
    <div class="header-content clearfix" > <a class="logo" href="index.php" style="mix-blend-mode:darken"><?php echo $conf["title"];?></a>
      <nav class="navigation" role="navigation">
        <ul class="primary-nav">
          <?php echo $links?>
        </ul>
      </nav>
      <a href="#" class="nav-toggle">Menu<span></span></a> </div>
  </header>
  <!-- banner text -->
  <div class="container">
    <div class="col-md-10 col-md-offset-1" style="mix-blend-mode:hard-light">
      <div class="banner-text">
        <?php echo $mainpage?>
      </div>
    </div>
  </div>
</section>
<!-- header section --> 
<!-- intro section -->

<!-- Footer section -->
<footer class="footer">
  <div class="footer-top section">
    <div class="container">
      <div class="row">
        <div class="footer-col col-md-6">
          <?php echo $Parsedown->text($conf["footertext"])?>
        </div>
          <p>
            powered by flatchat... <?php if($page_type == "main") {echo "<a href=\"admin/\">Admin Panel</a>";} else {echo "<a href=\"../admin/\">Admin Panel</a>";} ?>
            
          </p>
        <div class="footer-col col-md-3">
          <?php echo $links;?>
        </div>
        <div class="footer-col col-md-3">
        </div>
      </div>
    </div>
  </div>
  <!-- footer top --> 
  
</footer>
<!-- Footer section --> 
<!-- JS FILES --> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 
<?php
loadjs("js/bootstrap.min.js");
loadjs("js/jquery.flexslider-min.js");
loadjs("js/jquery.fancybox.pack.js");
loadjs("js/retina.min.js");
loadjs("js/modernizr.js");
loadjs("js/main.js");
loadjs("./themes/lexis/js/jquery.contact.js");
if ($page_type="admin"){
  echo <<<STYLING
  <style>
    background: white;
  </style>
  STYLING;
}
?>
</body>
</html>