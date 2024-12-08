/* Lab 7 */

//Ajout des listener pour le thème
document.getElementById("theme-std").addEventListener("click", changethemeStd);
document.getElementById("theme-sombre").addEventListener("click", changethemeSombre);

//ajout listener pour les button droite eet gauche du formulaire
buttonDroit = document.getElementsByClassName("fa-chevron-circle-right");

for (let i=0; i < buttonDroit.length; i++) {
    buttonDroit[i].addEventListener("click", moveRight);
}

buttonGauche = document.getElementsByClassName("fa-chevron-circle-left");

for (let i=0, l = buttonGauche.length; i < l; i++) {
    buttonGauche[i].addEventListener("click", moveLeft);
}

//ajouter un listener pour la liste d'option pour les poste
document.getElementById("poste").addEventListener("change", changeDescriptionPoste)

//Ajout des listener pour les boutons annuler une réservation
elems = document.getElementsByClassName("btn-annuler");

for (let i=0, l = elems.length; i < l; i++) {
    elems[i].addEventListener('click', annuleReservation);
}


//Ajout des listener pour les boutons pour voir la description
elems = document.getElementsByClassName("show-desc");

for (let i=0, l = elems.length; i < l; i++) {
    elems[i].addEventListener('click', showDesc);
}


// Appelé sur le click du bouton thème standard
function changethemeStd() {
    document.getElementsByTagName("body")[0].classList.remove("sombre");
    setCookie("mode", "std", 30);
}

// Appelé sur le click du bouton thème sombre
function changethemeSombre() {
    document.getElementsByTagName("body")[0].classList.add("sombre");
    setCookie("mode", "sombre", 30);
}


// Appelé sur le click d'un bouton Annuler cette réservation 
function annuleReservation(evt){
    if (!confirm('Êtes-vous certain de vouloir annuler cette réservation ?')) { 
        evt.preventDefault();
    }
}

// Appelé sur le click d'un bouton "Voir la description"   
function showDesc(evt){
    if (evt.target.nextElementSibling.classList.contains("hide")){
        evt.target.innerHTML = "Cacher description";
    } else {
        evt.target.innerHTML = "Voir la description";
    }

    evt.target.nextElementSibling.classList.toggle("hide");  
}


//Fonction qui ajoute ou modifie la valeur d'un cookie
function setCookie(cname, cvalue, exdays) {
    const d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    let expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

//Fonction qui lit le cookie demandé 
  function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for(let i = 0; i <ca.length; i++) {
      let c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
  }




  function moveRight() {
    let fieldset = document.getElementsByTagName("fieldset");

    for(let i = 0; i < fieldset.length;i++){
        if(fieldset[i].className != "hide"){
            fieldset[i].classList.add("hide");
            i++;
            fieldset[i].classList.remove("hide");
            return;
        }
    }
  }

  function moveLeft() {
    let fieldset = document.getElementsByTagName("fieldset");

    for(let i = 0; i < fieldset.length;i++){
        if(fieldset[i].className != "hide"){
            fieldset[i].classList.add("hide");
            i--;
            fieldset[i].classList.remove("hide");
            return;
        }
    }
  }

  function changeDescriptionPoste(){
    let posteList = document.getElementsByClassName("desc-poste");

    for(let i = 0; i < poste.length; i++){
        posteList[i].classList.add("hide");
    }
    selectElement = document.getElementsByName('poste');

    document.getElementById(selectElement.value).classList.remove("hide");
  }

  //simon

  document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector("form");
    
    form.addEventListener("submit", function(event) {
        // Validate credit card number (simple Luhn algorithm check)
        const creditCardNumber = document.getElementById("creditCardNumber").value;
        if (!isValidCreditCardNumber(creditCardNumber)) {
            alert("Numéro de carte invalide.");
            event.preventDefault();
            return;
        }

        // Validate credit card expiration date (MM/YY format)
        const creditCardExpiration = document.getElementById("creditCardExpiration").value;
        if (!isValidExpirationDate(creditCardExpiration)) {
            alert("Date d'expiration invalide. Utilisez le format MM/YY.");
            event.preventDefault();
            return;
        }

        // Validate CVV (3 or 4 digits)
        const creditCardCVV = document.getElementById("creditCardCVV").value;
        if (!/^\d{3,4}$/.test(creditCardCVV)) {
            alert("CVV invalide. Entrez 3 ou 4 chiffres.");
            event.preventDefault();
            return;
        }
    });

    function isValidCreditCardNumber(value) {
        // Luhn algorithm
        let sum = 0;
        let shouldDouble = false;
        for (let i = value.length - 1; i >= 0; i--) {
            let digit = parseInt(value.charAt(i));
            if (shouldDouble) {
                digit *= 2;
                if (digit > 9) {
                    digit -= 9;
                }
            }
            sum += digit;
            shouldDouble = !shouldDouble;
        }
        return sum % 10 === 0;
    }

    function isValidExpirationDate(value) {
        const match = value.match(/^(0[1-9]|1[0-2])\/?([0-9]{2})$/);
        if (!match) {
            return false;
        }
        const expMonth = parseInt(match[1], 10);
        const expYear = parseInt(match[2], 10) + 2000;
        const currentDate = new Date();
        const currentMonth = currentDate.getMonth() + 1;
        const currentYear = currentDate.getFullYear();
        return expYear > currentYear || (expYear === currentYear && expMonth >= currentMonth);
    }
});