// ===== FOCUS - BLUR NEL LOGIN & SIGNUP =====

// Prende tutti gli elementi di classe input
const inputs = document.querySelectorAll('.input');

// Aggiungo effetto al click degli elementi di login e signup
function focusFunc() {
    let parent = this.parentNode.parentNode;
    parent.classList.add('focus');
}

// Elimino effetto al click di un diverso elemento
function blurFunc() {
    let parent = this.parentNode.parentNode;
    if (this.value == "") {
        parent.classList.remove('focus');
    }

}

// Metto in ascolto gli input 
inputs.forEach(input => {
    input.addEventListener('focus', focusFunc);
    input.addEventListener('blur', blurFunc);
});




// ===== CONFERMA PASSWORD =====

// Prendo gli ID di 'password' e 'conferma_password'
var password = document.getElementById("password"), conferma_password = document.getElementById("conferma_password");

// Se le 2 password non corrispondono viene mostrato il messaggio di errore
function convalidaPassword() {
    if (password.value != conferma_password.value) {
        conferma_password.setCustomValidity("Le password non corrispondono");
    } else {
        conferma_password.setCustomValidity('');
    }
}

// Uso onchange e onkeyup per memorizzare temporaneamente i valori di 'password' e 'conferma_password' alla pressione dei loro input. 
password.onchange = convalidaPassword();
conferma_password.onkeyup = convalidaPassword();

// Alert per modifica password
function changePasswordAlert(old_password) {
    var nuova_pw;
    Swal.fire({
        title: "Modifica la Password",
        html: '<h1>Inserisci la password Attuale </h1><input type="password" id="old_pw" class="swal2-input" placeholder="Password Attuale">' +
            '<h1> Inserisci la nuova password </h1><input type="password" id="new_pw" class="swal2-input" placeholder="Nuova Password">' +
            '<h1> Conferma la nuova password </h1><input type="password" id="confirm_pw" class="swal2-input" placeholder="Nuova Password">',
        confirmButtonText: 'Conferma',
        showCancelButton: true,
        cancelButtonText: "Annulla",
        focusConfirm: false,
        preConfirm: () => {
            // Prendo i valori inseriti nei campi ed eseguo dei controlli
            const old_pw = Swal.getPopup().querySelector('#old_pw').value
            const confirm_pw = Swal.getPopup().querySelector('#confirm_pw').value
            const new_pw = Swal.getPopup().querySelector('#new_pw').value
            nuova_pw = new_pw;
            //Uso la libreria CryptoJS per criptare la password inserita
            var old_crypto = CryptoJS.MD5(old_pw);
            // Per ora controllo solo se i campi sono vuoti, se le password nuove coincidono o se la password vecchia coincide
            if (!old_pw || !new_pw || !confirm_pw) {
                Swal.showValidationMessage(`E' necessario riempire tutti i campi`)
            } else if (old_crypto != old_password) {  // controllo se la password vecchia inserita è uguale a quella attuale
                Swal.showValidationMessage(`La password attuale immessa non è corretta`)
            } else if (confirm_pw != new_pw) {   // controllo se la password nuova inserita è uguale al campo dove si conferma la password nuova
                Swal.showValidationMessage(`Le due password immesse sono differenti`)
            } else if (confirm_pw.length < 8 || new_pw.length < 8) {  // controllo che la password sia almeno lunga 8 caratteri
                Swal.showValidationMessage(`La password deve avere almeno una lunghezza di 8 caratteri`)
            }
        }
        // Faccio apparire solo il messaggio --> modificare la password nel db quando lo colleghiamo
    }).then((result) => {
        if (result.isConfirmed) {
            setCookie("unknown", nuova_pw, 1);
            Swal.fire({
                title: 'Password Modificata Correttamente',
                icon: 'success',
                allowOutsideClick: false,
                allowEscapeClick: false,
            }).then(function () {
                window.location = "refresh.php";
            });
        }
    })
}

