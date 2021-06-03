<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "livexperience";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_COOKIE["unknown"])) {

    // cambio pw nel db    
    $info = $_SESSION["infoUtente"];
    $Mail = $info["Mail"];
    $decodedPass = json_decode($_COOKIE["unknown"]);
    $new_password = md5($decodedPass);
    $sql = "UPDATE utente SET Password = '$new_password' WHERE utente.Mail = '$Mail'";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Dovrei aggiornare i dati della sessione con la password modificata poi

    // cancello il cookie
    setcookie("unknown", "boh", time() - 3600, "/");

    // reindirizzo al profilo
    header("Location: profile.php");
}

if (isset($_GET['delete'])) {
    $delete = $_GET['delete'];
} else {
    $delete = '0';
}
if ($delete == 1) {
    $info = $_SESSION["infoUtente"];
    $Mail = $info["Mail"];

    $sql = "DELETE FROM utente WHERE Mail = '$Mail'";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    session_unset();
    session_destroy();
    header("Location: index.php");
}
$conn->close();
