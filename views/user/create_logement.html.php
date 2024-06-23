<?php

use Core\Session\Session;
use App\AppRepoManager; ?>
<?php include(PATH_ROOT . 'views/_templates/_header_hosting.html.php'); ?>
<main>
  <div class="admin-container container-form">
  <div class="d-flex justify-content-center">
    <h1 class="title"> Ajouter une annonce <h1>
  </div>

  <?php include(PATH_ROOT . 'views/_templates/_message.html.php') ?>

  <form class="auth-form" action="/add-annonce-form" method="POST" enctype="multipart/form-data">
  <div class="div-form" width="100%">
  <div class="card p-4">
    <input type="hidden" name="user_id" value="<?= Session::get(Session::USER)->id  ?>">
    <h3>Le nom du logement</h3>
    <div class="box-auth-input">
      <input type="text" name="name" class="form-control">
    </div>
    <h3>Type de logement</h3>

    <?php foreach (AppRepoManager::getRm()->getTypeLogementRepository()->getAllTypeLogement() as $type) :

    ?> <div class="d-flex align-items-center">
        <div class="list-size-input me-2">
          <input type="radio" name="typeId" value="<?= $type->id ?>"> 
          <label class=""><?= $type->label ?></label>
        </div>
       
      </div><?php endforeach ?>
      <h3>Ajouter une image</h3> 
      <input type="text" name="label_image" class="form-control mb-3" placeholder="Ajouter un titre à l'image">
      <input type="file" name="image_logement" size="30">
      

</div>
<div class="card p-4">
 <h3>Description</h3>
    <textarea name="description" class="form-control" form-control></textarea>
    <h3>Prix par nuit (€)</h3>
    <input type="number" class="form-control" name="price">
    <label class="label-description" for="price"></label>
    <h3>Nombre de personnes max</h3>
    <input type="number" class="form-control" name="nb_voyageur" value="1" min="1" max="10">

    <h3>Nombre de chambres max</h3>
    <input type="number" class="form-control" name="nb_rooms" value="1" min="1" max="10">

    <h3>Taille du logement (m2)</h3>
    <input type="number" class="form-control" name="size" value="1" min="1" max="500">
    <label class="label-description" for="size"></label>
</div>
<div class="card p-4">
<h3>Adresse du logement</h3>
    <input type="text" class="form-control" name="address">
    <h3>Ville du logement</h3>
    <input type="text" class="form-control" name="city">
    <h3>Code Postal</h3>
    <input type="number" class="form-control" name="zipcode">
    <h3>Pays</h3>
    <input type="text"class="form-control" name="country">
    <h3>Phone</h3>
    <input type="number" class="form-control" name="phone">
  </div>
</div>
<div class="card p-4 d-flex justify-content-center align-items-center mb-5 ">
    <h3 class="text-align-center">Les équipements</h3>
    <div class="d-flex flex-start col-12 flex-wrap ">
      <?php foreach (AppRepoManager::getRm()->getEquipementRepository()->getAllEquipement() as $equipements) : ?>
        <div class="d-flex justify-content-center align-items-center m-4 card p-4">
        <div class="form-check form-switch">
        <input type="checkbox" class="form-check-input" name="equipements[]" value="<?= $equipements->id ?>" role="switch">
  
        <img class="icon-equipement" src="/assets/icons/<?= $equipements->image_path ?>" alt="icones<?= $equipements->label ?>" height="40" width="40">
        <label class="form-check-label"> <?= $equipements->label ?></label>
        </div>
      </div>
      <?php endforeach ?>
    </div>
  </div>
   

    

    <button type="submit" class="call-action">Je crée mon annonce</button>
  </form>
  </div>
</main>