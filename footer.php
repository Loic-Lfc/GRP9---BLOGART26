<style>
/* Cookie Modal Styling */
#cookieConsentModal .modal-content {
    background: var(--color-card, #1A1A1A);
    border: 2px solid var(--color-primary, #E31E24);
    border-radius: var(--radius, 8px);
    box-shadow: 0 8px 32px rgba(227, 30, 36, 0.3);
}

#cookieConsentModal .modal-header {
    background: var(--color-darker, #000000);
    border-bottom: 2px solid var(--color-primary, #E31E24);
    padding: 1.5rem;
}

#cookieConsentModal .modal-title {
    font-family: var(--font-title, 'Fredoka', sans-serif);
    color: var(--color-white, #FFFFFF);
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-size: 1.3rem;
}

#cookieConsentModal .modal-body {
    background: var(--color-card, #1A1A1A);
    padding: 2rem 1.5rem;
    color: var(--color-text, #FFFFFF);
}

#cookieConsentModal .modal-body p {
    color: var(--color-text, #FFFFFF);
    font-size: 1rem;
    line-height: 1.6;
    margin-bottom: 1rem;
}

#cookieConsentModal .modal-body a {
    color: #ffffff;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
}

#cookieConsentModal .modal-body a:hover {
    color: var(--color-primary, #E31E24);
    text-decoration: underline;
}

#cookieConsentModal .modal-footer {
    background: var(--color-card, #1A1A1A);
    border-top: 1px solid var(--color-border, #2A2A2A);
    padding: 1.5rem;
    justify-content: center;
    gap: 1rem;
}

#cookieConsentModal #cookieAccept {
    background: var(--color-primary, #E31E24);
    color: var(--color-white, #FFFFFF);
    border: none;
    border-radius: var(--radius-sm, 4px);
    padding: 12px 30px;
    font-weight: 700;
    font-family: var(--font-title, 'Fredoka', sans-serif);
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-size: 0.9rem;
}

#cookieConsentModal #cookieAccept:hover {
    background: var(--color-secondary, #B71C1C);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(227, 30, 36, 0.4);
}

#cookieConsentModal #cookieDecline {
    background: transparent;
    color: var(--color-white, #FFFFFF);
    border: 2px solid var(--color-gray, #666666);
    border-radius: var(--radius-sm, 4px);
    padding: 10px 28px;
    font-weight: 700;
    font-family: var(--font-title, 'Fredoka', sans-serif);
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-size: 0.9rem;
}

#cookieConsentModal #cookieDecline:hover {
    background: var(--color-gray, #666666);
    border-color: var(--color-gray, #666666);
    transform: translateY(-2px);
}

#cookieConsentModal .modal-backdrop {
    background-color: rgba(0, 0, 0, 0.8);
}
</style>

<div class="modal fade" id="cookieConsentModal" tabindex="-1" aria-labelledby="cookieConsentLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cookieConsentLabel">🍪 Gestion des Cookies</h5>
            </div>
            <div class="modal-body">
                <p>Ce site utilise des cookies pour améliorer votre expérience conformément au RGPD. Acceptez-vous leur utilisation ?</p>
                <p><a href="#" onclick="window.open('/views/frontend/rgpd/rgpd-cookies.php', 'RGPD', 'width=900,height=700,scrollbars=yes,resizable=yes'); return false;">En savoir plus</a></p>
            </div>
            <div class="modal-footer">
                <button type="button" id="cookieDecline" class="btn">Refuser</button>
                <button type="button" id="cookieAccept" class="btn">Accepter</button>
            </div>
        </div>
    </div>
</div>

<footer class="footer-cartoon py-5">
  <div class="container">
    <div class="row align-items-start">
      <div class="col-md-6 mb-4 mb-md-0">
        <img src="/src/images/murmures_bordeaux.png" alt="Murmures Bordeaux" style="height: 50px; margin-bottom: 1rem;">
        <p class="text-light-gray mb-3" style="line-height: 1.6;">L'ART DE LA RUE <span style="color: #ffffff; font-weight: 600;">BORDELAISE</span>. Explorez les murs qui parlent.</p>
        
        <!-- Réseaux sociaux -->
        <div class="d-flex gap-3">
          <a href="https://instagram.com/murmuresbordeaux" target="_blank" rel="noopener noreferrer" 
             class="social-link" title="Suivez-nous sur Instagram">
            <i class="fab fa-instagram"></i>
          </a>
          <a href="https://twitter.com/murmuresbordeaux" target="_blank" rel="noopener noreferrer" 
             class="social-link" title="Suivez-nous sur Twitter">
            <i class="fab fa-twitter"></i>
          </a>
        </div>
      </div>
      
      <div class="col-md-6">
        <div class="d-flex flex-column align-items-md-end h-100 justify-content-between">
          <div class="d-flex gap-4 flex-wrap justify-content-md-end mb-3">
            <a href="/about.php" class="footer-link">À PROPOS</a>
            <a href="/contact.php" class="footer-link">CONTACT</a>
            <a href="/views/frontend/rgpd/rgpd.php" class="footer-link">MENTIONS LÉGALES</a>
          </div>
          <div class="text-md-end">
            <span class="text-light-gray">&copy; <?php echo date('Y'); ?> Murmures Bordeaux. Tous droits réservés.</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>

<style>
.footer-nav-wrapper {
  width: 100%;
}

.social-link {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 40px;
  height: 40px;
  background: var(--color-card);
  border: 2px solid var(--color-primary);
  border-radius: 50%;
  color: var(--color-white) !important;
  font-size: 1.2rem;
  transition: all 0.3s ease;
  text-decoration: none;
}

.social-link:hover {
  background: var(--color-primary);
  color: var(--color-white) !important;
  transform: translateY(-3px);
  box-shadow: 0 4px 12px rgba(227, 30, 36, 0.4);
}

.social-link i {
  color: var(--color-white);
}
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

<script>
// ===== GESTION DES COOKIES =====

// Fonction pour créer/modifier un cookie
function setCookie(name,value,days){
    // Crée un nouvel objet Date
    var d = new Date();
    // Ajoute le nombre de jours spécifié au temps actuel (en millisecondes)
    d.setTime(d.getTime() + (days*24*60*60*1000));
    // Convertit la date en format UTC (format standard pour les cookies)
    var expires = "expires="+ d.toUTCString();
    // Stocke le cookie dans le navigateur avec la date d'expiration, le chemin et la sécurité SameSite
    document.cookie = name + "=" + value + ";" + expires + ";path=/;SameSite=Lax";
}

// Fonction pour récupérer la valeur d'un cookie existant
function getCookie(name){
    // Prépare le format "nom=" pour rechercher le cookie
    var cname = name + "=";
    // Décode tous les cookies stockés en une chaîne lisible
    var decoded = decodeURIComponent(document.cookie);
    // Divise les cookies en un tableau (ils sont séparés par des points-virgules)
    var ca = decoded.split(';');
    // Boucle à travers chaque cookie
    for(var i=0;i<ca.length;i++){
        // Supprime les espaces inutiles au début et à la fin de chaque cookie
        var c = ca[i].trim();
        // Vérifie si ce cookie correspond au cookie recherché
        if (c.indexOf(cname) == 0) return c.substring(cname.length,c.length);
    }
    // Retourne une chaîne vide si le cookie n'existe pas
    return "";
}

// Variable booléenne pour tracker si la navigation est actuellement bloquée
var navigationBlocked = false;

// Fonction qui gère le blocage de la navigation si l'utilisateur n'a pas consenti aux cookies
function blockHandler(e){
    // Si l'utilisateur a déjà donné son consentement, ne rien faire (laisser naviguer)
    if(getCookie('cookie_consent')) return;
    // Si le clic se fait dans la modale des cookies, ne pas bloquer (pour pouvoir utiliser les boutons)
    if(e.target.closest('#cookieConsentModal')) return;
    // Cherche si l'élément cliqué est un lien, bouton submit ou formulaire
    var clickable = e.target.closest('a[href], button[type="submit"], input[type="submit"], form');
    // Si c'est un élément de navigation
    if(clickable){
        // Empêche l'action par défaut (la navigation)
        e.preventDefault();
        // Arrête la propagation de l'événement aux éléments parents
        e.stopPropagation();
        // Récupère l'élément modal des cookies du DOM
        var modalEl = document.getElementById('cookieConsentModal');
        // Vérifie que la modale existe
        if(modalEl){
            // Récupère l'instance existante de la modale ou en crée une nouvelle avec des options (backdrop statique = pas de fermeture en cliquant dehors, keyboard:false = pas de fermeture à l'Échap)
            var modal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl, {backdrop:'static',keyboard:false});
            // Affiche la modale pour demander le consentement
            modal.show();
        }
    }
}

// Fonction pour activer le blocage de la navigation
function enableNavBlock(){
    // Vérifie que le blocage n'est pas déjà activé
    if(!navigationBlocked){
        // Ajoute un écouteur d'événement sur tous les clics (capture: true = capture les événements au niveau racine)
        document.addEventListener('click', blockHandler, true);
        // Ajoute un écouteur d'événement sur tous les submit de formulaires
        document.addEventListener('submit', blockHandler, true);
        // Marque le blocage comme actif
        navigationBlocked = true;
    }
}

// Fonction pour désactiver le blocage de la navigation
function disableNavBlock(){
    // Vérifie que le blocage est actuellement actif
    if(navigationBlocked){
        // Retire l'écouteur du clic pour permettre la navigation
        document.removeEventListener('click', blockHandler, true);
        // Retire l'écouteur du submit pour permettre la soumission de formulaires
        document.removeEventListener('submit', blockHandler, true);
        // Marque le blocage comme inactif
        navigationBlocked = false;
    }
}

// Déclenche le code quand la page est complètement chargée (DOM prêt)
document.addEventListener('DOMContentLoaded', function(){
    // Récupère l'élément modal des cookies du DOM
    var modalEl = document.getElementById('cookieConsentModal');
    // Vérifie que la modale existe
    if(modalEl){
        // Récupère la valeur du cookie "cookie_consent" (vide s'il n'existe pas)
        var consent = getCookie('cookie_consent');
        // Si le cookie n'existe pas (pas de consentement précédent)
        if(!consent){
            // Crée une instance de modale Bootstrap avec backdrop statique et sans fermeture au clavier
            var modal = new bootstrap.Modal(modalEl, {backdrop:'static',keyboard:false});
            // Affiche la modale
            modal.show();
            // Active le blocage de la navigation
            enableNavBlock();
            // Ajoute un écouteur au bouton "Accepter"
            document.getElementById('cookieAccept').addEventListener('click', function(){
                // Crée le cookie de consentement avec la valeur "accepted" pour 365 jours
                setCookie('cookie_consent','accepted',365);
                // Masque la modale
                modal.hide();
                // Désactive le blocage de la navigation (l'utilisateur peut maintenant naviguer)
                disableNavBlock();
            });
            // Ajoute un écouteur au bouton "Refuser"
            document.getElementById('cookieDecline').addEventListener('click', function(){
                // Crée le cookie de consentement avec la valeur "declined" pour 365 jours
                setCookie('cookie_consent','declined',365);
                // Masque la modale
                modal.hide();
                // Désactive le blocage de la navigation (l'utilisateur peut naviguer même s'il refuse)
                disableNavBlock();
            });
        } else {
            // Si un consentement existe déjà, désactive le blocage (il y a une réponse précédente)
            disableNavBlock();
        }
    }
});
</script>
</body>
</html>