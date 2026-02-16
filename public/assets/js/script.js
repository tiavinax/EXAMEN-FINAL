// ==========================================
// VARIABLES GLOBALES
// ==========================================
const hamburger = document.querySelector('.hamburger');
const navMenu = document.querySelector('.nav-menu');
const navLinks = document.querySelectorAll('.nav-link');
const backToTopBtn = document.querySelector('.back-to-top');
const searchInput = document.querySelector('.search-bar input');
const searchBtn = document.querySelector('.search-bar button');

// ==========================================
// HAMBURGER MENU
// ==========================================
function toggleMenu() {
    navMenu.classList.toggle('active');
    
    // Animation hamburger
    hamburger.querySelectorAll('span').forEach((span, index) => {
        if (navMenu.classList.contains('active')) {
            if (index === 0) span.style.transform = 'rotate(45deg) translate(10px, 10px)';
            if (index === 1) span.style.opacity = '0';
            if (index === 2) span.style.transform = 'rotate(-45deg) translate(7px, -7px)';
        } else {
            span.style.transform = 'none';
            span.style.opacity = '1';
        }
    });
}

if (hamburger) {
    hamburger.addEventListener('click', toggleMenu);
}

// Fermer le menu au clic sur un lien
navLinks.forEach(link => {
    link.addEventListener('click', () => {
        navMenu.classList.remove('active');
        hamburger.querySelectorAll('span').forEach((span) => {
            span.style.transform = 'none';
            span.style.opacity = '1';
        });
    });
});

// ==========================================
// BACK TO TOP BUTTON
// ==========================================
window.addEventListener('scroll', () => {
    if (window.pageYOffset > 300) {
        backToTopBtn.classList.add('show');
    } else {
        backToTopBtn.classList.remove('show');
    }
});

if (backToTopBtn) {
    backToTopBtn.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
}

// ==========================================
// SMOOTH SCROLL LINKS
// ==========================================
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const targetId = this.getAttribute('href');
        const target = document.querySelector(targetId);
        
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// ==========================================
// INTERSECTION OBSERVER - ANIMATIONS
// ==========================================
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -100px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
            observer.unobserve(entry.target);
        }
    });
}, observerOptions);

// Observer articles, cards, etc.
document.querySelectorAll('.article-card, .activity-card, .contact-card, .color-code-card').forEach(el => {
    el.style.opacity = '0';
    el.style.transform = 'translateY(20px)';
    el.style.transition = 'all 0.6s ease-out';
    observer.observe(el);
});

// ==========================================
// SEARCH FUNCTIONALITY
// ==========================================
if (searchBtn) {
    searchBtn.addEventListener('click', (e) => {
        e.preventDefault();
        performSearch();
    });
}

if (searchInput) {
    searchInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
            performSearch();
        }
    });
}

function performSearch() {
    const query = searchInput.value.trim();
    
    if (query.length === 0) {
        showNotification('Veuillez entrer un terme de recherche', 'warning');
        return;
    }
    
    // Simuler une recherche
    showNotification(`Recherche pour: "${query}"`, 'success');
    console.log('Recherche:', query);
    
    // Vous pouvez ajouter une vraie fonction de recherche ici
}

// ==========================================
// NOTIFICATIONS
// ==========================================
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.textContent = message;
    
    // Styles
    const styles = {
        'notification': {
            position: 'fixed',
            top: '20px',
            right: '20px',
            padding: '1rem 1.5rem',
            borderRadius: '6px',
            zIndex: '10000',
            animation: 'slideInRight 0.4s ease-out',
            maxWidth: '400px'
        },
        'notification-success': {
            background: '#10b981',
            color: 'white'
        },
        'notification-error': {
            background: '#ef4444',
            color: 'white'
        },
        'notification-warning': {
            background: '#f59e0b',
            color: 'white'
        },
        'notification-info': {
            background: '#3b82f6',
            color: 'white'
        }
    };
    
    // Appliquer les styles
    Object.assign(notification.style, styles['notification']);
    Object.assign(notification.style, styles[`notification-${type}`]);
    
    document.body.appendChild(notification);
    
    // Supprimer après 3 secondes
    setTimeout(() => {
        notification.style.animation = 'slideInLeft 0.4s ease-out reverse';
        setTimeout(() => notification.remove(), 400);
    }, 3000);
}

