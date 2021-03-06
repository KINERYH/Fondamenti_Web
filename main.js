
// ================== CARRELLO ================== 
function addToCart(id,disp,unit_price){
   
    //prendo i dati dell'evento su cui ho cliccato aggiungi al carrello
    var n_biglietti = document.getElementById("numero_biglietti").textContent;
    var title = document.getElementById("cart-title").textContent;
    var date = document.getElementById("cart-date").textContent;
    var img = document.getElementById("cart-img").src;
    
    // creo il vettore con tutti i dati dell'evento clicato, pronto per andare nei cookie del carrello
    var product = [id,title,unit_price,date,img,n_biglietti,disp];

    //controllo se esiste il cookie del carrello prendendo dai cookie "shopping-cart" e verificando che non sia vuoto
    products = getCookie("shopping-cart");
    if (products == null) { // se il carrello è vuoto
        //inizializzo il nuovo vettore degli eventi
        products = [];
        // inserisco nel vettore degli eventi, il vettore del singolo evento
        products.push(product);
    } else {  // se il carrello non è vuoto   
        // controllo se l'evento che sto inserendo è gia presente nel carrello
        var flag = 0;
        for (let i = 0; i < products.length; i++) {
            if (products[i][0] == id) { // l'evento è gia presente
                // incremento la quantità di biglietti di quell'evento già presente nel carrello
                var bigliettiTot = parseInt(products[i][5]) + parseInt(n_biglietti);
                products[i][5] = String(bigliettiTot);
                flag = 1; //segno che l'evento è stato trovato almeno una volta nel carrello
            }
        }
        //se flag == 0, allora l'evento non c'è nel carrello e quindi lo aggiungo in coda al vettore degli eventi
        if (flag == 0) {
            // inserisco nel vettore degli eventi, il vettore del singolo evento 
            products.push(product);
        }


    }

    //Setto il cookie o aggiorno se già esistente
    setCookie("shopping-cart", products, "4");
    // rimuovo tutti gli eventi nel carello per inserire i nuovi   
    removeEvents();
    // Aggiorno il carrello mostrando gli eventi presenti nel cookie "shopping-cart"
    updateCart();
    //apro il carrello
    openSlideMenu();
}

// Funzione per rimuovere dal carrello tutti gli eventi presenti
function removeEvents() {
    // prendo l'elemento con id "cart-events" che contiene gli eventi nel carrello
    var cart_events = document.getElementById("cart-events");
    // conto quanti elementi figli ha il nodo "cart-events"
    var numFigli = cart_events.childElementCount;
    // ciclo per il numero di figli che ha il nodo "cart-events"
    while (cart_events.childElementCount > 1) {
        // rimuovo l'evento presente nel carrello
        cart_events.removeChild(cart_events.childNodes[2]);
    }
}

// funzione per aggiornare il carrello con gli eventi presenti nei cookie
function updateCart(){
    // recuper il vettore degli eventi presenti nel carrello dai cookie 
    var events = getCookie("shopping-cart");
    // setto il prezzo totale a 0
    var total_price=0;
    // prendo il primo evento nel carrello (fittizzio, è un'evento segnaposto)
    var event = document.getElementsByClassName("cart-event")[0];
    //var figlio = event.cloneNode(true);
    
    var lastChild;
    // per ogni elemento nei cookie shipping cart appendo nel carrello un evento
    for(var i = 0; i < events.length; i++){
        document.getElementById("cart-events").appendChild(event.cloneNode(true));
        lastChild = document.getElementById("cart-events").lastChild;
        // sostituisco all'evento segnaposto il titolo
        lastChild.childNodes[3].childNodes[1].childNodes[1].innerHTML=events[i][1];
        // sostituisco all'evento segnaposto la data
        lastChild.childNodes[3].childNodes[1].childNodes[7].innerHTML=events[i][3];
        // sostituisco all'evento segnaposto il prezzo
        lastChild.childNodes[3].childNodes[3].childNodes[3].innerHTML="€"+(parseFloat(events[i][2])*parseFloat(events[i][5])).toFixed(2);
        // sostituisco all'evento segnaposto la disponibilità (invisibile)
        lastChild.childNodes[3].childNodes[3].childNodes[4].innerHTML=events[i][6];
        // sostituisco all'evento segnaposto il prezzo unitario (invisibile)
        lastChild.childNodes[3].childNodes[3].childNodes[5].innerHTML=events[i][2];
        // sostituisco all'evento segnaposto l'id (invisibile)
        lastChild.childNodes[3].childNodes[3].childNodes[6].innerHTML=events[i][0];
        // sostituisco all'evento segnaposto l'immagine
        lastChild.childNodes[1].childNodes[1].src = events[i][4];
        // sostituisco all'evento segnaposto il numero di biglietti
        lastChild.childNodes[3].childNodes[3].childNodes[1].childNodes[3].innerHTML = events[i][5];
        lastChild.style.display = "flex";
        //moltiplico prezzo unitario per biglietti e faccio il totale
        total_price += parseFloat(events[i][2])*parseFloat(events[i][5]);
    }  
    document.getElementById("total-price").innerHTML = total_price.toFixed(2);  
}


