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