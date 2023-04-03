console.log("Le JS fonctionne");
// console.info("langue utilisée : " + document.getElementById("languageID").options[document.getElementById("languageID").selectedIndex].value);

// MISE EN PLACE DES ÉCOUTEURS D'EVENEMENTS
window.addEventListener("load", function () {
    // Ecouteur sur le select de la langue
    let select = document.getElementById("languageID");
    select.addEventListener("change", changeLanguage);
});


// CHANGEMENT LANGUE
function changeLanguage(event) {
    let select = document.getElementById("languageID");
    let language = select.options[select.selectedIndex].value;
    window.location.href="Controleur.php?action=changerlangage&languageId="+language;
    console.log("value_langue utilisée : " + language);
}