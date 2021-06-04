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
$hash = md5( rand(0,1000) ); 
//Genero un numero casuale che poi trasformo in una 
//stringa di 32 caratteri. Mi serve per assegnarla ad una variabile locale.


//Query da eseguire
$sql = "INSERT INTO utente (Mail, Nome, Cognome, Genere, Password, Data_Nascita, isAdmin) VALUES ('$email', '$nome', '$cognome', '$gen', '$password', '$date', '0')";

/*
   //Mando l'email
  $to = $email;
  $subject = 'Verifica Email'; //Assegno un oggetto all'email
  $message = "<a href='http://localhost/verifica.php?Mail='.$email.'&hash='.$hash.'>Account Registrato</a>";
  $headers = "From:livexperience123@gmail.com"; //Imposto l'intestazione
  $headers .= "MIME-Version: 1.0" . "\r\n";
  $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

  mail($to, $subject, $message, $headers); //Mando l'email

  header('location:../grazie.html');

 */


if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
    echo "$sql";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  header("Location: ../login.php");
  
$conn->close();
?>