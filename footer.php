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
    // crée une nouvelle date
    var d = new Date();
    // ajoute le nombre de jours passé en paramètre (converti en millisecondes)
    d.setTime(d.getTime() + (days*24*60*60*1000));
    // formate la date en UTC standard pour les cookies
    var expires = "expires="+ d.toUTCString();
    // enregistre le cookie avec la date d'expiration, le chemin / et la sécu SameSite
    document.cookie = name + "=" + value + ";" + expires + ";path=/;SameSite=Lax";
}

// Fonction pour récupérer la valeur d'un cookie
function getCookie(name){
    // prépare la chaîne "nom=" pour chercher le bon cookie
    var cname = name + "=";
    // décode tous les cookies en une string lisible
    var decoded = decodeURIComponent(document.cookie);
    // sépare les cookies en un array (ils sont séparés par des ;)
    var ca = decoded.split(';');
    // boucle sur chaque cookie
    for(var i=0;i<ca.length;i++){
        // supprime les espaces inutiles au début et fin
        var c = ca[i].trim();
        // check si c'est le bon cookie
        if (c.indexOf(cname) == 0) return c.substring(cname.length,c.length);
    }
    // retourne rien si le cookie existe pas
    return "";
}

// variable pour savoir si la navigation est bloquée ou pas
var navigationBlocked = false;

// fonction qui bloque la navigation si l'user n'a pas dit oui aux cookies
function blockHandler(e){
    // si l'user a déja dit oui, on laisse passer
    if(getCookie('cookie_consent')) return;
    // si c'est un clic dans la popup, on bloque pas (faut pouvoir cliquer sur les boutons)
    if(e.target.closest('#cookieConsentModal')) return;
    // check si c'est un lien, un bouton submit ou un formulaire
    var clickable = e.target.closest('a[href], button[type="submit"], input[type="submit"], form');
    // si c'est bien un élément clickable
    if(clickable){
        // empêche l'action par défaut
        e.preventDefault();
        // arrête la propagation
        e.stopPropagation();
        // récupère la modal des cookies
        var modalEl = document.getElementById('cookieConsentModal');
        // si la modal existe
        if(modalEl){
            // récupère l'instance bootstrap ou crée une nouvelle avec des options (static backdrop + pas d'échap)
            var modal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl, {backdrop:'static',keyboard:false});
            // affiche la modal
            modal.show();
        }
    }
}

// fonction pour activer le blocage de la navigation
function enableNavBlock(){
    // check que c'est pas déja activé
    if(!navigationBlocked){
        // ajoute un listener sur les clics (capture: true = capture en phase de capture)
        document.addEventListener('click', blockHandler, true);
        // ajoute un listener sur les submit
        document.addEventListener('submit', blockHandler, true);
        // marque comme actif
        navigationBlocked = true;
    }
}

// fonction pour désactiver le blocage de la navigation
function disableNavBlock(){
    // check que c'est bien activé
    if(navigationBlocked){
        // retire le listener des clics
        document.removeEventListener('click', blockHandler, true);
        // retire le listener des submit
        document.removeEventListener('submit', blockHandler, true);
        // marque comme inactif
        navigationBlocked = false;
    }
}

// quand la page est chargée
document.addEventListener('DOMContentLoaded', function(){
    // récupère la modal des cookies
    var modalEl = document.getElementById('cookieConsentModal');
    // si elle existe
    if(modalEl){
        // récupère le cookie de consentement
        var consent = getCookie('cookie_consent');
        // si y a pas de cookie (premier passage ou pas encore répondu)
        if(!consent){
            // crée une modal bootstrap (static + pas d'échap)
            var modal = new bootstrap.Modal(modalEl, {backdrop:'static',keyboard:false});
            // l'affiche
            modal.show();
            // bloque la navigation jusqu'a ce qu'il réponde
            enableNavBlock();
            // listener sur le bouton accepter
            document.getElementById('cookieAccept').addEventListener('click', function(){
                // crée le cookie avec "accepted" pour 365 jours
                setCookie('cookie_consent','accepted',365);
                // cache la modal
                modal.hide();
                // débloque la navigation
                disableNavBlock();
            });
            // listener sur le bouton refuser
            document.getElementById('cookieDecline').addEventListener('click', function(){
                // crée le cookie avec "declined" pour 365 jours
                setCookie('cookie_consent','declined',365);
                // cache la modal
                modal.hide();
                // débloque la navigation (ouais il peut naviguer même s'il refuse)
                disableNavBlock();
            });
        } else {
            // si y a déja un cookie, pas besoin de bloquer
            disableNavBlock();
        }
    }
});
</script>
</body>
</html>