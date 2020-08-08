// Elements globaux
let body = document.querySelector('body');
let formulaire = document.getElementById('formulaire');
let form = document.querySelector('form');
let articleInfo = document.getElementById('article-info');
let infoAccount = document.getElementsByClassName('login');

// enfants
let formDiv = document.querySelector('form div');
let formH2 = document.querySelector('#formulaire h2');
let articleH2 = document.querySelector('#article-info h2');
let password = document.getElementById('password');
let inputSubmit = document.querySelector('form input[type="submit"]');
let logo = document.querySelector('header img');
let pRed = document.getElementsByClassName('red');


// Créa des Inputs email/password
let inputMail = document.createElement('input');
inputMail.setAttribute('type', 'email');
inputMail.setAttribute('name', 'mail');
inputMail.setAttribute('placeholder', 'exemple@gmail.com');

let inputPassword = document.createElement('input');
inputPassword.setAttribute('type', 'password');
inputPassword.setAttribute('name', 'password2');
inputPassword.setAttribute('placeholder', 'Confirmation mot de passe');



// Récupérer l'information vers quelle page veut aller le visiteur
let page = localStorage.getItem("page"); 


// Affichage de la bonne page
if (page === "inscription") {
    inscription();
}
else {
    window.localStorage.setItem("page", "connexion");
}


// Placement du bouton de changement de page
if (window.innerWidth >= 1000) {
    body.append(infoAccount[0]);
}

// connexion -> inscription
function inscription() {
    // Insertion pour s'inscrire
    form.insertBefore(inputMail, password);
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
    if ((typeof pRed[0] != 'undefined') && page != "inscription") {
        pRed[0].style.display = 'none';
    }

    // Same pour le cote article
    articleH2.style.color = '#ffbb00';
    articleH2.textContent = 'Les plus consultés';

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

    page = 'inscription';
    window.localStorage.setItem("page", "inscription");
};


// inscription -> connexion
function connexion() {
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

    infoAccount[0].innerHTML = "<span>Pas de compte ?</span><br>Créer en un içi";

    page = 'connexion';
    window.localStorage.setItem("page", "connexion");
}


// Optimisation du JS
function debounce(callback, interval) {
    let timer;
    return function debounced(...args) {
        clearTimeout(timer);
        timer = setTimeout(function () {
            callback(...args);
        }, interval);
    }
}

window.onresize = debounce(widthScreen, 200);


function widthScreen() {
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

infoAccount[0].addEventListener('click', function () { // Au clic
    if (page === 'inscription') { // si je suis sur la page inscription ...
        connexion();
    } else { // si je suis sur la page de connexion ...
        inscription();
    }

});