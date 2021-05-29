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

$email = $_REQUEST['email'];
$sql = "DELETE * FROM utente WHERE Mail = '$email'";
$result = $conn->query($sql);

header("Location: ../signup.html");


    $conn->close();

?>

