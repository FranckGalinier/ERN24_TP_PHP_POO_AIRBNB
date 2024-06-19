<?php include(PATH_ROOT . 'views/_templates/_header.html.php'); ?>
<?php

use Core\Session\Session; ?>
<main>
  <div class="admin-container">
<div class="container mt-5">
  <div class="card p-4">

    <h1><?= $logement->information->city ?> : <?= $logement->title ?></h1>

    <div class="row">
      <div class="col-md-8 mb-4">
        <?php if (!empty($logement->media)) : ?>
          <img src="/assets/media/<?= $logement->media[0]->image_path ?>" alt="" class="d-block w-100 img-thumbnail" data-toggle="modal" data-target="#imageModal">
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
        <h1><?= $logement->type_logement->label ?> - <?= $logement->information->city ?>, <?= $logement->information->country ?> </h1>

        <p>
          <?= $logement->nb_traveler ?> Voyageurs <span> · </span>
          <?= $logement->nb_rooms ?> Chambres
        </p>

      </div>
    </div>

    <!-- Détails du logement et réservation -->
    <div class="row">
      <hr class="divider">

      <div class="col-md-8">
        <h6 class=""><i class="bi bi-person-circle"></i><span style="font-weight: lighter"> Hôte: <?= $logement->user->firstname ?></span></h6>
        <hr class="divider">
        <h1>A propos de ce logement</h1>
        <p class="description"><?= $logement->description ?></p>

        <hr class="divider">
        <h1>Inclus dans ce logement :</h1><br>
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
              <p class="price-par-night"><span id="nightPrice"><?= $logement->price ?></span> € / nuit</p>
              <form action="/add/reservation" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="logement_id" value="<?= $logement->id ?>">
                <input type="hidden" name="user_logement" value="<?= $logement->user_id ?>">
                <input type="hidden" name="user_id" value="<?= Session::get(Session::USER)->id ?>">
                <input type="hidden" name="price" value="<?= $logement->price ?>">
                <input type="hidden" name="nb_traveler" value="<?= $logement->nb_traveler ?>">
                <div class=" form-group">
                  <label for="checkin">Date d'arrivée</label>
                  <input type="date" min="<?= date("Y-m-d") ?>" name="date_start" class="form-control" id="start_date">
                </div>
                <div class="form-group">
                  <label for="checkout">Date de départ</label>
                  <input type="date" name="date_end" class="form-control" id="end_date">
                </div>
                <div>
                  <label for="nb-child">Nombre d'enfants</label>
                  <input type="number" name="nb_child" class="form-control">
                </div>
                <label for="nb-adult">Nombre d'adultes</label>
                <input type="number" name="nb_adult" class="form-control">
                <div>
                  
                <div class="container">
                    <div class="form-wrapper">
                    <!-- Ici on va afficher le total de nombre de nuit en fonction de ce qui est choisit dans le calendrier -->
                    <div class="container">
   
                </div>

        
                      <script>
                      
                      // convert today date to input format
                      
                      const today = new Date().toISOString().split("T")[0];
                      
                      start_date.value = today;
                      start_date.min = today;
                      
                      // tomorrow date calc
                      
                      let tomorrow = new Date();
                      tomorrow.setDate(tomorrow.getDate() + 1);
                      
                      // convert to input format
                      let tomorrowFormat = tomorrow.toISOString().split("T")[0];
                      end_date.value = tomorrowFormat;
                      end_date.min = tomorrowFormat;
                      
                      start_date.addEventListener("change", (e) => {
                        let day = new Date(e.target.value);
                      
                        if (end_date.value < start_date.value) {
                          day.setDate(day.getDate() + 1);
                          end_date.value = day.toISOString().split("T")[0];
                        }
                      });
                      
                      end_date.addEventListener("change", (e) => {
                        let day = new Date(e.target.value);
                      
                        if (end_date.value < start_date.value) {
                          day.setDate(day.getDate() - 1);
                          start_date.value = day.toISOString().split("T")[0];
                        }
                      });
                      
                      let bookingCalc = () => {
                        let diffTime = Math.abs(
                          new Date(end_date.value) - new Date(start_date.value)
                        );
                        let diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                        console.log(diffDays);
                      
                        total.textContent = diffDays * nightPrice.textContent;
                      };
                      
                      start_date.addEventListener("change", bookingCalc);
                      end_date.addEventListener("change", bookingCalc);
                      
                      

                        let spanValue = document.getElementById('total').innerText;
                        let diffDays = document.getElementById('day').innerText;
                      

                        console.log(diffDays);
                      
                      </script>
                      <p class="price-total">Prix total : <span id="total" name="price"></span> €</p>
                    </div>
                  </div>
                </div>
                <div>
                  <?php include(PATH_ROOT . 'views/_templates/_message.html.php') ?>
                </div>
                <button type="submit" class="call-action">Réserver</button>
              </form>
          </div>
        </div>
    </div>
  </div>
</div>
<?php else: ?>
  <div class="col-md-4">
    <div class="card">
      <div class="card-body">
        <h1 class="price-per-night"><?= $logement->price ?> € par nuit</h1>
        <a href="/connexion" class="call-action">Connectez-vous pour réserver</a>
      </div>
    </div>
  </div>
  </div>
  </div>
  </div>
<?php
      endif ?>
      </div>
</main>