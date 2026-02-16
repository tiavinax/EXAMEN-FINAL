function voirDetails(villeId) {
    fetch(`/dashboard/detailVille/${villeId}`)
        .then(response => response.json())
        .then(data => {
            let html = `
                <h6 class="mb-3">Ville: ${data.ville.nom}</h6>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Besoin</th>
                            <th>Quantité</th>
                            <th>Prix unit.</th>
                            <th>Total besoin</th>
                            <th>Attribué</th>
                            <th>Reste</th>
                        </tr>
                    </thead>
                    <tbody>
            `;
            
            data.besoins.forEach(besoin => {
                html += `
                    <tr>
                        <td>${besoin.libelle}</td>
                        <td>${besoin.quantite_necessaire}</td>
                        <td>${formatMoney(besoin.prix_unitaire)}</td>
                        <td>${formatMoney(besoin.total_besoin)}</td>
                        <td>${formatMoney(besoin.total_attribue)}</td>
                        <td>${formatMoney(besoin.total_besoin - besoin.total_attribue)}</td>
                    </tr>
                `;
            });
            
            html += '</tbody></table>';
            
            document.getElementById('modalBody').innerHTML = html;
            new bootstrap.Modal(document.getElementById('detailsModal')).show();
        });
}

function formatMoney(montant) {
    return new Intl.NumberFormat('fr-MG', { 
        style: 'currency', 
        currency: 'MGA',
        minimumFractionDigits: 0
    }).format(montant);
}

function exporterTableau() {
    // Implémentation de l'export Excel/CSV
    alert('Fonctionnalité d\'export à implémenter');
}