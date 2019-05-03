<?php
/*
* flatchat
* flat file php cms/forum/chat all in one
* 
* (C) X35gaming, under GNU GPL-v3
* */
?>

<script src="core/php_libs/jquery/jquery-3.x.min.js"></script>
<script>
$(document).ajaxError(function(e, jqxhr, settings, exception) {
    if (jqxhr.readyState == 0 || jqxhr.status == 0) {
        alert('Ajax Error');
    }
});

function doit(){
    $.support.cors = true;
    $.ajax({
        type: "POST",
        url: "adminchats.php",
        cache: false,
        success: function(data){
            //Do something
            document.getElementById("chats").innerHTML=data;
        },
        error:function (xhr, ajaxOptions, thrownError){
            alert(xhr.status);
            alert(thrownError);
        }
    });
}
</script>
<div id="chats">Loading...</div>
<script>

setInterval(() => {
    doit()
}, 2000);

</script>
<style>
body{
    background: rgb(31, 31, 31);
    color: white;
    
    
    height:100vh;
}
.user {background: gray}
.msg {background: rgb(73, 73, 73)}
.message {
    border-radius: 10px;
    border:2px solid saddlebrown;
}
.msgid{text-align:right}
</style>
<script>
document.onload(doit())
</script>