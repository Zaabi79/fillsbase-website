<?php
$domain = isset($_GET['domain']) ? trim(strip_tags($_GET['domain'])) : '';
$result = '';
$error  = '';

if ($domain) {
    if (!preg_match('/^([a-zA-Z0-9]([a-zA-Z0-9\-]{0,61}[a-zA-Z0-9])?\.)+[a-zA-Z]{2,}$/', $domain)) {
        $error = 'Nom de domaine invalide. Exemple : mondomaine.com';
    } else {
        $output = shell_exec('whois ' . escapeshellarg($domain) . ' 2>&1');
        if ($output) {
            $result = htmlspecialchars($output, ENT_QUOTES, 'UTF-8');
        } else {
            $error = 'Impossible d\'obtenir les informations WHOIS pour ce domaine.';
        }
    }
}

function parseWhois($raw) {
    $fields = [
        'Registrant'   => ['Registrant Name','Registrant Organization','registrant'],
        'Registrar'    => ['Registrar','registrar'],
        'Créé le'      => ['Creation Date','created','Registered On','Domain Registration Date'],
        'Expire le'    => ['Registry Expiry Date','Expiry date','Registrar Registration Expiration Date','paid-till','expire'],
        'Mis à jour'   => ['Updated Date','last-update','Last Modified'],
        'Serveurs DNS' => ['Name Server','nserver','Nameserver'],
        'Statut'       => ['Domain Status','Status','state'],
    ];
    $parsed = [];
    foreach ($fields as $label => $keys) {
        foreach ($keys as $key) {
            if (preg_match_all('/^'.$key.'\s*[:\s]\s*(.+)$/mi', $raw, $m)) {
                $vals = array_unique(array_map('trim', $m[1]));
                $vals = array_filter($vals, fn($v) => strlen($v) > 1);
                if ($vals) {
                    $parsed[$label] = implode('<br>', array_slice($vals, 0, 4));
                    break;
                }
            }
        }
    }
    return $parsed;
}

