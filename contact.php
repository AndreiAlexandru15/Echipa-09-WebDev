<?php
// Procesare formular contact
function sanitize ($data) {
  return htmlspecialchars(stripslashes(trim($data)))
}

$name = $email = $message = ''
$hasError = false
$errorMsg = ''

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['message'])) {
    $hasError = true
    $errorMsg = 'Toate câmpurile obligatorii trebuie completate.'
  } else {
    $name = sanitize($_POST['name'])
    $email = sanitize($_POST['email'])
    $message = sanitize($_POST['message'])
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $hasError = true
      $errorMsg = 'Adresa de email nu este validă.'
    }
  }
}
?>
<!DOCTYPE html>
<html lang="ro">
<head>
  <meta charset="UTF-8">
  <title>Contact - AutoExpert</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/uikit.css">
  <style>
    body { font-family: 'Open Sans', sans-serif; }
    h1, h2, h3, h4, h5, h6 { font-family: 'Montserrat', sans-serif; }
  </style>
</head>
<body class="uk-background-muted uk-base">
  <!-- Navbar Sticky + Offcanvas -->
  <header>
    <nav class="uk-navbar-container uk-navbar-sticky" uk-navbar>
      <div class="uk-navbar-left">
        <a class="uk-navbar-item uk-logo" href="index.html">
          <img src="assets/logo.svg" alt="AutoExpert Logo" width="40">
          <span class="uk-visible@m uk-margin-small-left">AutoExpert</span>
        </a>
        <ul class="uk-navbar-nav uk-visible@m">
          <li><a href="index.html">Acasă</a></li>
          <li><a href="about.html">Despre</a></li>
          <li><a href="servicii.html">Servicii</a></li>
          <li class="uk-active"><a href="contact.php">Contact</a></li>
        </ul>
      </div>
      <div class="uk-navbar-right uk-hidden@m">
        <a class="uk-navbar-toggle" uk-navbar-toggle-icon href="#offcanvas-nav" uk-toggle></a>
      </div>
    </nav>
    <div id="offcanvas-nav" uk-offcanvas="overlay: true">
      <div class="uk-offcanvas-bar">
        <ul class="uk-nav uk-nav-default">
          <li><a href="index.html">Acasă</a></li>
          <li><a href="about.html">Despre</a></li>
          <li><a href="servicii.html">Servicii</a></li>
          <li class="uk-active"><a href="contact.php">Contact</a></li>
        </ul>
      </div>
    </div>
  </header>

  <!-- Alertă programare (Alert, Animation, Margin) -->
  <div class="uk-container uk-margin">
    <div class="uk-alert-primary uk-animation-slide-top-small" uk-alert>
      <a class="uk-alert-close" uk-close></a>
      <p><span uk-icon="icon: info"></span> Completează formularul pentru o programare rapidă!</p>
    </div>
  </div>

  <!-- Formular programare + Info contact -->
  <section class="uk-section uk-section-default">
    <div class="uk-container">
      <div class="uk-grid-match uk-child-width-1-2@m uk-child-width-1-1@s uk-flex-center" uk-grid>
        <div>
          <div class="uk-card uk-card-default uk-card-body uk-animation-fade">
            <h2 class="uk-card-title">Formular programare</h2>
            <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && !$hasError) { ?>
              <div class="uk-alert-success" uk-alert>
                <h3 class="uk-card-title">Mesaj trimis cu succes!</h3>
                <p><strong>Nume:</strong> <?php echo $name ?></p>
                <p><strong>Email:</strong> <?php echo $email ?></p>
                <p><strong>Mesaj:</strong> <?php echo nl2br($message) ?></p>
                <a href="contact.php" class="uk-button uk-button-default uk-margin-top">Trimite alt mesaj</a>
              </div>
            <?php } else { ?>
              <?php if ($hasError) { ?>
                <div class="uk-alert-danger" uk-alert>
                  <p><?php echo $errorMsg ?></p>
                </div>
              <?php } ?>
              <form class="uk-form-stacked" method="post" action="contact.php" autocomplete="off">
                <div class="uk-margin">
                  <label class="uk-form-label" for="nume">Nume <span class="uk-text-danger">*</span></label>
                  <div class="uk-form-controls">
                    <input class="uk-input" id="nume" name="name" type="text" placeholder="Numele dvs" required value="<?php echo $name ?>">
                  </div>
                </div>
                <div class="uk-margin">
                  <label class="uk-form-label" for="email">Email <span class="uk-text-danger">*</span></label>
                  <div class="uk-form-controls">
                    <input class="uk-input" id="email" name="email" type="email" placeholder="email@exemplu.com" required value="<?php echo $email ?>">
                  </div>
                </div>
                <div class="uk-margin">
                  <label class="uk-form-label" for="telefon">Telefon</label>
                  <div class="uk-form-controls">
                    <input class="uk-input" id="telefon" name="telefon" type="tel" placeholder="07xxxxxxxx">
                  </div>
                </div>
                <div class="uk-margin">
                  <label class="uk-form-label" for="serviciu">Serviciu dorit</label>
                  <div class="uk-form-controls">
                    <select class="uk-select" id="serviciu" name="serviciu">
                      <option value="">Alege serviciul</option>
                      <option>Diagnoză</option>
                      <option>Reparații mecanice</option>
                      <option>Electrică auto</option>
                      <option>ITP</option>
                    </select>
                  </div>
                </div>
                <div class="uk-margin">
                  <label class="uk-form-label" for="data">Data dorită</label>
                  <div class="uk-form-controls">
                    <input class="uk-input" id="data" name="data" type="date">
                  </div>
                </div>
                <div class="uk-margin">
                  <label class="uk-form-label" for="mesaj">Mesaj <span class="uk-text-danger">*</span></label>
                  <div class="uk-form-controls">
                    <textarea class="uk-textarea" id="mesaj" name="message" rows="4" placeholder="Mesajul dvs" required><?php echo $message ?></textarea>
                  </div>
                </div>
                <div class="uk-margin">
                  <button class="uk-button uk-button-primary" type="submit"><span uk-icon="icon: check"></span> Trimite</button>
                </div>
              </form>
            <?php } ?>
          </div>
        </div>
        <div>
          <div class="uk-card uk-card-secondary uk-card-body uk-animation-fade">
            <h2 class="uk-card-title">Contact</h2>
            <ul class="uk-list uk-list-divider">
              <li><span uk-icon="icon: location"></span> Str. Exemplu 123, București</li>
              <li><span uk-icon="icon: receiver"></span> 0722 123 456</li>
              <li><span uk-icon="icon: mail"></span> contact@autoexpert.ro</li>
              <li><span uk-icon="icon: clock"></span> Luni-Vineri: 08:00 - 18:00</li>
            </ul>
            <div class="uk-margin">
              <a class="uk-button uk-button-default uk-width-1-1" href="https://goo.gl/maps/xyz" target="_blank">
                <span uk-icon="icon: location"></span> Vezi pe hartă
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <hr class="uk-divider-icon">

  <!-- Tabel program (Table, Container, Section, Heading, Width, Margin, Text, Utility, Animation) -->
  <section class="uk-section uk-section-muted">
    <div class="uk-container">
      <h2 class="uk-heading-line uk-text-center"><span>Program Service</span></h2>
      <div class="uk-overflow-auto uk-width-1-1 uk-margin-auto">
        <table class="uk-table uk-table-divider uk-table-striped uk-table-hover uk-width-auto uk-text-center uk-animation-fade">
          <thead>
            <tr>
              <th>Zi</th>
              <th>Program</th>
            </tr>
          </thead>
          <tbody>
            <tr><td>Luni - Vineri</td><td>08:00 - 18:00</td></tr>
            <tr><td>Sâmbătă</td><td>09:00 - 14:00</td></tr>
            <tr><td>Duminică</td><td>Închis</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <!-- Social media și hartă (Flex, Icon, Position, Utility, Visibility, Margin, Padding, Lightbox, Align) -->
  <section class="uk-section uk-section-default uk-padding-small">
    <div class="uk-container">
      <div class="uk-flex uk-flex-center uk-flex-middle uk-child-width-1-2@m uk-child-width-1-1@s uk-grid-small" uk-grid>
        <div class="uk-text-center">
          <h3 class="uk-heading-bullet">Social Media</h3>
          <a href="#" class="uk-icon-button uk-margin-small-right" uk-icon="icon: facebook"></a>
          <a href="#" class="uk-icon-button uk-margin-small-right" uk-icon="icon: instagram"></a>
          <a href="#" class="uk-icon-button" uk-icon="icon: whatsapp"></a>
        </div>
        <div class="uk-text-center">
          <h3 class="uk-heading-bullet">Găsește-ne pe hartă</h3>
          <a href="assets/images/hero.jpg" uk-lightbox data-caption="Locație service">
            <img src="assets/images/hero.jpg" alt="Locație service" width="200" class="uk-border-rounded uk-box-shadow-small">
          </a>
        </div>
      </div>
    </div>
  </section>

  <a href="#" uk-totop uk-scroll class="uk-position-fixed uk-position-bottom-right uk-margin-small-right uk-margin-small-bottom"></a>

  <footer class="uk-section uk-section-secondary uk-light uk-text-center uk-padding-small">
    <div class="uk-container uk-flex uk-flex-center uk-flex-middle">
      <p class="uk-margin-remove">&copy; 2025 AutoExpert Service. Toate drepturile rezervate.</p>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/uikit@3.23.0/dist/js/uikit.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/uikit@3.23.0/dist/js/uikit-icons.min.js"></script>
</body>
</html> 