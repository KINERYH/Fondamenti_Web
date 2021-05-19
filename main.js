// Focus - Blur nel login e signup

const inputs = document.querySelectorAll('.input');

function focusFunc(){
    let parent = this.parentNode.parentNode;
    parent.classList.add('focus');
}

function blurFunc(){
    let parent = this.parentNode.parentNode;
    if(this.value == ""){
        parent.classList.remove('focus');
    }
    
}

inputs.forEach(input => {
    input.addEventListener('focus', focusFunc);
    input.addEventListener('blur', blurFunc);
});


// Conferma Password

var password = document.getElementById("password"), conferma_password = document.getElementById("conferma_password");

function convalidaPassword(){
    if(password.value != conferma_password.value){
        conferma_password.setCustomValidity("Le password non corrispondono");
    }else{
        conferma_password.setCustomValidity('');
    }
}

password.onchange = convalidaPassword;
conferma_password.onkeyup = convalidaPassword;



// Slide MENU Carrello

function openSlideMenu(){
    document.getElementById('menu').style.width = '400px';
    document.getElementById('slcontent').style.marginRight = '400px';
}
function closeSlideMenu(){
    document.getElementById('menu').style.width = '0';
    document.getElementById('slcontent').style.marginRight = '0';
}



