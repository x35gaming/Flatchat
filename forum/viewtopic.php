<?php
/*
 * flatchat
 * flat file php cms/forum/chat all in one
 * 
 * (C) X35gaming, under GNU GPL-v3
 * */
//ajax chat panel
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

$boardsdir = __DIR__ . '/boards';
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

jointomain('
<style>
.forumpost {
    float: top;
    display:block;
    border:3px ridge #666;
    font-family : Verdana, Geneva, sans-serif;
    padding:10px;
    border-radius:10px;
    background:rgb(199,128,128);
}
.forumhead {
    float: top;
    display:block;
    border:3px ridge #666;
    font-family : Verdana, Geneva, sans-serif;
    padding:10px;
    border-radius:10px;
    background:rgb(230,230,140);
}
.post {
    float: top;
    display:block;
    border:3px ridge #666;
    font-family : Verdana, Geneva, sans-serif;
    padding:10px;
    border-radius:10px;
    background:rgb(230,230,230);
}
.topic{
    float: top;
    display:block;
    border:3px ridge #666;
    font-family : Verdana, Geneva, sans-serif;
    padding:10px;
    border-radius:10px;
    background:slategray;
}
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
.inline{
    display:inline;
}
</style>

');$bannedwords=explode(", ",file_get_contents("../core/flatchat_modules/noswearing/bannedwords.array"));// set banned words list for defilth module
require_once("../core/flatchat_modules/noswearing/defilth.php");      
if(isset($_GET["topic"])){
    $topic = json_decode(file_get_contents($boardsdir . '/' .$_GET['topic'].'/post.json'),true);
    jointomain('<div class="topic"> <div class="forumhead"> <h1>' . $Parsedown->line(htmlspecialchars(defilth($topic['Topic-name'],$bannedwords))) . '</h1> thread started by:' . $Parsedown->line(htmlspecialchars(defilth($topic["Topic-user"],$bannedwords))). '</div>');
    foreach ($topic["Topic-posts"] as $topicpost) {
joinToMain( '
<br>
<div class="forumpost">
    <h3 class="inline"><div class="postuser">'. $Parsedown->line(htmlspecialchars(defilth($topicpost[0],$bannedwords))) . '</div></h3><br>
    <div class="post">'. $Parsedown->text(htmlspecialchars(defilth($topicpost[1],$bannedwords))) .'</div>
</div>
');
    }
    joinToMain('<br>
    <div class="post">
    <form method="post" action="./newcomment.php?topic='.$_GET['topic'].'">
    User name: 
    <input type="text" name="User_Name"><br>
    <br>message: (markdown)<br>
    <textarea name="Topic_Post" cols="30" rows="10"></textarea>
    <input type="submit" value="Post!"><br>
    </form>
    </div>');
    joinToMain('</div>');
}

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



