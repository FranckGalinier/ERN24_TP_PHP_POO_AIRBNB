<?php include(PATH_ROOT . 'views/_templates/_header.html.php'); ?>
<main class="container-form">
  <h1 class="title">Création de compte</h1>
  <!-- Affichage des erreurs s'il y en a -->
  <!-- si form result et form result a une erruer alors on affiche l'erreur -->
  <?php if ($form_result && $form_result->hasErrors()):?>
    <div class="alert alert-danger" role="alert">
      <?= $form_result->getErrors()[0]->getMessage() ?>
    </div>
  <?php endif ?>

  <!-- Formulaire -->
  <form class="auth-form" action="/register" method="POST">
    <div class="box-auth-input">
      <label class="detail-description">Adresse Email</label>
      <input type="email" class="form-control" name="email" placeholder="name@example.com">
    </div>
    <div class="box-auth-input">
      <label class="detail-description">Mot de passe</label><button class="unmask" id="unmask" type="button" title="Afficher ou masquer le mot de passe"><i class="bi bi-eye"></i></button>
      <input type="password" id="mdp" class="form-control" name="password" placeholder="Mininum : 1 majuscule, 1 minuscule, 1 chiffre, 8 caractères">
    </div>
    <div class="box-auth-input">
      <label class="detail-description">Confirmer le mot de passe</label>
      <input type="password" id="mdp1" class="form-control" name="password_confirm">
    </div>
    <div class="box-auth-input">
      <label class="detail-description">Nom</label>
      <input type="text" class="form-control" name="lastname">
    </div>
    <div class="box-auth-input">
      <label class="detail-description">Prénom</label>
      <input type="text" class="form-control" name="firstname">
    </div>
    <button class="call-action" type="submit">Je m'inscris</button>
  </form>

  <p class="header-description">J'ai déjà un compte <a class="auth-link" href="/connexion">Connexion</a></p>
</main>