// Alert per conferma eliminazione account
function deleteAccountAlert(oldpassword) {
    Swal.fire({
        title: 'Eliminazione account',
        text: "Sei veramente sicuro di voler eliminare l'account?",
        icon: 'warning',
        confirmButtonText: 'Si',
        showDenyButton: true,
        allowOutsideClick: false,
        allowEscapeClick: false,
        position: 'center-end'
    }).then((result) => { // volontà di eliminare l'account -> chiedo la password
        if (result.isConfirmed) {
            Swal.fire({
                title: "Inserisci la password per confermare di voler eliminare l'account",
                icon: 'warning',
                input: 'password',
                confirmButtonText: 'Conferma',
                confirmButtonColor: 'red',
                allowOutsideClick: false,
                allowEscapeClick: false,
                showDenyButton: true,
                denyButtonText: 'Annulla',
                denyButtonColor: 'gray',
                preConfirm: (password) => { //password che inserisco
                    var old_crypto = CryptoJS.MD5(password);
                    // Confronto con oldpassword del database
                    if (old_crypto != oldpassword) { // la passsword non è corretta
                        Swal.showValidationMessage(`La password immessa non è corretta`)
                    }
                }
            }).then((result => {  // la passsword è corretta
                // Faccio uscire il messaggio --> aggiornare il codice eliminando il profilo e facendo tornare alla schermata principale senza essere loggati
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Account Eliminato Correttamente',
                        icon: 'success',
                    }).then(function () {
                        window.location = "refresh.php?delete=1";
                    });
                }
            }))
        } else if (result.isDenied) {  // annulla eliminazione account
            window.location.reload()
        }
    })
}

// ========== slide delle freccie e cambio div in PROFILE ========== //
function arrowActive(arrowId) {
    var arrow = document.getElementsByClassName("fas fa-arrow-right");
    // inserisco in un array i 3 elementi con tag <h3> 
    var h3 = document.getElementById("profile-sx").getElementsByTagName("h3");
    // scorro l'array 
    for (var i = 0; i < arrow.length; i++) {
        // elemento cliccato 
        if (arrow[i].id == arrowId.id) {
            // aggiungo la classe "active" all'elemento cliccato per far muovere la freccia
            arrow[i].classList.add("active");
            // rimuovo la classe "h3hover" dall'elemento clicato
            h3[i].classList.remove("h3hover");
            switch (arrowId) {
                // clik su "informazioni personali"
                case arrow[0]:
                    document.getElementById("profile-dx_img").style.display = "none";
                    document.getElementById("profile-dx_info").style.display = "flex";
                    document.getElementById("profile-dx_orders").style.display = "none";
                    break;
                // clik su "i miei acquisti"
                case arrow[1]:
                    document.getElementById("profile-dx_img").style.display = "none";
                    document.getElementById("profile-dx_info").style.display = "none";
                    document.getElementById("profile-dx_orders").style.display = "flex";
                    break;
                // clik su "cancella registrazione"
                case arrow[2]:
                    document.getElementById("profile-dx_img").style.display = "none";
                    document.getElementById("profile-dx_info").style.display = "none";
                    document.getElementById("profile-dx_orders").style.display = "none";
                default:
                    break;
            }
        } else {   // elementi non cliccati
            // rimuovo la classe "active" all'elemento non cliccato
            arrow[i].classList.remove("active");
            // aggiungo la classe "h3hover" all'elemento non cliccato
            h3[i].classList.add("h3hover");
        }
    }
}




// ===== SLIDE MENU CARRELLO ======

// Imposto larghezza del menu del carrello al click del bottone
function openSlideMenu() {
    document.getElementById('menu').style.width = '400px';
    document.getElementById('slcontent').style.marginRight = '400px';
    var overlay = document.createElement('div');
    overlay.id = 'overlay-cart';
    document.body.appendChild(overlay);
}
function closeSlideMenu() {  //chiusura carrello
    document.getElementById('menu').style.width = '0';
    document.getElementById('slcontent').style.marginRight = '0';
    document.getElementById('overlay-cart').style.background = 'transparent';
    setTimeout(
        function () {
            document.getElementById('overlay-cart').remove();
        }, 200);
}

// ======== LEFT MENU MOBILE ========= //

