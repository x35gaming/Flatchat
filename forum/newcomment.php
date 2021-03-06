<?php
/*
 * flatchat
 * flat file php cms/forum/chat all in one
 * 
 * (C) X35gaming, under GNU GPL-v3
 * */
//ajax chat panel
$bannedwords=explode(", ",file_get_contents("../core/flatchat_modules/noswearing/bannedwords.array"));// set banned words list for defilth module
require_once("../core/flatchat_modules/noswearing/defilth.php");                                    // init Defilth module.

$uniquid = $_GET["topic"];
$boardsdir = __DIR__ . '/boards';
$topic = json_decode(file_get_contents($boardsdir . '/' .$_GET['topic'].'/post.json'),true);
if (isset($_POST["User_Name"])){
    file_put_contents($boardsdir.'/'. $uniquid . '/post.json' ,json_encode([
        'Topic-name' => $topic["Topic-name"],
        'Topic-user' => $topic["User-name"],
        'Topic-posts' => array_merge([
            [
                $_POST["User_Name"],
                $_POST["Topic_Post"]
            ]
            ],$topic['Topic-posts'])
    ]));
echo <<<REDIRECT_POST
<script type="text/javascript">
window.location.href = './viewtopic.php?topic={$uniquid}';
</script>
REDIRECT_POST;
}

$page_type="chat";
$conf;        // declare vars
$Parsedown;   // 

$conf = json_decode(file_get_contents("../config.json"),true); // load config file.
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
joinToMain('
<div class="header">
    <h1 >
        '. $conf["forumtitle"] .'
    </h1>
    <a href="newtopic.php">New topic</a> <a href="./">Home</a>
</div>');
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