$summary = $result ? parseWhois(html_entity_decode($result)) : [];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Vérifiez les informations WHOIS de n'importe quel nom de domaine.">
  <link href="assets/img/favicon.ico" rel="shortcut icon">
  <title>WHOIS Lookup | Fillsbase Africa</title>
  <link href="assets/fonts/fontawesome/css/all.min.css" rel="stylesheet">
  <link href="assets/fonts/fonts.min.css" rel="stylesheet">
  <link type="text/css" href="assets/css/rtl/bootstrap-rtl.min.css" rel="stylesheet" class="rtl" disabled>
  <link type="text/css" href="assets/css/rtl/theme-rtl.min.css" rel="stylesheet" class="rtl" disabled>
  <link type="text/css" href="assets/css/bootstrap.min.css" rel="stylesheet" class="ltr">
  <link type="text/css" href="assets/css/vendors.min.css" rel="stylesheet">
  <link type="text/css" href="assets/css/theme.min.css" rel="stylesheet">
  <link href="assets/css/fillsbase_custom.css?v=4.0" rel="stylesheet">
  <script type="text/javascript" src="assets/js/jquery.min.js"></script>
  <script type="text/javascript" src="assets/js/gdpr-cookie.min.js"></script>
  <script type="text/javascript" src="assets/js/popper.min.js"></script>
  <script defer type="text/javascript" src="assets/js/bootstrap.min.js"></script>
  <script defer type="text/javascript" src="assets/js/aos.min.js"></script>
  <script defer type="text/javascript" src="assets/js/jquery.lazyload-any.min.js"></script>
  <script defer type="text/javascript" src="assets/js/scripts.min.js"></script>
  <script defer type="text/javascript" src="assets/js/settings-init.js"></script>
  <style>
    .whois-hero {
      background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
      padding: 80px 20px 110px;
      text-align: center;
    }
    .whois-hero h1 { font-size: 2.6rem; font-weight: 800; color: #fff; margin-bottom: 14px; }
    .whois-hero p { font-size: 1.05rem; color: rgba(255,255,255,0.72); margin-bottom: 32px; }
    .whois-search-wrap { max-width: 640px; margin: 0 auto; }
    .whois-search-box {
      display: flex; background: #fff; border-radius: 50px;
      overflow: hidden; box-shadow: 0 10px 40px rgba(0,0,0,0.3);
    }
    .whois-search-box input {
      flex: 1; border: none; outline: none;
      padding: 16px 24px; font-size: 1rem; color: #333;
    }
    .whois-search-box button {
      background: var(--primary-color, #00d1b2); border: none; color: #fff;
      padding: 0 30px; font-size: 1rem; font-weight: 700; cursor: pointer;
      border-radius: 0 50px 50px 0; transition: opacity .2s; white-space: nowrap;
    }
    .whois-search-box button:hover { opacity: .88; }

    .whois-content { max-width: 900px; margin: -55px auto 60px; padding: 0 16px; position: relative; z-index: 2; }

    .whois-summary-card {
      background: #fff; border-radius: 16px;
      box-shadow: 0 16px 50px rgba(0,0,0,0.12); overflow: hidden; margin-bottom: 24px;
    }
    .whois-card-header {
      background: var(--primary-color, #00d1b2); padding: 18px 28px;
      display: flex; align-items: center; gap: 12px;
    }
    .whois-card-header i { color: #fff; font-size: 1.3rem; }
    .whois-card-header .title { color: #fff; font-weight: 700; font-size: 1.05rem; }
    .whois-domain-badge {
      margin-left: auto; background: rgba(255,255,255,.2);
      color: #fff; padding: 4px 14px; border-radius: 20px; font-size: .9rem; font-weight: 600;
    }
    .whois-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(240px,1fr)); }
    .whois-field { padding: 18px 24px; border-bottom: 1px solid #f0f0f0; border-right: 1px solid #f0f0f0; }
    .whois-field-label { font-size: .72rem; font-weight: 700; text-transform: uppercase; letter-spacing: .5px; color: #aaa; margin-bottom: 5px; }
    .whois-field-value { font-size: .92rem; color: #333; font-weight: 500; word-break: break-word; line-height: 1.5; }

    .whois-raw-card { background: #fff; border-radius: 16px; box-shadow: 0 16px 50px rgba(0,0,0,0.08); overflow: hidden; }
    .whois-raw-header { background: #2d2d2d; padding: 14px 24px; display: flex; align-items: center; justify-content: space-between; }
    .whois-raw-header .dots span { width: 12px; height: 12px; border-radius: 50%; display: inline-block; margin-right: 5px; }
    .whois-raw-header .cmd { color: #ccc; font-size: .85rem; font-family: monospace; }
    .whois-raw-header .tag { color: #666; font-size: .8rem; }
    .whois-raw-body { background: #1e1e1e; padding: 24px; max-height: 500px; overflow-y: auto; }
    .whois-raw-body pre { margin: 0; font-family: 'Courier New', monospace; font-size: .82rem; color: #d4d4d4; white-space: pre-wrap; word-break: break-word; line-height: 1.7; }

    .whois-error { background: #fff3f3; border: 1px solid #ffc5c5; border-radius: 12px; padding: 20px 24px; color: #c0392b; display: flex; align-items: center; gap: 12px; margin-bottom: 24px; }
    .whois-empty { text-align: center; padding: 60px 20px; color: #999; }
    .whois-empty i { font-size: 3rem; color: var(--primary-color, #00d1b2); margin-bottom: 16px; display: block; }
    .whois-empty h5 { font-size: 1.1rem; color: #555; margin-bottom: 8px; }

    .whois-features { display: grid; grid-template-columns: repeat(3,1fr); gap: 16px; max-width: 900px; margin: 0 auto 60px; padding: 0 16px; }
    .whois-feature { background: #f8f9fb; border-radius: 12px; padding: 24px 18px; text-align: center; }
    .whois-feature i { font-size: 1.8rem; color: var(--primary-color, #00d1b2); margin-bottom: 12px; display: block; }
    .whois-feature h6 { font-size: .9rem; font-weight: 700; color: #333; margin-bottom: 6px; }
    .whois-feature p { font-size: .78rem; color: #888; margin: 0; }
    @media(max-width:600px) {
      .whois-hero h1 { font-size: 1.8rem; }
      .whois-features { grid-template-columns: 1fr; }
      .whois-search-box button { padding: 0 18px; }
    }
  </style>
</head>
<body>
<div class="box-container limit-width">
  <section id="settings"></section>
  <div id="spinner-area">
    <div class="spinner">
      <div class="double-bounce1"></div>
      <div class="double-bounce2"></div>
      <div class="spinner-txt">Fillsbase...</div>
    </div>
  </div>
  <div class="body-borders" data-border="20">
    <div class="top-border bg-white"></div>
    <div class="right-border bg-white"></div>
    <div class="bottom-border bg-white"></div>
    <div class="left-border bg-white"></div>
  </div>

  <header id="header"> </header>

  <!-- Hero -->
  <div class="whois-hero">
    <h1><i class="fas fa-search me-2" style="color:var(--primary-color,#00d1b2)"></i> WHOIS Lookup</h1>
    <p>Découvrez les informations d'enregistrement de n'importe quel nom de domaine</p>
    <div class="whois-search-wrap">
      <form method="GET" action="whois.php">
        <div class="whois-search-box">
          <input type="text" name="domain"
                 value="<?php echo htmlspecialchars($domain); ?>"
                 placeholder="Entrez un domaine (ex: fillsbase.com)"
                 autocomplete="off" autocapitalize="none" spellcheck="false" />
          <button type="submit"><i class="fas fa-search me-1"></i> Rechercher</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Results -->
  <div class="whois-content">

    <?php if ($error): ?>
    <div class="whois-error">
      <i class="fas fa-exclamation-circle fa-lg"></i>
      <span><?php echo $error; ?></span>
    </div>
    <?php endif; ?>

    <?php if ($result && !$error): ?>

      <?php if ($summary): ?>
      <div class="whois-summary-card">
        <div class="whois-card-header">
          <i class="fas fa-id-card"></i>
          <span class="title">Résumé d'enregistrement</span>
          <span class="whois-domain-badge"><?php echo htmlspecialchars($domain); ?></span>
        </div>
        <div class="whois-grid">
          <?php foreach ($summary as $label => $value): ?>
          <div class="whois-field">
            <div class="whois-field-label"><?php echo $label; ?></div>
            <div class="whois-field-value"><?php echo $value; ?></div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
      <?php endif; ?>

      <div class="whois-raw-card">
        <div class="whois-raw-header">
          <div class="dots">
            <span style="background:#ff5f56"></span>
            <span style="background:#ffbd2e"></span>
            <span style="background:#27c93f"></span>
          </div>
          <span class="cmd">whois <?php echo htmlspecialchars($domain); ?></span>
          <span class="tag">raw output</span>
        </div>
        <div class="whois-raw-body">
          <pre><?php echo $result; ?></pre>
        </div>
      </div>

    <?php else: ?>
    <div class="whois-summary-card">
      <div class="whois-empty">
        <i class="fas fa-globe"></i>
        <h5>Entrez un nom de domaine pour commencer</h5>
        <p>Obtenez le registrant, les serveurs DNS, les dates de création et d'expiration.</p>
      </div>
    </div>
    <?php endif; ?>

  </div>

  <!-- Feature cards (shown only when no result) -->
  <?php if (!$result): ?>
  <div class="whois-features">
    <div class="whois-feature">
      <i class="fas fa-user-shield"></i>
      <h6>Propriétaire du domaine</h6>
      <p>Identifiez le registrant et ses coordonnées de contact</p>
    </div>
    <div class="whois-feature">
      <i class="fas fa-calendar-alt"></i>
      <h6>Dates clés</h6>
      <p>Création, mise à jour et date d'expiration du domaine</p>
    </div>
    <div class="whois-feature">
      <i class="fas fa-server"></i>
      <h6>Serveurs DNS</h6>
      <p>Consultez les serveurs de noms autoritatifs du domaine</p>
    </div>
  </div>
  <?php endif; ?>

  <footer id="footer"> </footer>
</div>
<script>
$(document).ready(function(){
  var $h = $("#header");
  if($h.length && $.trim($h.html()).length === 0){
    $h.load("header.php");
  }
  var $f = $("#footer");
  if($f.length && $.trim($f.html()).length === 0){
    $f.load("footer.php");
  }
});
</script>
</body>
</html>
