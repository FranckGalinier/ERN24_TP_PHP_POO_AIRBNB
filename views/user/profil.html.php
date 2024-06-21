<main>
<?php include(PATH_ROOT . 'views/_templates/_header.html.php'); ?>
<div class="admin-container container-form">
  <div class="d-flex justify-content-center">
    <h1 class="title">Mon Profil <h1>
  </div>
      <div class="d-flex flex-row flex-wrap my-3 justify-content-center">
      <div class="card m-2">
        <div class="card-body">
          <h3>Prénom : <?= $user->lastname ?></h3>
          <h3>Nom : <?= $user->firstname ?></h3>
          <h3>Email : <?= $user->email ?></h3>
    
    </div>
  </div>
</div>
</main>