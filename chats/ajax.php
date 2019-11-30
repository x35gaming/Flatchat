<?php
/*
* flatchat
* flat file php cms/forum/chat all in one
* 
* (C) X35gaming, under GNU GPL-v3
* */
// chats beautifier
?>

<script src="../core/php_libs/jquery/jquery-3.x.min.js"></script>
<script>
    function doit(){
        $.ajax({
            type: "POST",
            url: "chats.php",
            cache: false,
            success: function(data){
                //Do something
                document.getElementById("chats").innerHTML=data;
            },
            error:function (xhr, ajaxOptions, thrownError){
                document.getElementById("chats").innerHTML=(xhr.status);
                document.getElementById("chats").innerHTML+=(thrownError);  
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
        font-family : Verdana, Geneva, sans-serif;
        
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
