<?php include(PATH_ROOT . 'views/_templates/_header.html.php'); ?>
<?php use Core\Session\Session; ?>
<div class="container mt-5">
  <div class="card p-4">
  <div class="d-flex justify-content-center">
  <h1><?= $logement->title ?></h1>
  </div> 
    <div class="row">
      <div class="col-md-8 mb-4">
          <?php if (!empty($logement->media)) : ?> 
        <img src="/assets/media/<?= $logement->media[0]->image_path ?>" alt="" class="d-block w-100 img-thumbnail"
         data-toggle="modal" data-target="#imageModal">
        <?php endif; ?> 
      </div>
      <div class="col-md-4">
        <div class="row">
          <?php foreach ($logement->media as $index => $media) : ?>
              <div class="col-6 mb-2">
                 <img src="/assets/media/<?= $media->image_path ?>" alt="" class="img-fluid img-thumbnail thumbnail-img" data-toggle="modal" data-target="#imageModal">
        </div>
    <?php endforeach ?>
      </div>
    </div>
  </div>

  <!-- Titre et prix -->
  <div class="row">
    <div class="col-md-8">
      <p class="price-per-night"><?= $logement->price ?> € par nuit</p>
      <p>
        <?= $logement->nb_traveler ?> Voyageurs <span> · </span>
        <?= $logement->nb_rooms ?> Chambres<span> · </span>
      </p>

      <p></p>
    </div>
  </div>

  <!-- Détails du logement et réservation -->
  <div class="row">
    <hr class="divider">

    <div class="col-md-8">
      <h6 class=""> <span style="font-weight: lighter">Hôte: <?=$logement->user->firstname ?></span></h6>
      <hr class="divider">
      <h2>A propos de ce logement</h2>
      <p class="description"><?= $logement->description ?></p>

      <hr class="divider">
<h3>Inclus dans ce logement :</h2><br>
      <?php
      // Regrouper les équipements par catégorie
      $equipements_par_categorie = [];
      foreach ($logement->equipements as $equipement) {
        $equipements_par_categorie[$equipement->category][] = $equipement;
      }

      // Afficher uniquement la première catégorie avec maximum 5 labels
      $first_category = true;
      
      foreach ($equipements_par_categorie as $category => $equipements) :
      ?>
        <div id="<?= strtolower(str_replace(' ', '_', $category)) ?>">
          <?php if ($first_category) : ?>
            
            <h4><?= $category ?></h4>
            <ul class="amenities">
              <?php
              $count = 0;
              foreach ($equipements as $equipement) :
                if ($count < 5) : // Limite à 5 labels
              ?>
                  <li>
                    <img src="/assets/icons/<?= $equipement->image_path ?>" alt="<?= $equipement->label ?>" class="img-fluid" style="width: 32px; height: 32px;">
                    <?= $equipement->label ?>
                  </li>
                <?php
                  $count++;
                endif;
              endforeach;

              $remaining = count($equipements) - 5; // Calculer le nombre d'équipements restants
              if ($remaining > 0) :
                ?>
                <li>
                  <button type="button" class="btn btn-link" data-toggle="modal" data-target="#allCategoriesModal" style="text-decoration: underline; color: #008489; font-size: 14px;">
                    Voir toutes les catégories
                  </button>
                </li>
              <?php endif; ?>
            </ul>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>

      <!-- Modal pour afficher toutes les catégories et leurs équipements -->
      <div class="modal fade" id="allCategoriesModal" tabindex="-1" role="dialog" aria-labelledby="allCategoriesModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">tipi sur la plage"<data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <?php foreach ($equipements_par_categorie as $category => $equipements) : ?>
                <h2><?= $category ?></h2>
                <ul class="amenities">
                  <?php foreach ($equipements as $equipement) : ?>
                    <li>
                      <img src="/assets/icons/<?= $equipement->image_path ?>" alt="<?= $equipement->label ?>" class="img-fluid" style="width: 32px; height: 32px;">
                      <?= $equipement->label ?>
                    </li>
                  <?php endforeach; ?>
                </ul>
              <?php endforeach; ?>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php if ($auth::isAuth()) : ?>

    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
          <h3 class="card-title">Réservez maintenant</h3>
          <form action="/add/reservation" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="logement_id" value="<?= $logement->id ?>">
            <input type="hidden" name="user_logement" value="<?= $logement->user_id?>">
            <input type="hidden" name="user_id" value="<?= Session::get(Session::USER)->id ?>">
            <input type="hidden" name="price" value="<?= $logement->price ?>">
            <div class="form-group">
              <label for="checkin">Date d'arrivée</label>
              <input type="date" min="<?= date("Y-m-d") ?>" name="date_start" class="form-control" id="checkin">
            </div>
            <div class="form-group">
              <label for="checkout">Date de départ</label>
              <input type="date" name="date_end"class="form-control" id="checkout">
            </div>
            <div>
              <label for="nb-child">Nombre d'enfants</label>
              <input type="number" name="nb_child"class="form-control">
            </div>
            <label for="nb-adult">Nombre d'adultes</label>
            <input type="number" name="nb_adult"class="form-control">

            <div>
              <p><?= $logement->price ?> €/nuit</p>
            </div>
            <div>
            <?php include(PATH_ROOT . 'views/_templates/_message.html.php') ?>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Réserver</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div><?php
else : ?>
<p>Connectez-vous pour réserver</p>
<?php endif ?>
<!-- Modal pour les images avec carousel -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="imageModalLabel">Photo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="imageCarousel" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            <?php foreach ($logement->media as $index => $media) : ?>
              <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                <img src="/assets/media/<?= $media->image_path ?>" alt="" class="d-block w-100">
              </div>
            <?php endforeach ?>
          </div>
          <a class="carousel-control-prev" href="#imageCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#imageCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
    </div>
  </div>
