document.querySelectorAll('input[name="upload_option"]').forEach(function(radio) {
    radio.addEventListener('change', function() {
        document.getElementById('file_input').style.display = (this.value === 'file') ? 'block' : 'none';
        document.getElementById('url_input').style.display = (this.value === 'url') ? 'block' : 'none';
    });
});







const confirmationMessage = document.querySelector('.confirmation-message');

// Masque le message après 3 secondes (3000 millisecondes)
if (confirmationMessage) {
    setTimeout(() => {
        confirmationMessage.style.display = 'none';
    }, 3000);
}


function agrandirDescription() {
    var descriptionTextarea = document.querySelector(".description-textarea");
    descriptionTextarea.style.height = "auto";
    descriptionTextarea.style.height = (descriptionTextarea.scrollHeight) + "px";
}


document.addEventListener('DOMContentLoaded', function () {
    // Sélectionnez tous les boutons avec la classe "btn"
    const buttons = document.querySelectorAll('#filtre-collection .btn');

    // Ajoutez un gestionnaire d'événement de clic à chaque bouton
    buttons.forEach(function (button) {
        button.addEventListener('click', function () {
            // Supprimez la classe "active-filter-btn" de tous les boutons
            buttons.forEach(function (btn) {
                btn.classList.remove('active-filter-btn');
            });
            // Ajoutez la classe "active-filter-btn" au bouton cliqué
            button.classList.add('active-filter-btn');

            let filtre_id = button.getAttribute('data-id');
            const allElements = document.querySelectorAll('#collection .element');
            allElements.forEach(function (element) {
                element.classList.remove('hide');
                if ( !element.classList.contains('filtre-'+filtre_id) && filtre_id != 'tous' ){
                    element.classList.add('hide');
                }
            });
                
        });
    });
});