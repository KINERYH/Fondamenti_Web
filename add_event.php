<?php
session_start();
// $check = (!isset($_SESSION['infoUtente']) || empty($_SESSION['infoUtente']));
if (!isset($_SESSION['infoUtente'])) { //Non riporta l'errore
    error_reporting(0);
    $valAdmin = 0;
} else {
    $info = $_SESSION["infoUtente"]; //Mi da le informazioni dell'utente loggato
    $valAdmin = $info["isAdmin"];
}
if (empty(isset($_SESSION['infoUtente'])) ){
    $session = "0";
}else{
    $session = isset($_SESSION['infoUtente']);
}
?>



<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <!-- ============= RESET STYLE ============= -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css"
        integrity="sha512-NmLkDIU1C/C88wi324HBc+S2kLhi08PN5GDeUVVVC/BVt/9Izdsc9SVeVfA1UZbY3sHUlDSyRXhCzHfr6hmPPw=="
        crossorigin="anonymous" />
    <!-- ============= STYLE ============= -->
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/signup.css">
    <link rel="stylesheet" href="css/add_event.css">
    <!-- ============= Google Font ============= -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Righteous&family=Rubik&display=swap" rel="stylesheet">
   
   <!-- ICON -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
    <script src="hhtps://kit.fontawesome.com/a81368914c.js"></script>
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
                <input name="search_bar" type="text" placeholder="Cerca il tuo evento">
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

 
    <!-- ============= SLIDE SIDE CART ============= -->

    <div id="slcontent">
        <div id="menu" class="nav">
            <h13>Carrello</h13>
            <a href="#" class="close" onclick="closeSlideMenu()">
                <i class="fas fa-times"></i></a>
            <input type="submit" class="btn" value="Acquista">
        </div>
    </div>


<div id="body-addevent">
    <img class="onda" src="images/wave.png">
	<div class="container">
		<div class="img">
			<img src="images/add_event.svg">
		</div>
		<div class="addevent-form">
			<form action="php/add_event.php" method="POST" enctype="multipart/form-data">
				<h2 class="title">Inserisci evento</h2>

                <div class="input-div nome">
                    <!-- i = icone -->
                   <div class="i">
                           <i class="fas fa-pencil-alt"></i>
                   </div>
                   <div class="div">
                           <h5>Nome</h5>
                           <input type="text" name="nome" required class="input">
                   </div>
                </div>

                <div class="input-div descrizione" style="height:100px">
                    <!-- i = icone -->
                   <div class="i">
                           <i class="fas fa-bars"></i>
                   </div>
                   <div class="div">
                           <h5>Descrizione</h5>
                           <textarea class="input" name="descrizione" style="resize: none; height:95px"></textarea>
                   </div>
                </div>
           		
                <div class="input-div data">
                       <!-- i = icone -->
           		   <div class="i">
           		   		<i class="fas fa-calendar"></i>
           		   </div>
           		   <div class="div">
           		   		<input type="date" name="data" required class="input">
           		   </div>
           		</div>
           		
                   <div class="input-div prezzo">
           		   <div class="i"> 
           		    	<i class="fas fa-euro-sign"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Prezzo</h5>
           		    	<input type="number" name="prezzo" max="9999" required class="input">
            	   </div>
            	</div>
             
                <div class="input-div luogo">
           		   <div class="i"> 
           		    	<i class="fas fa-map-marked-alt"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Luogo</h5>
           		    	<input type="text" name="luogo" class="input">
            	   </div>
            	</div>
                
                <div class="input-div disponibilita">
           		   <div class="i"> 
           		    	<i class="fas fa-ticket-alt"></i>
           		   </div>
           		   <div class="div">
                        <h5>Disponibilità</h5>
           		    	<input type="number" name="disponibilita" max="999999" required class="input">
            	   </div>
            	</div>
                
                    
                <div class="select">
                    <select name="format" id="format" required>
                        <option selected disabled>Scegli una categoria</option>
                        <option name="cat" value="Musica">Concerti</option>
                        <option name="cat" value="Sport">Sport</option>
                        <option name="cat" value="Teatro">Teatro</option>
                        <option name="cat" value="Mostre_e_Musei">Mostre e Musei</option>
                    </select>
                </div>

                <div class="input-div image">
                    <label>
                        <input type="file" name="imgUpload" accept="image/*">
                        <i class="fas fa-cloud-upload-alt"></i> Carica un'immagine
                    </label>
                </div>

                    <input type="submit" class="btn" value="Inserisci">
            </div>
        </div>
    </div>
                
                
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
         </div>

    </footer>
    <div class="copyright">
        <p>Copyright © 2021 | Tutti i diritti sono riservati.</p>
    </div>





</body>
</html>