<?php
echo $_SERVER['PHP_SELF']."<br>".$_SERVER["SCRIPT_FILENAME"];
highlight_string('<?php $arr='.var_export($_SERVER,true).'?>');