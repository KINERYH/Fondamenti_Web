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

//Prendo le variabili
$title = $_POST["nome"];
$description = $_POST["descrizione"];
$date = $_POST["data"];
$price = $_POST["prezzo"];
$place = $_POST["luogo"];
$limitePosti = $_POST["disponibilita"];
$categoria = $_POST["format"];
$imgLink;

//Prendo l'immagine
$image = $_FILES["imgUpload"];

$imageName = $image["name"];
$imageTmpName = $image["tmp_name"];
$imageSize = $image["size"];
$imageError = $image["error"];
$imageType = $image["type"];

//Faccio il parse del nome del'immagine per prenderne l'estensione
$imageExt = explode('.', $imageName); 
$imageActualExt = strtolower(end($imageExt));
// Compongo il vettore di estensioni possibili per l'immagine
$allowedExt = array('jpg', 'jpeg', 'png');
// Verifico se l'estensione dell'immagine presa è permessa
if(in_array($imageActualExt, $allowedExt)){
  if($imageError == 0){  
    if ($imageSize < 100000000){
      // Creo un nome univoco per l'immagine
      $imageNewName = uniqid('', true). ".". $imageActualExt;
      $imageDestination ='../images/eventImages/' .  $imageNewName;
      $imgLink = "https://livexperience.altervista.org/images/eventImages/" . $imageNewName;
      move_uploaded_file($imageTmpName, $imageDestination);
    } else {
      echo "L'immagine che stai caricando pesa troppo";
    }
  } else {
    echo "Ci sono stati errori nel caricamento dell'immagine";
  }
} else {
  echo "Non puoi caricare file con questa estensione";
}


$sql = "INSERT INTO evento (Nome, Descrizione, Data, Prezzo, Luogo, Disp, Img, Categoria) VALUES ('$title', '$description', '$date', '$price', '$place', '$limitePosti', '$imgLink', '$categoria')";
header("Location: ../add_event.php");

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
    echo "$sql";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  
$conn->close();

?>