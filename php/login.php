<?php
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

//Prendi le variabili
$email = $_POST["email"];
$password = $_POST["password"];


$sql = "SELECT * FROM utente WHERE Mail = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        if ($row["Password"] == $password) {
            header("Location: ../profile.html");
            exit();
        }
    }
} else {
    echo "0 results";
}
$conn->close();
