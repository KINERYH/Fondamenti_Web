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

if(isset($_POST ['login'])){

    //Prendi le variabili
    $email = $_POST["email"]; 
    $password = md5($_POST["password"]);

    //Query da eseguire
    $sql = "SELECT * FROM utente WHERE Mail = '$email'";  //Confronto l'email presente nella tabella "utente" con l'email inserita dall'utente
    $result = $conn->query($sql);
    

    if ($result->num_rows > 0) { //Se ho trovato corrispondenza tra le email, confronto le password
        // output data of each row
        while ($row = $result->fetch_assoc()) {  // Cerco nella riga 
            if ($row["Password"] == $password) {
                $_SESSION['infoUtente'] = $row;
                /* REINDIRIZZA*/
                header("Location: ../index.php");
                exit();
            }
            header("Location: ../login.php?error_code=2");  //se la password non è corretta (non viene trovata nel database) viene ricaricata la pagina di login e viene mostrato un errore all'utente
        }
    } else {
        header("Location: ../login.php?error_code=1");  //se l'email non è corretta (non viene trovata nel database) viene ricaricata la pagina di login e viene mostrato un errore all'utente
    }
    
    $conn->close();
}





?>

