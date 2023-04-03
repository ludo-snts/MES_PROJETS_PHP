// window.addEventListener("load",setupListener)



// var reset = document.getElementById('reset');
// reset.addEventListener('click',confirm)

//     function Confirm(event) {
//         if (!confirm("Voulez effacer le profil")) {
//             event.preventDefault();
//         }
//     }


document.getElementById('lang').addEventListener('change',definirlangue);

function definirlangue(){
    // alert('vous etes passé');
    let select = document.getElementById('lang');
    let lang = select.options[select.selectedIndex].value;
    console.log(select); 
    console.log(lang);
    window.location.href="Controleur.php?action=definirlangue&lang="+lang;
}

// function recuperer(){

// var selectElmt = document.getElementById("ComboPays");
// var valeurselectionnee = selectElmt.options[selectElmt.selectedIndex].value;
// var textselectionne = selectElmt.options[selectElmt.selectedIndex].text;

// }