function openLeftMenu() {  //apertura carrello
    document.getElementById('left_menu').style.width = '350px';
    var overlay = document.createElement('div');
    overlay.id = 'overlay-cart';
    document.body.appendChild(overlay);
}
function closeLeftMenu() {  //chiusura carrello
    document.getElementById('left_menu').style.width = '0';
    document.getElementById('overlay-cart').style.background = 'transparent';
    setTimeout(
        function () {
            document.getElementById('overlay-cart').remove();
        }, 500);
}



// ======== Modifica prezzo e numero biglietti in base ai click su + o - ======== //

function riduci(prezzo) {
    var n = document.getElementById("numero_biglietti").textContent;
    n = parseInt(n);
    if (n > 1) {
        n = n - 1;
        document.getElementById("numero_biglietti").innerHTML = n;
        var prezzo = "€" + (n * prezzo).toFixed(2);
        document.getElementById("prezzo").innerHTML = prezzo;
        var plus = document.getElementsByClassName("fa-plus");
        plus[0].style.color = "black";
        document.getElementById("avvisoPosti").style.fontSize = "0";
    }
    if (n == 1) {
        var meno = document.getElementsByClassName("fa-minus");
        meno[0].style.color = "red";
    }

}
function aumenta(prezzo, limitePosti) {
    var n = document.getElementById("numero_biglietti").textContent;
    n = parseInt(n);
    if (n < limitePosti) {
        n = n + 1;
        document.getElementById("numero_biglietti").innerHTML = n;
        var prezzo = "€" + (n * prezzo).toFixed(2);
        document.getElementById("prezzo").innerHTML = prezzo;
        var meno = document.getElementsByClassName("fa-minus");
        meno[0].style.color = "black";
    }
    if (n == limitePosti) {
        var piu = document.getElementsByClassName("fa-plus");
        piu[0].style.color = "red";
        document.getElementById("avvisoPosti").style.fontSize = ".9em";
    }

}

function apriEvento(id) {
    var page = 'event.php?id=' + id;
    document.location.href = page;
}

function apriEvento1(id) {
    var page = 'php/event.php?id=' + id;
    document.location.href = page;
}

/* ====== CONTROLLI SESSIONE E LOGIN ====== */
function nascondoBtn(session, valAdmin) {
    //Nascondo i link di login e signup se l'utente è loggato
    console.log(valAdmin);
    console.log(session);
    if (session == 1) { // se esiste una sessione
        console.log(valAdmin);
        if (valAdmin == 0) {
            document.getElementById("add_event").style.display = "none";
        }
        document.getElementById("login").style.display = "none";
        document.getElementById("SignUp").style.display = "none";
    }
    //Nascondo i bottoni del profilo e del carrello e la scritta "Ciao nome+cognome" se l'utente non è loggato
    else if (session == "0") { // se NON esiste una sessione
        document.getElementById("profile").style.display = "none";
        document.getElementById("ciao").style.display = "none";
        document.getElementById("ciaoIndex").style.display = "none";
        document.getElementById("add_event").style.display = "none";
    }

}

/* ============ COOKIES ============ */

// setto i cookie convertendo array in stringa JSON
function setCookie(name, value, days) {
    var values = JSON.stringify(value);
    var expires = "";
    if (days) {
        // prendo data e sommo numero giorni
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (values || "") + expires + "; path=/";
}

// Ottengo i cookie e li converto da JSON in un array js 
function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) {
            var values = c.substring(nameEQ.length, c.length);
            return JSON.parse(values);
        }
    }
    return null;
}