// ================ CARICAMENTO SESSIONE PER OGNI PAGINA ===================
function onLoad(session, valAdmin) {
    // verfico se esiste la sessione, ovvero se l'utente è loggato e se è amministratore 
    // e di conseguenza nascondo o meno alcuni bottoni
    nascondoBtn(session, valAdmin);
    // aggiorno il carrello se esiste nei cookie
    updateCart();
}


// aumenta e ridduci n° biglietti nel carello e relativo prezzo
function aumenta_cart(plus){
    // recupero il numero di biglietti inseriti nel carrello
    var n_bigl = parseInt(plus.parentNode.childNodes[3].textContent);
    // recupero il numero di biglietti disponibili in totale
    var disp = parseInt(plus.parentNode.parentNode.childNodes[4].textContent);
    // recupero il prezzo unitario dell'evento
    var unit_price = parseFloat(plus.parentNode.parentNode.childNodes[5].textContent);
    // recupero l'id dell'evento per modificare i cookie
    var id = plus.parentNode.parentNode.childNodes[6].textContent;

    var new_price;
    if (n_bigl<disp){
        // inceremento di 1 il numero di biglietti che vengono mostrati tra i pulsanti
        plus.parentNode.childNodes[3].innerHTML = parseInt(n_bigl)+1;
        // calcolo il nuovo prezzo dato dal nuovo numero di biglietti*prezzo unitario
        new_price = unit_price*parseFloat(plus.parentNode.childNodes[3].textContent);
        // mostro il nuovo prezzo appena calcolato
        plus.parentNode.parentNode.childNodes[3].innerHTML =  "€"+ new_price.toFixed(2);
        
        // modifico i cookie per mantenere aggiorante le informazioni del carrello
        let events = getCookie("shopping-cart");
        // scorro il vettore con gli eventi nel carrello
        for (let i=0;i<events.length; i++){
            // se trovo l'evento con id uguale a quello dell'evento che sto cliccando
            if (events[i][0]==id){
                // assegno il nuovo numero di biglietti
                events[i][5]=plus.parentNode.childNodes[3].textContent;
            }
        }
        // setto i cookie con i nuovi dati
        setCookie("shopping-cart", events, "4");

        // rimuovo gli eventi nel carrello
        removeEvents();
        // aggiorno gli eventi nel carrello
        updateCart();
    }
}

