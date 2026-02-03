<!-- Load JS scripts -->
<<<<<<< Updated upstream
<script>
function onSubmit(token) {
    document.getElementById("form-recaptcha").submit();
    console.log(document.getElementById("form-recaptcha"));
}
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

<script>
// Cookie helper functions
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

// Navigation blocking to enforce user response to cookie popup
var navigationBlocked = false;
function blockHandler(e){
  // If consent already set, allow
if(getCookie('cookie_consent')) return;
  // allow interactions inside the modal
if(e.target.closest('#cookieConsentModal')) return;
  // If clicked element is an anchor, submit or form input, prevent navigation
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
      // consent already set: ensure navigation is allowed
    disableNavBlock();
    }
}
});

>>>>>>> Stashed changes
</script>

</body>
<footer>
	<!-- footer -->

</footer>
</html>