function deleteCookie(name) {
    document.cookie = name + '=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}

// dobbiamo prendere titolo, data, prezzo, immagine e quantità selezionata dall'utente
function addToCart(id, disp) {

    //prendo i dati dell'evento su cui ho cliccato aggiungi al carrello
    var n_biglietti = document.getElementById("numero_biglietti").textContent;
    var title = document.getElementById("cart-title").textContent;
    var price = document.getElementById("cart-price").textContent;
    var date = document.getElementById("cart-date").textContent;
    var img = document.getElementById("cart-img").src;

    var product = [id, title, price, date, img, n_biglietti, disp];

    //controllo se esiste il cookie del carrello
    products = getCookie("shopping-cart");
    if (products == null) { // se il carrello è vuoto
        console.log("sono nel ramo del null");
        console.log(getCookie("shopping-cart"));
        products = [];
        products.push(product);
    } else {  // se il carrello non è vuoto   
        // controllo se l'evento che sto inserendo è gia presente nel carrello
        console.log("sono nel ramo del non null");
        var flag = 0;
        for (let i = 0; i < products.length; i++) {
            if (products[i][0] == id) { // l'evento è gia presente
                var bigliettiTot = parseInt(products[i][5]) + parseInt(n_biglietti);
                products[i][5] = String(bigliettiTot);
                flag = 1;
            }
        }
        if (flag == 0) { //se flag == 0, allora l'evento non c'è nel carrello e quindi lo aggiungo in coda al vettore degli eventi
            products.push(product);
        }


    }

    //Setto il cookie
    setCookie("shopping-cart", products, "4");
    // rimuovo tutti gli eventi nel carello per inserire i nuovi   
    removeEvents();
    //Aggiorno i prodotti nel carrello (togliendo quelli che stavano prima)
    //(i child nodes incrementano di 2 in 2 a partire da 1)
    console.log(getCookie("shopping-cart"));
    updateCart();
    openSlideMenu();
}

function removeEvents() {
    var cart_events = document.getElementById("cart-events");
    var numFigli = cart_events.childElementCount;
    while (cart_events.childElementCount > 1) {
        cart_events.removeChild(cart_events.childNodes[2]);
    }
}

function updateCart() {
    var total_price;
    var event = document.getElementsByClassName("cart-event")[0];
    //var figlio = event.cloneNode(true);
    var events = getCookie("shopping-cart");
    var lastChild;
    for (var i = 0; i < events.length; i++) {
        document.getElementById("cart-events").appendChild(event.cloneNode(true));
        lastChild = document.getElementById("cart-events").lastChild;
        lastChild.childNodes[3].childNodes[1].childNodes[1].innerHTML = events[i][1];
        lastChild.childNodes[3].childNodes[1].childNodes[7].innerHTML = events[i][3];
        lastChild.childNodes[3].childNodes[3].childNodes[3].innerHTML = events[i][2];
        lastChild.childNodes[3].childNodes[3].childNodes[4].innerHTML = events[i][6];
        lastChild.childNodes[1].childNodes[1].src = events[i][4];
        lastChild.childNodes[3].childNodes[3].childNodes[1].childNodes[3].innerHTML = events[i][5];
        lastChild.style.display = "flex";
        //moltiplico prezzo unitario per biglietti e faccio il totale
        total_price = + parseFloat(events[i][2].replace('€', '')) * parseFloat(events[i][5]);
    }
    document.getElementById("total-price").innerHTML = total_price;
}

function onLoad(session, valAdmin) {
    nascondoBtn(session, valAdmin);
    updateCart();
}


// aumenta e ridduci n° biglietti nel carello e relativo prezzo
function aumenta_cart(plus) {
    console.log(plus);
    var n_bigl = plus.parentNode.childNodes[3].textContent;
    var disp = plus.parentNode.parentNode.childNodes[4].textContent;
    var new_price;
    console.log(disp);
    if (n_bigl < disp) {
        plus.parentNode.childNodes[3].innerHTML = parseInt(n_bigl) + 1;
        new_price = parseFloat(plus.parentNode.parentNode.childNodes[3].textContent.replace('€', '')) * plus.parentNode.childNodes[3].textContent;
        console.log(new_price);
        plus.parentNode.parentNode.childNodes[3].innerHTML = "€" + new_price;

    }
}

function riduci_cart(meno) {
    var n_bigl = meno.parentNode.childNodes[3].textContent;
    var disp = meno.parentNode.parentNode.childNodes[4].textContent;

    if (n_bigl > 1) {
        //meno.parentNode.childNodes[3].innerHTML =  
    }
}

function acquista() {
    cart = getCookie("shopping-cart");
    if (cart != null) {
        window.location = "acquisto.php"
    }
}