<!-- Footer -->
<style>
    /* ===== FOOTER STYLES ===== */
    .footer-new {
        background: linear-gradient(135deg, #003366 0%, #001a33 100%);
        color: #fff;
        position: relative;
        margin-top: 4rem;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }

    .footer-main {
        padding: 4rem 0 2rem;
    }

    .container {
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 2rem;
    }

    .footer-grid {
        display: grid;
        grid-template-columns: 2fr 1.5fr 1.5fr 1.5fr;
        gap: 2.5rem;
        margin-bottom: 3rem;
    }

    /* Sections */
    .footer-section {
        animation: fadeInUp 0.5s ease forwards;
    }

    .footer-title {
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 1rem;
        background: linear-gradient(135deg, #fff 0%, #ff6b6b 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        letter-spacing: -0.02em;
    }

    .footer-subtitle {
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
        position: relative;
        padding-bottom: 0.75rem;
        color: #fff;
    }

    .footer-subtitle::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 40px;
        height: 3px;
        background: #ff6b6b;
        border-radius: 2px;
    }

    /* Description */
    .footer-description {
        color: rgba(255,255,255,0.7);
        line-height: 1.6;
        margin-bottom: 1.5rem;
        font-size: 0.95rem;
    }

    /* Statistiques */
    .footer-stats {
        display: flex;
        gap: 1.5rem;
    }

    .footer-stats .stat-item {
        text-align: center;
        background: transparent;
        padding: 0;
        box-shadow: none;
    }

    .footer-stats .stat-number {
        display: block;
        font-size: 1.5rem;
        font-weight: 700;
        color: #ff6b6b;
        line-height: 1;
        margin-bottom: 0.25rem;
    }

    .footer-stats .stat-label {
        font-size: 0.8rem;
        color: rgba(255,255,255,0.6);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Contact */
    .footer-contact {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-contact li {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        margin-bottom: 1rem;
        color: rgba(255,255,255,0.7);
        font-size: 0.95rem;
        line-height: 1.5;
    }

    .footer-contact li i {
        color: #ff6b6b;
        font-size: 1.1rem;
        margin-top: 0.2rem;
        flex-shrink: 0;
    }

    .footer-contact li span {
        line-height: 1.5;
    }

    /* Liens */
    .footer-links {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-links li {
        margin-bottom: 0.8rem;
    }

    .footer-links li a {
        color: rgba(255,255,255,0.7);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
        font-size: 0.95rem;
    }

    .footer-links li a i {
        color: #ff6b6b;
        font-size: 0.9rem;
        transition: transform 0.3s ease;
    }

    .footer-links li a:hover {
        color: #ff6b6b;
        transform: translateX(5px);
    }

    .footer-links li a:hover i {
        transform: translateX(3px);
    }

    /* Newsletter */
    .footer-newsletter {
        background: rgba(255,255,255,0.05);
        border-radius: 16px;
        padding: 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 2rem;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.1);
    }

    .newsletter-content {
        display: flex;
        align-items: center;
        gap: 1.5rem;
    }

    .newsletter-content i {
        font-size: 2.5rem;
        color: #ff6b6b;
    }

    .newsletter-content h5 {
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 0.25rem;
        color: #fff;
    }

    .newsletter-content p {
        color: rgba(255,255,255,0.6);
        font-size: 0.95rem;
        margin: 0;
    }

    .newsletter-form {
        display: flex;
        gap: 0.75rem;
        flex: 1;
        max-width: 450px;
    }

    .newsletter-form input {
        flex: 1;
        padding: 0.9rem 1.2rem;
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 50px;
        background: rgba(255,255,255,0.05);
        color: #fff;
        font-size: 0.95rem;
        font-family: 'Inter', sans-serif;
        transition: all 0.3s ease;
    }

    .newsletter-form input::placeholder {
        color: rgba(255,255,255,0.4);
    }

    .newsletter-form input:focus {
        outline: none;
        border-color: #ff6b6b;
        background: rgba(255,255,255,0.1);
    }

    .newsletter-form button {
        padding: 0.9rem 2rem;
        background: #ff6b6b;
        color: #fff;
        border: none;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.95rem;
        cursor: pointer;
        transition: all 0.3s ease;
        white-space: nowrap;
        font-family: 'Inter', sans-serif;
    }

    .newsletter-form button:hover {
        background: #ff5252;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(255,107,107,0.3);
    }

    /* Barre sociale */
    .footer-social {
        background: rgba(0,0,0,0.2);
        padding: 1.2rem 0;
        border-top: 1px solid rgba(255,255,255,0.05);
        border-bottom: 1px solid rgba(255,255,255,0.05);
    }

    .social-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .social-content span {
        color: rgba(255,255,255,0.6);
        font-size: 0.95rem;
        font-weight: 500;
    }

    .social-links {
        display: flex;
        gap: 1rem;
    }

    .social-links a {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: rgba(255,255,255,0.05);
        display: flex;
        align-items: center;
        justify-content: center;
        color: rgba(255,255,255,0.7);
        text-decoration: none;
        transition: all 0.3s ease;
        border: 1px solid rgba(255,255,255,0.1);
        font-size: 1.2rem;
    }

    .social-links a:hover {
        background: #ff6b6b;
        color: #fff;
        transform: translateY(-3px);
        border-color: #ff6b6b;
    }

    /* Footer bottom */
    .footer-bottom {
        background: rgba(0,0,0,0.3);
        padding: 1.5rem 0;
    }

    .bottom-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .bottom-content p {
        margin: 0;
        color: rgba(255,255,255,0.6);
        font-size: 0.9rem;
    }

    .bottom-links {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .bottom-links a {
        color: rgba(255,255,255,0.6);
        text-decoration: none;
        font-size: 0.9rem;
        transition: color 0.3s ease;
    }

    .bottom-links a:hover {
        color: #ff6b6b;
    }

    .separator {
        color: rgba(255,255,255,0.2);
    }

    /* Back to top */
    .back-to-top {
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 50px;
        height: 50px;
        background: #ff6b6b;
        color: #fff;
        border: none;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
        z-index: 99;
        box-shadow: 0 4px 12px rgba(255,107,107,0.3);
    }

    .back-to-top.visible {
        opacity: 1;
        visibility: visible;
    }

    .back-to-top:hover {
        background: #ff5252;
        transform: translateY(-3px);
        box-shadow: 0 6px 16px rgba(255,107,107,0.4);
    }

    /* Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .footer-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 2rem;
        }
    }

    @media (max-width: 768px) {
        .footer-main {
            padding: 3rem 0 1.5rem;
        }

        .footer-grid {
            grid-template-columns: 1fr;
            gap: 2rem;
        }

        .footer-newsletter {
            flex-direction: column;
            align-items: stretch;
            text-align: center;
            padding: 1.5rem;
        }

        .newsletter-content {
            flex-direction: column;
            text-align: center;
        }

        .newsletter-form {
            max-width: 100%;
            flex-direction: column;
        }

        .newsletter-form button {
            width: 100%;
        }

        .social-content {
            flex-direction: column;
            text-align: center;
        }

        .bottom-content {
            flex-direction: column;
            text-align: center;
        }

        .bottom-links {
            justify-content: center;
        }

        .back-to-top {
            bottom: 20px;
            right: 20px;
            width: 45px;
            height: 45px;
            font-size: 1rem;
        }
    }

    @media (max-width: 480px) {
        .footer-stats {
            justify-content: space-around;
        }

        .footer-contact li {
            font-size: 0.85rem;
        }

        .bottom-links {
            flex-direction: column;
            gap: 0.5rem;
        }

        .separator {
            display: none;
        }
    }
</style>

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
                        <li><a href="/dons/liste"><i class="bi bi-chevron-right"></i> Faire un don</a></li>
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
                    <a href="https://www.facebook.com/groups/" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                    <a href="https://x.com/" aria-label="Twitter"><i class="bi bi-twitter-x"></i></a>
                    <a href="https://www.instagram.com/" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                    <a href="https://www.linkedin.com/" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
                    <a href="https://www.youtube.com/" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer bottom -->
    <div class="footer-bottom">
        <div class="container">
            <div class="bottom-content">
                <p style="font-weight: bold; font-size: 1rem;">&copy; Tiavina 3955 && Liantsoa 4318 && Jordhi</p>
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
    alert(`Merci pour votre inscription ! Un email de confirmation a été envoyé à ${email}`);
    e.target.reset();
});
</script>

</body>
</html>