function riduci_cart(meno){
    // recupero l'id dell'evento per modificare i cookie
    var id = meno.parentNode.parentNode.childNodes[6].textContent;
    // recupero il numero di biglietti inseriti nel carrello
    var n_bigl = parseInt(meno.parentNode.childNodes[3].textContent);
    // recupero il prezzo unitario dell'evento
    var unit_price = parseFloat(meno.parentNode.parentNode.childNodes[5].textContent);
    var new_price;
    if (n_bigl>1){
        // inceremento di 1 il numero di biglietti che vengono mostrati tra i pulsanti
        meno.parentNode.childNodes[3].innerHTML = parseInt(n_bigl)-1;
        // calcolo il nuovo prezzo dato dal nuovo numero di biglietti*prezzo unitario
        new_price = unit_price*parseFloat(meno.parentNode.childNodes[3].textContent);
        // mostro il nuovo prezzo appena calcolato
        meno.parentNode.parentNode.childNodes[3].innerHTML =  "€"+ new_price.toFixed(2);

        // modifico i cookie per mantenere aggiorante le informazioni del carrello
        let events = getCookie("shopping-cart");
        // scorro il vettore con gli eventi nel carrello
        for (let i=0;i<events.length; i++){
            // se trovo l'evento con id uguale a quello dell'evento che sto cliccando
            if (events[i][0]==id){
                // assegno il nuovo numero di biglietti
                events[i][5]=meno.parentNode.childNodes[3].textContent;
            }
        }
        // setto i cookie con i nuovi dati
        setCookie("shopping-cart", events, "4");
       // rimuovo gli eventi nel carrello
       removeEvents();
       // aggiorno gli eventi nel carrello
       updateCart();
    }else{// se il numero di biglietti era 1 e ho cliccato meno 
        // modifico i cookie per mantenere aggiorante le informazioni del carrello
        let events = getCookie("shopping-cart");
        // scorro il vettore con gli eventi nel carrello
        for (let i=0;i<events.length; i++){
            // se trovo l'evento con id uguale a quello dell'evento che sto cliccando
            if (events[i][0]==id){
                // rimuovo dai cookie l'evento
                events.splice(i,1); //rimuovo 1 evento in posizione i, gli altri scalano
            }
        }
        // setto i cookie con i nuovi dati
        setCookie("shopping-cart", events, "4");
        // rimuovo gli eventi nel carrello
        removeEvents();
        // aggiorno gli eventi nel carrello
        updateCart();
    }
}

// ================= ACQUISTA DAL CARRELLO ===============
function acquista() {
    // prendo gli eventi nei cookie, che sono gli stessi presenti nel carrello
    cart = getCookie("shopping-cart");
    // verifico che il carrello non sia vuoto
    if (cart != null) {
        // Prendo l'indirizzo della pagina attuale, che potrebbe essere qualsiasi
        // dato che il carrello si può aprire da tutte le pagine
        var path = window.location.pathname;
        // Reindirizzzo alla pagina acquisto.php a seconda della pagina attuale dell'utente
        if(path.includes("/php/")){
            window.location = "../acquisto.php"
        } else {
            window.location = "acquisto.php"
        }
    }
}


// ===== FOCUS - BLUR NEL LOGIN & SIGNUP =====

// Prende tutti gli elementi di classe input
const inputs = document.querySelectorAll('.input');

// Aggiungo effetto al click degli elementi di login e signup
function focusFunc() {
    let parent = this.parentNode.parentNode;
    // aggiungo la classe fous al div che contiene l'input text cliccato
    parent.classList.add('focus');
}

// Elimino l'effetto al click di un diverso elemento
function blurFunc() {
    let parent = this.parentNode.parentNode;
    if (this.value == "") {
        // rimuovo la classe fous al div che contiene l'input text cliccato in precedenza
        parent.classList.remove('focus');
    }

}

// Metto in ascolto gli input 
inputs.forEach(input => {
    input.addEventListener('focus', focusFunc);
    input.addEventListener('blur', blurFunc);
});




// ========= CONFERMA PASSWORD =========

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
    Swal.fire({ // setto gli attributi della libreria per l'alert
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
            setCookie("changePass", nuova_pw, 1);
            Swal.fire({ // setto gli attributi della libreria per l'alert
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
    Swal.fire({ // setto gli attributi della libreria per l'alert
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
            Swal.fire({ // setto gli attributi della libreria per l'alert
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
                    Swal.fire({ // setto gli attributi della libreria per l'alert
                        title: 'Account Eliminato Correttamente',
                        icon: 'success',
                    }).then(function () {
                        // Reindirizzo alla pagina refresh, indicando che ho eliminato il profilo
                        window.location = "refresh.php?delete=1";
                    });
                }
            }))
        } else if (result.isDenied) {  // annulla eliminazione account
            window.location.reload()
        }
    })
}

