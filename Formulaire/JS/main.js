console.log("Le JS fonctionne");

// CONFIRMER SUPPRESSION PERSONNE
// ECOUTEURS D'EVENEMENTS
document.getElementById("delete-personne-button").addEventListener("click", supprimerPersonne);
// FONCTIONS
function supprimerPersonne(event) {
    // Empêche la navigation vers la page de suppression
    event.preventDefault(); 
    if (confirm("Voulez-vous vraiment supprimer cette personne ?")) {
        const url = this.getAttribute("href");
    
        fetch(url, {
            method: "DELETE"
        }).then(response => {
            if (response.ok) {
                // Si la suppression est réussie, actualise la page pour afficher la liste mise à jour
                location.reload();
            } else {
                throw new Error("Erreur lors de la suppression de la personne.");
            }
        }).catch(error => {
            alert(error.message);
        });
    }
}