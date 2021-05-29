<?php
session_start();
session_unset();
session_destroy();

header("location:../login.html");

//session_start();
//if(!isset($_SESSION['infoUtente'])){
    //header("location:login.html");
//}

?>



