function togglePass(id) {
  const input = document.getElementById(id);
  input.type = (input.type === "password") ? "text" : "password";
}


function setValid(el, ok) { 
if (ok) { el.classList.add('valid'); el.classList.remove('invalid'); }
else    { el.classList.add('invalid'); el.classList.remove('valid'); }
}


document.addEventListener('DOMContentLoaded', () => { // Espera que cargen los datos 
    // Elementos Input del html
    const birthdateInput = document.getElementById('Birthdate');
    const passwordInput  = document.getElementById('Password');
    const confirmInput   = document.getElementById('ConfirmPassword');
    const form           = document.getElementById('signup-form');
    const submitBtn      = document.getElementById('btn-submit');

    // ajusta seccion de edad a +18
    const hoy = new Date();
    const anioMaximo = hoy.getFullYear() - 18;
    const mes  = String(hoy.getMonth() + 1).padStart(2, '0');
    const dia  = String(hoy.getDate()).padStart(2, '0');
    birthdateInput.max = `${anioMaximo}-${mes}-${dia}`;

    // Elementos de validación del html 
    const requirementsContainer = document.getElementById('password-requirements');
    const confirmFeedback = document.getElementById('confirm-feedback');
    const lengthReq   = document.getElementById('length');
    const uppercaseReq= document.getElementById('uppercase');
    const numberReq   = document.getElementById('number');
    const specialReq  = document.getElementById('special');
    const confirmMatchP = document.getElementById('confirm-match');


    function passwordChecks(pwd) { // Feedback confirmación de contraseña
        return {
        longEnough:  pwd.length >= 8,
        uppercase:   /[A-Z]/.test(pwd),
        number:      /[0-9]/.test(pwd),
        special:     /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/.test(pwd)
        };
    }

    function updatePasswordUI() { //actualiza UI
        const pwd = passwordInput.value;
        const c = passwordChecks(pwd);
        setValid(lengthReq,    c.longEnough);
        setValid(uppercaseReq, c.uppercase);
        setValid(numberReq,    c.number);
        setValid(specialReq,   c.special);
        return c.longEnough && c.uppercase && c.number && c.special;
    }

    function updateConfirmUI() { //Valida contraseñas iguales
        const match = confirmInput.value !== '' && confirmInput.value === passwordInput.value;
        setValid(confirmMatchP, match);
        return match;
    }

    
    passwordInput.addEventListener('focus', () => { //Muestra los requisitos de contraseña segura
        requirementsContainer.style.display = 'block';
    });
    passwordInput.addEventListener('blur', () => { //Oculta los requisitos de contraseña segura
        if (passwordInput.value === '') requirementsContainer.style.display = 'none';
    });

    passwordInput.addEventListener('focus', () => { //Muestra los requisitos de match de contraseñas
        confirmFeedback.style.display = 'block';
    });

    confirmInput.addEventListener('blur', () => { //Oculta los requisitos de match de contraseñas
        if (confirmInput.value === '') confirmFeedback.style.display = 'none';
    });
    

    
    passwordInput.addEventListener('input', () => { // verifica el match de contraseñas cuando cambia la password
        updatePasswordUI();
        if (confirmInput.value !== '') updateConfirmUI();
        updateSubmitState();
    });
    confirmInput.addEventListener('input', () => { // verifica el match de contraseñas cuando cambia la confirm password
        updateConfirmUI();
        updateSubmitState();
    });


    function updateSubmitState() {   //Deshabilitar botón si no cumple las condiciones
        const pwdOk = updatePasswordUI();
        const match = updateConfirmUI();
        submitBtn.disabled = !(pwdOk && match);
    }

    requirementsContainer.style.display = 'none'; // Estado inicial
    confirmFeedback.style.display = 'none';
    updateSubmitState();

});