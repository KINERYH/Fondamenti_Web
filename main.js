// Focus - Blur nel login e signup

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


// ALERT CON SWEETALERT


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
            const old_pw = Swal.getPopup().querySelector('#old_pw').value
            const confirm_pw = Swal.getPopup().querySelector('#confirm_pw').value
            const new_pw = Swal.getPopup().querySelector('#new_pw').value
            // Per ora controllo solo se i campi sono vuoti, se le password nuove coincidono o se la password vecchia coincide
            if (!old_pw || !new_pw || !confirm_pw) {
                Swal.showValidationMessage(`E' necessario riempire tutti i campi`)
            } else if (old_pw != old_password){
                Swal.showValidationMessage(`La password attuale immessa non è corretta`)
            }else if (confirm_pw != new_pw) {
                Swal.showValidationMessage(`Le due password immesse sono differenti`)
            } else if (confirm_pw.length < 8 || new_pw.length < 8) {
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
        }else{
            Swal.fire({
                title: 'La modifica della password non è andata a buon fine',
                icon: 'error',
                customClass: {
                  container: 'position-absolute'
                },
                toast: true,
              })
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
    }).then((result) => {
        if(result.isConfirmed){
            Swal.fire({
                title: "Inserisci la password per confermare di voler eliminare l'account",
                icon: 'warning',
                input: 'password',
                confirmButtonText: 'Conferma',
                confirmButtonColor: 'red',
                showDenyButton: true,
                denyButtonText: 'Annulla',
                denyButtonColor: 'orange',
                preConfirm: (password) => {
                    // Confronto a caso con password123 --> refactorizzare per eseguire il confronto con la pw nel db
                    if(password != 'password123'){
                        Swal.showValidationMessage(`La password immessa non è corretta`)
                    }
                }
            }).then((result => {
                //Faccio uscire il messaggio --> aggiornare il codice eliminando il profilo e facendo tornare alla schermata principale senza essere loggati
                if(result.isConfirmed){
                    Swal.fire({
                        title: 'Account Eliminato Correttamente',
                        icon: 'success',
                    });
                }
            }))
        }
    })
}




