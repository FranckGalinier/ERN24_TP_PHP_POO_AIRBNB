<?php include(PATH_ROOT . 'views/_templates/_header.html.php'); ?>
<?php if ($auth::isAuth()) $auth::redirect('/') ?>
<main class="container-form">
  <h1 class="title">Connexion</h1>
  <!-- Affichage des erreurs s'il y en a -->
  <!-- si form result et form result a une erruer alors on affiche l'erreur -->
  <?php if ($form_result && $form_result->hasErrors()) : ?>
    <div class="alert alert-danger" role="alert">
      <?= $form_result->getErrors()[0]->getMessage() ?>
    </div>
  <?php endif ?>

  <!-- Formulaire -->
  <form class="auth-form" action="/login" method="POST">
    <div class="box-auth-input">
      <label class="detail-description">Adresse Email</label>
      <input type="email" class="form-control" name="email" placeholder="name@example.com" required>
    </div>
    <div class="box-auth-input">
     <label class="detail-description">Mot de passe </label>
     <button class="unmask" id="unmask" type="button" title="Afficher ou masquer le mot de passe"><i class="bi bi-eye"></i></button>
      <input type="password" class="form-control" name="password" id="mdp" placeholder="Mininum : 1 majuscule, 1 minuscule, 1 chiffre, 8 caractères" required>
      
</div>
    <button class="call-action" type="submit">Je me connecte</button>
  </form>

  <p class="header-description">Je n'ai pas de compte <a class="auth-link" href="/inscription">M'inscrire</a></p>
</main>