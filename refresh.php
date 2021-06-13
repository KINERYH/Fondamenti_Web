<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "my_livexperience";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_COOKIE["changePass"])) {

    // cambio pw nel db    
    $info = $_SESSION["infoUtente"];
    $Mail = $info["Mail"];
    $decodedPass = json_decode($_COOKIE["changePass"]);
    $new_password = md5($decodedPass);
    $sql = "UPDATE utente SET Password = '$new_password' WHERE utente.Mail = '$Mail'";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Dovrei aggiornare i dati della sessione con la password modificata poi

    // cancello il cookie
    setcookie("changePass", "boh", time() - 3600, "/");

    // reindirizzo al profilo indicando che ho modificato la password
    header("Location: profile.php?change=1");
}

// Verifico se ho eliminato il profilo, cosi da cancellare la sua entry dal db e da effettuare il logout automaticamente
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
