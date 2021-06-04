<?php
session_start();
if (!isset($_SESSION['infoUtente'])) { //Non riporta l'errore
    error_reporting(0);
    $valAdmin = 0;
} else {
    $info = $_SESSION["infoUtente"]; //Mi da le informazioni dell'utente loggato
    $valAdmin = $info["isAdmin"];
    header("location:index.php"); //Se si è loggati, se cerco di andare in login, vengo reinderizzato nella home
}
if (empty(isset($_SESSION['infoUtente'])) ){
    $session = "0";
}else{
    $session = isset($_SESSION['infoUtente']);
}

// Se il login non è andato a buon fine avrò un messaggio di errore
// error_code 1 -> mail non presente nel db
// error_code 2 -> password errata
if(isset($_GET["error_code"])){
    $error_code = $_GET["error_code"];
    if($error_code == 1){
        //errore sulla mail
    } else if ($error_code == 2){
        //errore sulla password
    }
}
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | liveXperience </title>
    <!-- ============= RESET STYLE ============= -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css" integrity="sha512-NmLkDIU1C/C88wi324HBc+S2kLhi08PN5GDeUVVVC/BVt/9Izdsc9SVeVfA1UZbY3sHUlDSyRXhCzHfr6hmPPw==" crossorigin="anonymous" />
    <!-- ============= STYLE ============= -->
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/login.css">
    <!-- ============= Google Font ============= -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Righteous&family=Rubik&display=swap" rel="stylesheet">

    <!-- ICON -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
    <script src="hhtps://kit.fontawesome.com/a81368914c.js"></script>
    <!-- ============ Javascript =================-->
    <script src="main.js"></script>
</head>


