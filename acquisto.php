<?php
session_start();
if (!isset($_SESSION['infoUtente'])) { //Non riporta l'errore
    error_reporting(0);
    $valAdmin = 0;
    $isLogged = false;
} else {
    $info = $_SESSION["infoUtente"]; //Mi da le informazioni dell'utente loggato
    $valAdmin = $info["isAdmin"];
    $isLogged = true;
}
if (empty(isset($_SESSION['infoUtente']))) {
    $session = "0";
} else {
    $session = isset($_SESSION['infoUtente']);
}

$carrello = $_COOKIE["shopping-cart"];
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

if ($isLogged) {
    $carrello_JSON = $_COOKIE["shopping-cart"];
    $carrello = json_decode($carrello_JSON);
    //itero l'array e aggiungo l'acquisto di ogni evento al db
    for ($i = 0; $i < count($carrello); $i++) {
        $idEvento = $carrello[$i][0];
        $numBiglietti = $carrello[$i][5];
        $mail = $info["Mail"];
        $sql = "INSERT INTO acquisto (idEvento, mailUtente, nBiglietti) VALUES ('$idEvento', '$mail', '$numBiglietti')";
        if ($conn->query($sql) === TRUE) {
            // Elimino il cookie del carrello dopo aver fatto l'acquisto
            setcookie("shopping-cart", "", time() - 3600, "/");
            //Riduco il numero di biglietti acquistati da quelli disponibili dell'evento
            $disp = $carrello[$i][6];
            $newDisp = $disp - $numBiglietti;
            $riducoBiglietti = "UPDATE evento SET Disp = $newDisp WHERE evento.ID = $idEvento";
            if($conn->query($riducoBiglietti) === TRUE){
                //echo "New record created successfully";
                header("Location: grazie.php");
            } else {
                echo "Error: " . $riducoBiglietti . "<br>" . $conn->error;
            }
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
} else {
    header("location: login.php");
}
?>

