<?php

use Core\Session\Session;
use App\AppRepoManager; ?>
<?php include(PATH_ROOT . 'views/_templates/_header_hosting.html.php'); ?>
<main class="container-form">
  <div class="d-flex justify-content-center">
    <h1> Ajouter une annonce <h1>
  </div>

  <?php include(PATH_ROOT . 'views/_templates/_message.html.php') ?>

  <form class="auth-form" action="/add-annonce-form" method="POST" enctype="multipart/form-data">

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
        </div>
        <label class="label-description"><?= $type->label ?></label>
      </div>
    <?php endforeach ?>



    <h3>Les équipements</h3>
    <div class="d-flex flex-row flex-wrap">
      <?php foreach (AppRepoManager::getRm()->getEquipementRepository()->getAllEquipement() as $equipements) : ?>

        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" name="equipements[]" value="<?= $equipements->id ?>" role="switch">
        </div>
        <img class="icon-equipement" src="/assets/icons/<?= $equipements->image_path ?>" alt="icones<?= $equipements->label ?>" height="40" width="40">
        <label class="label-description"> <?= $equipements->label ?></label>
      <?php endforeach ?>
    </div>

    <h3>Description</h3>
    <textarea name="description" form-control></textarea>
    <h3>Prix par nuit</h3>
    <input type="number" name="price">
    <label class="label-description" for="price">€</label>
    <h3>Nombre de personnes max</h3>
    <input type="number" name="nb_voyageur" value="1" min="1" max="10">

    <h3>Nombre de chambres max</h3>
    <input type="number" name="nb_rooms" value="1" min="1" max="10">

    <h3>Taille du logement</h3>
    <input type="number" name="size" value="1" min="1" max="500">
    <label class="label-description" for="size">m2</label>

    <h2>Adresse du logement</h2>
    <input type="text" name="address">
    <h3>Ville du logement</h3>
    <input type="text" name="city">
    <h3>ZIPCODE</h3>
    <input type="number" name="zipcode">
    <h3>Pays</h3>
    <input type="text" name="country">
    <h3>Phone</h3>
    <input type="number" name="phone">

    <button class="submit-button" type="submit" class="call-action">Je crée mon annonce</button>
  </form>
</main>