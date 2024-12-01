
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
    //check the star until it arrive at the current star + 1.
    let iterator = -1;
    do {
        iterator += 1;
        etoile[iterator].classList.toggle('checked');
        numberOfEtoile = iterator + 1;
    } while (this !== etoile[iterator]);
    rating.value = numberOfEtoile;
}

//fin Cedrik Caron



//Ecrie par Nicolas Beaudoin


//fin



//Ecrie par Simon Roy


//fin