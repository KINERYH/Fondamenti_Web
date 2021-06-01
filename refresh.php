<?php
session_start();
if (isset($_COOKIE["unknown"])) {

    // cambio pw nel db
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

    //Query da eseguire
    $info = $_SESSION["infoUtente"];
    $id = $info["ID"];
    $new_password = md5($_COOKIE["unknown"]);
    $sql = "UPDATE utente SET Password = '$new_password' WHERE utente.ID = '$id'";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
        echo "$sql";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }


    // cancello il cookie
    setcookie("unknown", "", time() - 3600);

    // reindirizzo al profilo
    header("Location: profile.php");

    $conn->close();
}
