
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
    document.getElementById('micro').value = getCookie('micro');
    document.getElementById('titre').value = getCookie('titre');
    document.getElementById('rating').value = getCookie('rating');
    document.getElementById('textRevue').value = getCookie('textRevue');
    loadEtoile(getCookie('rating'));
};

function effaceCookie(){
    document.getElementById('micro').value = deleteCookie('micro');
    document.getElementById('titre').value = deleteCookie('titre');
    document.getElementById('rating').value = deleteCookie('rating');
    document.getElementById('textRevue').value = deleteCookie('textRevue');
};

//fin Cedrik Caron



//Ecrie par Nicolas Beaudoin


//fin Nicolas Beaudoin



//Ecrie par Simon Roy


//fin Simon Roy