function validateDate() {
    var today = new Date();
    var selectedDate = new Date(document.getElementById('datedebut').value);

    if (selectedDate < today) {
        alert("La date ne peut pas être antérieure à aujourd'hui.");
        // Vous pouvez également désactiver le bouton de soumission ou prendre d'autres mesures nécessaires.
        // Exemple : document.getElementById('boutonSoumettre').disabled = true;
        document.getElementById('datedebut').value = ''; // Efface la date sélectionnée
    }
}