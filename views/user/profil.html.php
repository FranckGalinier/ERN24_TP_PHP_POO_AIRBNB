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
          <!-- <a class ="call-action" href="/add_information_user/<?=$user->id ?>">Add information</a> -->
        <!-- <?php  if($user->information != null) : ?>
          <h3>Adresse : <?= $user->information->address ?></h3>
          <h3>Ville : <?= $user->information->city ?></h3>
          <h3>Code Postal : <?= $user->information->zip_code ?></h3>
          <h3>Pays : <?= $user->information->country ?></h3>
          <h3>Phone : <?= $user->information->phone ?></h3>
      </div>
      <?php else: ?>
        <h3>Vous n'avez pas encore renseigné votre adresse</h3>
        <button class="call-action">Renseigner mon adresse</button>
      </div> -->
      <?php endif ?>
    
    
    </div>
  </div>
</div>
</main>