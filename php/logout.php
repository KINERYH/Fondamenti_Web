<?php
// Elimino i dati della sessione e reindirizzo alla home page
session_start();
session_unset();
session_destroy();

header("location:../index.php");
?>



