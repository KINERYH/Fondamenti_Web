
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- ============= RESET STYLE ============= -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css"
        integrity="sha512-NmLkDIU1C/C88wi324HBc+S2kLhi08PN5GDeUVVVC/BVt/9Izdsc9SVeVfA1UZbY3sHUlDSyRXhCzHfr6hmPPw=="
        crossorigin="anonymous" />
    <!-- ============= STYLE ============= -->
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/event.css">
    <!-- ============= Google Font ============= -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Righteous&family=Rubik&display=swap" rel="stylesheet">
    <!-- ============= Slider ============= -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flickity/2.2.2/flickity.pkgd.min.js"
        integrity="sha512-cA8gcgtYJ+JYqUe+j2JXl6J3jbamcMQfPe0JOmQGDescd+zqXwwgneDzniOd3k8PcO7EtTW6jA7L4Bhx03SXoA=="
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flickity/2.2.2/flickity.min.css"
        integrity="sha512-BiFZ6oflftBIwm6lYCQtQ5DIRQ6tm02svznor2GYQOfAlT3pnVJ10xCrU3XuXnUrWQ4EG8GKxntXnYEdKY0Ugg=="
        crossorigin="anonymous" />
    <!-- ============= Font-Awesome ============= -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
    <script src="hhtps://kit.fontawesome.com/a81368914c.js"></script>
    <!-- ============ Javascript =================-->
    <script src="../main.js"></script>
    <!-- ============ SweetAlert =================--> 
    <!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>     SWEETALERT1 ORIGINALE --> 
    <script src="../sweetalert2.all.min.js"></script>

</head>
<body>
    <!-- ============= HEADER ============= -->
    <header>
        <!-- logo -->
        <div class="logo">
            <a href="index.html">
                liveXperience
            </a>
        </div>
        <!-- barra di ricerca -->
        <div class="search-container">
            <div class="dropdown">
                <button class="dropBtn">Categorie <i class="fa fa-caret-down"></i></button>
                <div class="dropdown_content">
                    <a href="#">Concerti</a>
                    <a href="#">Sport</a>
                    <a href="#">Teatro</a>
                    <a href="#">Mostre e Musei</a>
                </div>
            </div>
            <form action="#">
                <input type="text" placeholder="Cerca il tuo evento" name="search">
                <button type="submit"><img
                        src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pg0KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDE5LjAuMCwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPg0KPHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB2aWV3Qm94PSIwIDAgNTEyLjAwNSA1MTIuMDA1IiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA1MTIuMDA1IDUxMi4wMDU7IiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxnPg0KCTxnPg0KCQk8cGF0aCBkPSJNNTA1Ljc0OSw0NzUuNTg3bC0xNDUuNi0xNDUuNmMyOC4yMDMtMzQuODM3LDQ1LjE4NC03OS4xMDQsNDUuMTg0LTEyNy4zMTdjMC0xMTEuNzQ0LTkwLjkyMy0yMDIuNjY3LTIwMi42NjctMjAyLjY2Nw0KCQkJUzAsOTAuOTI1LDAsMjAyLjY2OXM5MC45MjMsMjAyLjY2NywyMDIuNjY3LDIwMi42NjdjNDguMjEzLDAsOTIuNDgtMTYuOTgxLDEyNy4zMTctNDUuMTg0bDE0NS42LDE0NS42DQoJCQljNC4xNiw0LjE2LDkuNjIxLDYuMjUxLDE1LjA4Myw2LjI1MXMxMC45MjMtMi4wOTEsMTUuMDgzLTYuMjUxQzUxNC4wOTEsNDk3LjQxMSw1MTQuMDkxLDQ4My45MjgsNTA1Ljc0OSw0NzUuNTg3eg0KCQkJIE0yMDIuNjY3LDM2Mi42NjljLTg4LjIzNSwwLTE2MC03MS43NjUtMTYwLTE2MHM3MS43NjUtMTYwLDE2MC0xNjBzMTYwLDcxLjc2NSwxNjAsMTYwUzI5MC45MDEsMzYyLjY2OSwyMDIuNjY3LDM2Mi42Njl6Ii8+DQoJPC9nPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPC9zdmc+DQo="
                        height="13px" width="13px" /></button>
            </form>
        </div>
        <!-- utility per il profilo + carrello-->
        <ul class="profile">
            <li><a href="login.html"> Log in </a></li>
            <li><a href="signup.html" id="SignUp"> Sign Up </a></li>
            <li><a href="profile.html"><button><i class="fas fa-user"></i></button></a></li>
            <!-- carrello -->
            <li>
                <div class="slide">
                    <button onclick="openSlideMenu()"><i class="fas fa-shopping-cart"></i></button>
                </div>
            </li>


        </ul>


    </header>
    <!-- ============= SLIDE SIDE CART ============= -->

    <div id="slcontent">
        <div id="menu" class="nav">
            <h13>Carrello</h13>
            <a href="#" class="close" onclick="closeSlideMenu()">
                <i class="fas fa-times"></i></a>
            <input type="submit" class="btn" value="Acquista">
        </div>
    </div>

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

    // Recupero l'Id col metodo post, dopo aver selezionato l'evento dalla ricerca o dallo slider
    $id = "0";

    //Query da eseguire
    $sql = "SELECT * FROM evento WHERE ID = '$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $description = $row["Descrizione"];
            $image_url = $row["Img"];
            $price = $row["Prezzo"];
            $title = $row["Nome"];
            $place = $row["Luogo"];
        }
    } else {
        echo "0 results";
    }
    $conn->close();
    ?>


    <!-- ============= BODY EVENT ============= -->
    <div class="main_event">
        <div class="main_sx">
            <img src="<?php echo $image_url?>"/>
        </div>
        <div class="main_dx">
            <h1> Finale champions league </h1>
            <span>€<?php echo $price ?></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star"></span>
            <span class="fa fa-star"></span>
            <br>
            <div class=center>    
                <i class="fas fa-minus" onclick="riduciPrezzo(<?php echo $price ?>)"></i>
                <span>3</span>
                <i class="fas fa-plus"></i>
            </div>
            <div class="center">
                <button> Aggiungi al carrello </button>
            </div>
        </div>
       
    </div>
    
    <div class="description">
        <h1>Descrizione</h1>
        <p> <?php echo $description ?> </p>
    </div>

    

</body>
</html>

