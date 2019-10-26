<!DOCTYPE html>
<html>
<head>
<title><?php echo $title?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php loadCss("style.css");
      loadCss("prism.css");
      loadJs("prism.js");
echo <<<METAQUERY
<meta name="description" content="{$conf["seodesc"]}">
METAQUERY

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
    </div>

<div class="footer">



    <div class="row">
        <div class="col-3 menu">
            <ul>
                <?php echo $links?>
            </ul>
        </div>
        <div class="col-6">
            <p>
                powered by flatchat... <?php if($page_type == "main") {echo "<a href=\"admin/\">Admin Panel</a>";} else {echo "<a href=\"../admin/\">Admin Panel</a>";} ?>
                <?php echo $Parsedown->text($conf["footertext"])?>
            </p>
        </div>
    </div>
</div>

</body>
</html>