// ============= slide delle freccie e cambio div in PROFILE ============= //
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
                    // faccio sparire il div che contiene l'immagine
                    document.getElementById("profile-dx_img").style.display = "none";
                    // faccio apparire il div che contiene le informazioni personali
                    document.getElementById("profile-dx_info").style.display = "flex";
                    // faccio sparire il div che contiene gli acquisti effettuati
                    document.getElementById("profile-dx_orders").style.display = "none";
                    break;
                // clik su "i miei acquisti"
                case arrow[1]:
                    // faccio sparire il div che contiene l'immagine
                    document.getElementById("profile-dx_img").style.display = "none";
                    // faccio sparire il div che contiene le informazioni personali
                    document.getElementById("profile-dx_info").style.display = "none";
                    // faccio apparire il div che contiene gli acquisti effettuati
                    document.getElementById("profile-dx_orders").style.display = "flex";
                    break;
                // clik su "cancella registrazione"
                case arrow[2]:
                    // faccio sparire il div che contiene l'immagine
                    document.getElementById("profile-dx_img").style.display = "none";
                    // faccio sparire il div che contiene le informazioni personali
                    document.getElementById("profile-dx_info").style.display = "none";
                    // faccio sparire il div che contiene gli acquisti effettuati
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




// =========== SLIDE MENU CARRELLO ============

// click sul bottone per aprire il carrello
function openSlideMenu() {
    // Imposto larghezza del menu del carrello al click del bottone
    document.getElementById('menu').style.width = '360px';
    document.getElementById('slcontent').style.marginRight = '360px';
    // aggiungo l'overlay per oscurare il resto del sito
    var overlay = document.createElement('div');
    overlay.id = 'overlay-cart';
    document.body.appendChild(overlay);
}
// click sul bottone per chiudere il carrello
function closeSlideMenu() { 
    // Imposto larghezza del menu del carrello al click del bottone a 0 per farlo sparire
    document.getElementById('menu').style.width = '0';
    document.getElementById('slcontent').style.marginRight = '0';
    // rimuovo l'overlay che oscura il resto del sito
    document.getElementById('overlay-cart').style.background = 'transparent';
    setTimeout(
        function () {
            document.getElementById('overlay-cart').remove();
        }, 200);
}

// ======== LEFT MENU MOBILE ========= //

function openLeftMenu() {  //apertura carrello
    // Imposto larghezza del menu di sinistra
    document.getElementById('left_menu').style.width = '350px';
    // aggiungo l'overlay per oscurare il resto del sito
    var overlay = document.createElement('div');
    overlay.id = 'overlay-cart';
    document.body.appendChild(overlay);
}
function closeLeftMenu() {  //chiusura carrello
    // Imposto larghezza del menu di sinistra a zero per farlo sparire
    document.getElementById('left_menu').style.width = '0';
    // rimuovo l'overlay che oscura il resto del sito
    document.getElementById('overlay-cart').style.background = 'transparent';
    setTimeout(
        function () {
            document.getElementById('overlay-cart').remove();
        },700);
}



// ============ Modifica prezzo e numero biglietti in base ai click su (+) o (-) nella pagina dell'evento ============ //

