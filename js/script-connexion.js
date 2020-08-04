let body = document.querySelector('body');
let formulaire = document.getElementById('formulaire');
let form = document.querySelector('form');
let articleInfo = document.getElementById('article-info');
let infoAccount = document.getElementsByClassName('login');

let formDiv = document.querySelector('form div');
let formH2 = document.querySelector('#formulaire h2');
let articleH2 = document.querySelector('#article-info h2');
let inputSubmit = document.querySelector('form input[type="submit"]');
let logo = document.querySelector('header img');
let pRed = document.getElementsByClassName('red');


// Nouveau Inputs email/password
let inputMail = document.createElement('input');
inputMail.setAttribute('type', 'email');
inputMail.setAttribute('name', 'mail');
inputMail.setAttribute('placeholder', 'exemple@gmail.com');

let inputPassword = document.createElement('input');
inputPassword.setAttribute('type', 'password');
inputPassword.setAttribute('name', 'password2');
inputPassword.setAttribute('placeholder', 'Confirmation mot de passe');

let page = localStorage.getItem("page"); // Récupérer l'information vers quelle page veut aller le visiteur

if (page === "inscription") {
    inscription();
}
else {
    window.localStorage.setItem("page", "connexion");
}
if (window.innerWidth >= 1000) {
    body.append(infoAccount[0]);
}


function widthScree() {
    if (window.innerWidth >= 1000) {
        body.append(infoAccount[0]);
    }
    if (window.innerWidth <= 1000) {
        formulaire.append(infoAccount[0]);
    }
    
    if (window.innerWidth >= 1000 && page === "inscription") {
        inscription();
    }
    if (window.innerWidth <= 1000 && page === "inscription") {
        inscription();
    }
}
window.onresize = widthScree;


function inscription() {
    page = "inscription";
    window.localStorage.setItem("page", "inscription");

    infoAccount[0].classList.add('inscription');

    // Insertion pour s'inscrire
    form.insertBefore(inputMail, form.firstChild);
    form.insertBefore(inputPassword, formDiv);

    // Suppression connexion auto
    formDiv.style.display = "none";

    // Changement de textes, couleurs et d'action du form
    formulaire.style.backgroundColor = '#ffbb00';
    formH2.textContent = "Inscription";
    formH2.style.color = 'black';
    inputSubmit.value = "S'inscrire";
    inputSubmit.style.color = '#ffbb00';
    inputSubmit.style.backgroundColor = 'black';
    logo.src = '../assets/icon-blog3.png';
    form.action = 'inscription_POST.php';
    if (typeof pRed[0] != 'undefined') {
        pRed[0].style.display = 'none';
    }

    // Same pour le cote article
    articleH2.textContent = 'Les plus consultés';
    articleH2.style.color = '#ffbb00';

    // div créer compte / connecter
    infoAccount[0].innerHTML = "<span>Déjà un compte ?</span><br>Connectez-vous";


    if (window.innerWidth >= 1000) {
        formulaire.style.transform = 'translateX(100%)';
        articleInfo.style.transform = 'translateX(-100%)';
        infoAccount[0].style.color = '';
    } else {
        formulaire.style.transform = '';
        infoAccount[0].style.color = 'black';
    }

};

function connexion() {
    page = "connexion";
    window.localStorage.setItem("page", "connexion");

    if (window.innerWidth <= 1000){
        infoAccount[0].style.color = '';
    }

    formulaire.style.transform = '';
    articleInfo.style.transform = '';

    form.removeChild(inputMail);
    form.removeChild(inputPassword);

    formDiv.style.display = "";

    formulaire.style.backgroundColor = '';
    formH2.textContent = "Connexion";
    formH2.style.color = '';
    inputSubmit.value = "Se connecter";
    inputSubmit.style.color = '';
    inputSubmit.style.backgroundColor = '';
    logo.src = '../assets/icon-blog2.png';
    form.action = 'connexion_POST.php';
    if (typeof pRed[0] != 'undefined') { // faire les erreurs
        pRed[0].style.display = 'none';
    }

    articleH2.textContent = 'Articles récents';
    articleH2.style.color = '';

    infoAccount[0].classList.remove('inscription');
    infoAccount[0].innerHTML = "<span>Pas de compte ?</span><br>Créez en un içi";

}


infoAccount[0].addEventListener('click', function () { // Au clic
    if (this.classList.contains('inscription')) { // si je suis sur la page inscription ...
        connexion();
    } else { // si je suis sur la page de connexion ...
        inscription();
    }

});