<?php 
require_once 'header.php';
sql_connect();


?>



<!-- Cookie Consent Modal -->
<div class="modal fade" id="cookieConsentModal" tabindex="-1" aria-labelledby="cookieConsentLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="cookieConsentLabel">Cookies</h5>
    </div>
    <div class="modal-body">
        <p>La gestion des cookies est devenue obligatoire. Ce site utilise des cookies pour améliorer votre expérience. Acceptez-vous l'utilisation des cookies ?</p>
        <p><a href="https://www.php.net/manual/fr/features.cookies.php" target="_blank" rel="noopener noreferrer">En savoir plus (RGPD)</a></p>
    </div>
    <div class="modal-footer">
        <button type="button" id="cookieDecline" class="btn btn-secondary">Refuser</button>
        <button type="button" id="cookieAccept" class="btn btn-primary">Accepter</button>
    </div>
    </div>
</div>
</div>

<?php require_once 'footer.php'; ?>