// ==========================================
// MODAL/POPUP POUR ARTICLES
// ==========================================
function initArticleModals() {
    const articles = document.querySelectorAll('.article-card-link');
    
    articles.forEach(article => {
        article.addEventListener('click', (e) => {
            e.preventDefault();
            
            const title = article.closest('.article-card').querySelector('.article-card-title').textContent;
            showArticleModal(title);
        });
    });
}

function showArticleModal(title) {
    const modal = document.createElement('div');
    modal.className = 'modal-overlay';
    modal.innerHTML = `
        <div class="modal-content">
            <button class="modal-close">&times;</button>
            <h2>${title}</h2>
            <p>Contenu détaillé de l'article...</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            <button class="modal-close-btn">Fermer</button>
        </div>
    `;
    
    // Styles
    const styles = `
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.7);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            animation: fadeIn 0.3s ease-out;
        }
        
        .modal-content {
            background: white;
            padding: 2rem;
            border-radius: 12px;
            max-width: 500px;
            width: 90%;
            position: relative;
            animation: scaleIn 0.3s ease-out;
        }
        
        .modal-close {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: none;
            border: none;
            font-size: 2rem;
            cursor: pointer;
            color: #999;
        }
        
        .modal-close:hover {
            color: #333;
        }
        
        .modal-content h2 {
            color: #1e3a8a;
            margin-bottom: 1rem;
        }
        
        .modal-close-btn {
            background: #1e3a8a;
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .modal-close-btn:hover {
            background: #dc2626;
        }
    `;
    
    const styleTag = document.createElement('style');
    styleTag.textContent = styles;
    document.head.appendChild(styleTag);
    
    document.body.appendChild(modal);
    
    // Fermer le modal
    const closeBtn = modal.querySelector('.modal-close');
    const closeBtn2 = modal.querySelector('.modal-close-btn');
    
    closeBtn.addEventListener('click', () => {
        modal.style.animation = 'fadeIn 0.3s ease-out reverse';
        setTimeout(() => modal.remove(), 300);
    });
    
    closeBtn2.addEventListener('click', () => {
        modal.style.animation = 'fadeIn 0.3s ease-out reverse';
        setTimeout(() => modal.remove(), 300);
    });
    
    // Fermer en cliquant en dehors
    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.style.animation = 'fadeIn 0.3s ease-out reverse';
            setTimeout(() => modal.remove(), 300);
        }
    });
}

// ==========================================
// LAZY LOADING IMAGES
// ==========================================
function initLazyLoading() {
    const images = document.querySelectorAll('img[data-src]');
    
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.removeAttribute('data-src');
                    imageObserver.unobserve(img);
                }
            });
        });
        
        images.forEach(img => imageObserver.observe(img));
    }
}

// ==========================================
// FORM VALIDATION
// ==========================================
function initFormValidation() {
    const forms = document.querySelectorAll('form');
    
    forms.forEach(form => {
        form.addEventListener('submit', (e) => {
            e.preventDefault();
            
            const inputs = form.querySelectorAll('input[required], textarea[required]');
            let isValid = true;
            
            inputs.forEach(input => {
                if (!input.value.trim()) {
                    input.style.borderColor = '#ef4444';
                    isValid = false;
                } else {
                    input.style.borderColor = '#e2e8f0';
                }
            });
            
            if (isValid) {
                showNotification('Formulaire envoyé avec succès!', 'success');
                form.reset();
            } else {
                showNotification('Veuillez remplir tous les champs', 'error');
            }
        });
    });
}

// ==========================================
// ACTIVE LINK HIGHLIGHT
// ==========================================
function updateActiveLink() {
    const sections = document.querySelectorAll('section');
    
    window.addEventListener('scroll', () => {
        let current = '';
        
        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.clientHeight;
            
            if (pageYOffset >= sectionTop - 200) {
                current = section.getAttribute('id');
            }
        });
        
        navLinks.forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href').slice(1) === current) {
                link.classList.add('active');
            }
        });
    });
}

