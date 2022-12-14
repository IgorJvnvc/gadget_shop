<?php
session_start();
if(isset($_SESSION["user"])||isset($_SESSION["admin"])):
    
    $_SESSION["admin"] = null;
    $_SESSION["user"] = null;
    header("location:index.php");
endif;


?>