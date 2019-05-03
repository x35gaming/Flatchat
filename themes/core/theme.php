<?php
/*
 * flatchat
 * flat file php cms/forum/chat all in one
 * 
 * (C) X35gaming, under GNU GPL-v3
 * */
?>

<!DOCTYPE html>
<html>
<head>
<?php
    loadCss("style.css") // load the css into the html
?>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><?php echo $title  // puts the title in to the page
            ?></h1>
        </div>
        <div class="headcont"><div class="headlinks"><?php echo $links?></div></div>
        <div class="content">
            <?php echo $mainpage   // puts the main content in
            ?>
        </div>
    </div>
</body>
</html>