/* Lab 7 */

//Ajout des listener pour le thème
//document.getElementById("theme-std").addEventListener("click", changethemeStd);
//document.getElementById("theme-sombre").addEventListener("click", changethemeSombre);

//ajout listener pour les button droite eet gauche du formulaire
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

//ajouter un listener pour la liste d'option pour les poste
//document.getElementById("poste").addEventListener("change", changeDescriptionPoste)

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

  function changeDescriptionPoste(){
    let posteList = document.getElementsByClassName("desc-poste");

    for(let i = 0; i < poste.length; i++){
        posteList[i].classList.add("hide");
    }
    selectElement = document.getElementsByName('poste');

    document.getElementById(selectElement.value).classList.remove("hide");
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