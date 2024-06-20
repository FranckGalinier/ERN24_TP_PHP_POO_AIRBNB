<?php include(PATH_ROOT . 'views/_templates/_header.html.php'); ?>
<main class="container-form">
  <h1 class="title">Ajouter des informations</h1>
  <!-- Affichage des erreurs s'il y en a -->
  <!-- si form result et form result a une erruer alors on affiche l'erreur -->
  <?php if ($form_result && $form_result->hasErrors()):?>
    <div class="alert alert-danger" role="alert">
      <?= $form_result->getErrors()[0]->getMessage() ?>
    </div>
  <?php endif ?>

  <!-- Formulaire -->
  <form class="auth-form" action="/add_info_user" method="POST">
    <div class="box-auth-input">
      <label class="detail-description">Adresse</label>
      <input type="text" class="form-control" name="address">
    </div>
    <div class="box-auth-input">
      <label class="detail-description">Zip Code</label>
      <input type="number" class="form-control" name="zip_code">
    </div>
    <div class="box-auth-input">
      <label class="detail-description">Ville</label>
      <input type="text" class="form-control" name="city">
    </div>
    <div class="box-auth-input">
      <label class="detail-description">Pays</label>
      <input type="text" class="form-control" name="country">
    </div>
    <div class="box-auth-input">
      <label class="detail-description">Numéro de téléphone</label>
      <input type="number" class="form-control" name="phone">
    </div>
    <button class="call-action" type="submit">J'enregistre mes informations</button>
  </form>

</main>