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
    color: var(--color-primary, #E31E24);
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
}

#cookieConsentModal .modal-body a:hover {
    color: var(--color-accent, #FF5252);
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
                <p><a href="https://www.php.net/manual/fr/features.cookies.php" target="_blank" rel="noopener noreferrer">En savoir plus</a></p>
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
    <div class="row align-items-center">
      <div class="col-md-4 mb-4 mb-md-0">
        <img src="/src/images/murmures_bordeaux.png" alt="Murmures Bordeaux" style="height: 50px; margin-bottom: 1rem;">
        <p class="text-light-gray mb-0">L'actualité du street art bordelais. Explorez les murs qui parlent.</p>
      </div>
      <div class="col-md-8">
        <div class="d-flex justify-content-end align-items-center flex-wrap">
          <a href="/views/frontend/rgpd/rgpd.php" class="footer-link mx-3">Mentions légales</a>
          <a href="#" class="footer-link mx-3">Contact</a>
          <a href="#" class="footer-link mx-3">À propos</a>
          <span class="text-light-gray ms-4">&copy; <?php echo date('Y'); ?> Murmures Bordeaux. Tous droits réservés.</span>
        </div>
      </div>
    </div>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

<script>
function setCookie(name,value,days){
    var d = new Date();
    d.setTime(d.getTime() + (days*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = name + "=" + value + ";" + expires + ";path=/;SameSite=Lax";
}

function getCookie(name){
    var cname = name + "=";
    var decoded = decodeURIComponent(document.cookie);
    var ca = decoded.split(';');
    for(var i=0;i<ca.length;i++){
        var c = ca[i].trim();
        if (c.indexOf(cname) == 0) return c.substring(cname.length,c.length);
    }
    return "";
}

var navigationBlocked = false;
function blockHandler(e){
    if(getCookie('cookie_consent')) return;
    if(e.target.closest('#cookieConsentModal')) return;
    var clickable = e.target.closest('a[href], button[type="submit"], input[type="submit"], form');
    if(clickable){
        e.preventDefault();
        e.stopPropagation();
        var modalEl = document.getElementById('cookieConsentModal');
        if(modalEl){
            var modal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl, {backdrop:'static',keyboard:false});
            modal.show();
        }
    }
}

function enableNavBlock(){
    if(!navigationBlocked){
        document.addEventListener('click', blockHandler, true);
        document.addEventListener('submit', blockHandler, true);
        navigationBlocked = true;
    }
}

function disableNavBlock(){
    if(navigationBlocked){
        document.removeEventListener('click', blockHandler, true);
        document.removeEventListener('submit', blockHandler, true);
        navigationBlocked = false;
    }
}

document.addEventListener('DOMContentLoaded', function(){
    var modalEl = document.getElementById('cookieConsentModal');
    if(modalEl){
        var consent = getCookie('cookie_consent');
        if(!consent){
            var modal = new bootstrap.Modal(modalEl, {backdrop:'static',keyboard:false});
            modal.show();
            enableNavBlock();
            document.getElementById('cookieAccept').addEventListener('click', function(){
                setCookie('cookie_consent','accepted',365);
                modal.hide();
                disableNavBlock();
            });
            document.getElementById('cookieDecline').addEventListener('click', function(){
                setCookie('cookie_consent','declined',365);
                modal.hide();
                disableNavBlock();
            });
        } else {
            disableNavBlock();
        }
    }
});
</script>
</body>
</html>