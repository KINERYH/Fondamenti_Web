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
    $sql = "SELECT * FROM utente WHERE Mail = '$email'";
    $result = $conn->query($sql);
    

    if ($result->num_rows > 0) { 
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            if ($row["Password"] == $password) {
                $_SESSION['infoUtente'] = $row;
                /* REINDIRIZZA*/
                header("Location: ../index.php");
                exit();
            }
            header("Location: ../login.php?error_code=2");
        }
    } else {
        header("Location: ../login.php?error_code=1");
    }
    
    $conn->close();
}





?>

