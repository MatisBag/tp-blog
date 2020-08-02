let formulaire = document.getElementById('formulaire');
let form = document.querySelector('form');
let articleInfo = document.getElementById('article-info');
let infoAccount = document.getElementsByClassName('login');

let formDiv = document.querySelector('form div');
let formH2 = document.querySelector('#formulaire h2');
let articleH2 = document.querySelector('#article-info h2');
let inputSubmit = document.querySelector('form input[type="submit"]');
let logo = document.querySelector('header img');


// Nouveau Inputs email/password
let inputMail = document.createElement('input');
inputMail.setAttribute('type', 'email');
inputMail.setAttribute('name', 'mail');
inputMail.setAttribute('placeholder', 'exemple@gmail.com');

let inputPassword = document.createElement('input');
inputPassword.setAttribute('type', 'password');
inputPassword.setAttribute('name', 'password2');
inputPassword.setAttribute('placeholder', 'Confirmation mot de passe');


infoAccount[0].addEventListener('click', function () {

    if (this.classList.contains('inscription')) {
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

        articleH2.textContent = 'Articles récents';
        articleH2.style.color = '';

        this.classList.remove('inscription');
    }
    else {
        this.classList.add('inscription');

        formulaire.style.transform = 'translateX(100%)';
        articleInfo.style.transform = 'translateX(-100%)';

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

        // Same pour le cote article
        articleH2.textContent = 'Les plus consultés';
        articleH2.style.color = '#ffbb00';

        // div créer compte / connecter
        this.innerHTML = "<span>Déjà un compte ?</span><br>Connectez-vous";
    }

    


});