function riduci(prezzo,element) {
    // prendo il numero dei biglietti attuale
    var n = document.getElementById("numero_biglietti").textContent;
    // lo trasformo in integer per svolgere operazioni
    n = parseInt(n);
    // verifico che il numero di biglietti sia maggiore di 1
    if (n > 1) {
        // dimuisco n
        n = n - 1;
        // aggiorno il valore di n nella pagina
        document.getElementById("numero_biglietti").innerHTML = n;
        // calcolo il nuovo prezzo dato da n*(prezzo unitario)
        var prezzo = "€" + (n * prezzo).toFixed(2);
        // aggiorno il valore del prezzo nella pagina
        document.getElementById("cart-price").innerHTML = prezzo;
        // imposto il colore nero del bottone (+)
        element.parentNode.childNodes[5].style.color = "black";
        // faccio scomparire l'avviso relativo al numero di biglietti massimo raggiunto
        document.getElementById("avvisoPosti").style.fontSize = "0";
    }
    if (n == 1) {
        // raggiunto il limite inferiore del numero di biglietti quindi imposto il colore rosso al bottone (-)
        element.style.color = "red";
    }

}
function aumenta(prezzo, limitePosti,element) {
    // prendo il numero dei biglietti attuale
    var n = document.getElementById("numero_biglietti").textContent;
    // lo trasformo in integer per svolgere operazioni
    n = parseInt(n);
    // verifico che il numero di biglietti sia minore del limite dei biglietti disponibile
    if (n < limitePosti) {
        // incremento n
        n = n + 1;
        // aggiorno il valore di n nella pagina
        document.getElementById("numero_biglietti").innerHTML = n;
        // calcolo il nuovo prezzo dato da n*(prezzo unitario)
        var prezzo = "€" + (n * prezzo).toFixed(2);
        // aggiorno il valore del prezzo nella pagina
        document.getElementById("cart-price").innerHTML = prezzo;
        // imposto il colore nero del bottone (-)
        element.parentNode.childNodes[1].style.color = "black";
    }
    // se n ha raggiunto il limite dei posti disponibile
    if (n == limitePosti) { 
        // raggiunto il limite superiore del numero di biglietti quindi imposto il colore rosso al bottone (+)
        element.style.color = "red";
        // faccio apparire l'avviso del numero max dei posti disponibili
        document.getElementById("avvisoPosti").style.fontSize = ".9em";
    }

}
// funzione per aprire la pagina del singolo evento in base alla posizione nelle cartelle
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
    if (session == 1) { // se esiste una sessione
        //Nascondo i link di login e signup se l'utente è loggato
        document.getElementById("login").style.display = "none";
        document.getElementById("SignUp").style.display = "none";
        // se l'utente loggato non è admin
        if (valAdmin == 0) {
            // nascondo il bottone per aggiungere un evento
            document.getElementById("add_event").style.display = "none";
        }
        
    }
    else if (session == "0") { // se NON esiste una sessione
        //Nascondo i bottoni del profilo e del carrello e la scritta "Ciao nome+cognome" se l'utente non è loggato
        document.getElementById("profile").style.display = "none";
        document.getElementById("ciao").style.display = "none";
        document.getElementById("ciaoIndex").style.display = "none";
        document.getElementById("add_event").style.display = "none";
    }

}

/* ================= COOKIES ================= */

// setto i cookie convertendo array in stringa JSON
function setCookie(name, value, days) {
    // converto l'array in stringa JSON
    var values = JSON.stringify(value);
    // inizializzo "expires" per creare i cookie
    var expires = "";
    if (days) {
        // prendo data e sommo numero giorni
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    // setto i cookie concatenando le stringhe costruite
    document.cookie = name + "=" + (values || "") + expires + "; path=/";
}

// Ottengo i cookie e li converto da JSON in un array js 
function getCookie(name) {
    var nameEQ = name + "=";
    // creo un vettore di eventi dai cookie divisi tramite ";"
    var ca = document.cookie.split(';');
    // ciclo per la lunghezza del vettore
    for (var i = 0; i < ca.length; i++) {
        // prendo l'elemento i-esimo del vettore
        var c = ca[i];
        // PIETRO SCRIVI COSA FA QUESTA ROBA
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) {
            var values = c.substring(nameEQ.length, c.length);
            return JSON.parse(values);
        }
    }
    return null;
}
// funzione per eliminare i cookie
function deleteCookie(name) {
    document.cookie = name + '=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}
