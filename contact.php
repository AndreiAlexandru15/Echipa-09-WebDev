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
    $errorMsg = 'Toate câmpurile sunt obligatorii.'
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
  <title>Procesare Contact</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/uikit.css">
</head>
<body>
  <div class="uk-container uk-margin-large-top">
    <h2 class="uk-heading-bullet">Rezultat trimitere formular</h2>
    <?php if ($_SERVER['REQUEST_METHOD'] !== 'POST') { ?>
      <div class="uk-alert-warning" uk-alert>
        <p>Acces direct nepermis. Trimiteți formularul de pe pagina de contact.</p>
      </div>
    <?php } else if ($hasError) { ?>
      <div class="uk-alert-danger" uk-alert>
        <p><?php echo $errorMsg ?></p>
        <a href="contact.html" class="uk-button uk-button-default uk-margin-top">Înapoi la contact</a>
      </div>
    <?php } else { ?>
      <div class="uk-card uk-card-default uk-card-body uk-animation-slide-bottom-small">
        <h3 class="uk-card-title">Mesaj trimis cu succes!</h3>
        <p><strong>Nume:</strong> <?php echo $name ?></p>
        <p><strong>Email:</strong> <?php echo $email ?></p>
        <p><strong>Mesaj:</strong> <?php echo nl2br($message) ?></p>
        <a href="index.html" class="uk-button uk-button-primary uk-margin-top">Înapoi la pagina principală</a>
      </div>
    <?php } ?>
  </div>
</body>
</html> 