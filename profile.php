<?php
session_start();
$info = $_SESSION["infoUtente"];

//Se l'utente non è loggato, viene indirizzato al login
if(!isset($_SESSION['infoUtente'])){
    header("location:login.html");
}
?>

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
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/profile.css">
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
    <script src="main.js"></script>
    <!-- ============ SweetAlert =================--> 
    <!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>     SWEETALERT1 ORIGINALE --> 
    <script src="sweetalert2.all.min.js"></script>
    <script src="crypto.js"></script>
</head>
<body>
    <!-- ============= HEADER ============= -->
    <header>
        <div class="logo">
            <a href="index.php">
                liveXperience
            </a>
        </div>
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
        <ul class="profile">
            <li><a href="login.html" id="login"> Log in </a></li>
            <li><a href="signup.html" id="SignUp"> Sign Up </a></li>
            <li><a href="profile.php" id="profile"><button><i class="fas fa-user"></i></button></a></li>
            <!-- carrello -->
            <li>
                <div class="slide" id="carrello">
                    <button onclick="openSlideMenu()"><i class="fas fa-shopping-cart"></i></button>
                </div>
            </li>
        </ul>

       

      


    </header>
    
    <body onload="nascondoBtn( <?php echo (isset($_SESSION['infoUtente']))?>)">
    
    <!-- ============= SLIDE SIDE CART ============= -->

    <div id="slcontent">
        <div id="menu" class="nav">
            <h13>Carrello</h13>
            <a href="#" class="close" onclick="closeSlideMenu()">
                <i class="fas fa-times"></i></a>
            <input type="submit" class="btn" value="Acquista">
        </div>
    </div>

    <!-- ============= BODY ============= -->
    <div class="profile-body">
        <div id="profile-sx" class="profile-sx">
            <h1>Il mio profilo</h1>
            <h3 class="h3hover" onclick="arrowActive(arrow1)" > <i id="arrow1" class="fas fa-arrow-right"></i> &nbsp;Informazioni personali</h3> 
            <h3 class="h3hover" onclick="arrowActive(arrow2)" > <i id="arrow2" class="fas fa-arrow-right"></i> &nbsp;I miei acquisti</h3>
            <?php $oldpass = $info["Password"];?>
            <h3 class="h3hover" onclick="arrowActive(arrow3); deleteAccountAlert('<?php echo $oldpass ?>')" style="color: red;"> <i id="arrow3" class="fas fa-arrow-right"style="color:black;"></i> &nbsp;Cancella registrazione</h3>
            <h3><a href="php/logout.php" class="h3hover" onclick="arrowActive(arrow4)" style="color: red;"> <i id="arrow4" class="fas fa-arrow-right"style="color:black;"></i> &nbsp;Logout</a></h3>


        </div>
        <div id="profile-dx_img" class="profile-dx_img">
            <img src="images/imgProfile.svg" alt="">
        </div>
        <div id="profile-dx_info" class="profile-dx_info">
            <div class="card-info">
                <div class="center">
                    <img class="avatar" src="images/avatar.svg" alt="">
                </div>
                <h2>Nome</h2>
                <p><?php echo $info["Nome"] ?></p>
                <h2>Cognome</h2>
                <p><?php echo $info["Cognome"] ?></p>
                <h2>Data di nascita</h2>
                <p><?php echo $info["Data_Nascita"] ?></p>
                <h2>Email</h2>
                <p> <?php echo $info["Mail"] ?> </p>
                <h2>Password</h2>
                <?php $oldpass = $info["Password"];?>
                <p>***********<button onclick="changePasswordAlert('<?php echo $oldpass ?>')"><i class="fas fa-edit" style="color: rgb(202, 0, 0);"></i></button></p>
            </div>
            
        </div>
        <div id="profile-dx_orders" class="profile-dx_orders">
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Prezzo</th>
                        <th>Data Evento</th>
                        <th>Data Acquisto</th>
                        <th>N° biglietti</th>
                        <th>Posto</th>
                    </tr>
                </thead>
                <tr>
                    <td>Prova</td>
                    <td>€50</td>
                    <td>05/12/21</td>
                    <td>30/01/20</td>
                    <td>5</td>
                    <td>Curva Sud</td>
                </tr>
                <tr>
                    <td>Prova</td>
                    <td>€50</td>
                    <td>05/12/21</td>
                    <td>30/01/20</td>
                    <td>5</td>
                    <td>Curva Sud</td>
                </tr>
                <tr>
                    <td>Prova</td>
                    <td>€50</td>
                    <td>05/12/21</td>
                    <td>30/01/20</td>
                    <td>5</td>
                    <td>Curva Sud</td>
                </tr>
                <tr>
                    <td>Prova</td>
                    <td>€50</td>
                    <td>05/12/21</td>
                    <td>30/01/20</td>
                    <td>5</td>
                    <td>Curva Sud</td>
                </tr>
            </table>
        </div>
    </div>


    <!-- ============= FOOTER ============= -->
    <footer>
        <div class="container">
            <!-- about us -->
            <div class="sec aboutus">
                <h8>About Us</h8>
                <p>LiveXperience è specializzato nella vendita di biglietti <br>
                    per eventi di musica, cultura e sport, <br>
                    rivolto a qualsiasi tipo di utente che vuole vivere le emozioni <br>
                    di partecipare a un evento pubblico acquistando il proprio biglietto <br>
                    in modo facile e sicuro.</p>
            </div>
            <!-- link utili -->
            <div class="sec link">
                <h8>Link Utili</h8>
                <ul>
                    <li><a href="https://www.garanteprivacy.it/documents/10160/0/Regolamento+UE+2016+679.+Arricchito+con+riferimenti+ai+Considerando+Aggiornato+alle+rettifiche+pubblicate+sulla+Gazzetta+Ufficiale++dell%27Unione+europea+127+del+23+maggio+2018">Privacy</a></li>
                    <li><a href="#">Informative Cookie</a></li>
                </ul>
            </div>
            <!-- contatti -->
            <div class="sec contatti">
                <h8>Contatti</h8>
                <ul class="info">
                    <li>
                        <span><i class="fas fa-envelope" aria-hidden="true"></i></span>
                        <p><a href="mailto:livexperience123@gmail.com">livexperience123@gmail.com</a></p>
                    </li>
                    <li>
                        <span><i class="fas fa-phone" aria-hidden="true"></i></span>
                        <p><a href="tel:080612224">080 612 224</a><br>
                            <a href="tel:332622778">+39 332 622 778</a>
                        </p>
                    </li>
                    <li>
                        <span><i class="fas fa-balance-scale" aria-hidden="true"></i></span>
                        <p> PIVA: 12345678910</p>
                    </li>
                </ul>
            </div>
        </div>

    </footer>
    <!-- ========= COPYRIGHT ========= -->
    <div class="copyright">
        <p>Copyright © 2021 | Tutti i diritti sono riservati.</p>
    </div>

</body>
</html>