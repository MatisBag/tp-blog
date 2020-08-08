let modifier = document.getElementById('modifier');

let form = document.querySelector('form');

let buttons = document.getElementsByClassName('buttons');





// Créations éléments

let p = document.createElement('p');
p.innerHTML = '<label for="password">Nouveau mot de passe :</label> <input type="password" name="password" id = "password">';

let p2 = document.createElement('p');
p2.innerHTML = '<label for="password2">Confirmation nouveau mot de passe :</label> <input type="password" name="password2" id = "password2">';

let submit = document.createElement('input');
submit.type = 'submit';
submit.value = 'Confirmer';

modifier.addEventListener('click', function(){
    form.action = 'compte_POST.php';

    form.appendChild(p);
    form.appendChild(p2);

    let inputs = document.querySelectorAll('input');

    inputs[2].parentElement.parentElement.removeChild(inputs[2].parentElement); // supp date inscription

    for (let i = 0; i < inputs.length; i++) {
        inputs[i].readOnly = false;
        inputs[i].style.color = 'black';
    }

    form.appendChild(submit);

    buttons[0].parentElement.removeChild(buttons[0]);
});