<body onload="onLoad(<?php echo $session ?>, <?php echo $valAdmin ?>)">

    <!-- ============= HEADER ============= -->
    <header>
        <div class="hamburger">
            <i class="fas fa-bars" onclick="openLeftMenu()"></i>
        </div>
        <!-- logo -->
        <div class="logo">
            <a href="index.php">
                liveXperience
            </a>
        </div>
        <!-- barra di ricerca -->
        <div class="search-container">
            <div class="dropdown">
                <button class="dropBtn">Categorie <i class="fa fa-caret-down"></i></button>
                <div class="dropdown_content">
                    <a href="php/search.php?Categoria=Musica"><i class="fas fa-microphone-alt"></i> &nbsp;Concerti</a>
                    <a href="php/search.php?Categoria=Sport"><i class="fas fa-futbol"></i> &nbsp;Sport</a>
                    <a href="php/search.php?Categoria=Teatro"><i class="fas fa-theater-masks"></i> &nbsp;Teatro</a>
                    <a href="php/search.php?Categoria=Musei"><i class="fas fa-atom"></i> &nbspMostre e Musei</a>
                </div>
            </div>
            <form action="php/search.php" method="GET">
                <input name="search_bar" type="text" placeholder="Cerca il tuo evento" name="search">
                <button type="submit"><img src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pg0KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDE5LjAuMCwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPg0KPHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB2aWV3Qm94PSIwIDAgNTEyLjAwNSA1MTIuMDA1IiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA1MTIuMDA1IDUxMi4wMDU7IiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxnPg0KCTxnPg0KCQk8cGF0aCBkPSJNNTA1Ljc0OSw0NzUuNTg3bC0xNDUuNi0xNDUuNmMyOC4yMDMtMzQuODM3LDQ1LjE4NC03OS4xMDQsNDUuMTg0LTEyNy4zMTdjMC0xMTEuNzQ0LTkwLjkyMy0yMDIuNjY3LTIwMi42NjctMjAyLjY2Nw0KCQkJUzAsOTAuOTI1LDAsMjAyLjY2OXM5MC45MjMsMjAyLjY2NywyMDIuNjY3LDIwMi42NjdjNDguMjEzLDAsOTIuNDgtMTYuOTgxLDEyNy4zMTctNDUuMTg0bDE0NS42LDE0NS42DQoJCQljNC4xNiw0LjE2LDkuNjIxLDYuMjUxLDE1LjA4Myw2LjI1MXMxMC45MjMtMi4wOTEsMTUuMDgzLTYuMjUxQzUxNC4wOTEsNDk3LjQxMSw1MTQuMDkxLDQ4My45MjgsNTA1Ljc0OSw0NzUuNTg3eg0KCQkJIE0yMDIuNjY3LDM2Mi42NjljLTg4LjIzNSwwLTE2MC03MS43NjUtMTYwLTE2MHM3MS43NjUtMTYwLDE2MC0xNjBzMTYwLDcxLjc2NSwxNjAsMTYwUzI5MC45MDEsMzYyLjY2OSwyMDIuNjY3LDM2Mi42Njl6Ii8+DQoJPC9nPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPC9zdmc+DQo=" height="13px" width="13px" /></button>
            </form>
        </div>

        <!-- utility per il profilo + carrello-->
        <ul class="profile">

            <div id="ciaoIndex">
                <p id="ciao"><?php echo "Ciao " . $info["Nome"] . " " . $info["Cognome"] . "!" ?></p>
            </div>
            <li><a href="add_event.php" id="add_event"><button><i class="fas fa-plus"> AGGIUNGI EVENTO</i></button></a></li>
            <li><a href="login.php" id="login"> Log in </a></li>
            <li><a href="signup.php" id="SignUp"> Sign Up </a></li>
            <li><a href="profile.php" id="profile"><button><i class="fas fa-user"></i></button></a></li>
        </ul>
    </header>

    <!-- ========= LEFT MENU ========== -->
    <div id="left_menu">
        <!-- logo e chiusura -->
        <div class="space_between">
            <div class="logo">
                <a href="index.php">
                    liveXperience
                </a>
            </div>
            <div id="close_left_menu">
                <i class="fas fa-times" onclick="closeLeftMenu()"></i>
            </div>
        </div>
        <!-- menu -->
        <div class="space_around">
            <ul>
                <a href="php/search.php?Categoria=Musica">
                    <li>
                        <i class="fas fa-microphone-alt"></i> &nbsp;Concerti
                    </li>
                </a>
                <a href="php/search.php?Categoria=Sport">
                    <li>
                        <i class="fas fa-futbol"></i> &nbsp;Sport
                    </li>
                </a>
                <a href="php/search.php?Categoria=Teatro">
                    <li>
                        <i class="fas fa-theater-masks"></i> &nbsp;Teatro
                    </li>
                </a>
                <a href="php/search.php?Categoria=Musei">
                    <li>
                        <i class="fas fa-atom"></i> &nbsp;Mostre e Musei
                    </li>
                </a>
                <li>
                    <form action="php/search.php" method="GET">
                        <input name="search_bar" type="text" placeholder="Cerca il tuo evento" name="search">
                        <button type="submit"><img src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pg0KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDE5LjAuMCwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPg0KPHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB2aWV3Qm94PSIwIDAgNTEyLjAwNSA1MTIuMDA1IiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA1MTIuMDA1IDUxMi4wMDU7IiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxnPg0KCTxnPg0KCQk8cGF0aCBkPSJNNTA1Ljc0OSw0NzUuNTg3bC0xNDUuNi0xNDUuNmMyOC4yMDMtMzQuODM3LDQ1LjE4NC03OS4xMDQsNDUuMTg0LTEyNy4zMTdjMC0xMTEuNzQ0LTkwLjkyMy0yMDIuNjY3LTIwMi42NjctMjAyLjY2Nw0KCQkJUzAsOTAuOTI1LDAsMjAyLjY2OXM5MC45MjMsMjAyLjY2NywyMDIuNjY3LDIwMi42NjdjNDguMjEzLDAsOTIuNDgtMTYuOTgxLDEyNy4zMTctNDUuMTg0bDE0NS42LDE0NS42DQoJCQljNC4xNiw0LjE2LDkuNjIxLDYuMjUxLDE1LjA4Myw2LjI1MXMxMC45MjMtMi4wOTEsMTUuMDgzLTYuMjUxQzUxNC4wOTEsNDk3LjQxMSw1MTQuMDkxLDQ4My45MjgsNTA1Ljc0OSw0NzUuNTg3eg0KCQkJIE0yMDIuNjY3LDM2Mi42NjljLTg4LjIzNSwwLTE2MC03MS43NjUtMTYwLTE2MHM3MS43NjUtMTYwLDE2MC0xNjBzMTYwLDcxLjc2NSwxNjAsMTYwUzI5MC45MDEsMzYyLjY2OSwyMDIuNjY3LDM2Mi42Njl6Ii8+DQoJPC9nPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPC9zdmc+DQo=" height="13px" width="13px" /></button>
                    </form>
                </li>
            </ul>
            <ul>
                <a href="login.php">
                    <li>
                        <i class="fas fa-sign-in-alt"></i> &nbsp;Log in
                    </li>
                </a>
                <a href="signup.php">
                    <li>
                        <i class="fas fa-user-plus"></i>&nbsp;Sign Up
                    </li>
                </a>
                <a href="profile.php">
                    <li>
                        <i class="fas fa-user"></i> &nbsp;Profilo
                    </li>
                </a>
                <a href="php/logout.php">
                    <li>
                        <i class="fas fa-sign-out-alt"></i> &nbsp;Log out
                    </li>
                </a>
            </ul>
        </div>
    </div>

    <div id="body-login">
        <img class="onda" src="images/wave.png">
        <div class="container">
            <div class="img">
                <img src="images/bg.svg">
            </div>
            <div class="login-form">
                <form action="php/login.php" method="POST">
                    <img class="avatar" src="images/avatar.svg">
                    <h2 class="title">Benvenuto!</h2>
                    <div class="input-div email">
                        <!-- i = icone -->
                        <div class="i">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="div">
                            <h5>Email</h5>
                            <input type="email" required class="input" name="email">
                            <?php if($error_code == 1){
                                   //errore sulla mail
                                   echo "la mail inserita non è corretta";
                            }?>
                        </div>
                    </div>
                    <div class="input-div password">
                        <div class="i">
                            <i class="fas fa-lock"></i>
                        </div>
                        <div class="div">
                            <h5>Password</h5>
                            <input type="password" name="password" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$" title="La password deve contenere almeno 1 lettera maiuscola, 1 minuscola e 1 numero" required minlength="6" maxlength="16" class="input">
                            <?php if ($error_code == 2){
                                //errore sulla password
                                echo "la password inserita non è corretta";
                            }?>
                        </div>
                    </div>
                    <input type="submit" class="btn" value="Login" name="login">
                    <a href="signup.php">Non hai un account? Clicca qui per crearne uno!</a>
                 </form>
            </div>
        </div>
        <!-- funzione javascript -->
        <script type="text/javascript" src="main.js"></script>
    </div>



<!-- ============= FOOTER ============= -->
<footer>
    <div class="container">
        <div class="sec aboutus">
            <h8>About Us</h8>
            <p>LiveXperience è specializzato nella vendita di biglietti <br>
                per eventi di musica, cultura e sport, <br>
                rivolto a qualsiasi tipo di utente che vuole vivere le emozioni  <br>
                di partecipare a un evento pubblico acquistando il proprio biglietto <br>
                in modo facile e sicuro.</p>
        </div>
        <div class="sec link">
            <h8>Link Utili</h8>
            <ul>
                <li><a href="#">Privacy</a></li>
                <li><a href="#">Informative Cookie</a></li>
            </ul>
        </div>
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
                     <a href="tel:332622778">+39 332 622 778</a></p>
                </li>
                <li>
                    <span><i class="fas fa-balance-scale" aria-hidden="true"></i></span>
                    <p> PIVA: 12345678910</p>
                </li>
            </ul>
        </div>

    </footer>
    <div class="copyright">
        <p>Copyright © 2021 | Tutti i diritti sono riservati.</p>
    </div>


</body>


</html>