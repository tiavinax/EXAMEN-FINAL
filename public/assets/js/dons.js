// assets/js/dons.js
document.addEventListener('DOMContentLoaded', function() {
    const typeSelect = document.getElementById('type');
    if(typeSelect) {
        typeSelect.addEventListener('change', function() {
            const valeurLabel = document.getElementById('valeurLabel');
            const valeurHelp = document.getElementById('valeurHelp');
            
            if(this.value === 'argent') {
                valeurLabel.textContent = 'Montant (Ar) *';
                valeurHelp.textContent = 'Entrez le montant en Ariary';
            } else if(this.value === 'nature' || this.value === 'materiaux') {
                valeurLabel.textContent = 'Quantité *';
                valeurHelp.textContent = 'Entrez la quantité (kg, L, unités, etc.)';
            }
        });
    }
});