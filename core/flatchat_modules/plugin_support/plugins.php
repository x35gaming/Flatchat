
<pre><code>
<?php
if (file_exists("./plugins")) {
    $x = scandir(__DIR__."/plugins"); //any directory
    foreach ($x as $key => $value) {
        if ('.' !== $value && '..' !== $value){
            if (is_dir($value)){
                if (file_exists($value."/plugin.json")){
                    $plugin = json_decode(file_get_contents($value."/plugin.json"),true);
                    echo "$value is a plugin with name: ".$plugin["name"]."\n";
                } else {
                    echo "$value is not a plugin, missing json file\n";
                };
            };
        };
    };
} else {
    trigger_error(__dir__."/plugins missing", E_USER_ERROR);
}
 //Simple and working 
 ?></code></pre>