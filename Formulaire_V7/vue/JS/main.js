console.log("Le JS fonctionne");

// MISE EN PLACE DES ÉCOUTEURS D'EVENEMENTS
window.addEventListener("load", function () {
    // Ecouteur sur le select de la langue
    let select = document.getElementById("languageID");
    select.addEventListener("change", changeLanguage);
    // Ecouteur sur l'input du mot de passe
    let password = document.getElementById("password");
    password.addEventListener("keyup", showPasswordicon);
    // Ecouteur sur l'icone d'affichage du mot de passe
    let toggleIcon = document.getElementById("toggleicon");
    toggleIcon.addEventListener("click", toggleicon);
});


// CHANGEMENT LANGUE
function changeLanguage(event) {
    let select = document.getElementById("languageID");
    let language = select.options[select.selectedIndex].value;
    if (language != 0) {
        window.location.href = "../controleur/Controleur.php?action=changerlangue&languageId=" + language;
    }
}

// AFFICHAGE ICONE DU MOT DE PASSE
function showPasswordicon(event) {
    let password = document.getElementById("password");
    let toggleIcon = document.getElementById("toggleicon");
    console.log(password.value.length);
    if (password.value.length > 0) {
        toggleIcon.style.visibility = "visible";
    } else {
        toggleIcon.style.visibility = "hidden";
    }
}

// AFFICHAGE MOT DE PASSE
function toggleicon(event) {
    let password = document.getElementById("password");
    let toggleIcon = document.getElementById("toggleicon");
    
    if (password.type === "password" && password.value != "") {
        password.type = "text";
    } else {
        password.type = "password";
    }
    toggleIcon.classList.toggle('fa-lock-open');
}



