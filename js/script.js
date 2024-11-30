
//Ecrie par Cerik Caron
// pour les etoiles
let etoile = document.getElementsByClassName("fa-star");
for(let i = 0; i<etoile.length; i++){
    etoile[i].addEventListener("click", etoileHighlight);
};
console.log(etoile);

//fontion pour highlight les etoiles
function etoileHighlight(){
    this.toggle('checked')
}

//fin



//Ecrie par Nicolas Beaudoin


//fin



//Ecrie par Simon Roy


//fin