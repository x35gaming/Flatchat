<!DOCTYPE html>
<html>
<head>
<title><?php echo $title?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php loadCss("style.css");
      loadCss("prism.css");
      loadJs("prism.js");

?>
</head>
<body>

<div class="header">
<h1><?php echo $title?></h1>
</div>

<div class="row">
<div class="col-3 menu">
<ul>
<?php echo $links?>
</ul>
</div>

<div class="col-6">
<?php echo $mainpage;   // puts the main content in
      //loadJs("highlight.js")
            ?>
</div>

<div class="col-3 right">
</div>

</div>

<div class="footer">
<p>powered by flatchat...</p>
</div>

</body>

<!-- Mirrored from www.w3schools.com/css/tryit.asp?filename=tryresponsive_mobilefirst by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 13 Mar 2016 11:04:42 GMT -->
</html>
