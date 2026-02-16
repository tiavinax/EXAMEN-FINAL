<!-- Footer -->
 <link rel="stylesheet" href="/assets/css/footer.css">
<footer class="footer-new">
    <div class="footer-main">
        <div class="container">
            <!-- Section principale -->
            <div class="footer-grid">
                <!-- À propos -->
                <div class="footer-section">
                    <h3 class="footer-title">BNGRC</h3>
                    <p class="footer-description">
                        Bureau National de Gestion des Risques et des Catastrophes de Madagascar. 
                        Notre mission : protéger les populations et coordonner les secours en cas de catastrophe.
                    </p>
                    <div class="footer-stats">
                        <div class="stat-item">
                            <span class="stat-number">22</span>
                            <span class="stat-label">Régions</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">119</span>
                            <span class="stat-label">Districts</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">24/7</span>
                            <span class="stat-label">Urgences</span>
                        </div>
                    </div>
                </div>

                <!-- Contact -->
                <div class="footer-section">
                    <h4 class="footer-subtitle">Contact</h4>
                    <ul class="footer-contact">
                        <li>
                            <i class="bi bi-geo-alt"></i>
                            <span>Antanimora, Antananarivo 101, Madagascar</span>
                        </li>
                        <li>
                            <i class="bi bi-telephone"></i>
                            <span>+261 34 05 480 68</span>
                        </li>
                        <li>
                            <i class="bi bi-telephone"></i>
                            <span>+261 34 05 480 69</span>
                        </li>
                        <li>
                            <i class="bi bi-envelope"></i>
                            <span>contact@bngrc.mg</span>
                        </li>
                        <li>
                            <i class="bi bi-clock"></i>
                            <span>Lun-Ven: 8h - 17h</span>
                        </li>
                    </ul>
                </div>

                <!-- Liens rapides -->
                <div class="footer-section">
                    <h4 class="footer-subtitle">Liens rapides</h4>
                    <ul class="footer-links">
                        <li><a href="#about"><i class="bi bi-chevron-right"></i> À propos</a></li>
                        <li><a href="#alerts"><i class="bi bi-chevron-right"></i> Urgences en cours</a></li>
                        <li><a href="#news"><i class="bi bi-chevron-right"></i> Actualités</a></li>
                        <li><a href="#donations"><i class="bi bi-chevron-right"></i> Faire un don</a></li>
                        <li><a href="#volunteer"><i class="bi bi-chevron-right"></i> Devenir bénévole</a></li>
                        <li><a href="#contact"><i class="bi bi-chevron-right"></i> Contact</a></li>
                    </ul>
                </div>

                <!-- Ressources -->
                <div class="footer-section">
                    <h4 class="footer-subtitle">Ressources</h4>
                    <ul class="footer-links">
                        <li><a href="#guides"><i class="bi bi-file-pdf"></i> Guides pratiques</a></li>
                        <li><a href="#reports"><i class="bi bi-bar-chart"></i> Rapports annuels</a></li>
                        <li><a href="#lexique"><i class="bi bi-book"></i> Lexique</a></li>
                        <li><a href="#faq"><i class="bi bi-question-circle"></i> FAQ</a></li>
                        <li><a href="#sitemap"><i class="bi bi-diagram-3"></i> Plan du site</a></li>
                    </ul>
                </div>
            </div>

            <!-- Newsletter -->
            <div class="footer-newsletter">
                <div class="newsletter-content">
                    <i class="bi bi-envelope-paper"></i>
                    <div>
                        <h5>Restez informé</h5>
                        <p>Recevez les alertes et actualités du BNGRC</p>
                    </div>
                </div>
                <form class="newsletter-form">
                    <input type="email" placeholder="Votre adresse email" required>
                    <button type="submit">S'abonner</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Barre sociale -->
    <div class="footer-social">
        <div class="container">
            <div class="social-content">
                <span>Suivez-nous :</span>
                <div class="social-links">
                    <a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                    <a href="#" aria-label="Twitter"><i class="bi bi-twitter-x"></i></a>
                    <a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                    <a href="#" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
                    <a href="#" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer bottom -->
    <div class="footer-bottom">
        <div class="container">
            <div class="bottom-content">
                <p>&copy; 2023-2026 BNGRC – Tous droits réservés</p>
                <div class="bottom-links">
                    <a href="#legal">Mentions légales</a>
                    <span class="separator">•</span>
                    <a href="#privacy">Politique de confidentialité</a>
                    <span class="separator">•</span>
                    <a href="#cookies">Gestion des cookies</a>
                    <span class="separator">•</span>
                    <a href="#accessibility">Accessibilité</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Back to top -->
    <button class="back-to-top" id="backToTop" aria-label="Retour en haut">
        <i class="bi bi-arrow-up"></i>
    </button>
</footer>

<!-- Scripts -->
<script src="/assets/js/bootstrap.bundle.min.js"></script>
<script>
// Back to top
const backToTop = document.getElementById('backToTop');
window.addEventListener('scroll', () => {
    if (window.scrollY > 300) {
        backToTop.classList.add('visible');
    } else {
        backToTop.classList.remove('visible');
    }
});

backToTop.addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
});

// Newsletter form
document.querySelector('.newsletter-form')?.addEventListener('submit', (e) => {
    e.preventDefault();
    const email = e.target.querySelector('input[type="email"]').value;
    // Ici vous pouvez ajouter la logique d'inscription
    alert(`Merci pour votre inscription ! Un email de confirmation a été envoyé à ${email}`);
    e.target.reset();
});
</script>


</body>
</html>