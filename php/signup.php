<?php
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

//Prendi le variabili
$email = $_POST["email"];
$password = md5($_POST["password"]);
$nome = $_POST["nome"];
$cognome = $_POST["cognome"];
$date = $_POST["date"];
$gen = $_POST["gen"];

//Query da eseguire, inserisco i dati inseriti dall'utente nel database
$sql = "INSERT INTO utente (Mail, Nome, Cognome, Genere, Password, Data_Nascita, isAdmin) VALUES ('$email', '$nome', '$cognome', '$gen', '$password', '$date', '0')";


if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";  
    echo "$sql";   // Creo la nuova riga nel database
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  header("Location: ../login.php");
  
$conn->close();
?>