// ==========================================
// COUNTER ANIMATION
// ==========================================
function initCounterAnimation() {
    const counters = document.querySelectorAll('.counter');
    
    const counterObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const counter = entry.target;
                const target = parseInt(counter.getAttribute('data-target'));
                const duration = 2000;
                const increment = target / (duration / 10);
                let current = 0;
                
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        counter.textContent = target;
                        clearInterval(timer);
                    } else {
                        counter.textContent = Math.floor(current);
                    }
                }, 10);
                
                counterObserver.unobserve(counter);
            }
        });
    }, observerOptions);
    
    counters.forEach(counter => counterObserver.observe(counter));
}

// ==========================================
// COLOR CODE INTERACTIVITY
// ==========================================
function initColorCodes() {
    const colorCards = document.querySelectorAll('.color-code-card');
    
    colorCards.forEach(card => {
        card.addEventListener('click', () => {
            card.style.transform = 'scale(0.95)';
            setTimeout(() => {
                card.style.transform = '';
            }, 200);
            
            const colorName = card.querySelector('h4').textContent;
            showNotification(`${colorName} - Niveau d'alerte sélectionné`, 'info');
        });
    });
}

// ==========================================
// NAVBAR SCROLL EFFECT
// ==========================================
let lastScrollTop = 0;
const navbar = document.querySelector('.navbar');

window.addEventListener('scroll', () => {
    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    
    if (scrollTop > 100) {
        navbar.style.boxShadow = '0 4px 12px rgba(0, 0, 0, 0.15)';
    } else {
        navbar.style.boxShadow = '0 2px 8px rgba(0, 0, 0, 0.08)';
    }
    
    lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
});

// ==========================================
// INITIALIZATION
// ==========================================
document.addEventListener('DOMContentLoaded', () => {
    console.log('BNGRC Website - Initialisé');
    
    // Initialiser tous les modules
    initArticleModals();
    initLazyLoading();
    initFormValidation();
    initColorCodes();
    initCounterAnimation();
    updateActiveLink();
    initHeroSlider();
    
    // Animation au chargement
    document.body.style.opacity = '0';
    setTimeout(() => {
        document.body.style.opacity = '1';
        document.body.style.transition = 'opacity 0.5s ease-out';
    }, 100);
});

// ==========================================
// UTILITY FUNCTIONS
// ==========================================

// Obtenir l'année actuelle
function getCurrentYear() {
    return new Date().getFullYear();
}

// Formater une date
function formatDate(date) {
    const options = { year: 'numeric', month: 'long', day: 'numeric', language: 'fr' };
    return new Date(date).toLocaleDateString('fr-FR', options);
}

// Débounce function
function debounce(func, delay) {
    let timeoutId;
    return function(...args) {
        clearTimeout(timeoutId);
        timeoutId = setTimeout(() => func(...args), delay);
    };
}

// Throttle function
function throttle(func, delay) {
    let lastCall = 0;
    return function(...args) {
        const now = Date.now();
        if (now - lastCall >= delay) {
            func(...args);
            lastCall = now;
        }
    };
}

// Console message
console.log('%cBNGRC Madagascar', 'color: #1e3a8a; font-size: 20px; font-weight: bold;');
console.log('%cBureau National de Gestion des Risques et des Catastrophes', 'color: #dc2626; font-size: 14px;');

// ==========================================
// HERO SLIDER
// ==========================================
function initHeroSlider() {
    const slides = document.querySelectorAll('.hero-slide');
    const dots = document.querySelectorAll('.hero-dots .dot');
    let current = 0;
    let timer;

    if (!slides.length) return;

    const goTo = (index) => {
        current = (index + slides.length) % slides.length;
        slides.forEach((s, i) => s.classList.toggle('active', i === current));
        dots.forEach((d, i) => d.classList.toggle('active', i === current));
    };

    const next = () => goTo(current + 1);
    const prev = () => goTo(current - 1);

    const start = () => { timer = setInterval(next, 3200); };
    const stop = () => { if (timer) clearInterval(timer); };

    dots.forEach((dot, i) => {
        dot.addEventListener('click', () => { stop(); goTo(i); start(); });
    });

    // Scroll wheel navigation
    const sliderArea = document.querySelector('.hero-slider');
    if (sliderArea) {
        sliderArea.addEventListener('wheel', (e) => {
            stop();
            if (e.deltaY > 0) {
                next();
            } else {
                prev();
            }
            start();
        }, { passive: true });
    }

    goTo(0);
    start();
}
