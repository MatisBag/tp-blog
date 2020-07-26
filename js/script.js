let body = document.querySelector('body');
let compte = document.getElementsByClassName('compte');
let info = document.getElementsByClassName('info');



compte[0].addEventListener('mouseover', function() {
    info[0].style.display = 'block';
});

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