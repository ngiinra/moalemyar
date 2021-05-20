<?php
if(isset($_POST['msg'])){
       echo '
       <script src="../js/jquery.js"></script>
       <script>
        $("#alarm").css("display","block");
        </script>    ';
        echo $_POST['msg'];
    }
