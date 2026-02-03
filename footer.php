<div class="modal fade" id="cookieConsentModal" tabindex="-1" aria-labelledby="cookieConsentLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cookieConsentLabel">Gestion des Cookies</h5>
            </div>
            <div class="modal-body">
                <p>Ce site utilise des cookies pour améliorer votre expérience conformément au RGPD. Acceptez-vous leur utilisation ?</p>
                <p><a href="https://www.php.net/manual/fr/features.cookies.php" target="_blank" rel="noopener noreferrer">En savoir plus</a></p>
            </div>
            <div class="modal-footer">
                <button type="button" id="cookieDecline" class="btn btn-secondary">Refuser</button>
                <button type="button" id="cookieAccept" class="btn btn-primary">Accepter</button>
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