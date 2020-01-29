<?php
/*
 * flatchat
 * flat file php cms/forum/chat all in one
 * 
 * (C) X35gaming, under GNU GPL-v3
 * */
//ajax chat panel
$conf = json_decode(file_get_contents("../config.json"),true); // load config file.
joinToMain('
<div class="header">
    <h1 >
        '. $conf["forumtitle"] .'
    </h1>
    <a href="newtopic.php">New topic</a> <a href="./">Home</a>
</div>');
$uniquid = uniqid();
$boardsdir = __DIR__ . '/boards';
if (isset($_POST["Topic_Name"])){
    mkdir($boardsdir.'/'. $uniquid );
    file_put_contents($boardsdir.'/'. $uniquid . '/post.json' ,json_encode([
        'Topic-name' => $_POST["Topic_Name"],
        'Topic-user' => $_POST["User_Name"],
        'Topic-posts' =>[
            [
                $_POST["User_Name"],
                $_POST["Topic_Post"]
            ]
        ]
    ]));
echo <<<REDIRECT_POST
<script type="text/javascript">
window.location.href = './viewtopic.php?topic={$uniquid}';
</script>
REDIRECT_POST;
}

$page_type="chat";
$Parsedown;   // 


function joinToLinks($text) {
    global $links;                      // declare $links as global
    $newmain = $links.$text;            // join $text to $links as $newmain
    $links = $newmain;                  // set $links to $newmain

};
$customlinks = $conf["links"];
foreach ($customlinks as $j){
    joinToLinks("<a class=\"myButton\" href=\"../".$j["url"]."\">"."<li>".$j["name"]."</li>"."</a>");
}

require_once("../core/php_libs/Parsedown/Parsedown.php");      // init parsedown.
$Parsedown = new Parsedown();                               // create a parsedown object to parse markdown.
chdir("..");
require("core/flatchat_modules/plugin_support/plugins.php");
chdir("../chats");

                                    // environment vars
                                    // use these in your theme for title and content.

$mainpage=""                  ;      // mainpage declaration
function joinToMain($text) {
    global $mainpage;                      // declare mainpage var
    $newmain = $mainpage.$text;            // join $text to $mainpage as $newmain
    $mainpage = $newmain;                  // set $mainpage to $newmain

};
$title = $Parsedown->line($conf["title"]);//set title 


$scanned_directory = array_diff(scandir($boardsdir), array('..', '.'));


// page formation
// <body>
joinToMain("
<style>
input[type=text], select, textarea {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}
input[type=submit] {
    width: 100%;
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}
input, select, textarea, {
    z-index:1000; 
}
</style>
");
joinToMain('
<form method="post">
Topic name: 
<input type="text" name="Topic_Name"><br>
User name: 
<input type="text" name="User_Name"><br>
<br>message: (markdown)<br>
<textarea name="Topic_Post" cols="30" rows="10"></textarea>
<input type="submit" value="Post!"><br>
</form>
');


// </body>
                                    // theme
require("../themes/".$conf["theme"]."/theme.php"); //load theme
function loadCss($file) { 
    global $conf;                      
    $style = "../themes/".$conf["theme"]."/$file";          //load css files without typing the dir
    echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"$style\"></link>" ;
}
function loadJs($file) { 
    global $conf;                      
    $script = "../themes/".$conf["theme"]."/$file";          //load css files without typing the dir
    echo "<script src=\"$script\"></script>" ;
}

?>




