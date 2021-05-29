// =========== Focus - Blur nel login e signup ============ //

// prende tutti gli elemnti di classe input
const inputs = document.querySelectorAll('.input');

function focusFunc() {
    let parent = this.parentNode.parentNode;
    parent.classList.add('focus');
}

function blurFunc() {
    let parent = this.parentNode.parentNode;
    if (this.value == "") {
        parent.classList.remove('focus');
    }

}

// metto in ascolto gli input 
inputs.forEach(input => {
    input.addEventListener('focus', focusFunc);
    input.addEventListener('blur', blurFunc);
});


// Conferma Password

var password = document.getElementById("password"), conferma_password = document.getElementById("conferma_password");

function convalidaPassword() {
    if (password.value != conferma_password.value) {
        conferma_password.setCustomValidity("Le password non corrispondono");
    } else {
        conferma_password.setCustomValidity('');
    }
}

password.onchange = convalidaPassword;
conferma_password.onkeyup = convalidaPassword;


// =========== ALERT CON SWEETALERT ============= //


// Alert per modifica password
function changePasswordAlert() {
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
            // Per ora metto la vecchia password posta pari a "password" --> refactorizzare il codice quando colleghiamo il db
            const old_password = 'password'
            // Prendo i valori inseriti nei campi ed eseguo dei controlli
            const old_pw = Swal.getPopup().querySelector('#old_pw').value
            const confirm_pw = Swal.getPopup().querySelector('#confirm_pw').value
            const new_pw = Swal.getPopup().querySelector('#new_pw').value
            // Per ora controllo solo se i campi sono vuoti, se le password nuove coincidono o se la password vecchia coincide
            if (!old_pw || !new_pw || !confirm_pw) {
                Swal.showValidationMessage(`E' necessario riempire tutti i campi`)
            } else if (old_pw != old_password){  // controllo se la password vecchia inserita è uguale a quella attuale
                Swal.showValidationMessage(`La password attuale immessa non è corretta`)
            }else if (confirm_pw != new_pw) {   // controllo se la password nuova inserita è uguale al campo dove si conferma la password nuova
                Swal.showValidationMessage(`Le due password immesse sono differenti`)
            } else if (confirm_pw.length < 8 || new_pw.length < 8) {  // controllo che la password sia almeno lunga 8 caratteri
                Swal.showValidationMessage(`La password deve avere almeno una lunghezza di 8 caratteri`)
            }
        }
        // Faccio apparire solo il messaggio --> modificare la password nel db quando lo colleghiamo
    }).then((result) => {
        if(result.isConfirmed){
             Swal.fire({
            title: 'Password Modificata Correttamente',
            icon: 'success',
        });
        }
       
    })
}

// Alert per conferma eliminazione account
function deleteAccountAlert(){
    Swal.fire({
        title: 'Eliminazione account',
        text: "Sei veramente sicuro di voler eliminare l'account?",
        icon: 'warning',
        confirmButtonText: 'Si',
        showDenyButton: true,
        allowOutsideClick: false,
        allowEscapeClick: false,
        position:'center-end'
    }).then((result) => { // volontà di eliminare l'account -> chiedo la password
        if(result.isConfirmed){
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
                preConfirm: (password) => {
                    // Confronto a caso con password123 --> refactorizzare per eseguire il confronto con la pw nel db
                    if(password != 'password123'){ // la passsword non è corretta
                        Swal.showValidationMessage(`La password immessa non è corretta`)
                    }
                }
            }).then((result => {  // la passsword è corretta
                // Faccio uscire il messaggio --> aggiornare il codice eliminando il profilo e facendo tornare alla schermata principale senza essere loggati
                if(result.isConfirmed){
                    Swal.fire({
                        title: 'Account Eliminato Correttamente',
                        icon: 'success',
                    });
                }
            }))
        } else if(result.isDenied){  // annulla eliminazione account
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
    for (var i=0;i<arrow.length;i++){
        // elemento cliccato 
        if (arrow[i].id==arrowId.id){   
            // aggiungo la classe "active" all'elemento cliccato per far muovere la freccia
            arrow[i].classList.add("active");
            // rimuovo la classe "h3hover" dall'elemento clicato
            h3[i].classList.remove("h3hover");
            switch (arrowId) {
                // clik su "informazioni personali"
                case arrow[0]:
                    document.getElementById("profile-dx_img").style.display="none";
                    document.getElementById("profile-dx_info").style.display="flex";
                    document.getElementById("profile-dx_orders").style.display="none";
                    break;
                // clik su "i miei acquisti"
                case arrow[1]:
                    document.getElementById("profile-dx_img").style.display="none";
                    document.getElementById("profile-dx_info").style.display="none";
                    document.getElementById("profile-dx_orders").style.display="flex";
                    break;
                // clik su "cancella registrazione"
                case arrow[2]:
                    document.getElementById("profile-dx_img").style.display="none";
                    document.getElementById("profile-dx_info").style.display="none";
                    document.getElementById("profile-dx_orders").style.display="none";
                default:
                    break;
            }
        } else{   // elementi non cliccati
            // rimuovo la classe "active" all'elemento non cliccato
            arrow[i].classList.remove("active");
            // aggiungo la classe "h3hover" all'elemento non cliccato
            h3[i].classList.add("h3hover");
        }
    }
}




// ======== Slide MENU Carrello ========= //

function openSlideMenu(){  //apertura carrello
    document.getElementById('menu').style.width = '400px';
    document.getElementById('slcontent').style.marginRight = '400px';
}
function closeSlideMenu(){  //chiusura carrello
    document.getElementById('menu').style.width = '0';
    document.getElementById('slcontent').style.marginRight = '0';
}

// ======== Modifica prezzo e numero biglietti in base ai click su + o - ======== //

function riduci(prezzo){
    var n = document.getElementById("numero_biglietti").textContent;
    n = parseInt(n);
    if (n>1){
    n=n-1;
    document.getElementById("numero_biglietti").innerHTML = n;
    var prezzo = "€" + (n*prezzo).toFixed(2);
    document.getElementById("prezzo").innerHTML = prezzo ; 
    var plus = document.getElementsByClassName("fa-plus");
        plus[0].style.color="black";
        document.getElementById("avvisoPosti").style.fontSize = "0";
    }
    if (n==1){
        var meno = document.getElementsByClassName("fa-minus");
        meno[0].style.color="red";  
    }
    
}
function aumenta(prezzo, limitePosti){
    var n = document.getElementById("numero_biglietti").textContent;
    n = parseInt(n);
    if (n < limitePosti){
    n=n+1;
    document.getElementById("numero_biglietti").innerHTML = n;
    var prezzo = "€" + (n*prezzo).toFixed(2);
    document.getElementById("prezzo").innerHTML = prezzo;
    var meno = document.getElementsByClassName("fa-minus");
        meno[0].style.color="black";
    }
    if (n == limitePosti){
        var piu = document.getElementsByClassName("fa-plus");
        piu[0].style.color="red";
        document.getElementById("avvisoPosti").style.fontSize = ".9em";
    }    
    
}

function apriEvento(id){
    var page='event.php?id='+id;
    document.location.href=page;
}

function apriEvento1(id){
    var page='php/event.php?id='+id;
    document.location.href=page;
}
