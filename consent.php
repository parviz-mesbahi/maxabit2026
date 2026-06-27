<!-- ── COOKIE CONSENT BANNER ── -->
<div id="cookie-banner">
  <div class="cb-text">
    <strong>Cookie-Einstellungen</strong>
    <p>Wir verwenden Google Analytics, um die Nutzung unserer Website zu analysieren und zu verbessern. Dabei werden Cookies gesetzt und Daten an Google LLC (USA) übertragen. <a href="datenschutz.php#analytics">Mehr erfahren</a></p>
  </div>
  <div class="cb-btns">
    <button id="cookie-decline" class="cb-ghost">Ablehnen</button>
    <button id="cookie-accept" class="cb-primary">Akzeptieren</button>
  </div>
</div>

<style>
#cookie-banner{
  display:none;
  position:fixed;bottom:1.5rem;left:50%;transform:translateX(-50%);
  width:calc(100% - 3rem);max-width:720px;z-index:9999;
  background:var(--ink);color:#fff;
  border-radius:var(--r-lg);padding:1.25rem 1.5rem;
  box-shadow:0 8px 32px rgba(0,0,0,.35);
  gap:1.25rem;align-items:center;
  flex-wrap:wrap;
}
.cb-text{flex:1;min-width:200px}
.cb-text strong{display:block;font-size:.95rem;margin-bottom:.3rem;font-family:var(--display)}
.cb-text p{font-size:.8rem;color:var(--muted-l);line-height:1.5;margin:0}
.cb-text a{color:var(--sky);text-decoration:underline}
.cb-btns{display:flex;gap:.6rem;flex-shrink:0}
.cb-ghost{
  padding:8px 18px;border-radius:100px;
  font-size:.82rem;font-weight:600;color:#fff;
  border:1.5px solid rgba(255,255,255,.25);background:transparent;
  cursor:pointer;transition:all .2s;
}
.cb-ghost:hover{border-color:#fff}
.cb-primary{
  padding:8px 18px;border-radius:100px;
  font-size:.82rem;font-weight:600;color:#fff;
  border:none;background:var(--sky-d);
  cursor:pointer;transition:background .2s;
}
.cb-primary:hover{background:var(--sky-dd)}
</style>

<script>
(function(){
  var GA_ID = 'G-XXXXXXXXXX';

  function getCookieConsent(){
    var m = document.cookie.match(/(?:^|; )cookie_consent=([^;]*)/);
    return m ? m[1] : null;
  }

  function setConsentCookie(val){
    var exp = new Date();
    exp.setFullYear(exp.getFullYear() + 1);
    document.cookie = 'cookie_consent=' + val + ';expires=' + exp.toUTCString() + ';path=/;SameSite=Lax';
  }

  function loadGA(){
    if (window._gaLoaded) return;
    window._gaLoaded = true;
    var s = document.createElement('script');
    s.async = true;
    s.src = 'https://www.googletagmanager.com/gtag/js?id=' + GA_ID;
    document.head.appendChild(s);
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    window.gtag = gtag;
    gtag('js', new Date());
    gtag('config', GA_ID, {anonymize_ip: true});
  }

  var consent = getCookieConsent();
  if (consent === 'accepted') {
    loadGA();
  } else if (consent === null) {
    document.getElementById('cookie-banner').style.display = 'flex';
  }

  document.getElementById('cookie-accept').addEventListener('click', function(){
    setConsentCookie('accepted');
    loadGA();
    document.getElementById('cookie-banner').style.display = 'none';
  });

  document.getElementById('cookie-decline').addEventListener('click', function(){
    setConsentCookie('declined');
    document.getElementById('cookie-banner').style.display = 'none';
  });
})();
</script>
