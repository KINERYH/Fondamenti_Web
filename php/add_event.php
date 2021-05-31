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

//Prendo le variabili
$title = $_POST["nome"];
$description = $_POST["descrizione"];
$date = $_POST["data"];
$price = $_POST["prezzo"];
$place = $_POST["luogo"];
$limitePosti = $_POST["disponibilita"];
$image_url = $_POST["img"];
$categoria = $_POST["format"];


$sql = "INSERT INTO evento (Nome, Descrizione, Data, Prezzo, Luogo, Disp, Img, Categoria) VALUES ('$title', '$description', '$date', '$price', '$place', '$limitePosti', '0', '$categoria')";

header("Location: ../add_event.php");

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
    echo "$sql";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  
$conn->close();

?>