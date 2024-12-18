
//Fonction pour cookie
function setCookie(cname, cvalue, exdays) {
    const d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    let expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

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

function deleteCookie(cname){
    document.cookie = cname + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
};

//Ecrie par Cerik Caron
// pour les etoiles
let etoile = document.getElementsByClassName('fa');
let rating = document.getElementById('rating')
let numberOfEtoile = 0;

for(let i = 0; i<etoile.length; i++){
    etoile[i].addEventListener("click", etoileHighlight);
};
console.log(etoile);

//fontion pour highlight les etoiles
function etoileHighlight(){
    //remove the checked item
    for(let i = 0; i<etoile.length; i++){
        etoile[i].classList.remove('checked');
    };
    //check the star until it arrive at the current star.
    let iterator = -1;
    do {
        iterator += 1;
        etoile[iterator].classList.toggle('checked');
        numberOfEtoile = iterator + 1;//add one so the rating is between 1-5
    } while (this !== etoile[iterator]);
    rating.value = numberOfEtoile;//keep the number of stars in an input
    saveInfo('rating');
};

function loadEtoile(nbEtoile){
    //remove the checked item
    for(let i = 0; i<etoile.length; i++){
        etoile[i].classList.remove('checked');
    };
    //check the star until it arrive at the current star.
    let iterator = -1;
    do {
        iterator += 1;
        etoile[iterator].classList.toggle('checked');
        numberOfEtoile = iterator + 1;//add one so the rating is between 1-5
    } while (iterator < nbEtoile - 1);
};
//fin etoile

//cookie qui se rapelle des info du formulaire de revue
function saveInfo(id){
    let elementD = document.getElementById(id);
    let valeur = elementD.value;
    setCookie(id,valeur,2);
};

function loadInfo(){
    if(getCookie('micro') !== ""){
        document.getElementById('micro').value = getCookie('micro');
    }
    if(getCookie('titre') !== ""){
        document.getElementById('titre').value = getCookie('titre');
    }
    if(getCookie('rating') !== ""){
        document.getElementById('rating').value = getCookie('rating');
        loadEtoile(getCookie('rating'));
    }
    if(getCookie('textRevue') !== ""){
        document.getElementById('textRevue').value = getCookie('textRevue');
    }
};

function effaceCookie(){
    deleteCookie('micro');
    deleteCookie('titre');
    deleteCookie('rating');
    deleteCookie('textRevue');
};

//fin Cedrik Caron



//Ecrie par Nicolas Beaudoin
let buttonDroit = document.getElementsByClassName("fa-chevron-circle-right");

for (let i=0; i < buttonDroit.length; i++) {
    buttonDroit[i].addEventListener("click", moveRight);
}

let buttonGauche = document.getElementsByClassName("fa-chevron-circle-left");

for (let i=0; i < buttonGauche.length; i++) {
    buttonGauche[i].addEventListener("click", moveLeft);
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
  let images = [];
  images = document.getElementsByClassName("imgCarouselle");
  for(let i = 1; i < images.length;i++){
      images[i].classList.add("hide");
  }
  
  setInterval(changerImage,7000);
  
  function changerImage(){
  
      for(let i = 0; i < images.length; i++){
       
          if(!images[i].classList.contains("hide")){
              images[i].classList.add("hide");
              images[(i+1) % images.length].classList.remove("hide");
              break;
          }
  
      }
    }
//fin Nicolas Beaudoin



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
        // Valide le numéro de carte de crédit
        const creditCardNumber = document.getElementById("creditCardNumber").value;
        if (!isValidCreditCardNumber(creditCardNumber)) {
            alert("Numéro de carte invalide.");
            event.preventDefault();
            return;
        }

        // valide la date d'expiration
        const creditCardExpiration = document.getElementById("creditCardExpiration").value;
        if (!isValidExpirationDate(creditCardExpiration)) {
            alert("Date d'expiration invalide. Utilisez le format MM/YY.");
            event.preventDefault();
            return;
        }

        // Valide le CVV
        const creditCardCVV = document.getElementById("creditCardCVV").value;
        if (!/^\d{3,4}$/.test(creditCardCVV)) {
            alert("CVV invalide. Entrez 3 ou 4 chiffres.");
            event.preventDefault();
            return;
        }
    });

    function isValidCreditCardNumber(value) {
        // algorithm de lunh pour valider le numero de carte de credit source : https://gist.github.com/DiegoSalazar/4075533
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
        // Cette fonction valide la date d'expiration d'une carte de crédit
        const match = value.match(/^(0[1-9]|1[0-2])\/?([0-9]{2})$/);
        if (!match) {
            // Si la valeur ne correspond pas au format attendu (MM/AA), retourner false
            return false;
        }
        
        // Extraire le mois et l'année des groupes correspondants
        const expMonth = parseInt(match[1], 10);
        const expYear = parseInt(match[2], 10) + 2000; // Convertir AA en AAAA
        
        // Obtenir la date actuelle, le mois et l'année
        const currentDate = new Date();
        const currentMonth = currentDate.getMonth() + 1; // Les mois sont indexés à partir de zéro, donc ajouter 1
        const currentYear = currentDate.getFullYear();
        
        // Vérifier si l'année d'expiration est supérieure à l'année actuelle
        // ou si l'année d'expiration est la même que l'année actuelle et le mois d'expiration est supérieur ou égal au mois actuel
        return expYear > currentYear || (expYear === currentYear && expMonth >= currentMonth);
    }

    //navigation entre les fieldset
 const fieldsets = document.querySelectorAll("form.inscription fieldset");
 const prevArrow = document.getElementById("prev-arrow");
 const nextArrow = document.getElementById("next-arrow");
 const submitButton = document.querySelector("form.inscription button[type='submit']");
 let currentFieldset = 0;

 function updateFieldsets() {
     fieldsets.forEach((fieldset, index) => {
         fieldset.classList.toggle("active", index === currentFieldset);
     });
     prevArrow.classList.toggle("hide", currentFieldset === 0);
     nextArrow.classList.toggle("hide", currentFieldset === fieldsets.length - 1);
     submitButton.classList.toggle("hide", currentFieldset !== fieldsets.length - 1);
 }

 prevArrow.addEventListener("click", function() {
     if (currentFieldset > 0) {
         currentFieldset--;
         updateFieldsets();
     }
 });

 nextArrow.addEventListener("click", function() {
     if (currentFieldset < fieldsets.length - 1) {
         currentFieldset++;
         updateFieldsets();
     }
 });

 updateFieldsets();

});

//fin simon





 