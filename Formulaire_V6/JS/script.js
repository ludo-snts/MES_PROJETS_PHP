// Fonction de mise en place des abonnements (listeners)
// Evénements gérés :
//      click : clique sur un bouton
//      change : déclenché quand la valeur d'un élément <input> (entrée), 
//              <select> (sélection) ou <textarea> (zone de texte) est modifiée.

var setupListeners = function() {
	
	// Abonnement pour l'élément d'id "langID"
    // Liste déroulante pour le choix de la langue
	document.getElementById("langID").addEventListener("change",fetchContent);

    // Abonnement pour l'élément d'id "lien_supprimer" de chaque ligne du tableau
    // des personnes
	const tab_elements = document.getElementsByClassName("lien_supprimer");
    for (let i = 0; i < tab_elements.length; i++)
        tab_elements[i].addEventListener ("click",supprimerPersonne);
};

// On provoque l'exécution de "setupListeners" à la fin du
// chargement du document
window.addEventListener("load", setupListeners);

// Fonction appelée sur un changement de langue
function changerLangue (event) {

    // Récupérer la langue sélectionnée : fr, en ou it
    let select = document.getElementById('langID');
    let lang = select.options[select.selectedIndex].value;

    // var url = document.URL.split('?')[0] + "?action=changerlangue&langID="+lang;
    // window.location.href=url;

    // Appel du controleur en lui passant l'action et la langue
    if (lang.length != 0) 
      window.location.href="../controleur/Controleur.php?action=changerlangue&langID="+lang;
}

// Fonction appelée suite au clique sur le bouton supprimer 
const supprimerPersonne = (event) => {

    // Récupérer les données mémorisées dans le localStorage via la requête AJAX
    let data = JSON.parse(window.localStorage.getItem("data"));

    // Si l'utilisateur annule la suppression
    if (!confirm(data["message"]))
        // La méthode preventDefault(), rattachée à l'interface Event, 
        // indique si l'évènement n'est pas explicitement géré, 
        // l'action par défaut ne devrait pas être exécutée comme elle l'est normalement.
        // Annuler la suppression
        event.preventDefault();
    else {
        // Récuperer l'id
        let id = document.getElementsByTagName('table')[0].getElementsByTagName('tr')[1].cells[0].innerHTML;
        // Appel du controleur en lui passant l'action et l'id
        window.location.href="../controleur/Controleur.php?action=supprimerpersonne&id="+ id;
    }
}

// Fonction appelée sur un changement de langue
// Télécharger le fichier JSON correspondant à la langue
const fetchContent = () => {

    // Récupérer la langue sélectionnée
    const select = document.getElementById("langID");
    var lang = select.options[select.selectedIndex].value;

    // Requête AJAX pour télécharger le fichier langue
    // fr.json - en.json - it.json
    fetch('locale/'+lang+'.json')
        .then((response) => {
            return response.json();
        })
        .then((data) => {
            // Mémoriser les données au format JSON dans le localStorage
            window.localStorage.setItem("data", JSON.stringify(data));

            // Appelle de la fonction de changement de langue
            changerLangue();
        }).catch((e) => {
            console.log(e.toString());
        });
};