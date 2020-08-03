let body = document.querySelector('body');
let compte = document.getElementsByClassName('compte');
let info = document.getElementsByClassName('info');
let connected = document.getElementsByClassName('connected');
let inscription = document.getElementsByClassName('btn-basic');


if (typeof connected[0] != 'undefined') {
    // the variable is defined
    compte[0].addEventListener('mouseover', function() {
    info[0].style.display = 'block';
    });
}
    
if(typeof inscription[0] != 'undefined'){
    inscription[0].addEventListener('click', function(){
        window.localStorage.setItem("page", "inscription");
    });
}

info[0].addEventListener('mousehover', function () {
    this.style.display = 'block';

});

info[0].addEventListener('mouseout', function () {
    this.style.display = 'none';
});

body.addEventListener('click', function(e) {
    if (e.target != info[0]) { //si je clique à l'exterieure de info[0]
        info[0].style.display = 'none';
    }
});